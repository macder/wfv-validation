<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class IntegerTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Does integer validation return true when
	 *  validation is NOT optional
	 *  and input is int?
	 *
	 */
	public function test_integer_returns_true_when_not_optional_and_input_int() {
		$optional = false;
		$validator = ( new Integer('test_field') )->set_policy( $optional );

		$result = $validator->validate( 1 );
		$this->assertTrue( $result );
	}

	/**
	 * Does integer validation return true when
	 *  validation is optional
	 *  and input is int?
	 *
	 */
	public function test_integer_returns_true_when_optional_and_input_int() {
		$optional = true;
		$validator = ( new Integer('test_field') )->set_policy( $optional );

		$result = $validator->validate( 1 );
		$this->assertTrue( $result );
	}

	/**
	 * Does integer validation return false when
	 *  validation is NOT optional
	 *  and input is alpha?
	 *
	 */
	public function test_integer_returns_false_when_not_optional_and_input_alpha() {
		$optional = false;
		$validator = ( new Integer('test_field') )->set_policy( $optional );

		$result = $validator->validate( 'abcdefg' );
		$this->assertFalse( $result );
	}

	/**
	 * Does integer validation return false when
	 *  validation is optional
	 *  and input is alpha?
	 *
	 */
	public function test_integer_returns_tfalse_when_optional_and_input_alpha() {
		$optional = true;
		$validator = ( new Integer('test_field') )->set_policy( $optional );

		$result = $validator->validate( 'abcdefg' );
		$this->assertFalse( $result );
	}

}
