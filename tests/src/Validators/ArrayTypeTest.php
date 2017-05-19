<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class ArrayTypeTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Does array validation return true when
	 *  validation is NOT optional
	 *  and input is array?
	 *
	 */
	public function test_array_returns_true_when_not_optional_and_input_array() {
		$optional = false;
		$validator = ( new ArrayType('test_field') )->set_policy( $optional );

		$result = $validator->validate( array('test','test2') );
		$this->assertTrue( $result );
	}

	/**
	 * Does array validation return true when
	 *  validation is optional
	 *  and input is array?
	 *
	 */
	public function test_array_returns_true_when_optional_and_input_array() {
		$optional = true;
		$validator = ( new ArrayType('test_field') )->set_policy( $optional );

		$result = $validator->validate( array('test','test2') );
		$this->assertTrue( $result );
	}

	/**
	 * Does array validation return true when
	 *  validation is optional
	 *  and input is empty?
	 *
	 */
	public function test_array_returns_true_when_optional_and_input_empty() {
		$optional = true;
		$validator = ( new ArrayType('test_field') )->set_policy( $optional );

		$result = $validator->validate( null );
		$this->assertTrue( $result );
	}

	/**
	 * Does array validation return false when
	 *  validation is NOT optional
	 *  and input is string?
	 *
	 */
	public function test_array_returns_false_when_not_optional_and_input_string() {
		$optional = false;
		$validator = ( new ArrayType('test_field') )->set_policy( $optional );

		$result = $validator->validate( 'string val' );
		$this->assertFalse( $result );
	}

	/**
	 * Does array validation return false when
	 *  validation is optional
	 *  and input is string?
	 *
	 */
	public function test_array_returns_false_when_optional_and_input_string() {
		$optional = true;
		$validator = ( new ArrayType('test_field') )->set_policy( $optional );

		$result = $validator->validate( 'string val' );
		$this->assertFalse( $result );
	}

	/**
	 * Does array validation return false when
	 *  validation is NOT optional
	 *  and input is empty?
	 *
	 */
	public function test_array_returns_false_when_not_optional_and_input_null() {
		$optional = false;
		$validator = ( new ArrayType('test_field') )->set_policy( $optional );

		$result = $validator->validate( null );
		$this->assertFalse( $result );
	}
}
