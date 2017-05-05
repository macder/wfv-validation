<?php
namespace WFV\Collection;

use WFV\Collection\MessageCollection;

class MessageCollectionTest extends \PHPUnit_Framework_TestCase {

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
	}

	/**
	 *
	 *
	 */
	protected function tearDown() {
	}

	/**
	 *
	 *
	 */
	public function test_messages_is_instance_when_null_parameter() {
		$expected = 'WFV\Collection\MessageCollection';
		$result = new MessageCollection();

		$this->assertInstanceOf( $expected, $result );
	}

}
