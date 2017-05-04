<?php
namespace WFV\Artisan;

use \Valitron\Validator;
use WFV\ValidatorAdapter;

use WFV\Component\ErrorCollection;
use WFV\Component\InputCollection;
use WFV\Component\RuleCollection;
use WFV\Composite\Form;

class FormTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var array
	 */
	protected static $form_array;

	/**
	 *
	 *
	 * @access protected
	 * @var ValidationInterface $validator
	 */
	protected static $validator;

	/**
	 *
	 *
	 */
	protected function setUp() {
		self::$validator = new ValidatorAdapter( new Validator() );

    self::$form_array = array(
      'rules'   => array(
        'name'      => ['required'],
        'email'     => ['required', 'email'],
        'shades'   => ['required'],
        'colors'   => ['required'],
      ),
      'messages' => [
        'email' => array(
          'required' => 'Email required - phpunit'
        ),
      ]
    );
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$validator = null;
	}

	/**
	 * Does the form construct when $component parameter is an empty array?
	 *
	 */
	public function test_form_is_instante_when_component_array_is_empty() {
		$expected = 'WFV\Composite\Form';
		$result = new Form( 'phpunit', array(), self::$validator );
		$this->assertInstanceOf( $expected, $result );
	}

	/**
	 * Does errors() return an instance of ErrorCollection?
	 *
	 */
	public function test_form_errors_returns_error_collection() {
		$errors = array( 'errors' => new ErrorCollection() );
		$form = new Form( 'phpunit', $errors, self::$validator );

		$expected = 'WFV\Component\ErrorCollection';
		$result = $form->errors();
		$this->assertInstanceOf( $expected, $result );
	}

	/**
	 * Does input() return an instance of InputCollection?
	 *
	 */
	public function test_form_input_returns_input_collection() {
		$input = array( 'input' => new InputCollection() );
		$form = new Form( 'phpunit', $input, self::$validator );

		$expected = 'WFV\Component\InputCollection';
		$result = $form->input();
		$this->assertInstanceOf( $expected, $result );
	}
}
