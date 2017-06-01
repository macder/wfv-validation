<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class DigitTest extends \PHPUnit_Framework_TestCase {

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
		self::$validator = new Digit();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does digit validation return true when
	 *  validation is NOT optional
	 *  and input is int digit?
	 *
	 */
	public function test_digit_returns_true_when_not_optional_and_input_int_digit() {
		$optional = false;

		$result = self::$validator->validate( 1, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does digit validation return true when
	 *  validation is optional
	 *  and input is int digit?
	 *
	 */
	public function test_digit_returns_true_when_optional_and_input_int_digit() {
		$optional = true;

		$result = self::$validator->validate( 1, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does digit validation return true when
	 *  validation is NOT optional
	 *  and input is string digit?
	 *
	 */
	public function test_digit_returns_true_when_not_optional_and_input_string_digit() {
		$optional = false;

		$result = self::$validator->validate( '1', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does digit validation return true when
	 *  validation is optional
	 *  and input is string digit?
	 *
	 */
	public function test_digit_returns_true_when_optional_and_input_string_digit() {
		$optional = true;

		$result = self::$validator->validate( '1', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does digit validation return true when
	 *  validation is optional
	 *  and input is null?
	 *
	 */
	public function test_digit_returns_true_when_optional_and_input_null() {
		$optional = true;

		$result = self::$validator->validate( null, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does digit validation return false when
	 *  validation is NOT optional
	 *  and input is null?
	 *
	 */
	public function test_digit_returns_false_when_not_optional_and_input_null() {
		$optional = false;

		$result = self::$validator->validate( null, $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does digit validation return false when
	 *  validation is NOT optional
	 *  and input is not digit?
	 *
	 */
	public function test_digit_returns_false_when_not_optional_and_input_not_digit() {
		$optional = false;

		$result = self::$validator->validate( 'string is not digit', $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does digit validation return false when
	 *  validation is optional
	 *  and input is not digit?
	 *
	 */
	public function test_digit_returns_false_when_optional_and_input_digit() {
		$optional = true;

		$result = self::$validator->validate( 'string is not digit', $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does digit validation return false when
	 *  validation is NOT optional
	 *  and input is numeric?
	 *
	 */
	public function test_digit_returns_false_when_not_optional_and_input_numeric() {
		$optional = false;

		$result = self::$validator->validate( 123, $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does digit validation return false when
	 *  validation is optional
	 *  and input is not digit?
	 *
	 */
	public function test_digit_returns_false_when_optional_and_input_numeric() {
		$optional = true;

		$result = self::$validator->validate( 123, $optional );
		$this->assertFalse( $result );
	}
}
