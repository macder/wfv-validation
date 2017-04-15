<?php

namespace WFV;

use WFV\Form;
use WFV\Input;

class FormTest extends \PHPUnit_Framework_TestCase {

  const HTTP_POST = array(
    'action' => 'phpunit',
    'name' => 'Foo Bar',
    'skills' => array(
      'js',
      'php',
      'sh',
      'sass',
    ),
    'color' => array(
      'red',
      'blue',
      'green'
    )
  );

  /**
   *
   *
   */
  public function test_form() {

  }

}