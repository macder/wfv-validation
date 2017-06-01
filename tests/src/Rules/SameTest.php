<?php
namespace WFV\Rules;

use \Respect\Validation\Validator;

class SameTest extends \PHPUnit_Framework_TestCase {

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
			'test_field'
		);
		self::$validator = new Same();
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
	 * Does same return true when
	 *  input value is same as other field
	 *
	 */
	public function test_same_returns_true_when_input_same_other_field() {
		$optional = false;

		$_POST = array(
			'other_field' => 'same value',
			'test_field' => 'same value',
		);

		$result = self::$validator->validate( null, $optional, self::$params );
		$this->assertTrue( $result );
	}

	/**
	 * Does same return true when
	 *  input and compare value are blank?
	 *
	 */
	public function test_same_returns_true_when_input_empty_compare_empty() {
		$optional = false;

		$_POST = array(
			'other_field' => '',
			'test_field' => '',
		);

		$result = self::$validator->validate( null, $optional, self::$params );
		$this->assertTrue( $result );
	}

	/**
	 * Does same return false when
	 *  input value is different from other field
	 *
	 */
	public function test_same_returns_false_when_input_different() {
		$optional = false;

		$_POST = array(
			'other_field' => 'is some value',
			'test_field' => 'has different value',
		);

		$result = self::$validator->validate( null, $optional, self::$params );
		$this->assertFalse( $result );
	}

}
