<?php
namespace WFV\Factory;
defined( 'ABSPATH' ) or die();

use \Valitron\Validator;

use WFV\Errors;
use WFV\Form;
use WFV\Guard;
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
    $errors = new Errors();
    $input = self::input();
    $messages = self::messages();
    $rules = self::rules();

    $form = new Form( $action, $input, $rules, $messages, $errors );
  }

  /**
   *
   *
   * @since 0.9.1
   *
   * @param
   */
  public static function create_guard( $input_action, $input_token ) {
    return self::guard( $input_action, $input_token );
  }

  /**
   *
   *
   * @since 0.9.1
   *
   * @param
   */
  public static function create_validator( $form ) {
    return self::validator( $form->input->get_array() );
  }

  /**
   * Push rules onto an instance of Valitron
   *
   * @since 0.7.0
   * @since 0.9.1 Moved here from WFV\Rules
   *
   * @param WFV\Form $form
   * @param \Valitron\Validator $validator
   */
  public static function load_rules( $form, &$validator ) {
    // WIP - simplification

    // loop the field
    foreach( $form->rules as $field => $rules ) {

      // loop this field rules - a field can have many rules
      foreach( $rules as $rule ) {
        if( $form->rules->is_custom( $rule ) ) {
          self::add_rule( $rule, $validator );
        }

        // check if this field/rule has a custom error message
        if( $form->messages->exist( $field, $rule ) ) {
          $message = $form->messages->$field;
          $validator->rule( $rule, $field )->message( $message[ $rule ] );
        } else { // use defaults
          $validator->rule( $rule, $field );
        }
      }
    }
  }

  /**
   * Add custom rule to Valitron\Validator
   * Trigger callback function for this custom rule
   *
   * @since 0.7.1
   * @since 0.9.1 Moved here from WFV\Rules
   * @access private
   *
   * @param string $rule
   * @param \Valitron\Validator $validator
   */
  private static function add_rule( $rule, $validator ) {
    $validator::addRule( $rule, function($field, $value, array $params, array $fields ) use ( $rule ) {
      $rule = explode( ':', $rule );
      $callback = 'wfv__'. $rule[1];
      // TODO: throw exception if no callback, or warning?
      return ( function_exists( $callback ) ) ? $callback( $value ) : false;
    });
  }

  /**
   *
   *
   * @since 0.9.1
   *
   * @param
   */
  private static function guard( $input_action, $input_token ) {
    return new Guard( $input_action, $input_token );
  }

  /**
   *
   *
   * @since 0.9.1
   *
   * @param
   */
  private static function input() {
    return new Input( self::$config['action'] );
  }

  /**
   *
   *
   * @since 0.9.1
   *
   * @param
   */
  private static function messages() {
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
  private static function rules() {
    return new Rules( self::$config['rules'] );
  }

  /**
   *
   *
   * @since 0.9.1
   *
   * @param
   */
  private static function validator( $input ) {
    return new Validator( $input );
  }

}
