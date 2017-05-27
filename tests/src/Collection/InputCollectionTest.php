<?php
namespace WFV\Collection;

use WFV\Agent\InspectionAgent;
use WFV\Collection\InputCollection;

class InputCollectionTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $input_collection;

	/**
	 *
	 *
	 */
	protected function setUp() {
		$_POST = array(
			'name' => 'Foo Bar',
			'email' => 'foo@bar.com',
			'trim' => ' should trim   ',
			'action' => 'phpunit',
			'phpunit_token' => wp_create_nonce( 'phpunit' ),
		);

		$_REQUEST[ 'phpunit_token' ] = wp_create_nonce( 'phpunit' );

		self::$input_collection = new InputCollection( new InspectionAgent( 'phpunit' ) );
	}

	/**
	 *
	 *
	 */
	protected function tearDown() {
		$_POST = null;
		$_REQUEST = null;
		self::$input_collection = null;
	}

	/**
	 * Does get_array( false ) return array without action and token attr?
	 *
	 */
	public function test_input_collection_get_array_return_neat() {
		$expected = array(
			'name' => 'Foo Bar',
			'email' => 'foo@bar.com',
			'trim' => 'should trim',
		);
		$result = self::$input_collection->get_array( false );
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does get_array() return array with action and token attr?
	 *
	 */
	public function test_input_collection_get_array_return_with_action_token() {
		$expected = array(
			'name' => 'Foo Bar',
			'email' => 'foo@bar.com',
			'trim' => 'should trim',
			'action' => 'phpunit',
			'phpunit_token' => wp_create_nonce( 'phpunit' ),
		);
		$result = self::$input_collection->get_array();
		$this->assertEquals( $expected, $result );
	}
}
