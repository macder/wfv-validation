<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class DigitTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Does digit validation return true when
	 *  validation is NOT optional
	 *  and input is int digit?
	 *
	 */
	public function test_digit_returns_true_when_not_optional_and_input_int_digit() {
		$optional = false;
		$validator = ( new Digit('test_field') )->set_policy( $optional );

		$result = $validator->validate( 1 );
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
		$validator = ( new Digit('test_field') )->set_policy( $optional );

		$result = $validator->validate( 1 );
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
		$validator = ( new Digit('test_field') )->set_policy( $optional );

		$result = $validator->validate( '1' );
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
		$validator = ( new Digit('test_field') )->set_policy( $optional );

		$result = $validator->validate( '1' );
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
		$validator = ( new Digit('test_field') )->set_policy( $optional );

		$result = $validator->validate( null );
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
		$validator = ( new Digit('test_field') )->set_policy( $optional );

		$result = $validator->validate( null );
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
		$validator = ( new Digit('test_field') )->set_policy( $optional );

		$result = $validator->validate( 'string is not digit' );
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
		$validator = ( new Digit('test_field') )->set_policy( $optional );

		$result = $validator->validate( 'string is not digit' );
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
		$validator = ( new Digit('test_field') )->set_policy( $optional );

		$result = $validator->validate( 123 );
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
		$validator = ( new Digit('test_field') )->set_policy( $optional );

		$result = $validator->validate( 123 );
		$this->assertFalse( $result );
	}
}
