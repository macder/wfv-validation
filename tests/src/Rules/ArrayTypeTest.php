<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class ArrayTypeTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var ValidateInterface
	 */
	protected static $validator;

	/**
	 *
	 *
	 */
	protected function setUp() {
		self::$validator = new ArrayType();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does array validation return true when
	 *  validation is NOT optional
	 *  and input is array?
	 *
	 */
	public function test_array_returns_true_when_not_optional_and_input_array() {
		$optional = false;

		$result = self::$validator->validate( array('test','test2'), $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does array validation return true when
	 *  validation is optional
	 *  and input is array?
	 *
	 */
	public function test_array_returns_true_when_optional_and_input_array() {
		$optional = true;

		$result = self::$validator->validate( array('test','test2'), $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does array validation return true when
	 *  validation is optional
	 *  and input is empty?
	 *
	 */
	public function test_array_returns_true_when_optional_and_input_empty() {
		$optional = true;

		$result = self::$validator->validate( null, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does array validation return false when
	 *  validation is NOT optional
	 *  and input is string?
	 *
	 */
	public function test_array_returns_false_when_not_optional_and_input_string() {
		$optional = false;

		$result = self::$validator->validate( 'string val', $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does array validation return false when
	 *  validation is optional
	 *  and input is string?
	 *
	 */
	public function test_array_returns_false_when_optional_and_input_string() {
		$optional = true;

		$result = self::$validator->validate( 'string val', $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does array validation return false when
	 *  validation is NOT optional
	 *  and input is empty?
	 *
	 */
	public function test_array_returns_false_when_not_optional_and_input_null() {
		$optional = false;

		$result = self::$validator->validate( null, $optional );
		$this->assertFalse( $result );
	}
}
