<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class BooleanTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Does boolean validation return true when
	 *  validation is NOT optional
	 *  and input is bool false?
	 *
	 */
	public function test_boolean_returns_true_when_not_optional_and_input_bool_false() {
		$optional = false;
		$validator = new Boolean( new Validator(), 'test_field', $optional );

		$result = $validator->validate( false );
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
		$validator = new Boolean( new Validator(), 'test_field', $optional );

		$result = $validator->validate( true );
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
		$validator = new Boolean( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 1 );
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
		$validator = new Boolean( new Validator(), 'test_field', $optional );

		$result = $validator->validate( '1' );
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
		$validator = new Boolean( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 0 );
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
		$validator = new Boolean( new Validator(), 'test_field', $optional );

		$result = $validator->validate( '0' );
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
		$validator = new Boolean( new Validator(), 'test_field', $optional );

		$result = $validator->validate( false );
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
		$validator = new Boolean( new Validator(), 'test_field', $optional );

		$result = $validator->validate( true );
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
		$validator = new Boolean( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 1 );
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
		$validator = new Boolean( new Validator(), 'test_field', $optional );

		$result = $validator->validate( '1' );
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
		$validator = new Boolean( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 0 );
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
		$validator = new Boolean( new Validator(), 'test_field', $optional );

		$result = $validator->validate( '0' );
		$this->assertTrue( $result );
	}
}
