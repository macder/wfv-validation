<?php
namespace WFV\Rules;

use \Respect\Validation\Validator;

class IpTest extends \PHPUnit_Framework_TestCase {

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
		self::$validator = new Ip();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does IP validation return true when
	 *  validation is NOT optional
	 *  and input is IP address?
	 *
	 */
	public function test_ip_returns_true_when_not_optional_and_input_ip() {
		$optional = false;

		$result = self::$validator->validate( '192.168.1.1', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does IP validation return true when
	 *  validation is optional
	 *  and input is IP address?
	 *
	 */
	public function test_ip_returns_true_when_optional_and_input_ip() {
		$optional = true;

		$result = self::$validator->validate( '192.168.1.1', $optional );
		$this->assertTrue( $result );
	}

	/**
	 * Does IP validation return false when
	 *  validation is NOT optional
	 *  and input is NOT IP address?
	 *
	 */
	public function test_ip_returns_false_when_not_optional_and_input_not_ip() {
		$optional = false;

		$result = self::$validator->validate( 'not an ip address', $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does IP validation return false when
	 *  validation is optional
	 *  and input is NOT IP address?
	 *
	 */
	public function test_ip_returns_false_when_optional_and_input_not_ip() {
		$optional = true;

		$result = self::$validator->validate( 'not an ip address', $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does IP validation return false when
	 *  validation is NOT optional
	 *  and input is null?
	 *
	 */
	public function test_ip_returns_false_when_not_optional_and_input_null() {
		$optional = false;

		$result = self::$validator->validate( null, $optional );
		$this->assertFalse( $result );
	}

	/**
	 * Does IP validation return true when
	 *  validation is optional
	 *  and input is null?
	 *
	 */
	public function test_ip_returns_true_when_optional_and_input_null() {
		$optional = true;

		$result = self::$validator->validate( null, $optional );
		$this->assertTrue( $result );
	}

}
