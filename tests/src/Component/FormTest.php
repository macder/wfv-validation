<?php
namespace WFV\Component;

use WFV\Artisan\Director;
use WFV\Artisan\FormArtisan;
use WFV\Component\Errors;
use WFV\Component\Form;
use WFV\Component\Input;

class FormTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $action;

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
	protected static $rules = array();

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $fake_http_post = array();

	/**
	 *
	 *
	 * @access protected
	 * @var array
	 */
	protected static $config;

	/**
	 *
	 *
	 */
	protected function setUp() {
		self::$config = array(
		  'rules'  => array(
		    'fname' => ['required', 'custom:phone'],
		    'email'=> ['required', 'email'],
		  ),

		  'messages' => [
		    'email' => array(
		      'required' => 'Your email is required so we can reply back'
		    ),
		  ]
		);

		$artisan = new FormArtisan();
		self::$form = ( new Director() )
			->describe( 'action', 'phpunit' )
			->with( 'rules', self::$config['rules'] )
			->with( 'input', 'phpunit' )
			->with( 'errors' )
			->compose( $artisan );

	}

	/**
	 *
	 *
	 */
	protected function tearDown() {
		self::$form = null;
	}

	/**
	 * Does Form instantiation with no component parameter produce instance of Form?
	 *
	 */
	public function test_form_instantiate_with_no_components_makes_instance_of_form() {
		$result = new Form('phpunit');
		$this->assertInstanceOf( 'WFV\Component\Form', $result );
	}

	/**
	 * Does Form instantiation with components produce instance of Form?
	 *
	 */
	public function test_form_instantiate_with_components_makes_instance_of_form() {
		$result = new Form('phpunit', self::$config );
		$this->assertInstanceOf( 'WFV\Component\Form', $result );
	}

	/**
	 *
	 *
	 */
	public function test_form_errors_returns_instance_of_errors() {
		$form = self::$form;
		$result = $form->errors();
		$this->assertInstanceOf( 'WFV\Component\Errors', $result );
	}

	/**
	 *
	 *
	 */
	public function test_form_input_returns_instance_of_input() {
		$form = self::$form;
		$result = $form->Input();
		$this->assertInstanceOf( 'WFV\Component\Input', $result );
	}
}
