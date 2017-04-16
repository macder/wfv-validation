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
   * Instance of WFV\Form
   *
   * @access protected
   * @var WFV\Form $form
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
   * Reset $_POST
   *
   */
  public static function tearDownAfterClass() {
    $_POST = null;
  }

  /**
   * Is the form an instance of WFV\Form?
   *
   */
  public function test_form_is_instance() {
    $this->assertInstanceOf( 'WFV\Form', self::$form );
  }

  /**
   * Is the form input property an instance of WFV\Input?
   *
   */
  public function test_form_input_property_is_input_instance() {
    $this->assertInstanceOf( 'WFV\Input', self::$form->input );
  }

  /**
   * Did the WFV\Input instance create properties from POST keys?
   *
   */
  public function test_form_input_prop_has_props_from_POST() {
    $post = self::HTTP_POST;
    // array_push($post, array('injected_field' => 'injected_value'));

    foreach( $post as $key => $value ) {
      $this->assertTrue( property_exists( self::$form->input, $key ) );
    }
  }

  /**
   * Does 'checked_if' method return 'checked' when POST data
   *  has matching key/value for the field
   *
   */
  public function test_form_does_checked_if_return_checked() {
    foreach( self::$form->input->skills as $skill ) {
      $this->assertEquals( 'checked', self::$form->checked_if( 'skills', $skill ) );
    }
  }

  /**
   * Does 'checked_if' method return null when POST data
   *  is NOT matching key/value for the field
   *
   */
  public function test_form_does_checked_if_return_null() {
    foreach( self::$form->input->skills as $skill ) {
      $this->assertEquals( null, self::$form->checked_if( 'skills', 'BAH!' ) );
    }
  }

  /**
   * Does 'selected_if' method return 'selected' when POST data
   *  has matching key/value for the field
   *
   */
  public function test_form_does_selected_if_return_selected() {
    foreach( self::$form->input->skills as $skill ) {
      $this->assertEquals( 'selected', self::$form->selected_if( 'skills', $skill ) );
    }
  }

  /**
   * Does 'selected_if' method return null when POST data
   *  is NOT matching key/value for the field
   *
   */
  public function test_form_does_selected_if_return_null() {
    foreach( self::$form->input->skills as $skill ) {
      $this->assertEquals( null, self::$form->selected_if( 'skills', 'BAH!' ) );
    }
  }
}
