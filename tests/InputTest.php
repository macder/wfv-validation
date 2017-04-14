<?php
define( 'ABSPATH', 'w0w0w0w' );

use PHPUnit\Framework\TestCase;

use WFV\Input;

class InputTest extends TestCase {

  public function testSanitizeReturnsSafeString() {

    $_POST = array(
      'action' => 'phpunit',
      'name' => '<h1>hi</h1>'
    );

    $expected_result = array(
      'action' => 'phpunit',
      'name' => 'hi'
    );

    $input = new Input('phpunit');

    //$this->assertTrue($input);
  }
}