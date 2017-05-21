<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class BetweenTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var ValidateInterface
	 */
	protected static $validator;

	/**
	 *
	 *
	 */
	protected function setUp() {
		self::$validator = new Between();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

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

		$result = self::$validator->validate( 3, $optional, $params );
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

		$result = self::$validator->validate( 3, $optional, $params );
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

		$result = self::$validator->validate( 10, $optional, $params );
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

		$result = self::$validator->validate( 10, $optional, $params );
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

		$result = self::$validator->validate( 'c', $optional, $params );
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

		$result = self::$validator->validate( 'c', $optional, $params );
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

		$result = self::$validator->validate( 'z', $optional, $params );
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

		$result = self::$validator->validate( 'z', $optional, $params );
		$this->assertFalse( $result );
	}
}
