<?php

namespace WFV;

use WFV\Factory\ValidationFactory;
use WFV\Guard;

class GuardTest extends \PHPUnit_Framework_TestCase {

  /**
   * Instance of WFV\Form after $_POST.
   *
   * @access protected
   * @var WFV\Form $form_after_post
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
   *
   *
   * @access protected
   * @var WFV\Guard $guard
   */
  protected static $guard;

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
   * @access protected
   * @var string $input_action
   */
  protected static $input_action;

  /**
   *
   *
   * @access protected
   * @var string $input_token
   */
  protected static $input_token;

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
      )
    );

    self::$http_post = array(
      'action'  => 'phpunit',
      'name'    => 'Maciek',
      'email'   => 'foo@bar.com',
      'phone'   => '1234567890',
      'website' => 'http://test.com',
      'phpunit_token' => wp_create_nonce( 'phpunit' )
    );

    $_POST = self::$http_post;
    $form = self::$form_args;
    ValidationFactory::create_form( $form );
    self::$form = $form;

    $token_name = self::$form->action .'_token';
    self::$input_action = self::$form->input->action;
    self::$input_token = self::$form->input->$token_name;

    $_REQUEST[ self::$input_action.'_token' ] = self::$input_token;

    self::$guard = ValidationFactory::create_guard( self::$input_action, self::$input_token );
  }

  /**
   * Reset $_POST and $_REQUEST
   *
   */
  public function tearDown() {
    $_POST = null;
    $_REQUEST = null;
  }

  /**
   *
   *
   */
  public function test_guard_is_nonce_valid_returns_true() {
    $result = self::$guard->is_nonce_valid( self::$form->action, self::$form->token );
    $this->assertTrue( $result );
  }

  /**
   *
   *
   */
  public function test_guard_is_nonce_valid_returns_false() {
    $_REQUEST[ self::$input_action.'_token' ] = 'token_bad';
    $result = self::$guard->is_nonce_valid( self::$form->action, self::$form->token );
    $this->assertFalse( $result );
  }

  /**
   *
   *
   */
  public function test_guard_validate_returns_true() {
    $validator = ValidationFactory::create_validator( self::$form );
    ValidationFactory::load_rules( self::$form, $validator );

    $result = self::$guard->validate( self::$form, $validator );

    $this->assertTrue( $result );
  }

  /**
   *
   *
   */
  public function test_guard_validate_returns_false() {
    self::$form->input->forget('email');

    $validator = ValidationFactory::create_validator( self::$form );
    ValidationFactory::load_rules( self::$form, $validator );

    $result = self::$guard->validate( self::$form, $validator );

    $this->assertFalse( $result );
  }

}