<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class AlphaDashTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Does alpha_dash validation return true when
	 *  validation is NOT optional
	 *  and input is only alpha chars?
	 *
	 */
	public function test_alphadash_returns_true_when_not_optional_and_input_alpha() {
		$optional = false;
		$validator = new AlphaDash( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'abcdefghi' );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is NOT optional
	 *  and input is alpha chars with spaces?
	 *
	 */
	public function test_alphadash_returns_true_when_not_optional_and_input_alpha_spaces() {
		$optional = false;
		$validator = new AlphaDash( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'abc def ghi' );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is optional
	 *  and input is empty?
	 *
	 */
	public function test_alphadash_returns_true_when_optional_and_input_empty() {
		$optional = true;
		$validator = new AlphaDash( new Validator(), 'test_field', $optional );

		$result = $validator->validate( '' );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is optional
	 *  and input is alpha chars?
	 *
	 */
	public function test_alphadash_returns_true_when_optional_and_input_alpha() {
		$optional = true;
		$validator = new AlphaDash( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'abcdefghi' );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return false when
	 *  validation is NOT optional
	 *  and input is alpha-numeric?
	 *
	 */
	public function test_alphadash_returns_false_when_not_optional_and_input_alphanum() {
		$optional = false;
		$validator = new AlphaDash( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'abcdefghi123' );
		$this->assertFalse( $result );
	}

	/**
	 * Does alpha_dash validation return false when
	 *  validation is optional
	 *  and input is alpha-numeric?
	 *
	 */
	public function test_alphadash_returns_false_when_optional_and_input_alphanum() {
		$optional = true;
		$validator = new AlphaDash( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'abcdefghi123' );
		$this->assertFalse( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is NOT optional
	 *  and input is alpha and dash?
	 *
	 */
	public function test_alphadash_returns_true_when_not_optional_and_input_alpha_dash() {
		$optional = false;
		$validator = new AlphaDash( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'abc-def-ghi' );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is optional
	 *  and input is alpha and dash?
	 *
	 */
	public function test_alphadash_returns_true_when_optional_and_input_alpha_dash() {
		$optional = true;
		$validator = new AlphaDash( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'abc-def-ghi' );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is NOT optional
	 *  and input is alpha and underscore?
	 *
	 */
	public function test_alphadash_returns_true_when_not_optional_and_input_alpha_underscore() {
		$optional = false;
		$validator = new AlphaDash( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'abc_def_ghi' );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is optional
	 *  and input is alpha and underscore?
	 *
	 */
	public function test_alphadash_returns_true_when_optional_and_input_alpha_underscore() {
		$optional = true;
		$validator = new AlphaDash( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'abc_def_ghi' );
		$this->assertTrue( $result );
	}


	/**
	 * Does alpha_dash validation return true when
	 *  validation is NOT optional
	 *  and input is alpha, dash, and underscore?
	 *
	 */
	public function test_alphadash_returns_true_when_not_optional_and_input_alphadash_underscore() {
		$optional = false;
		$validator = new AlphaDash( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'a-bc_d-f_gh-i' );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is optional
	 *  and input is alpha, dash, and underscore?
	 *
	 */
	public function test_alphadash_returns_true_when_optional_and_input_alphadash_underscore() {
		$optional = true;
		$validator = new AlphaDash( new Validator(), 'test_field', $optional );

		$result = $validator->validate( 'a-bc_d-ef_g-hi' );
		$this->assertTrue( $result );
	}
}
