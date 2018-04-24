<?php
namespace WFV\Rules;

use \Respect\Validation\Validator as RespectValidator;

class NumericTest extends \PHPUnit_Framework_TestCase {

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
		self::$validator = new Numeric( new RespectValidator() );
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does numeric validation return true when
	 *  validation is NOT optional
	 *  and input is numeric string?
	 *
	 */
	public function test_numeric_returns_true_when_not_optional_and_input_numeric_string() {
		$optional = false;

		$result = self::$validator->validate( '123456', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does numeric validation return true when
	 *  validation is NOT optional
	 *  and input is numeric int?
	 *
	 */
	public function test_numeric_returns_true_when_not_optional_and_input_numeric_int() {
		$optional = false;

		$result = self::$validator->validate( 123456, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does numeric validation return true when
	 *  validation is optional
	 *  and input is numeric string?
	 *
	 */
	public function test_numeric_returns_true_when_optional_and_input_numeric_string() {
		$optional = true;

		$result = self::$validator->validate( '123456.5', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does numeric validation return true when
	 *  validation is optional
	 *  and input is numeric int?
	 *
	 */
	public function test_numeric_returns_true_when_optional_and_input_numeric_int() {
		$optional = true;

		$result = self::$validator->validate( 123456.4, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does numeric validation return false when
	 *  validation is NOT optional
	 *  and input is alpha string?
	 *
	 */
	public function test_numeric_returns_false_when_not_optional_and_input_alpha_string() {
		$optional = false;

		$result = self::$validator->validate( 'this is not numeric', $optional );
		$this->assertFalse( $result );
	}


	/**
	 * Does numeric validation return false when
	 *  validation is optional
	 *  and input is alpha string?
	 *
	 */
	public function test_numeric_returns_false_when_optional_and_input_alpha_string() {
		$optional = true;

		$result = self::$validator->validate( 'this is not numeric', $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does numeric validation return false when
	 *  validation is NOT optional
	 *  and input null?
	 *
	 */
	public function test_numeric_returns_false_when_not_optional_and_input_null() {
		$optional = false;

		$result = self::$validator->validate( null, $optional );
		$this->assertFalse( $result );
	}


	/**
	 * Does numeric validation return true when
	 *  validation is optional
	 *  and input is null?
	 *
	 */
	public function test_numeric_returns_true_when_optional_and_input_null() {
		$optional = true;

		$result = self::$validator->validate( null, $optional );
		$this->assertTrue( $result );
	}
}
