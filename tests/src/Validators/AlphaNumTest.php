<?php
namespace WFV\Validators;

use \Respect\Validation\Validator;

class AlphaNumTest extends \PHPUnit_Framework_TestCase {

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
		self::$validator = new AlphaNum();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does alpha_num validation return true when
	 *  validation is NOT optional
	 *  and input is only alphanum chars?
	 *
	 */
	public function test_alphanum_returns_true_when_not_optional_and_input_alphanum() {
		$optional = false;

		$result = self::$validator->validate( 'abc 123', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_num validation return true when
	 *  validation is optional
	 *  and input is only alphanum chars?
	 *
	 */
	public function test_alphanum_returns_true_when_optional_and_input_alphanum() {
		$optional = true;

		$result = self::$validator->validate( 'abc 123', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_num validation return false when
	 *  validation is NOT optional
	 *  and input is NOT alphanum chars?
	 *
	 */
	public function test_alphanum_returns_false_when_not_optional_and_input_not_alphanum() {
		$optional = false;

		$result = self::$validator->validate( '?!@', $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does alpha_num validation return false when
	 *  validation is optional
	 *  and input is NOT alphanum chars?
	 *
	 */
	public function test_alphanum_returns_false_when_optional_and_input_not_alphanum() {
		$optional = true;

		$result = self::$validator->validate( '?!@', $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does alpha_num validation return false when
	 *  validation is NOT optional
	 *  and input is null?
	 *
	 */
	public function test_alphanum_returns_false_when_not_optional_and_input_null() {
		$optional = false;

		$result = self::$validator->validate( null, $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does alpha_num validation return true when
	 *  validation is optional
	 *  and input null?
	 *
	 */
	public function test_alphanum_returns_true_when_optional_and_input_null() {
		$optional = true;

		$result = self::$validator->validate( null, $optional );
		$this->assertTrue( $result );
	}
}
