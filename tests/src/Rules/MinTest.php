<?php
namespace WFV\Rules;

use \Respect\Validation\Validator;

class MinTest extends \PHPUnit_Framework_TestCase {

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
		self::$validator = new Min();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does min validation return true when
	 *  validation is NOT optional
	 *  and input exceeds int min?
	 *
	 */
	public function test_min_returns_true_when_not_optional_and_input_int_above() {
		$optional = false;
		$params = [10];

		$result = self::$validator->validate( 15, $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does min validation return false when
	 *  validation is NOT optional
	 *  and input below int min?
	 *
	 */
	public function test_min_returns_true_when_not_optional_and_input_int_below() {
		$optional = false;
		$params = [10];

		$result = self::$validator->validate( 5, $optional, $params );
		$this->assertFalse( $result );
	}

	/**
	 * Does min validation return true when
	 *  validation is optional
	 *  and input exceeds int min?
	 *
	 */
	public function test_min_returns_true_when_optional_and_input_int_above() {
		$optional = true;
		$params = [10];

		$result = self::$validator->validate( 15, $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does min validation return false when
	 *  validation is optional
	 *  and input below int min?
	 *
	 */
	public function test_min_returns_false_when_optional_and_input_int_below() {
		$optional = true;
		$params = [10];

		$result = self::$validator->validate( 5, $optional, $params );
		$this->assertFalse( $result );
	}


	/**
	 * Does min validation return true when
	 *  validation is NOT optional
	 *  and input exceeds alpha min?
	 *
	 */
	public function test_min_returns_true_when_not_optional_and_input_alpha_above() {
		$optional = false;
		$params = ['c'];

		$result = self::$validator->validate( 'd', $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does min validation return false when
	 *  validation is NOT optional
	 *  and input below alpha min?
	 *
	 */
	public function test_min_returns_false_when_not_optional_and_input_alpha_below() {
		$optional = false;
		$params = ['c'];

		$result = self::$validator->validate( 'a', $optional, $params );
		$this->assertFalse( $result );
	}

	/**
	 * Does min validation return true when
	 *  validation is optional
	 *  and input exceeds alpha min?
	 *
	 */
	public function test_min_returns_true_when_optional_and_input_alpha_above() {
		$optional = true;
		$params = ['c'];

		$result = self::$validator->validate( 'd', $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does min validation return false when
	 *  validation is optional
	 *  and input below alpha min?
	 *
	 */
	public function test_min_returns_false_when_optional_and_input_alpha_below() {
		$optional = true;
		$params = ['c'];

		$result = self::$validator->validate( 'a', $optional, $params );
		$this->assertFalse( $result );
	}

	/**
	 * Does min validation return true when
	 *  validation is NOT optional
	 *  and input exceeds date min?
	 *
	 */
	public function test_min_returns_true_when_not_optional_and_input_date_above() {
		$optional = false;
		$params = ['2017-06-30'];

		$result = self::$validator->validate( '2017-07-29', $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does min validation return false when
	 *  validation is NOT optional
	 *  and input below date min?
	 *
	 */
	public function test_min_returns_false_when_not_optional_and_input_date_below() {
		$optional = false;
		$params = ['2017-06-30'];

		$result = self::$validator->validate( '2017-05-29', $optional, $params );
		$this->assertFalse( $result );
	}

	/**
	 * Does min validation return true when
	 *  validation is optional
	 *  and input exceeds date min?
	 *
	 */
	public function test_min_returns_true_when_optional_and_input_date_above() {
		$optional = true;
		$params = ['2017-06-30'];

		$result = self::$validator->validate( '2017-07-29', $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does min validation return false when
	 *  validation is optional
	 *  and input below date min?
	 *
	 */
	public function test_min_returns_false_when_optional_and_input_date_below() {
		$optional = true;
		$params = ['2017-06-30'];

		$result = self::$validator->validate( '2017-05-29', $optional, $params );
		$this->assertFalse( $result );
	}

}