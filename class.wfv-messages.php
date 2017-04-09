<?php defined( 'ABSPATH' ) or die();

/**
 *
 *
 *
 * @since 0.7.0
 */
class WFV_Messages {

  /**
   * _construct
   *
   * @param array $messages
   */
  function __construct( $messages ) {
    if( $messages ) {
      $this->set( $messages );
    }
  }

  public function get( $property ) {
    return ( true === property_exists( $this, $property ) ) ? $this->$property : $this;
  }

  /**
   * Check if field/rule has custom message
   *
   * @since 0.7.0
   * @param string $field
   * @param string $rule
   *
   * @return bool
   */
  public function has($field, $rule) {
    if( property_exists( $this, $field ) && array_key_exists( $rule, $this->$field ) ) {
      return true;
    }
  }

  /**
   * Sets the messages as properties on this class
   *
   * @since 0.7.0
   * @param array $messages
   * @access protected
   */
  protected function set( $messages ) {
    foreach( $messages as $field => $message ) {
      $this->$field = $message;
    }
  }
}
