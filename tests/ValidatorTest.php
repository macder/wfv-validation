<?php

namespace WFV;

use WFV\Factory\ValidationFactory;
use WFV\Validator;

// there are a lot of possible cases
// planning in progress...

class ValidatorTest extends \PHPUnit_Framework_TestCase {

  /**
   * Instance of WFV\Validator before $_POST.
   *
   * @access protected
   * @var WFV\Validator $form_before_post
   */
  protected static $form_before_post;

  /**
   * Instance of WFV\Validator after $_POST.
   *
   * @access protected
   * @var WFV\Validator $form_after_post
   */
  protected static $form_after_post;

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
   * @access protected
   * @var
   */
  protected static $instances;

  /**
   * Create 2 instances of WFV\Validator.
   * Instances for before and after $_POST.
   *
   */
  public static function setUpBeforeClass() {

  }

  /**
   * Reset $_POST and $_REQUEST
   *
   */
  public static function tearDownAfterClass() {
    $_POST = null;
    $_REQUEST = null;
  }

  /**
   *
   *
   */
  protected function setUp() {
    $form_args = array(
      'action'  => 'phpunit',
      'rules'   => array(
        'name'      => ['required'],
        'email'     => ['required', 'email'],
        'website'   => ['required', 'url'],
      ),
      'messages' => [
        'email' => array(
          'required' => 'Email required - phpunit'
        ),
      ]
    );

    self::$http_post = array(
      'action'  => 'phpunit',
      'name'    => 'Foo Bar',
      'email'   => 'foo@bar.com',
      'website' => 'http://test.com'
    );

    self::$instances = array(
      'errors' => 'WFV\Errors',
      'input' => 'WFV\Input',
      'messages' => 'WFV\Messages',
      'rules' => 'WFV\Rules',
    );



    $form_before_post = $form_args;
    ValidationFactory::create( $form_before_post );
    self::$form_before_post = $form_before_post;

    // needs to happen after no POST instance setup
    // otherwise first instance will also grab $_POST...
    $_POST = self::$http_post;
    $form_after_post = $form_args;
    ValidationFactory::create( $form_after_post );
    self::$form_after_post = $form_after_post;
  }

  public function test_validator_is_instance() {
    $this->assertInstanceOf( 'WFV\Validator', self::$form_before_post );
    $this->assertInstanceOf( 'WFV\Validator', self::$form_after_post );
  }

  /**
   * Is the factory building all instances and assigning
   *  them as properties before $_POST?
   *
   */
  public function test_validator_has_instances_before_post() {
    $instances = self::$instances;
    foreach( $instances as $property_name => $expected_instance ) {
      $this->assertInstanceOf( $expected_instance, self::$form_before_post->$property_name );
    }
  }

  /**
   * Is the factory building all instances and assigning
   *  them as properties after $_POST?
   *
   */
  public function test_validator_has_instances_after_post() {
    $instances = self::$instances;
    foreach( $instances as $property_name => $expected_instance  ) {
      $this->assertInstanceOf( $expected_instance , self::$form_after_post->$property_name );
    }
  }

  /**
   * Does is_safe return true when REQUEST is legit?
   *
   */
  public function test_validator_is_safe_returns_true() {
    $validator = self::$form_after_post;

    $validator->input->put( 'phpunit_token', $validator->token );
    $_REQUEST[ 'phpunit_token' ] = $validator->input->phpunit_token;

    $this->assertTrue( $validator->is_safe() );
  }

  /**
   * Does is_safe return false when the token in REQUEST
   *  does not match token in WFV\Input?
   *
   */
  public function test_validator_is_safe_returns_false_on_token_mismatch() {
    $validator = self::$form_after_post;

    $validator->input->put( 'phpunit_token', $validator->token );
    $tampered_token = 'sdf'.$validator->token.'sdfert';
    $_REQUEST[ 'phpunit_token' ] = $tampered_token;

    $this->assertFalse( $validator->is_safe() );
  }

  /**
   * When validation passes, validate should return true.
   *
   */
  public function test_validator_validate_input_pass() {
    $form = self::$form_after_post;
    $this->assertTrue( $form->validate() );
  }

  /**
   * When validation passes there should be no properties on errors.
   *
   */
  public function test_validator_validate_input_pass_has_no_errors() {
    $form = self::$form_after_post;
    $form->validate();

    foreach( $form->rules as $field => $rule ) {
      $this->assertFalse( property_exists( $form->errors, $field ) );
    }

  }

  /**
   * When validation fails, validate should return false.
   *
   */
  public function test_validator_validate_input_fail() {
    $form = self::$form_after_post;

    foreach( $form->input as $field => $value ) {
      $form->input->forget( $field );
    }

    $this->assertFalse( $form->validate() );
  }

  /**
   * Check if the error() method returns first error message string
   *
   */
  public function test_validator_error_returns_first_message() {
    $form = self::$form_after_post;

    $custom_message = $form->messages->email;
    $expected_result = $custom_message['required'];

    $form->input->forget('email');
    $form->validate();

    $this->assertEquals( $expected_result, $form->error('email') );
  }

}
