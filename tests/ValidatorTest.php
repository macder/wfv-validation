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
   * Reset $_POST
   *
   */
  public static function tearDownAfterClass() {
    $_POST = null;
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
    $expected_instance = self::PROP_INSTANCE;

    foreach( $expected_instance as $property => $instance ) {
      $this->assertInstanceOf( $instance, self::$form_before_post->$property );
    }
  }

  /**
   * Is the factory building all instances and assigning
   *  them as properties after $_POST?
   *
   */
  public function test_validator_has_instances_after_post() {
    $expected_instance = self::PROP_INSTANCE;

    foreach( $expected_instance as $property => $instance ) {
      $this->assertInstanceOf( $instance, self::$form_after_post->$property );
    }
  }


}
