<?php
namespace WFV\Rules;

use \Respect\Validation\Validator as RespectValidator;

class BooleanTest extends \PHPUnit_Framework_TestCase {

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
		self::$validator = new Boolean( new RespectValidator() );
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does boolean validation return true when
	 *  validation is NOT optional
	 *  and input is bool false?
	 *
	 */
	public function test_boolean_returns_true_when_not_optional_and_input_bool_false() {
		$optional = false;

		$result = self::$validator->validate( false, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does boolean validation return true when
	 *  validation is NOT optional
	 *  and input is bool true?
	 *
	 */
	public function test_boolean_returns_true_when_not_optional_and_input_bool_true() {
		$optional = false;

		$result = self::$validator->validate( true, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does boolean validation return true when
	 *  validation is NOT optional
	 *  and input is int 1?
	 *
	 */
	public function test_boolean_returns_true_when_not_optional_and_input_int_1() {
		$optional = false;

		$result = self::$validator->validate( 1, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does boolean validation return true when
	 *  validation is NOT optional
	 *  and input is string 1?
	 *
	 */
	public function test_boolean_returns_true_when_not_optional_and_input_string_1() {
		$optional = false;

		$result = self::$validator->validate( '1', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does boolean validation return true when
	 *  validation is NOT optional
	 *  and input is int 0?
	 *
	 */
	public function test_boolean_returns_true_when_not_optional_and_input_int_0() {
		$optional = false;

		$result = self::$validator->validate( 0, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does boolean validation return true when
	 *  validation is NOT optional
	 *  and input is string 1?
	 *
	 */
	public function test_boolean_returns_true_when_not_optional_and_input_string_0() {
		$optional = false;

		$result = self::$validator->validate( '0', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does boolean validation return true when
	 *  validation is optional
	 *  and input is bool false?
	 *
	 */
	public function test_boolean_returns_true_when_optional_and_input_bool_false() {
		$optional = true;

		$result = self::$validator->validate( false, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does boolean validation return true when
	 *  validation is optional
	 *  and input is bool true?
	 *
	 */
	public function test_boolean_returns_true_when_optional_and_input_bool_true() {
		$optional = true;

		$result = self::$validator->validate( true, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does boolean validation return true when
	 *  validation is optional
	 *  and input is int 1?
	 *
	 */
	public function test_boolean_returns_true_when_optional_and_input_int_1() {
		$optional = true;

		$result = self::$validator->validate( 1, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does boolean validation return true when
	 *  validation is optional
	 *  and input is string 1?
	 *
	 */
	public function test_boolean_returns_true_when_optional_and_input_string_1() {
		$optional = true;

		$result = self::$validator->validate( '1', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does boolean validation return true when
	 *  validation is optional
	 *  and input is int 0?
	 *
	 */
	public function test_boolean_returns_true_when_optional_and_input_int_0() {
		$optional = true;

		$result = self::$validator->validate( 0, $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does boolean validation return true when
	 *  validation is optional
	 *  and input is string 1?
	 *
	 */
	public function test_boolean_returns_true_when_optional_and_input_string_0() {
		$optional = true;

		$result = self::$validator->validate( '0', $optional );
		$this->assertTrue( $result );
	}
}
