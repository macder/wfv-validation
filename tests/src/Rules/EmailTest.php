<?php
namespace WFV\Rules;

use \Respect\Validation\Validator;


class EmailTest extends \PHPUnit_Framework_TestCase {

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
		self::$validator = new Email();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does email validation return true when
	 *  validation is NOT optional and
	 *  input is email format string?
	 *
	 */
	public function test_email_returns_true_when_string_is_email_format() {
		$optional = false;
		$result = self::$validator->validate('foo@bar.com', $optional);
		$this->assertTrue( $result );
	}

	/**
	 * Does email validation return false when
	 *  validation is NOT optional and
	 *  input is NOT email format string?
	 *
	 */
	public function test_email_returns_false_when_string_not_email_format() {
		$optional = false;
		$result = self::$validator->validate('foobarcom', $optional);
		$this->assertFalse( $result );
	}

	/**
	 * Does email validation return false when
	 *  validation is NOT optional and
	 *  input is empty?
	 *
	 */
	public function test_email_returns_false_when_not_optional_and_empty() {
		$optional = false;
		$result = self::$validator->validate('', $optional);
		$this->assertFalse( $result );
	}

	/**
	 * Does email validation return true when
	 *  validation is optional and
	 *  input is valid email string?
	 *
	 */
	public function test_email_returns_true_when_optional_and_valid_email() {
		$optional = true;
		$result = self::$validator->validate('foo@bar.com', $optional);
		$this->assertTrue( $result );
	}

	/**
	 * Does email validation return true when
	 *  validation is optional and
	 *  input is empty?
	 *
	 */
	public function test_email_returns_true_when_optional_and_empty() {
		$optional = true;
		$result = self::$validator->validate('', $optional);
		$this->assertTrue( $result );
	}

	/**
	 * Does email validation return false when
	 *  validation is optional and
	 *  input is not valid email string?
	 *
	 */
	public function test_email_returns_false_when_optional_and_invalid_email_string() {
		$optional = true;
		$result = self::$validator->validate('foobarcom', $optional);
		$this->assertFalse( $result );
	}
}
