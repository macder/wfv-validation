<?php

namespace WFV;

use WFV\Factory\ValidationFactory;

// there are a lot of possible cases
// planning in progress...

class ValidatorTest extends \PHPUnit_Framework_TestCase {

  const FORM = array(
    'action'  => 'phpunit',
    'rules'   => array(
      'name'      => ['required']
    )
  );

  const HTTP_POST = array(
    'action' => 'phpunit',
    'name' => 'Foo Bar'
  );

  const PROP_INSTANCE = array(
    'errors' => 'WFV\Errors',
    'input' => 'WFV\Input',
    'messages' => 'WFV\Messages',
    'rules' => 'WFV\Rules',
  );

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
   * Create 2 instances of WFV\Validator.
   * Instances for before and after $_POST.
   *
   */
  public static function setUpBeforeClass() {
    $form_before_post = self::FORM;
    ValidationFactory::create( $form_before_post );
    self::$form_before_post = $form_before_post;

    // needs to happen after no POST instance setup
    // otherwise first instance will also grab $_POST...
    $_POST = self::HTTP_POST;
    $form_after_post = self::FORM;
    ValidationFactory::create( $form_after_post );
    self::$form_after_post = $form_after_post;
  }

  /**
   * Reset $_POST and $_REQUEST
   *
   */
  public static function tearDownAfterClass() {
    $_POST = null;
    $_REQUEST = null;
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
    $instances = self::PROP_INSTANCE;
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
    $instances = self::PROP_INSTANCE;
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

    // ok.. we need to fake a legit request to pass the nonce check
    // 1. put the nonce token into WFV\Input
    $validator->input->put( 'phpunit_token', $validator->token );
    // 2. put the key and token into super global $_REQUEST
    $_REQUEST[ 'phpunit_token' ] = $validator->input->phpunit_token;
    // ...now this is a legit request

    $this->assertTrue( $validator->is_safe() );
  }

  /**
   * Does is_safe return false when the token in REQUEST
   *  does not match token in WFV\Input?
   *
   */
  public function test_validator_is_safe_returns_false_on_token_mismatch() {
    $validator = self::$form_after_post;

    // ok.. we need to fake a illegal request
    // 1. put the real nonce token into WFV\Input
    $validator->input->put( 'phpunit_token', $validator->token );
    // 2. put a manipulated nonce token into super global $_REQUEST
    $tampered_token = 'sdf'.$validator->token.'sdfert';
    $_REQUEST[ 'phpunit_token' ] = $tampered_token;
    // ...now the request is illegal

    $this->assertFalse( $validator->is_safe() );
  }
}
