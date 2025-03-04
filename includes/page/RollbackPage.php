<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

namespace MediaWiki\Page;

use ActorMigration;
use CommentStoreComment;
use ManualLogEntry;
use MediaWiki\Config\ServiceOptions;
use MediaWiki\HookContainer\HookContainer;
use MediaWiki\HookContainer\HookRunner;
use MediaWiki\Message\Converter;
use MediaWiki\Permissions\Authority;
use MediaWiki\Permissions\PermissionStatus;
use MediaWiki\Revision\RevisionRecord;
use MediaWiki\Revision\RevisionStore;
use MediaWiki\Revision\SlotRecord;
use MediaWiki\Storage\EditResult;
use MediaWiki\User\ActorNormalization;
use MediaWiki\User\UserFactory;
use MediaWiki\User\UserIdentity;
use Message;
use RawMessage;
use ReadOnlyMode;
use RecentChange;
use Revision;
use StatusValue;
use TitleFormatter;
use TitleValue;
use Wikimedia\Message\MessageValue;
use Wikimedia\Rdbms\IDatabase;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Logic for page rollbacks.
 * @since 1.37
 * @package MediaWiki\Page
 */
class RollbackPage {

	/**
	 * @internal for use in PageCommandFactory only
	 * @var array
	 */
	public const CONSTRUCTOR_OPTIONS = [
		'UseRCPatrol',
		'DisableAnonTalk',
	];

	/** @var ServiceOptions */
	private $options;

	/** @var ILoadBalancer */
	private $loadBalancer;

	/** @var UserFactory */
	private $userFactory;

	/** @var ReadOnlyMode */
	private $readOnlyMode;

	/** @var TitleFormatter */
	private $titleFormatter;

	/** @var RevisionStore */
	private $revisionStore;

	/** @var HookContainer */
	private $hookContainer;

	/** @var HookRunner */
	private $hookRunner;

	/** @var WikiPageFactory */
	private $wikiPageFactory;

	/** @var ActorMigration */
	private $actorMigration;

	/** @var ActorNormalization */
	private $actorNormalization;

	/** @var PageIdentity */
	private $page;

	/** @var Authority */
	private $performer;

	/** @var UserIdentity who made the edits we are rolling back */
	private $byUser;

	/** @var string */
	private $summary = '';

	/** @var bool */
	private $bot = false;

	/** @var string[] */
	private $tags = [];

	/**
	 * @param ServiceOptions $options
	 * @param ILoadBalancer $loadBalancer
	 * @param UserFactory $userFactory
	 * @param ReadOnlyMode $readOnlyMode
	 * @param RevisionStore $revisionStore
	 * @param TitleFormatter $titleFormatter
	 * @param HookContainer $hookContainer
	 * @param WikiPageFactory $wikiPageFactory
	 * @param ActorMigration $actorMigration
	 * @param ActorNormalization $actorNormalization
	 * @param PageIdentity $page
	 * @param Authority $performer
	 * @param UserIdentity $byUser who made the edits we are rolling back
	 */
	public function __construct(
		ServiceOptions $options,
		ILoadBalancer $loadBalancer,
		UserFactory $userFactory,
		ReadOnlyMode $readOnlyMode,
		RevisionStore $revisionStore,
		TitleFormatter $titleFormatter,
		HookContainer $hookContainer,
		WikiPageFactory $wikiPageFactory,
		ActorMigration $actorMigration,
		ActorNormalization $actorNormalization,
		PageIdentity $page,
		Authority $performer,
		UserIdentity $byUser
	) {
		$options->assertRequiredOptions( self::CONSTRUCTOR_OPTIONS );
		$this->options = $options;
		$this->loadBalancer = $loadBalancer;
		$this->userFactory = $userFactory;
		$this->readOnlyMode = $readOnlyMode;
		$this->revisionStore = $revisionStore;
		$this->titleFormatter = $titleFormatter;
		$this->hookContainer = $hookContainer;
		$this->hookRunner = new HookRunner( $hookContainer );
		$this->wikiPageFactory = $wikiPageFactory;
		$this->actorMigration = $actorMigration;
		$this->actorNormalization = $actorNormalization;

		$this->page = $page;
		$this->performer = $performer;
		$this->byUser = $byUser;
	}

	/**
	 * Set custom edit summary.
	 *
	 * @param string|null $summary
	 * @return $this
	 */
	public function setSummary( ?string $summary ): self {
		$this->summary = $summary ?: '';
		return $this;
	}

	/**
	 * Mark all reverted edits as bot.
	 *
	 * @param bool|null $bot
	 * @return $this
	 */
	public function markAsBot( ?bool $bot ): self {
		if ( $bot && $this->performer->isAllowedAny( 'markbotedits', 'bot' ) ) {
			$this->bot = true;
		} elseif ( !$bot ) {
			$this->bot = false;
		}
		return $this;
	}

	/**
	 * Change tags to apply to the rollback.
	 *
	 * @note Callers are responsible for permission checks (with ChangeTags::canAddTagsAccompanyingChange)
	 *
	 * @param string[]|null $tags
	 * @return $this
	 */
	public function setChangeTags( ?array $tags ): self {
		$this->tags = $tags ?: [];
		return $this;
	}

	/**
	 * Authorize the rollback.
	 *
	 * @return PermissionStatus
	 */
	public function authorizeRollback(): PermissionStatus {
		$permissionStatus = PermissionStatus::newEmpty();
		$this->performer->authorizeWrite( 'edit', $this->page, $permissionStatus );
		$this->performer->authorizeWrite( 'rollback', $this->page, $permissionStatus );

		if ( $this->readOnlyMode->isReadOnly() ) {
			$permissionStatus->fatal( 'readonlytext' );
		}

		$user = $this->userFactory->newFromAuthority( $this->performer );
		if ( $user->pingLimiter( 'rollback' ) || $user->pingLimiter() ) {
			$permissionStatus->fatal( 'actionthrottledtext' );
		}
		return $permissionStatus;
	}

	/**
	 * Rollback the most recent consecutive set of edits to a page
	 * from the same user; fails if there are no eligible edits to
	 * roll back to, e.g. user is the sole contributor. This function
	 * performs permissions checks and executes ::rollback.
	 *
	 * @return StatusValue see ::rollback for return value documentation.
	 *   In case the rollback is not allowed, PermissionStatus is returned.
	 */
	public function rollbackIfAllowed(): StatusValue {
		$permissionStatus = $this->authorizeRollback();
		if ( !$permissionStatus->isGood() ) {
			return $permissionStatus;
		}
		return $this->rollback();
	}

	/**
	 * Backend implementation of rollbackIfAllowed().
	 *
	 * @note This function does NOT check ANY permissions, it just commits the
	 * rollback to the DB. Therefore, you should only call this function directly
	 * if you want to use custom permissions checks. If you don't, use
	 * ::rollbackIfAllowed() instead.
	 *
	 * @return StatusValue On success, wrapping the array with the following keys:
	 *   'summary' - rollback edit summary
	 *   'current-revision-record' - revision record that was current before rollback
	 *   'target-revision-record' - revision record we are rolling back to
	 *   'newid' => the id of the rollback revision
	 *   'tags' => the tags applied to the rollback
	 */
	public function rollback() {
		// Begin revision creation cycle by creating a PageUpdater.
		// If the page is changed concurrently after grabParentRevision(), the rollback will fail.
		// TODO: move PageUpdater to PageStore or PageUpdaterFactory or something?
		$updater = $this->wikiPageFactory->newFromTitle( $this->page )->newPageUpdater( $this->performer );
		$currentRevision = $updater->grabParentRevision();

		if ( !$currentRevision ) {
			// Something wrong... no page?
			return StatusValue::newFatal( 'notanarticle' );
		}

		$currentEditor = $currentRevision->getUser( RevisionRecord::RAW );
		$currentEditorForPublic = $currentRevision->getUser( RevisionRecord::FOR_PUBLIC );
		// User name given should match up with the top revision.
		if ( !$this->byUser->equals( $currentEditor ) ) {
			$result = StatusValue::newGood( [
				'current-revision-record' => $currentRevision
			] );
			$result->fatal(
				'alreadyrolled',
				htmlspecialchars( $this->titleFormatter->getPrefixedText( $this->page ) ),
				htmlspecialchars( $this->byUser->getName() ),
				htmlspecialchars( $currentEditorForPublic ? $currentEditorForPublic->getName() : '' )
			);
			return $result;
		}

		$dbw = $this->loadBalancer->getConnectionRef( DB_MASTER );

		// TODO: move this query to RevisionSelectQueryBuilder when it's available
		// Get the last edit not by this person...
		// Note: these may not be public values
		$actorWhere = $this->actorMigration->getWhere( $dbw, 'rev_user', $currentEditor );
		$targetRevisionRow = $dbw->selectRow(
			[ 'revision' ] + $actorWhere['tables'],
			[ 'rev_id', 'rev_timestamp', 'rev_deleted' ],
			[
				'rev_page' => $currentRevision->getPageId(),
				'NOT(' . $actorWhere['conds'] . ')',
			],
			__METHOD__,
			[
				'USE INDEX' => [ 'revision' => 'page_timestamp' ],
				'ORDER BY' => [ 'rev_timestamp DESC', 'rev_id DESC' ]
			],
			$actorWhere['joins']
		);

		if ( $targetRevisionRow === false ) {
			// No one else ever edited this page
			return StatusValue::newFatal( 'cantrollback' );
		} elseif ( $targetRevisionRow->rev_deleted & RevisionRecord::DELETED_TEXT
			|| $targetRevisionRow->rev_deleted & RevisionRecord::DELETED_USER
		) {
			// Only admins can see this text
			return StatusValue::newFatal( 'notvisiblerev' );
		}

		// Generate the edit summary if necessary
		$targetRevision = $this->revisionStore
			->getRevisionById( $targetRevisionRow->rev_id, RevisionStore::READ_LATEST );

		// Save
		$flags = EDIT_UPDATE | EDIT_INTERNAL;

		if ( $this->performer->isAllowed( 'minoredit' ) ) {
			$flags |= EDIT_MINOR;
		}

		if ( $this->bot ) {
			$flags |= EDIT_FORCE_BOT;
		}

		// TODO: MCR: also log model changes in other slots, in case that becomes possible!
		$currentContent = $currentRevision->getContent( SlotRecord::MAIN );
		$targetContent = $targetRevision->getContent( SlotRecord::MAIN );
		$changingContentModel = $targetContent->getModel() !== $currentContent->getModel();

		// Build rollback revision:
		// Restore old content
		// TODO: MCR: test this once we can store multiple slots
		foreach ( $targetRevision->getSlots()->getSlots() as $slot ) {
			$updater->inheritSlot( $slot );
		}

		// Remove extra slots
		// TODO: MCR: test this once we can store multiple slots
		foreach ( $currentRevision->getSlotRoles() as $role ) {
			if ( !$targetRevision->hasSlot( $role ) ) {
				$updater->removeSlot( $role );
			}
		}

		$updater->setOriginalRevisionId( $targetRevision->getId() );
		$oldestRevertedRevision = $this->revisionStore->getNextRevision(
			$targetRevision,
			RevisionStore::READ_LATEST
		);
		if ( $oldestRevertedRevision !== null ) {
			$updater->markAsRevert(
				EditResult::REVERT_ROLLBACK,
				$oldestRevertedRevision->getId(),
				$currentRevision->getId()
			);
		}

		// TODO: this logic should not be in the storage layer, it's here for compatibility
		// with 1.31 behavior. Applying the 'autopatrol' right should be done in the same
		// place the 'bot' right is handled, which is currently in EditPage::attemptSave.
		if ( $this->options->get( 'UseRCPatrol' ) &&
			$this->performer->authorizeWrite( 'autopatrol', $this->page )
		) {
			$updater->setRcPatrolStatus( RecentChange::PRC_AUTOPATROLLED );
		}

		$summary = $this->getSummary( $currentRevision, $targetRevision );

		// Actually store the rollback
		$rev = $updater->saveRevision(
			CommentStoreComment::newUnsavedComment( $summary ),
			$flags
		);

		// This is done even on edit failure to have patrolling in that case (T64157).
		$this->updateRecentChange( $dbw, $currentRevision, $targetRevision );

		if ( !$updater->wasSuccessful() ) {
			return $updater->getStatus();
		}

		// Report if the edit was not created because it did not change the content.
		if ( $updater->isUnchanged() ) {
			$result = StatusValue::newGood( [
				'current-revision-record' => $currentRevision
			] );
			$result->fatal(
				'alreadyrolled',
				htmlspecialchars( $this->titleFormatter->getPrefixedText( $this->page ) ),
				htmlspecialchars( $this->byUser->getName() ),
				htmlspecialchars( $currentEditorForPublic ? $currentEditorForPublic->getName() : '' )
			);
			return $result;
		}

		if ( $changingContentModel ) {
			// If the content model changed during the rollback,
			// make sure it gets logged to Special:Log/contentmodel
			$log = new ManualLogEntry( 'contentmodel', 'change' );
			$log->setPerformer( $this->performer->getUser() );
			$log->setTarget( new TitleValue( $this->page->getNamespace(), $this->page->getDBkey() ) );
			$log->setComment( $summary );
			$log->setParameters( [
				'4::oldmodel' => $currentContent->getModel(),
				'5::newmodel' => $targetContent->getModel(),
			] );

			$logId = $log->insert( $dbw );
			$log->publish( $logId );
		}

		// Hook is hard deprecated since 1.35
		$user = $this->userFactory->newFromAuthority( $this->performer );
		$wikiPage = $this->wikiPageFactory->newFromTitle( $this->page );
		if ( $this->hookContainer->isRegistered( 'ArticleRollbackComplete' ) ) {
			// Only create the Revision objects if needed
			$legacyCurrent = new Revision( $currentRevision );
			$legacyTarget = new Revision( $targetRevision );
			$this->hookRunner->onArticleRollbackComplete( $wikiPage, $user,
				$legacyTarget, $legacyCurrent );
		}

		$this->hookRunner->onRollbackComplete( $wikiPage, $user, $targetRevision, $currentRevision );

		return StatusValue::newGood( [
			'summary' => $summary,
			'current-revision-record' => $currentRevision,
			'target-revision-record' => $targetRevision,
			'newid' => $rev->getId(),
			'tags' => array_merge( $this->tags, $updater->getEditResult()->getRevertTags() )
		] );
	}

	/**
	 * Set patrolling and bot flag on the edits, which gets rolled back.
	 *
	 * @param IDatabase $dbw
	 * @param RevisionRecord $current
	 * @param RevisionRecord $target
	 */
	private function updateRecentChange(
		IDatabase $dbw,
		RevisionRecord $current,
		RevisionRecord $target
	) {
		$set = [];
		if ( $this->bot ) {
			// Mark all reverted edits as bot
			$set['rc_bot'] = 1;
		}

		if ( $this->options->get( 'UseRCPatrol' ) ) {
			// Mark all reverted edits as patrolled
			$set['rc_patrolled'] = RecentChange::PRC_AUTOPATROLLED;
		}

		if ( $set ) {
			$actorId = $this->actorNormalization
				->acquireActorId( $current->getUser( RevisionRecord::RAW ), $dbw );
			$dbw->update(
				'recentchanges',
				$set,
				[ /* WHERE */
					'rc_cur_id' => $current->getPageId(),
					'rc_timestamp > ' . $dbw->addQuotes( $dbw->timestamp( $target->getTimestamp() ) ),
					'rc_actor' => $actorId
				],
				__METHOD__
			);
		}
	}

	/**
	 * Generate and format summary for the rollback.
	 *
	 * @param RevisionRecord $current
	 * @param RevisionRecord $target
	 * @return string
	 */
	private function getSummary( RevisionRecord $current, RevisionRecord $target ): string {
		$currentEditorForPublic = $current->getUser( RevisionRecord::FOR_PUBLIC );
		if ( !$this->summary ) {
			if ( !$currentEditorForPublic ) { // no public user name
				$summary = MessageValue::new( 'revertpage-nouser' );
			} elseif ( $this->options->get( 'DisableAnonTalk' ) && !$currentEditorForPublic->isRegistered() ) {
				$summary = MessageValue::new( 'revertpage-anon' );
			} else {
				$summary = MessageValue::new( 'revertpage' );
			}
		} else {
			$summary = $this->summary;
		}

		$targetEditorForPublic = $target->getUser( RevisionRecord::FOR_PUBLIC );
		// Allow the custom summary to use the same args as the default message
		$args = [
			$targetEditorForPublic ? $targetEditorForPublic->getName() : null,
			$currentEditorForPublic ? $currentEditorForPublic->getName() : null,
			$target->getId(),
			Message::dateTimeParam( $target->getTimestamp() ),
			$current->getId(),
			Message::dateTimeParam( $current->getTimestamp() ),
		];
		if ( $summary instanceof MessageValue ) {
			$summary = ( new Converter() )->convertMessageValue( $summary );
			$summary = $summary->params( $args )->inContentLanguage()->text();
		} else {
			$summary = ( new RawMessage( $summary, $args ) )->inContentLanguage()->plain();
		}

		// Trim spaces on user supplied text
		return trim( $summary );
	}
}
