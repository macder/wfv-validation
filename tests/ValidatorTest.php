<?php

namespace WFV;

use WFV\Factory\ValidationFactory;

class ValidatorTest extends \PHPUnit_Framework_TestCase {

  const FORM = array(
    'action'  => 'phpunit', // unique identifier
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

    $_POST = self::HTTP_POST;
    ValidationFactory::create( $form_has_post );
    self::$form_has_post = $form_has_post;
  }

  /**
   * is the factory building all instances and assigning
   *  them as properties to WFV\Validator when there is no $_POST?
   *
   */
  public function test_validator_factory_create_with_no_post() {
    $this->assertInstanceOf( 'WFV\Validator', self::$form_no_post );
    $this->assertInstanceOf( 'WFV\Errors', self::$form_no_post->errors );
    $this->assertInstanceOf( 'WFV\Input', self::$form_no_post->input );
    $this->assertInstanceOf( 'WFV\Messages', self::$form_no_post->messages );
    $this->assertInstanceOf( 'WFV\Rules', self::$form_no_post->rules );
  }

  /**
   * $_POST exists - is the factory building all instances and assigning
   *  them as properties to WFV\Validator?
   *
   */
  public function test_validator_factory_create_with_post() {
    $this->assertInstanceOf( 'WFV\Validator', self::$form_has_post );
    $this->assertInstanceOf( 'WFV\Errors', self::$form_has_post->errors );
    $this->assertInstanceOf( 'WFV\Input', self::$form_has_post->input );
    $this->assertInstanceOf( 'WFV\Messages', self::$form_has_post->messages );
    $this->assertInstanceOf( 'WFV\Rules', self::$form_has_post->rules );
  }
}
