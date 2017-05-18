<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class AlphaTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Does alpha validation return true when
	 *  validation is NOT optional
	 *  and input is only alpha chars?
	 *
	 */
	public function test_alpha_returns_true_when_not_optional_and_input_alpha() {
		$optional = false;
		$validator = new Alpha( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'abcdefghi' );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha validation return true when
	 *  validation is NOT optional
	 *  and input is alpha chars with spaces?
	 *
	 */
	public function test_alpha_returns_true_when_not_optional_and_input_alpha_spaces() {
		$optional = false;
		$validator = new Alpha( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'abc def ghi' );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha validation return true when
	 *  validation is optional
	 *  and input is empty?
	 *
	 */
	public function test_alpha_returns_true_when_optional_and_input_empty() {
		$optional = true;
		$validator = new Alpha( new Validator(), 'test_field', $optional );

		$result = $validator->validate( '' );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha validation return true when
	 *  validation is optional
	 *  and input is alpha chars?
	 *
	 */
	public function test_alpha_returns_true_when_optional_and_input_alpha() {
		$optional = true;
		$validator = new Alpha( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'abcdefghi' );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha validation return false when
	 *  validation is NOT optional
	 *  and input is alpha-numeric?
	 *
	 */
	public function test_alpha_returns_false_when_not_optional_and_input_alphanum() {
		$optional = false;
		$validator = new Alpha( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'abcdefghi123' );
		$this->assertFalse( $result );
	}

	/**
	 * Does alpha validation return false when
	 *  validation is optional
	 *  and input is alpha-numeric?
	 *
	 */
	public function test_alpha_returns_false_when_optional_and_input_alphanum() {
		$optional = true;
		$validator = new Alpha( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'abcdefghi123' );
		$this->assertFalse( $result );
	}

}
