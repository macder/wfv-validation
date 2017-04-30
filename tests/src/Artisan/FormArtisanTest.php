<?php
namespace WFV\Artisan;

use WFV\Artisan\Director;
use WFV\Artisan\FormArtisan;
use WFV\Component\Form;

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
		self::$form_artisan = new FormArtisan();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$form_artisan = null;
	}

	/**
	 * Does input method return instance of this Artisan?
	 *
	 */
	public function test_form_artisan_input_return_self_instance() {
		$result = self::$form_artisan
			->input( 'phpunit' );
		$this->assertInstanceOf('WFV\Artisan\FormArtisan', $result );
	}

	/**
	 * Does rules method return instance of this Artisan?
	 *
	 */
	public function test_form_artisan_rules_return_self_instance() {
		$rules = array(
			'fname' => ['required', 'custom:phone'],
			'email'=> ['required', 'email'],
		);

		$result = self::$form_artisan
			->rules( $rules );
		$this->assertInstanceOf( 'WFV\Artisan\FormArtisan', $result, 'FormArtisan rules() must return Self' );
	}

	/**
	 * Does input create return instance of this Artisan?
	 *
	 */
	public function test_form_artisan_create_return_self_instance() {
		$result = self::$form_artisan
			->create( 'phpunit' );
		$this->assertInstanceOf( 'WFV\Artisan\FormArtisan', $result, 'FormArtisan create() must return Self' );
	}

	/**
	 * Does actualize method return instance Form?
	 *
	 */
	public function test_form_artisan_actualize_return_form_instance() {
		$rules = array(
			'fname' => ['required', 'custom:phone'],
			'email'=> ['required', 'email'],
		);

		$result = self::$form_artisan
			->input('phpunit')
			->rules( $rules )
			->create('phpunit')
			->actualize();

		$this->assertInstanceOf( 'WFV\Component\Form', $result, 'FormArtisan actualize() must return Form' );
	}
}
