<?php

namespace WFV;

use WFV\Errors;
use WFV\Form;
use WFV\Guard;
use WFV\Input;
use WFV\Messages;
use WFV\Rules;

class FormTest extends \PHPUnit_Framework_TestCase {

  /**
   * Instance of WFV\Form before $_POST.
   *
   * @access protected
   * @var WFV\Form $form_before_post
   */
  protected static $form_before_post;

  /**
   * Instance of WFV\Form after $_POST.
   *
   * @access protected
   * @var WFV\Form $form_after_post
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
   * Create WFV\Form instance with WFV\Input input property
   *
   */
  public static function setUpBeforeClass() {
    $form_args = array(
      'action'  => 'phpunit',
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
      )
    );

    self::$instances = array(
      'errors' => 'WFV\Errors',
      'input' => 'WFV\Input',
      'messages' => 'WFV\Messages',
      'rules' => 'WFV\Rules',
    );

    $action = $form_args['action'];
    $errors = new Errors();
    $input = new Input( $action );
    $messages = new Messages( $form_args['messages'] );
    $rules = new Rules( $form_args['rules'] );

    self::$form_before_post = new Form( $action, $input, $rules, $messages, $errors );

    $_POST = self::$http_post;
    $input = new Input( $action );

    self::$form_after_post = new Form( $action, $input, $rules, $messages, $errors );

  }

  /**
   * Reset $_POST
   *
   */
  public static function tearDownAfterClass() {
    $_POST = null;
  }

  /**
   * Is the form an instance of WFV\Form?
   *
   */
  public function test_form_is_instance() {
    $this->assertInstanceOf( 'WFV\Form', self::$form_before_post );
    $this->assertInstanceOf( 'WFV\Form', self::$form_after_post );
  }

  /**
   *
   *
   */
  public function test_form_has_instances_before_post() {
    $instances = self::$instances;
    foreach( $instances as $property_name => $expected_instance ) {
      $this->assertInstanceOf( $expected_instance, self::$form_before_post->$property_name );
    }
  }

  /**
   *
   *
   */
  public function test_form_has_instances_after_post() {
    $instances = self::$instances;
    foreach( $instances as $property_name => $expected_instance ) {
      $this->assertInstanceOf( $expected_instance, self::$form_after_post->$property_name );
    }
  }


  /**
   * Does 'checked_if' method return 'checked' when POST data
   *  has matching key/value for the field
   *
   */
  public function test_form_does_checked_if_return_checked() {
    foreach( self::$form_after_post->input->shades as $shade ) {
      $this->assertEquals( 'checked', self::$form_after_post->checked_if( 'shades', $shade ) );
    }
  }

  /**
   * Does 'checked_if' method return null when POST data
   *  is NOT matching key/value for the field
   *
   */
  public function test_form_does_checked_if_return_null() {
    foreach( self::$form_after_post->input->shades as $shade ) {
      $this->assertEquals( null, self::$form_after_post->checked_if( 'shades', 'BAH!' ) );
    }
  }

  /**
   * Does 'selected_if' method return 'selected' when POST data
   *  has matching key/value for the field
   *
   */
  public function test_form_does_selected_if_return_selected() {
    foreach( self::$form_after_post->input->shades as $shade ) {
      $this->assertEquals( 'selected', self::$form_after_post->selected_if( 'shades', $shade ) );
    }
  }

  /**
   * Does 'selected_if' method return null when POST data
   *  is NOT matching key/value for the field
   *
   */
  public function test_form_does_selected_if_return_null() {
    foreach( self::$form_after_post->input->shades as $shade ) {
      $this->assertEquals( null, self::$form_after_post->selected_if( 'shades', 'BAH!' ) );
    }
  }

  /**
   *
   *
   */
  public function test_form_must_validate_return_true() {
    $result = self::$form_after_post->must_validate();
    $this->assertTrue($result);
  }

  /**
   *
   *
   */
  public function test_form_must_validate_return_false_if_no_post() {
    $result = self::$form_before_post->must_validate();
    $this->assertFalse($result);
  }

  /**
   *
   *
   */
  public function test_form_must_validate_return_false_if_action_mismatch() {
    $form = self::$form_after_post;
    $form->input->put('action', 'tampered_action');
    $result = $form->must_validate();
    $this->assertFalse($result);
  }
}
