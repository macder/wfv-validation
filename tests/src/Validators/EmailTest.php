<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;


class EmailTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Does email validation return true when
	 *  validation is NOT optional and
	 *  input is email format string?
	 *
	 */
	public function test_email_returns_true_when_string_is_email_format() {
		$optional = false;
		$email = ( new Email('test_field') )->set_policy( $optional );
		$result = $email->validate('foo@bar.com');
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
		$email = ( new Email('test_field') )->set_policy( $optional );
		$result = $email->validate('foobarcom');
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
		$email = ( new Email('test_field') )->set_policy( $optional );
		$result = $email->validate('');
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
		$email = ( new Email('test_field') )->set_policy( $optional );
		$result = $email->validate('foo@bar.com');
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
		$email = ( new Email('test_field') )->set_policy( $optional );
		$result = $email->validate('');
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
		$email = ( new Email('test_field') )->set_policy( $optional );
		$result = $email->validate('foobarcom');
		$this->assertFalse( $result );
	}
}
