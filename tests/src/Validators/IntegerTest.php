<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class IntegerTest extends \PHPUnit_Framework_TestCase {

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
		self::$validator = new Integer();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does integer validation return true when
	 *  validation is NOT optional
	 *  and input is int?
	 *
	 */
	public function test_integer_returns_true_when_not_optional_and_input_int() {
		$optional = false;

		$result = self::$validator->validate( 1, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does integer validation return true when
	 *  validation is optional
	 *  and input is int?
	 *
	 */
	public function test_integer_returns_true_when_optional_and_input_int() {
		$optional = true;

		$result = self::$validator->validate( 1, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does integer validation return false when
	 *  validation is NOT optional
	 *  and input is alpha?
	 *
	 */
	public function test_integer_returns_false_when_not_optional_and_input_alpha() {
		$optional = false;

		$result = self::$validator->validate( 'abcdefg', $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does integer validation return false when
	 *  validation is optional
	 *  and input is alpha?
	 *
	 */
	public function test_integer_returns_tfalse_when_optional_and_input_alpha() {
		$optional = true;

		$result = self::$validator->validate( 'abcdefg', $optional );
		$this->assertFalse( $result );
	}


	/**
	 * Does integer validation return false when
	 *  validation is NOT optional
	 *  and input is float?
	 *
	 */
	public function test_integer_returns_false_when_not_optional_and_input_float() {
		$optional = false;

		$result = self::$validator->validate( 1.1, $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does integer validation return false when
	 *  validation is optional
	 *  and input is float?
	 *
	 */
	public function test_integer_returns_false_when_optional_and_input_float() {
		$optional = true;

		$result = self::$validator->validate( 1.1, $optional );
		$this->assertFalse( $result );
	}
}
