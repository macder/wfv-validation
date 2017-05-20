<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class AlphaNumTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Does alpha_num validation return true when
	 *  validation is NOT optional
	 *  and input is only alphanum chars?
	 *
	 */
	public function test_alphanum_returns_true_when_not_optional_and_input_alphanum() {
		$optional = false;
		$validator = ( new AlphaNum( 'test_field' ) )->set_policy( $optional );

		$result = $validator->validate( 'abc 123' );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_num validation return true when
	 *  validation is optional
	 *  and input is only alphanum chars?
	 *
	 */
	public function test_alphanum_returns_true_when_optional_and_input_alphanum() {
		$optional = true;
		$validator = ( new AlphaNum( 'test_field' ) )->set_policy( $optional );

		$result = $validator->validate( 'abc 123' );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_num validation return false when
	 *  validation is NOT optional
	 *  and input is NOT alphanum chars?
	 *
	 */
	public function test_alphanum_returns_false_when_not_optional_and_input_not_alphanum() {
		$optional = false;
		$validator = ( new AlphaNum( 'test_field' ) )->set_policy( $optional );

		$result = $validator->validate( '?!@' );
		$this->assertFalse( $result );
	}

	/**
	 * Does alpha_num validation return false when
	 *  validation is optional
	 *  and input is NOT alphanum chars?
	 *
	 */
	public function test_alphanum_returns_false_when_optional_and_input_not_alphanum() {
		$optional = true;
		$validator = ( new AlphaNum( 'test_field' ) )->set_policy( $optional );

		$result = $validator->validate( '?!@' );
		$this->assertFalse( $result );
	}

	/**
	 * Does alpha_num validation return false when
	 *  validation is NOT optional
	 *  and input is null?
	 *
	 */
	public function test_alphanum_returns_false_when_not_optional_and_input_null() {
		$optional = false;
		$validator = ( new AlphaNum( 'test_field' ) )->set_policy( $optional );

		$result = $validator->validate( null );
		$this->assertFalse( $result );
	}

	/**
	 * Does alpha_num validation return true when
	 *  validation is optional
	 *  and input null?
	 *
	 */
	public function test_alphanum_returns_true_when_optional_and_input_null() {
		$optional = true;
		$validator = ( new AlphaNum( 'test_field' ) )->set_policy( $optional );

		$result = $validator->validate( null );
		$this->assertTrue( $result );
	}
}
