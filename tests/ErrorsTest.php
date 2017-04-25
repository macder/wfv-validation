<?php

namespace WFV;

use WFV\Errors;

class ErrorsTest extends \PHPUnit_Framework_TestCase {

  /**
   * Instance of WFV\Errors.
   *
   * @access protected
   * @var WFV\Errors $errors
   */
  protected static $errors;

  /**
   *
   *
   */
  protected function setUp() {
    self::$errors = new Errors();
  }

  /**
   *
   *
   */
  protected function tearDown() {
    self::$errors = null;
  }

  /**
   * Instance of WFV\Errors?
   *
   */
  public function test_errors_is_instance() {
    $this->assertInstanceOf( 'WFV\Errors', self::$errors );
  }

  /**
   * Check if the first() method returns first error message string
   *
   */
  public function test_errors_first_returns_first_string() {
    $instance = self::$errors;
    $errors = array(
      'email' => array(
        'first',
        'second',
        'third',
        'fourth'
      ),
    );
    $instance->set( $errors );

    $expected_result = $errors['email'][0];
    $result = $instance->first('email');

    $this->assertEquals( $expected_result, $result );
  }
}