<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class MaxTest extends \PHPUnit_Framework_TestCase {

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
		self::$validator = new Max();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does max validation return true when
	 *  validation is NOT optional
	 *  and input does NOT exceed int max?
	 *
	 */
	public function test_max_returns_true_when_not_optional_and_input_int_beneath() {
		$optional = false;
		$params = [10];

		$result = self::$validator->validate( 5, $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does max validation return false when
	 *  validation is NOT optional
	 *  and input exceeds int max?
	 *
	 */
	public function test_max_returns_false_when_not_optional_and_input_int_above() {
		$optional = false;
		$params = [10];

		$result = self::$validator->validate( 15, $optional, $params );
		$this->assertFalse( $result );
	}

	/**
	 * Does max validation return true when
	 *  validation is optional
	 *  and input does NOT exceed int max?
	 *
	 */
	public function test_max_returns_true_when_optional_and_input_int_beneath() {
		$optional = true;
		$params = [10];

		$result = self::$validator->validate( 5, $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does max validation return false when
	 *  validation is optional
	 *  and input exceeds int max?
	 *
	 */
	public function test_max_returns_false_when_optional_and_input_int_above() {
		$optional = false;
		$params = [10];

		$result = self::$validator->validate( 15, $optional, $params );
		$this->assertFalse( $result );
	}

	/**
	 * Does max validation return true when
	 *  validation is NOT optional
	 *  and input does NOT exceed alpha max?
	 *
	 */
	public function test_max_returns_true_when_not_optional_and_input_alpha_beneath() {
		$optional = false;
		$params = ['c'];

		$result = self::$validator->validate( 'a', $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does max validation return false when
	 *  validation is NOT optional
	 *  and input exceeds alpha max?
	 *
	 */
	public function test_max_returns_false_when_not_optional_and_input_alpha_above() {
		$optional = false;
		$params = ['c'];

		$result = self::$validator->validate( 'd', $optional, $params );
		$this->assertFalse( $result );
	}

	/**
	 * Does max validation return true when
	 *  validation is optional
	 *  and input does NOT exceed alpha max?
	 *
	 */
	public function test_max_returns_true_when_optional_and_input_alpha_beneath() {
		$optional = true;
		$params = ['c'];

		$result = self::$validator->validate( 'a', $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does max validation return false when
	 *  validation is optional
	 *  and input exceeds alpha max?
	 *
	 */
	public function test_max_returns_true_when_optional_and_input_alpha_above() {
		$optional = true;
		$params = ['c'];

		$result = self::$validator->validate( 'd', $optional, $params );
		$this->assertFalse( $result );
	}

	/**
	 * Does max validation return true when
	 *  validation is NOT optional
	 *  and input does NOT exceed date max?
	 *
	 */
	public function test_max_returns_true_when_not_optional_and_input_date_beneath() {
		$optional = false;
		$params = ['2017-06-30'];

		$result = self::$validator->validate( '2017-06-29', $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does max validation return false when
	 *  validation is NOT optional
	 *  and input exceeds date max?
	 *
	 */
	public function test_max_returns_false_when_not_optional_and_input_date_above() {
		$optional = false;
		$params = ['2017-06-30'];

		$result = self::$validator->validate( '2017-07-29', $optional, $params );
		$this->assertFalse( $result );
	}

	/**
	 * Does max validation return true when
	 *  validation is optional
	 *  and input does NOT exceed date max?
	 *
	 */
	public function test_max_returns_true_when_optional_and_input_date_beneath() {
		$optional = true;
		$params = ['2017-06-30'];

		$result = self::$validator->validate( '2017-06-29', $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does max validation return false when
	 *  validation is optional
	 *  and input exceeds date max?
	 *
	 */
	public function test_max_returns_true_when_optional_and_input_date_above() {
		$optional = true;
		$params = ['2017-06-30'];

		$result = self::$validator->validate( '2017-07-29', $optional, $params );
		$this->assertFalse( $result );
	}
}
