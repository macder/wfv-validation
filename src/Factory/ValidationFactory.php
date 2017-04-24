<?php
namespace WFV\Factory;
defined( 'ABSPATH' ) or die();

use \Valitron\Validator;

use WFV\Errors;
use WFV\Form;
use WFV\Input;
use WFV\Messages;
use WFV\Rules;

/**
 * Static methods for assembling instances
 *
 * @since 0.8.2
 */
class ValidationFactory {

  /**
   *
   *
   * @since 0.9.1
   * @access protected
   * @var
   */
  protected static $config;


  /**
   * Build an instance of WFV\Form as described by $form
   *
   * @since 0.8.2
   *
   * @param array $form
   */
  public static function create_form( &$form ) {
    self::$config = $form;

    $action = $form['action'];
    $input = self::input();
    $messages = self::messages();
    $rules = self::rules();

    $form = new Form( $action, $input, $rules, $messages );
  }

  /**
   *
   *
   * @since 0.9.1
   *
   * @param
   */
  public static function create_validator( &$form ) {
    $validator = self::validator( $form->input->get_array() );
    $form->rules->load( $validator, $form->messages );
  }

  /**
   *
   *
   * @since 0.9.1
   *
   * @param
   */
  private function guard() {
    // return new Input( self::$config['action'] );
  }

  /**
   *
   *
   * @since 0.9.1
   *
   * @param
   */
  private function input() {
    return new Input( self::$config['action'] );
  }

  /**
   *
   *
   * @since 0.9.1
   *
   * @param
   */
  private function messages() {
    $messages = ( isset( self::$config['messages'] ) ) ? self::$config['messages'] : null;
    return new Messages( $messages );
  }

  /**
   *
   *
   * @since 0.9.1
   *
   * @param
   */
  private function rules() {
    return new Rules( self::$config['rules'] );
  }

  /**
   *
   *
   * @since 0.9.1
   *
   * @param
   */
  private function validator() {
    return new Validator();
  }

}
