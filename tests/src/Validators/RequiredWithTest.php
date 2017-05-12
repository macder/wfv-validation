<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class RequiredWithTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var ValidateInterface
	 */
	protected static $required_with;

	/**
	 *
	 *
	 */
	protected function setUp() {
		$params = array(
				'other_field',
		);
		self::$required_with = new RequiredWith( new Validator(), 'test_field', $params );
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		$_POST = null;
		self::$required_with = null;
	}

	/**
	 * Does required_with return true when other field is not empty
	 *  and this field is not empty?
	 *
	 */
	public function test_required_with_returns_true_when_other_field_not_empty_value_this_not_empty() {
		$_POST = array(
			'other_field' => 'is not empty',
			'test_field' => 'is now required',
		);

		$result = self::$required_with->validate( $_POST );
		$this->assertTrue( $result );
	}

	/**
	 * Does required_with return true when other field is empty
	 *  and this field is not empty?
	 *
	 */
	public function test_required_with_returns_true_when_other_field_empty_value_this_not_empty() {
		$_POST = array(
			'other_field' => '',
			'test_field' => 'is now optional',
		);

		$result = self::$required_with->validate( $_POST );
		$this->assertTrue( $result );
	}

	/**
	 * Does required_with return true when other field is empty
	 *  and this field is empty?
	 *
	 */
	public function test_required_with_returns_true_when_other_field_empty_value_this_empty() {
		$_POST = array(
			'other_field' => '',
			'test_field' => '',
		);

		$result = self::$required_with->validate( $_POST );
		$this->assertTrue( $result );
	}

	/**
	 * Does required_with return false when other field is not empty
	 *  and this field is empty?
	 *
	 */
	public function test_required_with_returns_false_when_other_field_not_empty_this_empty() {
		$_POST = array(
			'other_field' => 'is not empty',
			'test_field' => '',
		);

		$result = self::$required_with->validate( $_POST );
		$this->assertFalse( $result );
	}

}