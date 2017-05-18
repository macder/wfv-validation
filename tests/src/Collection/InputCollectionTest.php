<?php
namespace WFV\Collection;

use WFV\Collection\InputCollection;

class InputCollectionTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $data;

	/**
	 *
	 *
	 */
	protected function setUp() {
		self::$data = array(
			'action' => 'phpunit',
			'name' => 'Foo Bar',
			'email' => 'foo@bar.com',
		);
	}

	/**
	 *
	 *
	 */
	protected function tearDown() {
		self::$data = null;
	}

	/**
	 *
	 *
	 */
	public function test_input_collection_is_instance() {
		$expected = 'WFV\Collection\InputCollection';
		$result = new InputCollection( self::$data, true );
		$this->assertInstanceOf( $expected, $result );
	}

	/**
	 * Is data populated when array param is provided?
	 *
	 */
	public function test_input_collection_is_populated_returns_true() {
		$result = new InputCollection( self::$data, true );
		$this->assertTrue( $result->is_populated() );
	}
}
