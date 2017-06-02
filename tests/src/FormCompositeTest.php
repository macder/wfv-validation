<?php
namespace WFV;

use WFV\FormComposite;
use WFV\Artisan\Director;
use WFV\Artisan\FormArtisan;
use WFV\Factory\ValidatorFactory;

class FormCompositeTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $builder;

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $form;

	/**
	 *
	 *
	 * @access protected
	 * @var array
	 */
	protected static $http_post;


	/**
	 *
	 *
	 */
	protected function setUp() {
		$form = array(
			'first_name' => [
				'label' => 'First Name',
				'rules' => 'required',
			],
			'email' => [
				'label' => 'Email',
				'rules' => 'optional|email',
			],
		);

    self::$http_post = array(
      'action' => 'phpunit',
      'phpunit_token' => wp_create_nonce( 'phpunit' ),
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
      ),
    	'html_input' => '<h1>Im a H1</h1><p>This is a paragraph</p>',
    );

  $_REQUEST[ 'phpunit_token' ] = self::$http_post['phpunit_token'];

	self::$builder = new FormArtisan( $form, 'phpunit' );
	self::$form = ( new Director() )
		->with( 'rules' )
		->with( 'errors' )
		->with( 'validator' );
	}


	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		$_POST = null;
		$_REQUEST = null;
		self::$form = null;
		self::$builder = null;
		self::$http_post = null;
	}

	/**
	 * Does checked_if() return string
	 *
	 */
	public function test_form_checked_if_returns_string() {
		$_POST = self::$http_post;

		$form = self::$form
			->with( 'input' )
			->compose( self::$builder );

		$expected = 'checked';
		$result = $form->checked_if('color', 'green');
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does checked_if() return null when no $_POST
	 *
	 */
	public function test_form_checked_if_returns_null_when_no_post() {
		$form = self::$form
			->with( 'input' )
			->compose( self::$builder );

		$expected = null;
		$result = $form->checked_if('color', 'green');
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does checked_if() return null
	 *  when field empty
	 *
	 */
	public function test_form_checked_if_returns_null_when_post_field_empty() {
		unset(self::$http_post['color'][1]);
		$_POST = self::$http_post;

		$form = self::$form
			->with( 'input' )
			->compose( self::$builder );

		$expected = null;
		$result = $form->checked_if('color', 'green');
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does errors() return an instance of ErrorCollection?
	 *
	 */
	public function test_form_errors_returns_error_collection() {
		$form = self::$form
			->with( 'input' )
			->compose( self::$builder );

		$expected = 'WFV\Collection\ErrorCollection';
		$result = $form->errors();
		$this->assertInstanceOf( $expected, $result );
	}

	/**
	 * Does input() return an instance of InputCollection?
	 *
	 */
	public function test_form_input_returns_input_collection() {
		$form = self::$form
			->with( 'input' )
			->compose( self::$builder );

		$expected = 'WFV\Collection\InputCollection';
		$result = $form->input();
		$this->assertInstanceOf( $expected, $result );
	}

	/**
	 * Does rules() return an instance of RuleCollection?
	 *
	 */
	public function test_form_input_returns_rule_collection() {
		$form = self::$form
			->with( 'input' )
			->compose( self::$builder );

		$expected = 'WFV\Collection\RuleCollection';
		$result = $form->rules();
		$this->assertInstanceOf( $expected, $result );
	}
}
