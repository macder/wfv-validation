<?php
namespace WFV;

use \Valitron\Validator;
use WFV\ValidatorAdapter;

use WFV\Collection\ErrorCollection;
use WFV\Collection\InputCollection;
use WFV\Collection\RuleCollection;
use WFV\FormComposite;

class FormCompositeTest extends \PHPUnit_Framework_TestCase {

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
	 * @var array
	 */
	protected static $http_post;

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
      ),
    	'html_input' => '<h1>Im a H1</h1><p>This is a paragraph</p>',
    );
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		$_POST = null;
		self::$validator = null;
	}

	/**
	 * Does the form construct when $component parameter is an empty array?
	 *
	 */
	public function test_form_is_instante_when_collection_array_is_empty() {
		$expected = 'WFV\FormComposite';
		$result = new FormComposite( 'phpunit', array(), self::$validator );
		$this->assertInstanceOf( $expected, $result );
	}

	/**
	 * Does errors() return an instance of ErrorCollection?
	 *
	 */
	public function test_form_errors_returns_error_collection() {
		$errors = array( 'errors' => new ErrorCollection() );
		$form = new FormComposite( 'phpunit', $errors, self::$validator );

		$expected = 'WFV\Collection\ErrorCollection';
		$result = $form->errors();
		$this->assertInstanceOf( $expected, $result );
	}

	/**
	 * Does input() return an instance of InputCollection?
	 *
	 */
	public function test_form_input_returns_input_collection() {
		$input = array( 'input' => new InputCollection() );
		$form = new FormComposite( 'phpunit', $input, self::$validator );

		$expected = 'WFV\Collection\InputCollection';
		$result = $form->input();
		$this->assertInstanceOf( $expected, $result );
	}

	/**
	 * Does checked_if() return 'checked' string?
	 *
	 */
	public function test_form_checked_if_returns_checked_string() {
		$_POST = self::$http_post;
		$input = array( 'input' => new InputCollection( $_POST ) );

		$form = new FormComposite( 'phpunit', $input, self::$validator );

		$expected = 'checked';
		$result = $form->checked_if('color', 'green');
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does checked_if() return null?
	 *
	 */
	public function test_form_checked_if_returns_null() {
		$_POST = self::$http_post;
		$input = array( 'input' => new InputCollection( $_POST ) );

		$form = new FormComposite( 'phpunit', $input, self::$validator );

		$expected = null;
		$result = $form->checked_if('color', 'is_not_there');
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does checked_if() return null?
	 *
	 */
	public function test_form_checked_if_returns_null_when_no_params() {
		$_POST = self::$http_post;
		$input = array( 'input' => new InputCollection( $_POST ) );

		$form = new FormComposite( 'phpunit', $input, self::$validator );

		$expected = null;
		$result = $form->checked_if();
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does checked_if() return null when $field param is null?
	 *
	 */
	public function test_form_checked_if_returns_null_when_field_null() {
		$_POST = self::$http_post;
		$input = array( 'input' => new InputCollection( $_POST ) );

		$form = new FormComposite( 'phpunit', $input, self::$validator );

		$expected = null;
		$result = $form->checked_if(null, 'wait.. huh?!');
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does checked_if() return null when $field param is null?
	 *
	 */
	public function test_form_checked_if_returns_null_when_value_null() {
		$_POST = self::$http_post;
		$input = array( 'input' => new InputCollection( $_POST ) );

		$form = new FormComposite( 'phpunit', $input, self::$validator );

		$expected = null;
		$result = $form->checked_if('name', null);
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does display() return an encoded string using default callback ( esc_html() )
	 *
	 */
	public function test_form_display_returns_default_encoded_string() {
		$_POST = self::$http_post;
		$input = array( 'input' => new InputCollection( $_POST ) );

		$form = new FormComposite( 'phpunit', $input, self::$validator );

		$expected = esc_html( $_POST['html_input'] );
		$result = $form->display('html_input');

		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does display() return null when the provided key does NOT exist?
	 *
	 */
	public function test_form_display_returns_null_when_no_field() {
		$_POST = self::$http_post;
		$input = array( 'input' => new InputCollection( $_POST ) );

		$form = new FormComposite( 'phpunit', $input, self::$validator );

		$expected = null;
		$result = $form->display('this_is_not_a_field');

		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does display() return null no parameters are given?
	 *
	 */
	public function test_form_display_returns_null_when_no_arguments_given() {
		$_POST = self::$http_post;
		$input = array( 'input' => new InputCollection( $_POST ) );

		$form = new FormComposite( 'phpunit', $input, self::$validator );

		$expected = null;
		$result = $form->display();

		$this->assertEquals( $expected, $result );
	}


}
