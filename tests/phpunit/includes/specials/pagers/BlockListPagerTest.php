<?php

use MediaWiki\Block\BlockRestrictionStore;
use MediaWiki\Block\BlockUtils;
use MediaWiki\Block\DatabaseBlock;
use MediaWiki\Block\Restriction\NamespaceRestriction;
use MediaWiki\Block\Restriction\PageRestriction;
use MediaWiki\Cache\LinkBatchFactory;
use MediaWiki\MediaWikiServices;
use MediaWiki\SpecialPage\SpecialPageFactory;
use Wikimedia\Rdbms\ILoadBalancer;
use Wikimedia\TestingAccessWrapper;

/**
 * @group Database
 * @coversDefaultClass BlockListPager
 */
class BlockListPagerTest extends MediaWikiIntegrationTestCase {

	/**
	 * @var LinkBatchFactory
	 */
	private $linkBatchFactory;

	/** @var BlockRestrictionStore */
	private $blockRestrictionStore;

	/** @var ILoadBalancer */
	private $loadBalancer;

	/** @var SpecialPageFactory */
	private $specialPageFactory;

	/** @var CommentStore */
	private $commentStore;

	/** @var BlockUtils */
	private $blockUtils;

	protected function setUp() : void {
		parent::setUp();

		$services = MediaWikiServices::getInstance();
		$this->linkBatchFactory = $services->getLinkBatchFactory();
		$this->blockRestrictionStore = $services->getBlockRestrictionStore();
		$this->loadBalancer = $services->getDBLoadBalancer();
		$this->specialPageFactory = $services->getSpecialPageFactory();
		$this->commentStore = $services->getCommentStore();
		$this->blockUtils = $services->getBlockUtils();
	}

	private function getBlockListPager() {
		return new BlockListPager(
			new SpecialPage(),
			[],
			$this->linkBatchFactory,
			$this->blockRestrictionStore,
			$this->loadBalancer,
			$this->specialPageFactory,
			$this->commentStore,
			$this->blockUtils
		);
	}

	/**
	 * @covers ::formatValue
	 * @dataProvider formatValueEmptyProvider
	 * @dataProvider formatValueDefaultProvider
	 */
	public function testFormatValue( $name, $expected = null, $row = null ) {
		// Set the time to now so it does not get off during the test.
		MWTimestamp::setFakeTime( MWTimestamp::time() );

		$value = $name === 'ipb_timestamp' ? MWTimestamp::time() : '';
		$expected = $expected ?? MWTimestamp::getInstance()->format( 'H:i, j F Y' );

		$row = $row ?: (object)[];
		$pager = $this->getBlockListPager();
		$wrappedPager = TestingAccessWrapper::newFromObject( $pager );
		$wrappedPager->mCurrentRow = $row;

		$formatted = $pager->formatValue( $name, $value );
		$this->assertStringMatchesFormat( $expected, $formatted );

		// Reset the time.
		MWTimestamp::setFakeTime( false );
	}

	/**
	 * Test empty values.
	 */
	public function formatValueEmptyProvider() {
		return [
			[
				'test',
				'Unable to format test',
			],
			[
				'ipb_timestamp',
			],
			[
				'ipb_expiry',
				'infinite<br />0 minutes left',
			],
		];
	}

	/**
	 * Test the default row values.
	 */
	public function formatValueDefaultProvider() {
		$row = (object)[
			'ipb_user' => 0,
			'ipb_address' => '127.0.0.1',
			'ipb_by_text' => 'Admin',
			'ipb_create_account' => 1,
			'ipb_auto' => 0,
			'ipb_anon_only' => 0,
			'ipb_create_account' => 1,
			'ipb_enable_autoblock' => 1,
			'ipb_deleted' => 0,
			'ipb_block_email' => 0,
			'ipb_allow_usertalk' => 0,
			'ipb_sitewide' => 1,
		];

		return [
			[
				'test',
				'Unable to format test',
				$row,
			],
			[
				'ipb_timestamp',
				null,
				$row,
			],
			[
				'ipb_expiry',
				'infinite<br />0 minutes left',
				$row,
			],
			[
				'ipb_by',
				'<a %s><bdi>Admin</bdi></a>%s',
				$row,
			],
			[
				'ipb_params',
				'<ul><li>editing (sitewide)</li>' .
					'<li>account creation disabled</li><li>cannot edit own talk page</li></ul>',
				$row,
			]
		];
	}

	/**
	 * @covers ::formatValue
	 * @covers ::getRestrictionListHTML
	 */
	public function testFormatValueRestrictions() {
		$this->setMwGlobals( [
			'wgArticlePath' => '/wiki/$1',
			'wgScript' => '/w/index.php',
		] );

		$pager = $this->getBlockListPager();

		$row = (object)[
			'ipb_id' => 0,
			'ipb_user' => 0,
			'ipb_anon_only' => 0,
			'ipb_enable_autoblock' => 0,
			'ipb_create_account' => 0,
			'ipb_block_email' => 0,
			'ipb_allow_usertalk' => 1,
			'ipb_sitewide' => 0,
		];
		$wrappedPager = TestingAccessWrapper::newFromObject( $pager );
		$wrappedPager->mCurrentRow = $row;

		$pageName = 'Victor Frankenstein';
		$page = $this->insertPage( $pageName );
		$title = $page['title'];
		$pageId = $page['id'];

		$restrictions = [
			( new PageRestriction( 0, $pageId ) )->setTitle( $title ),
			new NamespaceRestriction( 0, NS_MAIN ),
			// Deleted page.
			new PageRestriction( 0, 999999 ),
		];

		$wrappedPager = TestingAccessWrapper::newFromObject( $pager );
		$wrappedPager->restrictions = $restrictions;

		$formatted = $pager->formatValue( 'ipb_params', '' );
		$this->assertEquals( '<ul><li>'
			// FIXME: Expectation value should not be dynamic
			// and must not depend on a localisation message.
			// TODO: Mock the message or consider using qqx.
			. wfMessage( 'blocklist-editing' )->text()
			. '<ul><li>'
			. wfMessage( 'blocklist-editing-page' )->text()
			. '<ul><li>'
			. '<a href="/wiki/Victor_Frankenstein" title="'
			. $pageName
			. '">'
			. $pageName
			. '</a></li></ul></li><li>'
			. wfMessage( 'blocklist-editing-ns' )->text()
			. '<ul><li>'
			. '<a href="/w/index.php?title=Special:AllPages&amp;namespace=0" title="'
			. 'Special:AllPages'
			. '">'
			. wfMessage( 'blanknamespace' )->text()
			. '</a></li></ul></li></ul></li></ul>',
			$formatted
		);
	}

	/**
	 * @covers ::preprocessResults
	 */
	public function testPreprocessResults() {
		// Test the Link Cache.
		$linkCache = MediaWikiServices::getInstance()->getLinkCache();
		$wrappedlinkCache = TestingAccessWrapper::newFromObject( $linkCache );
		$admin = $this->getTestSysop()->getUser();

		$links = [
			'User:127.0.0.1',
			'User_talk:127.0.0.1',
			$admin->getUserPage()->getPrefixedDBkey(),
			$admin->getTalkPage()->getPrefixedDBkey()
		];

		foreach ( $links as $link ) {
			$this->assertNull( $wrappedlinkCache->badLinks->get( $link ) );
		}

		$row = (object)[
			'ipb_address' => '127.0.0.1',
			'ipb_by' => $admin->getId(),
			'ipb_by_text' => $admin->getName(),
			'ipb_sitewide' => 1,
			'ipb_timestamp' => $this->db->timestamp( wfTimestamp( TS_MW ) ),
		];
		$pager = $this->getBlockListPager();
		$pager->preprocessResults( [ $row ] );

		foreach ( $links as $link ) {
			$this->assertSame( 1, $wrappedlinkCache->badLinks->get( $link ), "Bad link [[$link]]" );
		}

		// Test sitewide blocks.
		$row = (object)[
			'ipb_address' => '127.0.0.1',
			'ipb_by' => $admin->getId(),
			'ipb_by_text' => $admin->getName(),
			'ipb_sitewide' => 1,
		];
		$pager = $this->getBlockListPager();
		$pager->preprocessResults( [ $row ] );

		$this->assertObjectNotHasAttribute( 'ipb_restrictions', $row );

		$pageName = 'Victor Frankenstein';
		$page = $this->getExistingTestPage( 'Victor Frankenstein' );
		$title = $page->getTitle();

		$target = '127.0.0.1';

		// Test partial blocks.
		$block = new DatabaseBlock( [
			'address' => $target,
			'by' => $this->getTestSysop()->getUser()->getId(),
			'reason' => 'Parce que',
			'expiry' => $this->db->getInfinity(),
			'sitewide' => false,
		] );
		$block->setRestrictions( [
			new PageRestriction( 0, $page->getId() ),
		] );
		$blockStore = MediaWikiServices::getInstance()->getDatabaseBlockStore();
		$blockStore->insertBlock( $block );

		$result = $this->db->select( 'ipblocks', [ '*' ], [ 'ipb_id' => $block->getId() ] );

		$pager = $this->getBlockListPager();
		$pager->preprocessResults( $result );

		$wrappedPager = TestingAccessWrapper::newFromObject( $pager );

		$restrictions = $wrappedPager->restrictions;
		$this->assertIsArray( $restrictions );

		$restriction = $restrictions[0];
		$this->assertEquals( $page->getId(), $restriction->getValue() );
		$this->assertEquals( $page->getId(), $restriction->getTitle()->getArticleID() );
		$this->assertEquals( $title->getDBkey(), $restriction->getTitle()->getDBkey() );
		$this->assertEquals( $title->getNamespace(), $restriction->getTitle()->getNamespace() );

		// Delete the block and the restrictions.
		$blockStore->deleteBlock( $block );
	}
}
