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
   * Create WFV\Form instance and put WFV\Input on input property
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

  /**
   *
   * @depends test_form_create
   */
  public function test_form_input_prop_has_props_from_POST( $form ) {
    foreach( $form->input as $key => $value ) {
      $this->assertTrue( property_exists( $form->input, $key ) );
    }
  }

  /**
   *
   * @depends test_form_create
   */
  public function test_form_does_checked_if_return_checked( $form ) {

    foreach( $form->input->skills as $skill ) {
      $this->assertEquals( 'checked', $form->checked_if( 'skills', $skill ) );
    }

    // ugh... repeat... trickier than it looks...

    foreach( $form->input->color as $color ) {
      $this->assertEquals( 'checked', $form->checked_if( 'color', $color ) );
    }

  }
}
