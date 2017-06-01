<?php
namespace WFV\Rules;

use \Respect\Validation\Validator;


class UrlTest extends \PHPUnit_Framework_TestCase {

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
		self::$validator = new Url();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does url validation return true when
	 *  validation is NOT optional and
	 *  input is url string?
	 *
	 */
	public function test_url_returns_true_when_not_optional_input_url_string() {
		$optional = false;
		$result = self::$validator->validate('http://google.com', $optional);
		$this->assertTrue( $result );
	}

	/**
	 * Does url validation return true when
	 *  validation is optional and
	 *  input is url string?
	 *
	 */
	public function test_url_returns_true_when_optional_input_url_string() {
		$optional = true;
		$result = self::$validator->validate('http://google.com', $optional);
		$this->assertTrue( $result );
	}

	/**
	 * Does url validation return false when
	 *  validation is NOT optional and
	 *  input not url?
	 *
	 */
	public function test_url_returns_false_when_not_optional_input_not_url() {
		$optional = false;
		$result = self::$validator->validate('not a url', $optional);
		$this->assertFalse( $result );
	}

	/**
	 * Does url validation return false when
	 *  validation is optional and
	 *  input not url?
	 *
	 */
	public function test_url_returns_false_when_optional_input_not_url() {
		$optional = true;
		$result = self::$validator->validate('not a url', $optional);
		$this->assertFalse( $result );
	}

}
