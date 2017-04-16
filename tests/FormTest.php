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
   * Instance of WFV\Validator
   *
   * @access protected
   * @var WFV\Validator $form
   */
  protected static $form;

  /**
   * Create WFV\Form instance with WFV\Input input property
   *
   */
  public static function setUpBeforeClass() {
    $_POST = self::HTTP_POST;

    $action = $_POST['action'];
    self::$form = new Form();
    $input = new Input( $action );
    self::$form->put( 'action', $action );
    self::$form->put( 'input', $input );
  }

  /**
   *
   *
   */
  public static function tearDownAfterClass() {
    $_POST = null;
  }

  /**
   *
   *
   */
  public function test_form_input_prop_has_props_from_POST() {
    foreach( self::$form->input as $key => $value ) {
      $this->assertTrue( property_exists( self::$form->input, $key ) );
    }
  }

  /**
   *
   *
   */
  public function test_form_does_checked_if_return_checked() {
    foreach( self::$form->input->skills as $skill ) {
      $this->assertEquals( 'checked', self::$form->checked_if( 'skills', $skill ) );
    }
  }

  /**
   *
   *
   */
  public function test_form_does_checked_if_return_null() {
    foreach( self::$form->input->skills as $skill ) {
      $this->assertEquals( null, self::$form->checked_if( 'skills', 'BAH!' ) );
    }
  }

  /**
   *
   *
   */
  public function test_form_does_selected_if_return_selected() {
    foreach( self::$form->input->skills as $skill ) {
      $this->assertEquals( 'selected', self::$form->selected_if( 'skills', $skill ) );
    }
  }

  /**
   *
   *
   */
  public function test_form_does_selected_if_return_null() {
    foreach( self::$form->input->skills as $skill ) {
      $this->assertEquals( null, self::$form->selected_if( 'skills', 'BAH!' ) );
    }
  }
}
