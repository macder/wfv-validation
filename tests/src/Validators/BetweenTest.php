<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class BetweenTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Does between validation return true when
	 *  validation is NOT optional,
	 *  range is numeric, and input is within numeric range?
	 *
	 */
	public function test_between_returns_true_when_not_optional_and_input_in_num_range() {
		$optional = false;
		$params = [
			0,5
		];
		$validator = ( new Between( 'test_field', $params ) )->set_policy( $optional );

		$result = $validator->validate( 3 );
		$this->assertTrue( $result );
	}

	/**
	 * Does between validation return true when
	 *  validation is optional,
	 *  range is numeric, and input is within numeric range?
	 *
	 */
	public function test_between_returns_true_when_optional_and_input_in_num_range() {
		$optional = true;
		$params = [
			0,5
		];
		$validator = ( new Between( 'test_field', $params ) )->set_policy( $optional );

		$result = $validator->validate( 3 );
		$this->assertTrue( $result );
	}

	/**
	 * Does between validation return false when
	 *  validation is NOT optional,
	 *  range is numeric, and input is outside numeric range?
	 *
	 */
	public function test_between_returns_false_when_not_optional_and_input_not_num_range() {
		$optional = false;
		$params = [
			0,5
		];
		$validator = ( new Between( 'test_field', $params ) )->set_policy( $optional );

		$result = $validator->validate( 10 );
		$this->assertFalse( $result );
	}

	/**
	 * Does between validation return false when
	 *  validation is optional,
	 *  range is numeric, and input is outside numeric range?
	 *
	 */
	public function test_between_returns_false_when_optional_and_input_not_num_range() {
		$optional = true;
		$params = [
			0,5
		];
		$validator = ( new Between( 'test_field', $params ) )->set_policy( $optional );

		$result = $validator->validate( 10 );
		$this->assertFalse( $result );
	}


	/**
	 * Does between validation return true when
	 *  validation is NOT optional,
	 *  range is alpha, and input is within alpha range?
	 *
	 */
	public function test_between_returns_true_when_not_optional_and_input_in_alpha_range() {
		$optional = false;
		$params = [
			'a', 'f'
		];
		$validator = ( new Between( 'test_field', $params ) )->set_policy( $optional );

		$result = $validator->validate( 'c' );
		$this->assertTrue( $result );
	}

	/**
	 * Does between validation return true when
	 *  validation is optional,
	 *  range is alpha, and input is within alpha range?
	 *
	 */
	public function test_between_returns_true_when_optional_and_input_in_alpha_range() {
		$optional = true;
		$params = [
			'a', 'f'
		];
		$validator = ( new Between( 'test_field', $params ) )->set_policy( $optional );

		$result = $validator->validate( 'c' );
		$this->assertTrue( $result );
	}

	/**
	 * Does between validation return false when
	 *  validation is NOT optional,
	 *  range is alpha, and input outside alpha range?
	 *
	 */
	public function test_between_returns_false_when_not_optional_and_input_not_alpha_range() {
		$optional = false;
		$params = [
			'a', 'f'
		];
		$validator = ( new Between( 'test_field', $params ) )->set_policy( $optional );

		$result = $validator->validate( 'z' );
		$this->assertFalse( $result );
	}

	/**
	 * Does between validation return false when
	 *  validation is optional,
	 *  range is alpha, and input outside alpha range?
	 *
	 */
	public function test_between_returns_false_when_optional_and_input_not_alpha_range() {
		$optional = true;
		$params = [
			'a', 'f'
		];
		$validator = ( new Between( 'test_field', $params ) )->set_policy( $optional );

		$result = $validator->validate( 'z' );
		$this->assertFalse( $result );
	}
}
