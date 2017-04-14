<?php
define( 'ABSPATH', 'w0w0w0w' );

use PHPUnit\Framework\TestCase;

use WFV\Errors;

class ErrorsTest extends TestCase {

  public function testSanitizeReturnsSafeString() {
    $errors = new Errors();
  }
}