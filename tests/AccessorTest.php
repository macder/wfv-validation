<?php

namespace WFV;

use WFV\Factory\ValidationFactory;

class AccessorTest extends \PHPUnit_Framework_TestCase {

  /**
   * Instance of WFV\Validator after $_POST.
   *
   * @access protected
   * @var WFV\Validator $form_after_post
   */
  protected static $form;

  /**
   * Array form config mock
   *
   * @access protected
   * @var array
   */
  protected static $form_args;

  /**
   * Mock $_POST
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
    self::$form_args = array(
      'action'  => 'phpunit',
      'rules'   => array(
        'name'      => ['required'],
        'email'     => ['required', 'email'],
        'phone'     => ['required'],
        'website'   => ['required', 'url'],
        'colors'    => ['required']
      ),
      'messages' => [
        'email' => array(
          'required' => 'Email required - phpunit',
          'email'    => 'No email, no reply',
        ),
        'phone' => array(
          'required' => 'No phone, no dialback',
        ),

      ]
    );

    self::$http_post = array(
      'action'  => 'phpunit',
      'name'    => 'Maciek',
      'email'   => 'foo@bar.com',
      'phone'   => '1234567890',
      'website' => 'http://test.com',
      'colors'  => array(
        'red', 'blue', 'green'
      ),
    );

    $_POST = self::$http_post;
    $form = self::$form_args;
    ValidationFactory::create( $form );
    self::$form = $form;
  }

  /**
   * Reset $_POST and $_REQUEST
   *
   */
  public function tearDown() {
    $_POST = null;
  }

  /**
   * Do the Input property/value pairs match the $_POST?
   *
   */
  public function test_accessor_get_input_equals_post() {
    $form = self::$form;
    // $form->input->put('email', 'mismatch@email.com');
    foreach( self::$http_post as $field => $expected_value ) {
      $this->assertEquals( $expected_value, $form->input->$field );
    }
  }

  /**
   * Does contains return true on value match from Input
   *
   */
  public function test_accessor_contains_input_returns_true() {
    $form = self::$form;

    foreach( self::$http_post as $field => $expected_value ) {

      if( is_array( $expected_value ) ) {
        foreach( $expected_value as $value ) {
          $this->assertTrue( $form->input->contains( $field, $value ) );
        }
      } else {
        $this->assertTrue( $form->input->contains($field, $expected_value) );
      }
    }
  }

  /**
   * Does get_array return array?
   *
   */
  public function test_accessor_get_array_is_array() {
    $form = self::$form;
    $this->assertTrue( is_array( $form->input->get_array() ) );
    $this->assertTrue( is_array( $form->rules->get_array() ) );
    $this->assertTrue( is_array( $form->messages->get_array() ) );
    $this->assertTrue( is_array( $form->errors->get_array() ) );
  }

  /**
   * Does has return true when property exists?
   *
   */
  public function test_accessor_has_returns_true() {
    $form = self::$form;
    $form_args = self::$form_args;
    unset( $form_args['action'] );

    // rules and messages
    foreach( $form_args as $instance => $properties ) {
      foreach( $properties as $property => $value ) {
        $this->assertTrue( $form->$instance->has( $property ) );
      }
    }

    // input
    foreach( self::$http_post as $property => $value ) {
      $this->assertTrue( $form->input->has( $property ) );
    }
  }
}
