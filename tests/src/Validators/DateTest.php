<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class DateTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Does date validation return true when
	 *  validation is NOT optional
	 *  and input is date string?
	 *
	 */
	public function test_date_returns_true_when_not_optional_and_input_date_string() {
		$optional = false;
		$validator = ( new Date('test_field') )->set_policy( $optional );

		$result = $validator->validate( '2017-06-31' );
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
		$validator = ( new Date('test_field') )->set_policy( $optional );

		$result = $validator->validate( '2017-06-31' );
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
		$validator = ( new Date('test_field') )->set_policy( $optional );

		$result = $validator->validate( 'now' );
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
		$validator = ( new Date('test_field') )->set_policy( $optional );

		$result = $validator->validate( 'now' );
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
		$validator = ( new Date('test_field', ['Y-m-d']) )->set_policy( $optional );

		$result = $validator->validate( '2017-06-30' );
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
		$validator = ( new Date('test_field', ['Y-m-d']) )->set_policy( $optional );

		$result = $validator->validate( '2017-06-30' );
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
		$validator = ( new Date('test_field') )->set_policy( $optional );

		$result = $validator->validate( 'this is not a date' );
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
		$validator = ( new Date('test_field') )->set_policy( $optional );

		$result = $validator->validate( 'this is not a date' );
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
		$validator = ( new Date('test_field') )->set_policy( $optional );

		$result = $validator->validate( null );
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
		$validator = ( new Date('test_field') )->set_policy( $optional );

		$result = $validator->validate( null );
		$this->assertTrue( $result );
	}
}
