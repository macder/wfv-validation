<?php
namespace WFV\Collection;

use WFV\Collection\ErrorCollection;

class ErrorCollectionTest extends \PHPUnit_Framework_TestCase {

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
	public function test_errors_is_instance_when_null_parameter() {
		$expected = 'WFV\Collection\ErrorCollection';
		$result = new ErrorCollection();

		$this->assertInstanceOf( $expected, $result );
	}
}
