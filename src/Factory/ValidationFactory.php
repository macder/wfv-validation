<?php
namespace WFV\Factory;
defined( 'ABSPATH' ) or die();

use WFV\Rules;
use WFV\Input;
use WFV\Messages;
use WFV\Errors;
use WFV\Validator;

/**
 * Static methods for assembling instances
 *
 * @since 0.8.2
 */
class ValidationFactory {

  /**
   * Build an instance of WFV\Validator as described by $form
   *
   * @since 0.8.2
   *
   * @param array $form
   */
  public static function create_form( &$form ){
    $custom_messages = ( isset( $form['messages'] ) ) ? $form['messages'] : null;

    $rules = new Rules();
    $input = new Input( $form['action'] );
    $messages = new Messages( $custom_messages );
    $errors = new Errors();
    $rules->set( $form['rules'] );
    $form = new Validator( $form['action'], $rules, $input, $messages, $errors );
  }

}
