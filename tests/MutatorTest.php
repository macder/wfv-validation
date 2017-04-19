<?php

namespace WFV;

use WFV\Factory\ValidationFactory;

class MutatorTest extends \PHPUnit_Framework_TestCase {

  /**
   * Instance of WFV\Validator after $_POST.
   *
   * @access protected
   * @var WFV\Validator $form_after_post
   */
  protected static $form;

  /**
   * Array form config mock
   *
   * @access protected
   * @var array
   */
  protected static $form_args;

  /**
   * Mock $_POST
   *
   * @access protected
   * @var array
   */
  protected static $http_post;

  /**
   *
   *
   */
  protected function setUp() {
    self::$form_args = array(
      'action'  => 'phpunit',
      'rules'   => array(
        'name'      => ['required'],
        'email'     => ['required', 'email'],
        'phone'     => ['required'],
        'website'   => ['required', 'url'],
        'colors'    => ['required']
      ),
      'messages' => [
        'email' => array(
          'required' => 'Email required - phpunit',
          'email'    => 'No email, no reply',
        ),
        'phone' => array(
          'required' => 'No phone, no dialback',
        ),

      ]
    );

    self::$http_post = array(
      'action'  => 'phpunit',
      'name'    => 'Maciek',
      'email'   => 'foo@bar.com',
      'phone'   => '1234567890',
      'website' => 'http://test.com',
      'colors'  => array(
        'red', 'blue', 'green'
      ),
    );

    $_POST = self::$http_post;
    $form = self::$form_args;
    ValidationFactory::create( $form );
    self::$form = $form;
  }

  /**
   * Reset $_POST and $_REQUEST
   *
   */
  public function tearDown() {
    $_POST = null;
  }

  /**
   * Does drop unset properties on the instances?
   *
   */
  public function test_mutator_drop_unsets_property() {
    $form = self::$form;
    $form_args = self::$form_args;
    unset( $form_args['action'] );

    foreach( $form_args as $instance => $values ) {
      foreach( $values as $property => $value ) {
        $form->$instance->drop( $property );
        $this->assertFalse( property_exists( $form->$instance, $property ) );
      }
    }
  }
}
