<?php
namespace WFV\Artisan;

use \Respect\Validation\Validator;
use WFV\Agent\InspectionAgent;
use WFV\Artisan\Director;
use WFV\Artisan\FormArtisan;
use WFV\FormComposite;

class FormArtisanTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Instance of WFV\Artisan\FormArtisan.
	 *
	 * @access protected
	 * @var WFV\Artisan\FormArtisan $form_Artisan
	 */
	protected static $form_artisan;

	/**
	 * Instantiate FormArtisan
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
		    'rules' => 'required|email',
		    'messages' => [
		      'required' => 'Custom required validation error msg',
		      'email'    => 'No email? No soup for you!',
		    ],
		  ],
		);

		self::$form_artisan = new FormArtisan( $form, 'phpunit' );
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$form_artisan = null;
	}

	/**
	 * Does input method return instance of this FormArtisan?
	 *
	 */
	public function test_form_artisan_input_return_self_instance() {
		$expected = 'WFV\Artisan\FormArtisan';

		$result = self::$form_artisan->input( new InspectionAgent( 'test' ) );
		$this->assertInstanceOf( $expected, $result );
	}

	/**
	 * Does rules method return instance of this FormArtisan?
	 *
	 */
	public function test_form_artisan_rules_return_self_instance() {
		$result = self::$form_artisan ->rules();

		$this->assertInstanceOf( 'WFV\Artisan\FormArtisan', $result, 'FormArtisan rules() must return Self' );
	}

	/**
	 * Does create return instance of this FormArtisan?
	 *
	 */
	public function test_form_artisan_create_return_self_instance() {
		self::$form_artisan->validator();
		$result = self::$form_artisan->create( 'phpunit' );

		$this->assertInstanceOf( 'WFV\Artisan\FormArtisan', $result, 'FormArtisan create() must return Self' );
	}

	/**
	 * Does errors return instance of this FormArtisan?
	 *
	 */
	public function test_form_artisan_errors_return_self_instance() {
		$result = self::$form_artisan->errors();

		$this->assertInstanceOf( 'WFV\Artisan\FormArtisan', $result, 'FormArtisan errors() must return Self' );
	}

	/**
	 * Does factory return instance of this FormArtisan?
	 *
	 */
	public function test_form_artisan_factory_return_self_instance() {
		$result = self::$form_artisan->factory();

		$this->assertInstanceOf( 'WFV\Artisan\FormArtisan', $result, 'FormArtisan factory() must return Self' );
	}

	/**
	 * Does validator return instance of this FormArtisan?
	 *
	 */
	public function test_form_artisan_validator_return_self_instance() {
		$result = self::$form_artisan->validator();

		$this->assertInstanceOf( 'WFV\Artisan\FormArtisan', $result, 'FormArtisan validator() must return Self' );
	}

	/**
	 * Does actualize method return instance Form?
	 *
	 */
	public function test_form_artisan_actualize_return_form_instance() {
		$result = self::$form_artisan
			->input( new InspectionAgent( 'test' ) )
			->rules()
			->validator()
			->create('phpunit')
			->actualize();

		$this->assertInstanceOf( 'WFV\FormComposite', $result, 'FormArtisan actualize() must return Form' );
	}
}
