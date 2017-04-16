<?php

namespace WFV;

use WFV\Factory\ValidationFactory;

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

  protected static $form_no_post;

  protected static $form_has_post;

  // there are a lot of possible cases
  // planning the automation...

  public static function setUpBeforeClass() {
    $form_no_post = self::FORM;
    ValidationFactory::create( $form_no_post );
    self::$form_no_post = $form_no_post;

    // needs to happen after no POST instance setup
    // otherwise first instance will also grab $_POST...
    $_POST = self::HTTP_POST;
    $form_has_post = self::FORM;
    ValidationFactory::create( $form_has_post );
    self::$form_has_post = $form_has_post;
  }

  public static function tearDownAfterClass() {
    $_POST = null;
  }

  /**
   * is the factory building all instances and assigning
   *  them as properties
   *
   */
  public function test_validator_factory_create_instances() {

    $forms = array(
      'no_post'  => self::$form_no_post,
      'has_post' => self::$form_has_post,
    );

    print_r($forms);

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
