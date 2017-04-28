<?php
namespace WFV\Builder;

use WFV\Builder\Director;
use WFV\Builder\FormBuilder;
use WFV\Component\Form;

class FormBuilderTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Instance of WFV\Builder\FormBuilder.
	 *
	 * @access protected
	 * @var WFV\Builder\FormBuilder $form_builder
	 */
	protected static $form_builder;

	/**
	 * Instantiate FormBuilder
	 *
	 */
	protected function setUp() {
		self::$form_builder = new FormBuilder();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$form_builder = null;
	}

	/**
	 * Does input method return instance of this builder?
	 *
	 */
	public function testFormBuilderInputReturnSelfInstance() {
		$result = self::$form_builder
			->input( 'phpunit' );
		$this->assertInstanceOf( FormBuilder::class, $result );
	}

	/**
	 * Does rules method return instance of this builder?
	 *
	 */
	public function testFormBuilderRulesReturnSelfInstance() {
		$rules = array(
			'fname' => ['required', 'custom:phone'],
			'email'=> ['required', 'email'],
		);

		$result = self::$form_builder
			->rules( $rules );
		$this->assertInstanceOf( FormBuilder::class, $result, 'FormBuilder rules() must return Self' );
	}

	/**
	 * Does input create return instance of this builder?
	 *
	 */
	public function testFormBuilderCreateReturnSelfInstance() {
		$result = self::$form_builder
			->create( 'phpunit' );
		$this->assertInstanceOf( FormBuilder::class, $result, 'FormBuilder create() must return Self' );
	}

	/**
	 * Does deliver method return instance Form?
	 *
	 */
	public function testFormBuilderDeliverReturnFormInstance() {
		$rules = array(
			'fname' => ['required', 'custom:phone'],
			'email'=> ['required', 'email'],
		);

		$result = self::$form_builder
			->input('phpunit')
			->rules( $rules )
			->create('phpunit')
			->deliver();

		$this->assertInstanceOf( Form::class, $result, 'FormBuilder deliver() must return Form' );
	}
}
