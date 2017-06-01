<?php
namespace WFV\Rules;

use \Respect\Validation\Validator;

class AlphaDashTest extends \PHPUnit_Framework_TestCase {

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
		self::$validator = new AlphaDash();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is NOT optional
	 *  and input is only alpha chars?
	 *
	 */
	public function test_alphadash_returns_true_when_not_optional_and_input_alpha() {
		$optional = false;

		$result = self::$validator->validate( 'abcdefghi', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is NOT optional
	 *  and input is alpha chars with spaces?
	 *
	 */
	public function test_alphadash_returns_true_when_not_optional_and_input_alpha_spaces() {
		$optional = false;

		$result = self::$validator->validate( 'abc def ghi', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is optional
	 *  and input is empty?
	 *
	 */
	public function test_alphadash_returns_true_when_optional_and_input_empty() {
		$optional = true;

		$result = self::$validator->validate( '', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is optional
	 *  and input is alpha chars?
	 *
	 */
	public function test_alphadash_returns_true_when_optional_and_input_alpha() {
		$optional = true;

		$result = self::$validator->validate( 'abcdefghi', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return false when
	 *  validation is NOT optional
	 *  and input is alpha-numeric?
	 *
	 */
	public function test_alphadash_returns_false_when_not_optional_and_input_alphanum() {
		$optional = false;

		$result = self::$validator->validate( 'abcdefghi123', $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does alpha_dash validation return false when
	 *  validation is optional
	 *  and input is alpha-numeric?
	 *
	 */
	public function test_alphadash_returns_false_when_optional_and_input_alphanum() {
		$optional = true;

		$result = self::$validator->validate( 'abcdefghi123', $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is NOT optional
	 *  and input is alpha and dash?
	 *
	 */
	public function test_alphadash_returns_true_when_not_optional_and_input_alpha_dash() {
		$optional = false;

		$result = self::$validator->validate( 'abc-def-ghi', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is optional
	 *  and input is alpha and dash?
	 *
	 */
	public function test_alphadash_returns_true_when_optional_and_input_alpha_dash() {
		$optional = true;

		$result = self::$validator->validate( 'abc-def-ghi', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is NOT optional
	 *  and input is alpha and underscore?
	 *
	 */
	public function test_alphadash_returns_true_when_not_optional_and_input_alpha_underscore() {
		$optional = false;

		$result = self::$validator->validate( 'abc_def_ghi', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is optional
	 *  and input is alpha and underscore?
	 *
	 */
	public function test_alphadash_returns_true_when_optional_and_input_alpha_underscore() {
		$optional = true;

		$result = self::$validator->validate( 'abc_def_ghi', $optional );
		$this->assertTrue( $result );
	}


	/**
	 * Does alpha_dash validation return true when
	 *  validation is NOT optional
	 *  and input is alpha, dash, and underscore?
	 *
	 */
	public function test_alphadash_returns_true_when_not_optional_and_input_alphadash_underscore() {
		$optional = false;

		$result = self::$validator->validate( 'a-bc_d-f_gh-i', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does alpha_dash validation return true when
	 *  validation is optional
	 *  and input is alpha, dash, and underscore?
	 *
	 */
	public function test_alphadash_returns_true_when_optional_and_input_alphadash_underscore() {
		$optional = true;

		$result = self::$validator->validate( 'a-bc_d-ef_g-hi', $optional );
		$this->assertTrue( $result );
	}
}
