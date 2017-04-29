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
	public function test_input_is_instance_of_input_before_post() {
		$result = new Input('phpunit');
		$this->assertInstanceOf( 'WFV\Component\Input', $result );
	}

	/**
	 *
	 *
	 */
	public function test_input_is_instance_of_input_after_post() {
		$_POST = self::$http_post;
		$result = new Input('phpunit');
		$this->assertInstanceOf( 'WFV\Component\Input', $result );
	}

	/**
	 *
	 *
	 */
	public function test_form_does_checked_if_return_checked() {
		$_POST = self::$http_post;
		$result = new Input('phpunit');
		$this->assertEquals( 'checked', $result->checked_if( 'shades', 'dark' ) );
	}

	/**
	 *
	 *
	 */
	public function test_form_does_checked_if_return_null() {
		$_POST = self::$http_post;
		$result = new Input('phpunit');
		$this->assertEquals( null, $result->checked_if( 'shades', 'void' ) );
	}

	/**
	 *
	 *
	 */
	public function test_form_does_selected_if_return_selected() {
		$_POST = self::$http_post;
		$result = new Input('phpunit');
		$this->assertEquals( 'selected', $result->selected_if( 'shades', 'dark' ) );
	}

	/**
	 *
	 *
	 */
	public function test_form_does_selected_if_return_null() {
		$_POST = self::$http_post;
		$result = new Input('phpunit');
		$this->assertEquals( null, $result->selected_if( 'shades', 'void' ) );
	}


	/**
	 *
	 *
	 */
	public function test_input_is_empty_before_post() {
		$result = new Input('phpunit');
		$this->assertFalse( $result->is_not_empty() );
	}

	/**
	 *
	 *
	 */
	public function input_is_empty_before_post() {
		$_POST = self::$http_post;
		$result = new Input('phpunit');
		$this->assertTrue( $result->is_not_empty() );
	}
}
