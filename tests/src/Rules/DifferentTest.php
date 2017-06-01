<?php
namespace WFV\Rules;

use \Respect\Validation\Validator;

class DifferentTest extends \PHPUnit_Framework_TestCase {

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
	 * @access protected
	 * @var
	 */
	protected static $params;

	/**
	 *
	 *
	 */
	protected function setUp() {
		self::$params = array(
				'other_field',
		);
		self::$validator = new Different();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		$_POST = null;
		self::$validator = null;
	}

	/**
	 * Does different return true when
	 *  validation is NOT optional
	 *  and this field is different than other field?
	 *
	 */
	public function test_different_returns_true_when_not_optional_input_different_other_field() {
		$optional = false;

		$_POST = array(
			'other_field' => 'has different value',
		);

		$result = self::$validator->validate( 'is some value', $optional, self::$params );
		$this->assertTrue( $result );
	}

	/**
	 * Does different return true when
	 *  validation is optional
	 *  and this field is different than other field?
	 *
	 */
	public function test_different_returns_true_when_optional_input_different_other_field() {
		$optional = true;

		$_POST = array(
			'other_field' => 'has different value',
		);

		$result = self::$validator->validate( 'is some value', $optional, self::$params );
		$this->assertTrue( $result );
	}


	/**
	 * Does different return false when
	 *  validation is NOT optional
	 *  and this field is same as other field?
	 *
	 */
	public function test_different_returns_false_when_not_optional_input_same_other_field() {
		$optional = false;

		$_POST = array(
			'other_field' => 'same value',
		);

		$result = self::$validator->validate( 'same value', $optional, self::$params );
		$this->assertFalse( $result );
	}

	/**
	 * Does different return false when
	 *  validation is optional
	 *  and this field is same as other field?
	 *
	 */
	public function test_different_returns_false_when_optional_input_same_other_field() {
		$optional = true;

		$_POST = array(
			'other_field' => 'same value',
		);

		$result = self::$validator->validate( 'same value', $optional, self::$params );
		$this->assertFalse( $result );
	}

	/**
	 * Does different return true when
	 *  validation is optional
	 *  and this field is empty
	 *  and other field is empty?
	 *
	 */
	public function test_different_returns_true_when_optional_input_empty_other_field_empty() {
		$optional = true;

		$_POST = array(
			'other_field' => '',
		);

		$result = self::$validator->validate( '', $optional, self::$params );
		$this->assertTrue( $result );
	}

	/**
	 * Does different return true when
	 *  validation is optional
	 *  and this field is empty
	 *  and other field is string?
	 *
	 */
	public function test_different_returns_true_when_optional_input_empty_other_field_string() {
		$optional = true;

		$_POST = array(
			'other_field' => 'has a value',
		);

		$result = self::$validator->validate( '', $optional, self::$params );
		$this->assertTrue( $result );
	}

}
