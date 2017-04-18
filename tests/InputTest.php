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
   *
   *
   * @access protected
   * @var
   */
  protected static $http_post;

  /**
   * Populate $_POST
   *
   */
  public static function setUpBeforeClass() {
    self::$http_post = array(
      'action' => 'phpunit',
      'name' => '<h1>Foo Bar</h1>',
      '<% skills %>' =>
        array(
          'js <script>console.log("oh no!");</script>',
          'php <?php echo "oh no!"; ?>',
        )
      );

    self::$expected_result = array(
      'action' => 'phpunit',
      'name' => 'Foo Bar',
      'skills' =>
        array(
          'js',
          'php',
        )
    );

    $_POST = self::$http_post;
  }

  /**
   * Reset $_POST
   *
   */
  public static function tearDownAfterClass() {
    $_POST = null;
  }

  /**
   * Make sure properties are sanitized key/values from $_POST
   *
   */
  public function test_post_gets_sanitized_to_instance() {
    $result = new Input('phpunit');
    $expected = self::$expected_result;

    foreach( $result as $key => $value ) {
      $this->assertEquals( $expected[$key], $result->$key );
    }
  }

  /**
   * Make sure POST is ignored when $_POST['action'] does not match $this->action
   *
   */
  public function test_if_no_property_value_on_action_mismatch() {
    $action = 'phpunit_manipulated';
    $result = new Input( $action );

    foreach( self::$expected_result as $key => $expected ) {
      $this->assertFalse( ( property_exists( $result, $key ) ) );
    }
  }

  /**
   * NOT IN USE
   *
   */
  public function provider_test_post() {
    $expected_result = self::$expected_result;
    return array( array( $_POST, $expected_result ) );
  }
}
