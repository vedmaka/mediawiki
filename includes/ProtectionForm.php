<?php
/**
 * Page protection
 *
 * Copyright © 2005 Brion Vibber <brion@pobox.com>
 * https://www.mediawiki.org/
 *
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

use MediaWiki\HookContainer\HookRunner;
use MediaWiki\MediaWikiServices;
use MediaWiki\Permissions\PermissionManager;
use MediaWiki\Watchlist\WatchlistManager;

/**
 * Handles the page protection UI and backend
 */
class ProtectionForm {
	/** @var array A map of action to restriction level, from request or default */
	protected $mRestrictions = [];

	/** @var string The custom/additional protection reason */
	protected $mReason = '';

	/** @var string The reason selected from the list, blank for other/additional */
	protected $mReasonSelection = '';

	/** @var bool True if the restrictions are cascading, from request or existing protection */
	protected $mCascade = false;

	/** @var array Map of action to "other" expiry time. Used in preference to mExpirySelection. */
	protected $mExpiry = [];

	/**
	 * @var array Map of action to value selected in expiry drop-down list.
	 * Will be set to 'othertime' whenever mExpiry is set.
	 */
	protected $mExpirySelection = [];

	/** @var array Permissions errors for the protect action */
	protected $mPermErrors = [];

	/** @var array Types (i.e. actions) for which levels can be selected */
	protected $mApplicableTypes = [];

	/** @var array Map of action to the expiry time of the existing protection */
	protected $mExistingExpiry = [];

	/** @var Article */
	protected $mArticle;

	/** @var Title */
	protected $mTitle;

	/** @var bool */
	protected $disabled;

	/** @var array */
	protected $disabledAttrib;

	/** @var IContextSource */
	private $mContext;

	/** @var WebRequest */
	private $mRequest;

	/** @var User */
	private $mUser;

	/** @var Language */
	private $mLang;

	/** @var OutputPage */
	private $mOut;

	/** @var PermissionManager */
	private $permManager;

	/**
	 * @var WatchlistManager
	 */
	private $watchlistManager;

	/** @var HookRunner */
	private $hookRunner;

	public function __construct( Article $article ) {
		// Set instance variables.
		$this->mArticle = $article;
		$this->mTitle = $article->getTitle();
		$this->mApplicableTypes = $this->mTitle->getRestrictionTypes();
		$this->mContext = $article->getContext();
		$this->mRequest = $this->mContext->getRequest();
		$this->mUser = $this->mContext->getUser();
		$this->mOut = $this->mContext->getOutput();
		$this->mLang = $this->mContext->getLanguage();

		$services = MediaWikiServices::getInstance();
		$this->permManager = $services->getPermissionManager();
		$this->hookRunner = new HookRunner( $services->getHookContainer() );
		$this->watchlistManager = $services->getWatchlistManager();

		// Check if the form should be disabled.
		// If it is, the form will be available in read-only to show levels.
		$this->mPermErrors = $this->permManager->getPermissionErrors(
			'protect',
			$this->mUser,
			$this->mTitle,
			$this->mRequest->wasPosted()
				? PermissionManager::RIGOR_SECURE
				: PermissionManager::RIGOR_FULL // T92357
		);
		if ( wfReadOnly() ) {
			$this->mPermErrors[] = [ 'readonlytext', wfReadOnlyReason() ];
		}
		$this->disabled = $this->mPermErrors !== [];
		$this->disabledAttrib = $this->disabled ? [ 'disabled' => 'disabled' ] : [];

		$this->loadData();
	}

	/**
	 * Loads the current state of protection into the object.
	 */
	private function loadData() {
		$levels = $this->permManager->getNamespaceRestrictionLevels(
			$this->mTitle->getNamespace(), $this->mUser
		);

		$this->mCascade = $this->mTitle->areRestrictionsCascading();
		$this->mReason = $this->mRequest->getText( 'mwProtect-reason' );
		$this->mReasonSelection = $this->mRequest->getText( 'wpProtectReasonSelection' );
		$this->mCascade = $this->mRequest->getBool( 'mwProtect-cascade', $this->mCascade );

		foreach ( $this->mApplicableTypes as $action ) {
			// @todo FIXME: This form currently requires individual selections,
			// but the db allows multiples separated by commas.

			// Pull the actual restriction from the DB
			$this->mRestrictions[$action] = implode( '', $this->mTitle->getRestrictions( $action ) );

			if ( !$this->mRestrictions[$action] ) {
				// No existing expiry
				$existingExpiry = '';
			} else {
				$existingExpiry = $this->mTitle->getRestrictionExpiry( $action );
			}
			$this->mExistingExpiry[$action] = $existingExpiry;

			$requestExpiry = $this->mRequest->getText( "mwProtect-expiry-$action" );
			$requestExpirySelection = $this->mRequest->getVal( "wpProtectExpirySelection-$action" );

			if ( $requestExpiry ) {
				// Custom expiry takes precedence
				$this->mExpiry[$action] = $requestExpiry;
				$this->mExpirySelection[$action] = 'othertime';
			} elseif ( $requestExpirySelection ) {
				// Expiry selected from list
				$this->mExpiry[$action] = '';
				$this->mExpirySelection[$action] = $requestExpirySelection;
			} elseif ( $existingExpiry ) {
				// Use existing expiry in its own list item
				$this->mExpiry[$action] = '';
				$this->mExpirySelection[$action] = $existingExpiry;
			} else {
				// Catches 'infinity' - Existing expiry is infinite, use "infinite" in drop-down
				// Final default: infinite
				$this->mExpiry[$action] = '';
				$this->mExpirySelection[$action] = 'infinite';
			}

			$val = $this->mRequest->getVal( "mwProtect-level-$action" );
			if ( isset( $val ) && in_array( $val, $levels ) ) {
				$this->mRestrictions[$action] = $val;
			}
		}
	}

	/**
	 * Get the expiry time for a given action, by combining the relevant inputs.
	 *
	 * @param string $action
	 *
	 * @return string|false 14-char timestamp or "infinity", or false if the input was invalid
	 */
	private function getExpiry( $action ) {
		if ( $this->mExpirySelection[$action] == 'existing' ) {
			return $this->mExistingExpiry[$action];
		} elseif ( $this->mExpirySelection[$action] == 'othertime' ) {
			$value = $this->mExpiry[$action];
		} else {
			$value = $this->mExpirySelection[$action];
		}
		if ( wfIsInfinity( $value ) ) {
			$time = 'infinity';
		} else {
			$unix = strtotime( $value );

			if ( !$unix || $unix === -1 ) {
				return false;
			}

			// @todo FIXME: Non-qualified absolute times are not in users specified timezone
			// and there isn't notice about it in the ui
			$time = wfTimestamp( TS_MW, $unix );
		}
		return $time;
	}

	/**
	 * Main entry point for action=protect and action=unprotect
	 */
	public function execute() {
		if (
			$this->permManager->getNamespaceRestrictionLevels(
				$this->mTitle->getNamespace()
			) === [ '' ]
		) {
			throw new ErrorPageError( 'protect-badnamespace-title', 'protect-badnamespace-text' );
		}

		if ( $this->mRequest->wasPosted() ) {
			if ( $this->save() ) {
				$q = $this->mArticle->getPage()->isRedirect() ? 'redirect=no' : '';
				$this->mOut->redirect( $this->mTitle->getFullURL( $q ) );
			}
		} else {
			$this->show();
		}
	}

	/**
	 * Show the input form with optional error message
	 *
	 * @param string|string[]|null $err Error message or null if there's no error
	 */
	private function show( $err = null ) {
		$out = $this->mOut;
		$out->setRobotPolicy( 'noindex,nofollow' );
		$out->addBacklinkSubtitle( $this->mTitle );

		if ( is_array( $err ) ) {
			$out->addHTML( Html::errorBox( $out->msg( ...$err )->plain() ) );
		} elseif ( is_string( $err ) ) {
			$out->addHTML( Html::errorBox( $err ) );
		}

		if ( $this->mApplicableTypes === [] ) {
			// No restriction types available for the current title
			// this might happen if an extension alters the available types
			$out->setPageTitle( $this->mContext->msg(
				'protect-norestrictiontypes-title',
				$this->mTitle->getPrefixedText()
			) );
			$out->addWikiTextAsInterface(
				$this->mContext->msg( 'protect-norestrictiontypes-text' )->plain()
			);

			// Show the log in case protection was possible once
			$this->showLogExtract();
			// return as there isn't anything else we can do
			return;
		}

		list( $cascadeSources, /* $restrictions */ ) = $this->mTitle->getCascadeProtectionSources();
		if ( $cascadeSources && count( $cascadeSources ) > 0 ) {
			$titles = '';

			foreach ( $cascadeSources as $title ) {
				$titles .= '* [[:' . $title->getPrefixedText() . "]]\n";
			}

			/** @todo FIXME: i18n issue, should use formatted number. */
			$out->wrapWikiMsg(
				"<div id=\"mw-protect-cascadeon\">\n$1\n" . $titles . "</div>",
				[ 'protect-cascadeon', count( $cascadeSources ) ]
			);
		}

		# Show an appropriate message if the user isn't allowed or able to change
		# the protection settings at this time
		if ( $this->disabled ) {
			$out->setPageTitle(
				$this->mContext->msg( 'protect-title-notallowed',
					$this->mTitle->getPrefixedText() )
			);
			$out->addWikiTextAsInterface( $out->formatPermissionsErrorMessage(
				$this->mPermErrors, 'protect'
			) );
		} else {
			$out->setPageTitle(
				$this->mContext->msg( 'protect-title', $this->mTitle->getPrefixedText() )
			);
			$out->addWikiMsg( 'protect-text',
				wfEscapeWikiText( $this->mTitle->getPrefixedText() ) );
		}

		$out->addHTML( $this->buildForm() );
		$this->showLogExtract();
	}

	/**
	 * Save submitted protection form
	 *
	 * @return bool Success
	 */
	private function save() {
		# Permission check!
		if ( $this->disabled ) {
			$this->show();
			return false;
		}

		$token = $this->mRequest->getVal( 'wpEditToken' );
		if ( !$this->mUser->matchEditToken( $token, [ 'protect', $this->mTitle->getPrefixedDBkey() ] ) ) {
			$this->show( [ 'sessionfailure' ] );
			return false;
		}

		# Create reason string. Use list and/or custom string.
		$reasonstr = $this->mReasonSelection;
		if ( $reasonstr != 'other' && $this->mReason != '' ) {
			// Entry from drop down menu + additional comment
			$reasonstr .= $this->mContext->msg( 'colon-separator' )->text() . $this->mReason;
		} elseif ( $reasonstr == 'other' ) {
			$reasonstr = $this->mReason;
		}

		$expiry = [];
		foreach ( $this->mApplicableTypes as $action ) {
			$expiry[$action] = $this->getExpiry( $action );
			if ( empty( $this->mRestrictions[$action] ) ) {
				// unprotected
				continue;
			}
			if ( !$expiry[$action] ) {
				$this->show( [ 'protect_expiry_invalid' ] );
				return false;
			}
			if ( $expiry[$action] < wfTimestampNow() ) {
				$this->show( [ 'protect_expiry_old' ] );
				return false;
			}
		}

		$this->mCascade = $this->mRequest->getBool( 'mwProtect-cascade' );

		$status = $this->mArticle->getPage()->doUpdateRestrictions(
			$this->mRestrictions,
			$expiry,
			$this->mCascade,
			$reasonstr,
			$this->mUser
		);

		if ( !$status->isOK() ) {
			$this->show( $this->mOut->parseInlineAsInterface(
				$status->getWikiText( false, false, $this->mLang )
			) );
			return false;
		}

		/**
		 * Give extensions a change to handle added form items
		 *
		 * @since 1.19 you can (and you should) return false to abort saving;
		 *             you can also return an array of message name and its parameters
		 */
		$errorMsg = '';
		if ( !$this->hookRunner->onProtectionForm__save( $this->mArticle, $errorMsg, $reasonstr ) ) {
			if ( $errorMsg == '' ) {
				$errorMsg = [ 'hookaborted' ];
			}
		}
		if ( $errorMsg != '' ) {
			$this->show( $errorMsg );
			return false;
		}

		$this->watchlistManager->setWatch(
			$this->mRequest->getCheck( 'mwProtectWatch' ),
			$this->mUser,
			$this->mTitle
		);

		return true;
	}

	/**
	 * Build the input form
	 *
	 * @return string HTML form
	 */
	private function buildForm() {
		$this->mOut->enableOOUI();
		$out = '';
		$fields = [];
		if ( !$this->disabled ) {
			$this->mOut->addModules( 'mediawiki.action.protect' );
			$this->mOut->addModuleStyles( 'mediawiki.action.styles' );
		}
		$scExpiryOptions = $this->mContext->msg( 'protect-expiry-options' )->inContentLanguage()->text();
		$levels = $this->permManager->getNamespaceRestrictionLevels(
			$this->mTitle->getNamespace(),
			$this->disabled ? null : $this->mUser
		);

		// Not all languages have V_x <-> N_x relation
		foreach ( $this->mRestrictions as $action => $selected ) {
			// Messages:
			// restriction-edit, restriction-move, restriction-create, restriction-upload
			$section = 'restriction-' . $action;
			$id = 'mwProtect-level-' . $action;
			$options = [];
			foreach ( $levels as $key ) {
				$options[$this->getOptionLabel( $key )] = $key;
			}

			$fields[$id] = [
				'type' => 'select',
				'name' => $id,
				'default' => $selected,
				'id' => $id,
				'size' => count( $levels ),
				'options' => $options,
				'disabled' => $this->disabled,
				'section' => $section,
			];

			$expiryOptions = [];

			if ( $this->mExistingExpiry[$action] ) {
				if ( $this->mExistingExpiry[$action] == 'infinity' ) {
					$existingExpiryMessage = $this->mContext->msg( 'protect-existing-expiry-infinity' );
				} else {
					$timestamp = $this->mLang->userTimeAndDate( $this->mExistingExpiry[$action], $this->mUser );
					$date = $this->mLang->userDate( $this->mExistingExpiry[$action], $this->mUser );
					$time = $this->mLang->userTime( $this->mExistingExpiry[$action], $this->mUser );
					$existingExpiryMessage = $this->mContext->msg(
						'protect-existing-expiry',
						$timestamp,
						$date,
						$time
					);
				}
				$expiryOptions[$existingExpiryMessage->text()] = 'existing';
			}

			$expiryOptions[$this->mContext->msg( 'protect-othertime-op' )->text()] = 'othertime';
			foreach ( explode( ',', $scExpiryOptions ) as $option ) {
				if ( strpos( $option, ":" ) === false ) {
					$show = $value = $option;
				} else {
					list( $show, $value ) = explode( ":", $option );
				}
				$expiryOptions[$show] = htmlspecialchars( $value );
			}

			# Add expiry dropdown
			$fields["wpProtectExpirySelection-$action"] = [
				'type' => 'select',
				'name' => "wpProtectExpirySelection-$action",
				'id' => "mwProtectExpirySelection-$action",
				'tabindex' => '2',
				'disabled' => $this->disabled,
				'label' => $this->mContext->msg( 'protectexpiry' )->text(),
				'options' => $expiryOptions,
				'default' => $this->mExpirySelection[$action],
				'section' => $section,
			];

			# Add custom expiry field
			if ( !$this->disabled ) {
				$fields["mwProtect-expiry-$action"] = [
					'type' => 'text',
					'label' => $this->mContext->msg( 'protect-othertime' )->text(),
					'name' => "mwProtect-expiry-$action",
					'id' => "mwProtect-$action-expires",
					'size' => 50,
					'default' => $this->mExpiry[$action],
					'disabled' => $this->disabled,
					'section' => $section,
				];
			}
		}

		# Give extensions a chance to add items to the form
		$hookFormRaw = '';
		$hookFormOptions = [];

		$this->hookRunner->onProtectionForm__buildForm( $this->mArticle, $hookFormRaw );
		$this->hookRunner->onProtectionFormAddFormFields( $this->mArticle, $hookFormOptions );

		# Merge forms added from addFormFields
		$fields = array_merge( $fields, $hookFormOptions );

		# Add raw sections added in buildForm
		if ( $hookFormRaw ) {
			$fields['rawinfo'] = [
				'type' => 'info',
				'default' => $hookFormRaw,
				'raw' => true,
				'section' => 'restriction-blank'
			];
		}

		# JavaScript will add another row with a value-chaining checkbox
		if ( $this->mTitle->exists() ) {
			$fields['mwProtect-cascade'] = [
				'type' => 'check',
				'label' => $this->mContext->msg( 'protect-cascade' )->text(),
				'id' => 'mwProtect-cascade',
				'name' => 'mwProtect-cascade',
				'default' => $this->mCascade,
				'disabled' => $this->disabled,
			];
		}

		# Add manual and custom reason field/selects as well as submit
		if ( !$this->disabled ) {
			// HTML maxlength uses "UTF-16 code units", which means that characters outside BMP
			// (e.g. emojis) count for two each. This limit is overridden in JS to instead count
			// Unicode codepoints.
			// Subtract arbitrary 75 to leave some space for the autogenerated null edit's summary
			// and other texts chosen by dropdown menus on this page.
			$maxlength = CommentStore::COMMENT_CHARACTER_LIMIT - 75;
			$fields['wpProtectReasonSelection'] = [
				'type' => 'select',
				'cssclass' => 'mwProtect-reason',
				'label' => $this->mContext->msg( 'protectcomment' )->text(),
				'tabindex' => 4,
				'id' => 'wpProtectReasonSelection',
				'name' => 'wpProtectReasonSelection',
				'flatlist' => true,
				'options' => Xml::listDropDownOptions(
					$this->mContext->msg( 'protect-dropdown' )->inContentLanguage()->text(),
					[ 'other' => $this->mContext->msg( 'protect-otherreason-op' )->inContentLanguage()->text() ]
				),
				'default' => $this->mReasonSelection,
			];
			$fields['mwProtect-reason'] = [
				'type' => 'text',
				'id' => 'mwProtect-reason',
				'label' => $this->mContext->msg( 'protect-otherreason' )->text(),
				'name' => 'mwProtect-reason',
				'size' => 60,
				'maxlength' => $maxlength,
				'default' => $this->mReason,
			];
			# Disallow watching if user is not logged in
			if ( $this->mUser->isRegistered() ) {
				$fields['mwProtectWatch'] = [
					'type' => 'check',
					'id' => 'mwProtectWatch',
					'label' => $this->mContext->msg( 'watchthis' )->text(),
					'name' => 'mwProtectWatch',
					'default' => (
						$this->watchlistManager->isWatched( $this->mUser, $this->mTitle )
						|| $this->mUser->getOption( 'watchdefault' )
					),
				];
			}
		}

		if ( $this->permManager->userHasRight( $this->mUser, 'editinterface' ) ) {
			$linkRenderer = MediaWikiServices::getInstance()->getLinkRenderer();
			$link = $linkRenderer->makeKnownLink(
				$this->mContext->msg( 'protect-dropdown' )->inContentLanguage()->getTitle(),
				$this->mContext->msg( 'protect-edit-reasonlist' )->text(),
				[],
				[ 'action' => 'edit' ]
			);
			$out .= '<p class="mw-protect-editreasons">' . $link . '</p>';
		}

		if ( !$this->disabled ) {
			$fields['wpEditToken'] = [
				'name' => 'wpEditToken',
				'type' => 'hidden',
				'default' => $this->mUser->getEditToken( [ 'protect', $this->mTitle->getPrefixedDBkey() ] ),
			];
		}

		$htmlForm = HTMLForm::factory( 'ooui', $fields, $this->mContext );
		$htmlForm
			->setMethod( 'post' )
			->setId( 'mw-Protect-Form' )
			->setTableId( 'mw-protect-table2' )
			->setAction( $this->mTitle->getLocalURL( 'action=protect' ) )
			->setSubmitID( 'mw-Protect-submit' )
			->setSubmitText( $this->mContext->msg( 'confirm' )->text() )
			->suppressDefaultSubmit( $this->disabled )
			->setWrapperLegend( $this->mContext->msg( 'protect-legend' )->text() )
			->loadData();

		return $htmlForm->getHTML( false ) . $out;
	}

	/**
	 * Prepare the label for a protection selector option
	 *
	 * @param string $permission Permission required
	 * @return string
	 */
	private function getOptionLabel( $permission ) {
		if ( $permission == '' ) {
			return $this->mContext->msg( 'protect-default' )->text();
		} else {
			// Messages: protect-level-autoconfirmed, protect-level-sysop
			$msg = $this->mContext->msg( "protect-level-{$permission}" );
			if ( $msg->exists() ) {
				return $msg->text();
			}
			return $this->mContext->msg( 'protect-fallback', $permission )->text();
		}
	}

	/**
	 * Show protection long extracts for this page
	 */
	private function showLogExtract() {
		# Show relevant lines from the protection log:
		$protectLogPage = new LogPage( 'protect' );
		$this->mOut->addHTML( Xml::element( 'h2', null, $protectLogPage->getName()->text() ) );
		/** @phan-suppress-next-line PhanTypeMismatchPropertyByRef */
		LogEventsList::showLogExtract( $this->mOut, 'protect', $this->mTitle );
		# Let extensions add other relevant log extracts
		$this->hookRunner->onProtectionForm__showLogExtract( $this->mArticle, $this->mOut );
	}
}
