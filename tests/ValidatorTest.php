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

  /**
   * Is the factory building all instances and assigning
   *  them as properties?
   * Check using before and after $_POST instances.
   *
   */
  public function test_validator_factory_create_instances() {

    $forms = array(
      'before_post'  => self::$form_before_post,
      'after_post' => self::$form_after_post,
    );

    // assert with and without $_POST
    foreach( $forms as $type => $form ) {
      $this->assertInstanceOf( 'WFV\Validator', $form );
      $this->assertInstanceOf( 'WFV\Errors', $form->errors );
      $this->assertInstanceOf( 'WFV\Input', $form->input );
      $this->assertInstanceOf( 'WFV\Messages', $form->messages );
      $this->assertInstanceOf( 'WFV\Rules', $form->rules );
    }
  }
}
