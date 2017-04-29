<?php
namespace WFV\Component;

use WFV\Component\Input;

class InputTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $http_post;

	/**
	 *
	 *
	 */
  protected function setUp() {
    self::$http_post = array(
      'action' => 'phpunit',
      'name' => 'Foo Bar',
      'email' => 'foo@bar.com',
      'shades' => array(
        'lightest',
        'light',
        'dark',
        'darkest',
      ),
      'color' => array(
        'red',
        'green',
        'blue',
      )
    );
	}

	/**
	 *
	 *
	 */
	protected function tearDown() {
		self::$http_post = null;
		$_POST = null;
	}

	/**
	 *
	 *
	 */
	public function testInputIsInstanceOfInputBeforePost() {
		$result = new Input('phpunit');
		$this->assertInstanceOf( 'WFV\Component\Input', $result );
	}

	/**
	 *
	 *
	 */
	public function testInputIsInstanceOfInputAfterPost() {
		$_POST = self::$http_post;
		$result = new Input('phpunit');
		$this->assertInstanceOf( 'WFV\Component\Input', $result );
	}

	/**
	 *
	 *
	 */
	public function testInputIsEmptyBeforePost() {
		$result = new Input('phpunit');
		$this->assertFalse( $result->is_not_empty() );
	}

	/**
	 *
	 *
	 */
	public function testInputIsNotEmptyAfterPost() {
		$_POST = self::$http_post;
		$result = new Input('phpunit');
		$this->assertTrue( $result->is_not_empty() );
	}
}
