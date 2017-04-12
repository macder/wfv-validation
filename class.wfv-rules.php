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
   * Return property value
   *
   * @since 0.7.2
   * @param string $property Property key name
   *
   * @return string|array Property value
   */
  public function get( $property ) {
    return ( true === property_exists( $this, $property ) ) ? $this->$property : $this;
  }

  /**
   * Push rules onto an instance of Valitron
   *
   * @since 0.7.0
   * @param object $valitron Instance of Valitron\Validator
   * @param object (optional) $messages Instance of WFV_Messages
   */
  public function load( &$valitron, $messages = null ) {

    // loop the field
    foreach( $this as $field => $rules ) {

      // loop this field rules - a field can have many rules
      foreach( $rules as $rule ) {
        if( $this->is_custom( $rule ) ) {
          $this->add( $rule, $valitron );
        }

        // check if this field/rule has a custom error message
        if( $messages->has( $field, $rule ) ) {
          $message = $messages->$field;
          $valitron->rule( $rule, $field )->message( $message[ $rule ] );
        } else { // use defaults
          $valitron->rule( $rule, $field );
        }
      }
    }
  }

  /**
   * Add a custom rule
   * Trigger callback for the rule
   *
   * @since 0.7.1
   * @param string $rule
   * @param object $valitron Instance of Valitron\Validator
   * @access private
   */
  private function add( $rule, $valitron ) {
    $valitron::addRule( $rule, function($field, $value, array $params, array $fields ) use ( $rule ) {
      $rule = explode( ':', $rule );
      $callback = 'wfv__'. $rule[1];
      // TODO: throw exception if no callback, or warning?
      return ( function_exists( $callback ) ) ? $callback( $value ) : false;
    });
  }

  /**
   * Check if rule is custom
   *
   * @since 0.7.0
   * @param string $rule
   * @access private
   *
   * @return string|bool
   */
  private function is_custom( $rule ) {
    return ( false !== strpos( $rule, 'custom:' ) ) ? $rule : false;
  }

  /**
   * Sets supplied rules as properties on this class
   *
   * @since 0.7.0
   * @param array $rules Validation rules
   * @access private
   */
  private function set( $rules ) {
    foreach( $rules as $field => $rule ) {
      $this->$field = $rule;
    }
  }
}
