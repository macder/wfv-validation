<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class RequiredIfTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var ValidateInterface
	 */
	protected static $required_if;

	/**
	 *
	 *
	 */
	protected function setUp() {
		$params = array(
			'other_field',
			'is this value'
		);
		self::$required_if = new RequiredIf( new Validator(), 'test_field', $params );
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		$_POST = null;
		self::$required_if = null;
	}

	/**
	 * Does required_if return true when other field is given value
	 *  and this field is not empty?
	 *
	 */
	public function test_requiredif_returns_true_when_other_field_hasthe_value_this_not_empty() {
		$_POST = array(
			'other_field' => 'is this value',
			'test_field' => 'is now required',
		);

		$result = self::$required_if->validate( $_POST );
		$this->assertTrue( $result );
	}

	/**
	 * Does required_if return true when other field is empty
	 *  and this field is empty?
	 *
	 */
	public function test_requiredif_returns_true_when_other_field_blank_and_this_empty() {
		$_POST = array(
			'other_field' => '',
			'test_field' => '',
		);

		$result = self::$required_if->validate( $_POST );
		$this->assertTrue( $result );
	}

	/**
	 * Does required_if return true when other field has different value
	 *  and this field is empty?
	 *
	 */
	public function test_requiredif_returns_true_when_other_field_has_diff_value_and_this_empty() {
		$_POST = array(
			'other_field' => 'has different value',
			'test_field' => '',
		);

		$result = self::$required_if->validate( $_POST );
		$this->assertTrue( $result );
	}

	/**
	 * Does required_if return true when other field has different value
	 *  and this field is empty?
	 *
	 */
	public function test_requiredif_returns_true_when_other_field_empty_and_this_has_value() {
		$_POST = array(
			'other_field' => '',
			'test_field' => 'is not required',
		);

		$result = self::$required_if->validate( $_POST );
		$this->assertTrue( $result );
	}

	/**
	 * Does required_if return false when other field is given value
	 *  and this field is empty?
	 *
	 */
	public function test_requiredif_returns_false_when_other_field_has_value_this_field_empty() {
		$_POST = array(
			'other_field' => 'is this value',
			'test_field' => '',
		);

		$result = self::$required_if->validate( $_POST );
		$this->assertFalse( $result );
	}
}
