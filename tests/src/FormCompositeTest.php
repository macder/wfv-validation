<?php
namespace WFV;

use WFV\FormComposite;
use WFV\Agent\InspectionAgent;
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
	 * @var
	 */
	protected static $guard;

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
		// self::$validator = new ValidatorAdapter( new Validator() );

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

	self::$guard = new InspectionAgent( 'phpunit' );

	self::$builder = new FormArtisan( $form );
	self::$form = ( new Director( 'phpunit' ) )
		//->with( 'input', [ $input, $trim ] )
		->with( 'rules' )
		->with( 'errors' )
		->with( 'validator' );
		//->compose( $builder );
	}


	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		$_POST = null;
		$_REQUEST = null;
		self::$form = null;
		self::$guard = null;
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
			->with( 'input', self::$guard )
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
			->with( 'input', self::$guard )
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
			->with( 'input', self::$guard )
			->compose( self::$builder );

		$expected = null;
		$result = $form->checked_if('color', 'green');
		$this->assertEquals( $expected, $result );
	}



}
