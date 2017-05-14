<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class CallbackTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Does callback validation return true when
	 *  validation is NOT optional
	 *  and input is a string?
	 *
	 */
	public function test_callback_returns_true_when_not_optional_and_input_string() {
		$optional = false;
		$params = ['is_string'];
		$validator = new Callback( new Validator(), 'test_field', $optional, $params );

		$result = $validator->validate('test_input');
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
		$validator = new Callback( new Validator(), 'test_field', $optional, $params );

		$result = $validator->validate('test_input');
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
		$validator = new Callback( new Validator(), 'test_field', $optional, $params );

		$result = $validator->validate( null );
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
		$validator = new Callback( new Validator(), 'test_field', $optional, $params );

		$result = $validator->validate( null );
		$this->assertTrue( $result );
	}
}
