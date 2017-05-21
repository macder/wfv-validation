<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class EqualsTest extends \PHPUnit_Framework_TestCase {

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
		self::$validator = new Equals();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does equal validation return true when
	 *  validation is NOT optional
	 *  and input is equal to given value?
	 *
	 */
	public function test_equals_returns_true_when_not_optional_and_input_equal() {
		$optional = false;
		$params = ['must_equal_this'];

		$result = self::$validator->validate( 'must_equal_this', $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does equal validation return true when
	 *  validation is optional
	 *  and input is equal to given value?
	 *
	 */
	public function test_equals_returns_true_when_optional_and_input_equal() {
		$optional = true;
		$params = ['must_equal_this'];

		$result = self::$validator->validate( 'must_equal_this', $optional, $params );
		$this->assertTrue( $result );
	}

	/**
	 * Does equal validation return false when
	 *  validation is NOT optional
	 *  and input is NOT equal to given value?
	 *
	 */
	public function test_equals_returns_false_when_not_optional_and_input_equal() {
		$optional = false;
		$params = ['must_equal_this'];

		$result = self::$validator->validate( 'does_not_equal_that', $optional, $params );
		$this->assertFalse( $result );
	}

	/**
	 * Does equal validation return false when
	 *  validation is optional
	 *  and input is NOT equal to given value?
	 *
	 */
	public function test_equals_returns_false_when_optional_and_input_equal() {
		$optional = true;
		$params = ['must_equal_this'];

		$result = self::$validator->validate( 'does_not_equal_that', $optional, $params );
		$this->assertFalse( $result );
	}

	/**
	 * Does equal validation return false when
	 *  validation is NOT optional
	 *  and input is null?
	 *
	 */
	public function test_equals_returns_false_when_not_optional_and_input_null() {
		$optional = false;
		$params = ['must_equal_this'];

		$result = self::$validator->validate( null, $optional, $params );
		$this->assertFalse( $result );
	}

	/**
	 * Does equal validation return true when
	 *  validation is optional
	 *  and input is null?
	 *
	 */
	public function test_equals_returns_false_when_optional_and_input_null() {
		$optional = true;
		$params = ['must_equal_this'];

		$result = self::$validator->validate( null, $optional, $params );
		$this->assertTrue( $result );
	}

}
