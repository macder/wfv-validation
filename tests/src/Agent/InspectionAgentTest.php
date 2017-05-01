<?php
namespace WFV\Agent;

use WFV\Agent\InspectionAgent;

class InspectionAgentTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $http_post;

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $token;

	/**
	 *
	 *
	 */
  protected function setUp() {

  	self::$token = wp_create_nonce( 'phpunit' );

    self::$http_post = array(
      'action' => 'phpunit',
      'email' => 'foo@bar.com',
      'phpunit_token' => self::$token,
    );


	}

	/**
	 *
	 *
	 */
	protected function tearDown() {
		self::$http_post = null;
		$_POST = null;
		$_REQUEST = null;
	}

	/**
	 *
	 *
	 */
	public function test_inspection_safe_submit_returns_true() {
		$_POST = self::$http_post;
		$_REQUEST[ 'phpunit_token' ] = self::$token;

		$result = new InspectionAgent( 'phpunit' );

		$this->assertTrue( $result->safe_submit() );
	}

	/**
	 *
	 *
	 */
	public function test_inspection_safe_submit_returns_false_when_request_token_null() {
		$_POST = self::$http_post;
		$_REQUEST[ 'phpunit_token' ] = null;

		$result = new InspectionAgent( 'phpunit' );

		$this->assertFalse( $result->safe_submit() );
	}

	/**
	 *
	 *
	 */
	public function test_inspection_safe_submit_returns_false_when_request_token_mismatch() {
		$_POST = self::$http_post;
		$_REQUEST[ 'phpunit_token' ] = '8609aa6594';

		$result = new InspectionAgent( 'phpunit' );

		$this->assertFalse( $result->safe_submit() );
	}

	/**
	 *
	 *
	 */
	public function test_inspection_safe_submit_returns_false_when_no_post() {
		$result = new InspectionAgent( 'phpunit' );
		$this->assertFalse( $result->safe_submit() );
	}

	/**
	 *
	 *
	 */
	public function test_inspection_safe_submit_returns_false_when_post_but_no_action() {
		$_POST = self::$http_post;
		unset($_POST['action']);

		$result = new InspectionAgent( 'phpunit' );

		$this->assertFalse( $result->safe_submit() );
	}

	/**
	 *
	 *
	 */
	public function test_inspection_safe_submit_returns_false_when_action_mismatch() {
		$_POST = self::$http_post;
		$_POST['action'] = 'not our action';

		$result = new InspectionAgent( 'phpunit' );

		$this->assertFalse( $result->safe_submit() );
	}
}
