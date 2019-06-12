<?php

namespace MediaWiki\Tests\Rest\BasicAccess;

use GuzzleHttp\Psr7\Uri;
use MediaWiki\MediaWikiServices;
use MediaWiki\Rest\BasicAccess\MWBasicAuthorizer;
use MediaWiki\Rest\Handler;
use MediaWiki\Rest\RequestData;
use MediaWiki\Rest\ResponseFactory;
use MediaWiki\Rest\Router;
use MediaWiki\Rest\Validator\Validator;
use MediaWikiTestCase;
use Psr\Container\ContainerInterface;
use User;
use Wikimedia\ObjectFactory;

/**
 * @group Database
 *
 * @covers \MediaWiki\Rest\BasicAccess\BasicAuthorizerBase
 * @covers \MediaWiki\Rest\BasicAccess\MWBasicAuthorizer
 * @covers \MediaWiki\Rest\BasicAccess\BasicRequestAuthorizer
 * @covers \MediaWiki\Rest\BasicAccess\MWBasicRequestAuthorizer
 */
class MWBasicRequestAuthorizerTest extends MediaWikiTestCase {
	private function createRouter( $userRights, $request ) {
		$user = User::newFromName( 'Test user' );
		// Don't allow the rights to everybody so that user rights kick in.
		$this->mergeMwGlobalArrayValue( 'wgGroupPermissions', [ '*' => $userRights ] );
		$this->overrideUserPermissions(
			$user,
			array_keys( array_filter( $userRights ), function ( $value ) {
				return $value === true;
			} )
		);

		global $IP;

		$objectFactory = new ObjectFactory(
			$this->getMockForAbstractClass( ContainerInterface::class )
		);

		return new Router(
			[ "$IP/tests/phpunit/unit/includes/Rest/testRoutes.json" ],
			[],
			'/rest',
			new \EmptyBagOStuff(),
			new ResponseFactory(),
			new MWBasicAuthorizer( $user, MediaWikiServices::getInstance()->getPermissionManager() ),
			$objectFactory,
			new Validator( $objectFactory, $request, $user )
		);
	}

	public function testReadDenied() {
		$request = new RequestData( [ 'uri' => new Uri( '/rest/user/joe/hello' ) ] );
		$router = $this->createRouter( [ 'read' => false ], $request );
		$response = $router->execute( $request );
		$this->assertSame( 403, $response->getStatusCode() );

		$body = $response->getBody();
		$body->rewind();
		$data = json_decode( $body->getContents(), true );
		$this->assertSame( 'rest-read-denied', $data['error'] );
	}

	public function testReadAllowed() {
		$request = new RequestData( [ 'uri' => new Uri( '/rest/user/joe/hello' ) ] );
		$router = $this->createRouter( [ 'read' => true ], $request );
		$response = $router->execute( $request );
		$this->assertSame( 200, $response->getStatusCode() );
	}

	public static function writeHandlerFactory() {
		return new class extends Handler {
			public function needsWriteAccess() {
				return true;
			}

			public function execute() {
				return '';
			}
		};
	}

	public function testWriteDenied() {
		$request = new RequestData( [
			'uri' => new Uri( '/rest/mock/MWBasicRequestAuthorizerTest/write' )
		] );
		$router = $this->createRouter( [ 'read' => true, 'writeapi' => false ], $request );
		$response = $router->execute( $request );
		$this->assertSame( 403, $response->getStatusCode() );

		$body = $response->getBody();
		$body->rewind();
		$data = json_decode( $body->getContents(), true );
		$this->assertSame( 'rest-write-denied', $data['error'] );
	}

	public function testWriteAllowed() {
		$request = new RequestData( [
			'uri' => new Uri( '/rest/mock/MWBasicRequestAuthorizerTest/write' )
		] );
		$router = $this->createRouter( [ 'read' => true, 'writeapi' => true ], $request );
		$response = $router->execute( $request );

		$this->assertSame( 200, $response->getStatusCode() );
	}
}
