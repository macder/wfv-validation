<?php
namespace WFV\Rules;

use \Respect\Validation\Validator as RespectValidator;

class CallbackTest extends \PHPUnit_Framework_TestCase {

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
		self::$validator = new Callback( new RespectValidator() );
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does callback validation return true when
	 *  validation is NOT optional
	 *  and input is a string?
	 *
	 */
	public function test_callback_returns_true_when_not_optional_and_input_string() {
		$optional = false;
		$params = ['is_string'];

		$result = self::$validator->validate('test_input', $optional, $params);
		$this->assertTrue( $result );
	}

	/**
	 * Does callback validation return true when
	 *  validation is optional
	 *  and input is a string?
	 *
	 */
	public function test_callback_returns_true_when_optional_and_input_string() {
		$optional = true;
		$params = ['is_string'];

		$result = self::$validator->validate('test_input', $optional, $params);
		$this->assertTrue( $result );
	}

	/**
	 * Does callback validation return false when
	 *  validation is NOT optional
	 *  and input is empty?
	 *
	 */
	public function test_callback_returns_false_when_not_optional_and_input_null() {
		$optional = false;
		$params = ['is_string'];

		$result = self::$validator->validate( null, $optional, $params );
		$this->assertFalse( $result );
	}

	/**
	 * Does callback validation return true when
	 *  validation is optional
	 *  and input is empty?
	 *
	 */
	public function test_callback_returns_true_when_optional_and_input_null() {
		$optional = true;
		$params = ['is_string'];

		$result = self::$validator->validate( null, $optional, $params );
		$this->assertTrue( $result );
	}
}
