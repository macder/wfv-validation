<?php
namespace WFV\Rules;

use \Respect\Validation\Validator;

class DateTest extends \PHPUnit_Framework_TestCase {

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
		self::$validator = new Date();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does date validation return true when
	 *  validation is NOT optional
	 *  and input is date string?
	 *
	 */
	public function test_date_returns_true_when_not_optional_and_input_date_string() {
		$optional = false;

		$result = self::$validator->validate( '2017-06-31', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does date validation return true when
	 *  validation is optional
	 *  and input is date string?
	 *
	 */
	public function test_date_returns_true_when_optional_and_input_date_string() {
		$optional = true;

		$result = self::$validator->validate( '2017-06-31', $optional );
		$this->assertTrue( $result );
	}


	/**
	 * Does date validation return true when
	 *  validation is NOT optional
	 *  and input is strtotime?
	 *
	 */
	public function test_date_returns_true_when_not_optional_and_input_strtotime() {
		$optional = false;

		$result = self::$validator->validate( 'now', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does date validation return true when
	 *  validation is optional
	 *  and input is strtotime?
	 *
	 */
	public function test_date_returns_true_when_optional_and_input_strtotime() {
		$optional = true;

		$result = self::$validator->validate( 'now', $optional );
		$this->assertTrue( $result );
	}



	/**
	 * Does date validation return true when
	 *  validation is NOT optional with format param
	 *  and input is date in param format?
	 *
	 */
	public function test_date_returns_true_when_not_optional_and_input_format_param() {
		$optional = false;
		$params = [ 'Y-m-d' ];

		$result = self::$validator->validate( '2017-06-30', $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does date validation return true when
	 *  validation is optional with format param
	 *  and input is date in param format?
	 *
	 */
	public function test_date_returns_true_when_optional_and_input_format_param() {
		$optional = true;
		$params = [ 'Y-m-d' ];

		$result = self::$validator->validate( '2017-06-30', $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does date validation return false when
	 *  validation is NOT optional
	 *  and input is not date?
	 *
	 */
	public function test_date_returns_false_when_not_optional_and_input_not_date() {
		$optional = false;

		$result = self::$validator->validate( 'this is not a date', $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does date validation return false when
	 *  validation is optional
	 *  and input is not date?
	 *
	 */
	public function test_date_returns_false_when_optional_and_input_not_date() {
		$optional = true;

		$result = self::$validator->validate( 'this is not a date', $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does date validation return false when
	 *  validation is NOT optional
	 *  and input is null?
	 *
	 */
	public function test_date_returns_false_when_not_optional_and_input_null() {
		$optional = false;

		$result = self::$validator->validate( null, $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does date validation return true when
	 *  validation is optional
	 *  and input is null?
	 *
	 */
	public function test_date_returns_true_when_optional_and_input_null() {
		$optional = true;

		$result = self::$validator->validate( null, $optional );
		$this->assertTrue( $result );
	}
}
