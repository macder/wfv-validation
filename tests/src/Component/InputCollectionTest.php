<?php
namespace WFV\Component;

use WFV\Component\InputCollection;

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
		$expected = 'WFV\Component\InputCollection';
		$result = new InputCollection( self::$data );
		$this->assertInstanceOf( $expected, $result );
	}
}
