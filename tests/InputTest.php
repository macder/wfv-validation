<?php

namespace WFV;

use WFV\Input;

class InputTest extends \PHPUnit_Framework_TestCase {

  /**
   * @param array $_POST
   * @param array $expected_result
   *
   * @dataProvider provider_Test_Post
   */
  public function test_Sanitize_Returns_Safe_Post($post_array, $expected_result) {
    $result = get_object_vars( new Input('phpunit') );
    $this->assertEquals( $expected_result, $result );
  }

  public function provider_Test_Post() {
    $_POST = array(
      'action' => 'phpunit',
      'name' => '<h1>Foo Bar</h1>'
    );
    $expected_result = array(
      'action' => 'phpunit',
      'name' => 'Foo Bar'
    );
    return array( array( $_POST, $expected_result ) );
  }
}
