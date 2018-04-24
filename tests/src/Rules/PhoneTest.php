<?php
namespace WFV\Rules;

use \Respect\Validation\Validator as RespectValidator;


class PhoneTest extends \PHPUnit_Framework_TestCase {

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
		self::$validator = new Phone( new RespectValidator() );
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does phone validation return true when
	 *  validation is NOT optional and
	 *  input is 10 digit phone number
	 *  with brackets around area code?
	 *
	 */
	public function test_phone_returns_true_when_not_optional_input_phone_10_area_bracket() {
		$optional = false;
		$result = self::$validator->validate('(555)555-5555', $optional);
		$this->assertTrue( $result );
	}

	/**
	 * Does phone validation return true when
	 *  validation is optional and
	 *  input is 10 digit phone number
	 *  with brackets around area code?
	 *
	 */
	public function test_phone_returns_true_when_optional_input_phone_10_area_bracket() {
		$optional = true;
		$result = self::$validator->validate('(555)555-5555', $optional);
		$this->assertTrue( $result );
	}

	/**
	 * Does phone validation return false when
	 *  validation is NOT optional and
	 *  input not phone number?
	 *
	 */
	public function test_phone_returns_false_when_not_optional_input_not_phone() {
		$optional = false;
		$result = self::$validator->validate('not a phone num', $optional);
		$this->assertFalse( $result );
	}

	/**
	 * Does phone validation return false when
	 *  validation is optional and
	 *  input not phone number?
	 *
	 */
	public function test_phone_returns_false_when_optional_input_not_phone() {
		$optional = true;
		$result = self::$validator->validate('not a phone num', $optional);
		$this->assertFalse( $result );
	}

}