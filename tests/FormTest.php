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
  public function test_form_POST() {
    $_POST = self::HTTP_POST;
    return $_POST;
  }

  /**
   *
   *
   */
  public function test_form_create() {
    $action = $_POST['action'];
    $form = new Form();
    $input = new Input( $action );
    $form->put( 'action', $action );
    $form->put( 'input', $input );

    return $form;
  }

