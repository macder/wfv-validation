<?php defined( 'ABSPATH' ) or die();

/**
 *
 *
 *
 * @since 0.7.0
 */
class WFV_Rules {


  /**
   * _construct
   *
   * @param array $rules
   */
  function __construct( $rules ) {
    $this->set( $rules );
  }

  /**
   * Push rules onto an instance of Valitron
   *
   * @since 0.7.0
   * @param object $valitron Instance of Valitron\Validator
   * @param object (optional) $messages Instance of WFV_Messages
   */
  public function push( &$valitron, $messages = null ) {
    foreach( $this as $field => $rules ) {
      //loop this field rules
      foreach( $rules as $rule ){

        // test if rule is custom
        if( $this->is_custom( $rule )) {
          // do something...
        }

        if( property_exists($messages, $field) && array_key_exists($rule, $messages->$field)) {
          $message = $messages->$field;
          $valitron->rule( $rule, $field )->message( $message[$rule] );

        } else { // use defaults
          $valitron->rule( $rule, $field );
        }
      }
    }
  }

  /**
   * Check if rule is custom
   *
   * @since 0.7.0
   * @param string $rule
   *
   * @return string|bool
   */
  public function is_custom( $rule ) {
    return ( false !== strpos( $rule, 'custom:' ) ) ? $rule : false;
  }

  /**
   * Sets supplied rules as properties on this class
   *
   * @since 0.7.0
   * @param array $rules Validation rules
   */
  private function set( $rules ) {
    foreach($rules as $field => $rule){
      $this->$field = $rule;
    }
  }
}
