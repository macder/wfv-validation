<?php

namespace WFV;

use WFV\Input;

class InputTest extends \PHPUnit_Framework_TestCase {

  /**
   * @param array $_POST
   * @param array $expected_result
   *
   * @dataProvider provider_test_post
   */
  public function test_post_is_sanitized_on_instance($post_array, $expected_result) {
    $result = new Input('phpunit');
    $this->assertEquals( 'phpunit', $result->action );
    $this->assertEquals( 'Mr. Foo Bar', $result->name );
    $this->assertEquals( 'js', $result->skills[0]);

    $result = get_object_vars( $result );
    $this->assertEquals( $expected_result, $result );
  }

  public function provider_test_post() {
    $_POST = array(
      'action' => 'phpunit',
      'name' => '<h1>Mr. Foo Bar</h1>',
      'skills' => array(
        'js <script>console.log("oh no!");</script>',
        'php <?php echo "oh no!"; ?>',
      )
    );
    $expected_result = array(
      'action' => 'phpunit',
      'name' => 'Mr. Foo Bar',
      'skills' => array(
        'js',
        'php',
      )
    );
    return array( array( $_POST, $expected_result ) );
  }
}
