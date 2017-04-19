<?php

namespace WFV;

use WFV\Input;

class InputTest extends \PHPUnit_Framework_TestCase {

  /**
   *
   *
   * @access protected
   * @var
   */
  protected static $expected_result;

  /**
   * Mock $_POST
   *
   * @access protected
   * @var
   */
  protected static $http_post;

  /**
   *
   *
   * @access protected
   * @var class WFV\Input
   */
  protected static $input_after_post;

  /**
   *
   *
   * @access protected
   * @var class WFV\Input
   */
  protected static $input_before_post;

  /**
   *
   *
   */
  public static function setUpBeforeClass() {

  }

  /**
   *
   *
   */
  protected function setUp() {
    self::$http_post = array(
      'action' => 'phpunit',
      'name' => '<h1>Foo Bar</h1>',
      'email' => 'foo@bar.com',
      '<% skills %>' =>
        array(
          'js <script>console.log("oh no!");</script>',
          'php <?php echo "oh no!"; ?>',
        )
      );

    self::$expected_result = array(
      'action' => 'phpunit',
      'name' => 'Foo Bar',
      'email' => 'foo@bar.com',
      'skills' =>
        array(
          'js',
          'php',
        )
    );
    self::$input_before_post = new Input('phpunit');

    $_POST = self::$http_post;
    self::$input_after_post = new Input('phpunit');
  }

  public function tearDown() {
    $_POST = null;
  }

  /**
   * Reset $_POST
   *
   */
  public static function tearDownAfterClass() {
    $_POST = null;
  }

  /**
   * Is input an instance of WFV\Input?
   *
   */
  public function test_input_is_instance() {
    $this->assertInstanceOf( 'WFV\Input', self::$input_before_post );
    $this->assertInstanceOf( 'WFV\Input', self::$input_after_post );
  }

  /**
   * Make sure properties are sanitized key/values from $_POST
   *
   */
  public function test_post_gets_sanitized_to_instance() {
    $input = self::$input_after_post;
    $expected = self::$expected_result;

    foreach( $input as $field => $value ) {
      $this->assertEquals( $expected[$field], $input->$field );
    }
  }
}
