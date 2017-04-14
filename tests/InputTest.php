<?php

namespace WFV;

use WFV\Input;

class InputTest extends \PHPUnit_Framework_TestCase {

  public function testSanitizeReturnsSafeStrings() {

    $_POST = array(
      'action' => 'phpunit',
      'name' => '<h1>hi</h1>'
    );

    $expected_result = array(
      'action' => 'phpunit',
      'name' => 'hi'
    );

    $input = new Input('phpunit');
    $result = get_object_vars( $input );
    $this->assertEquals($expected_result, $result);
  }
}
