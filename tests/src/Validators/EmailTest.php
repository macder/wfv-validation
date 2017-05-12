<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;


class EmailTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Does email validation return true when input is email format string?
	 *
	 */
	public function test_email_returns_true_when_string_is_email_format() {
		$email = new Email( new Validator(), 'test_field' );
		$result = $email->validate('foo@bar.com');
		$this->assertTrue( $result );
	}

	/**
	 * Does email validation return false when input is NOT email format string?
	 *
	 */
	public function test_email_returns_false_when_string_not_email_format() {
		$email = new Email( new Validator(), 'test_field' );
		$result = $email->validate('foobarcom');
		$this->assertFalse( $result );
	}
}
