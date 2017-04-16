<?php

namespace WFV;

use WFV\Input;

class InputTest extends \PHPUnit_Framework_TestCase {

  const HTTP_POST = array(
    'action' => 'phpunit',
    'name' => '<h1>Foo Bar</h1>',
    '<% skills %>' =>
      array(
        'js <script>console.log("oh no!");</script>',
        'php <?php echo "oh no!"; ?>',
      )
  );

  const EXPECTED_RESULT = array(
    'action' => 'phpunit',
    'name' => 'Foo Bar',
    'skills' =>
      array(
        'js',
        'php',
      )
  );

  public static function setUpBeforeClass() {
    $_POST = self::HTTP_POST;
  }

  public static function tearDownAfterClass() {
    $_POST = null;
  }

  /**
   * Make sure properties are sanitized key/values from $_POST
   *
   */
  public function test_post_gets_sanitized_to_instance() {
    $result = new Input('phpunit');
    $expected = self::EXPECTED_RESULT;

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

    foreach( self::EXPECTED_RESULT as $key => $expected ) {
      $this->assertFalse( ( property_exists( $result, $key ) ) );
    }
  }

  public function provider_test_post() {
    $expected_result = self::EXPECTED_RESULT;
    return array( array( $_POST, $expected_result ) );
  }
}
