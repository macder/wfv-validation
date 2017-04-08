<?php defined( 'ABSPATH' ) or die();

/**
 *
 *
 *
 * @since 0.7.2
 */
class WFV_Input {


  /**
   * _construct
   *
   * @param string $action
   */
  function __construct( $action ) {
    if( $this->is_submit( $action ) ) {
      $this->set( $this->sanitize() );
    }
  }

  /**
   * Check if there is input data
   * Will return true after form submission
   *
   * @since 0.7.2
   * @param string $action The forms action value
   *
   * @return bool
   */
  public function is_loaded() {
    return ( property_exists( $this, 'action' ) ) ? true : false;
  }

  /**
   * Return property value
   * By default returns this instance
   * If $property string passed, returns value for that property
   *
   * @since 0.7.2
   * @param string (optional) $property Property key name
   *
   * @return string|object Property value
   */
  public function get( $property = false ) {
    return ( $property ) ? $this->$property : $this;
  }

  /**
   * Return input as array
   *
   * @since 0.7.2
   * @param string $property Property key name
   *
   * @return array|null This instance as an array
   */
  public function get_array() {
    return ( $this->is_loaded() ) ? get_object_vars( $this ) : null;
  }

  /**
   * Sanitize $_POST array
   *
   * @since 0.2.0
   * @since 0.7.2 Returns result, does not set $input property
   * @access protected
   *
   * @return array Sanitized keys and values from $_POST
   */
  protected function sanitize() {
    foreach ( $_POST as $key => $value ) {
      $sane[ sanitize_key( $key ) ] = sanitize_text_field( $value );
    }
    return $sane;
  }

  /**
   * Check if there was a $_POST for this form
   *
   * @since 0.7.2
   * @param string $action The forms action value
   *
   * @return bool
   */
  private function is_submit( $action ) {
    return ( $_POST && $_POST['action'] === $action ) ? true : false;
  }

  /**
   * Decorate this class with the input
   *
   * @since 0.7.2
   * @param array $input The sane POST array
   *
   * @return bool
   */
  private function set( $input ) {
    foreach( $input as $field => $value ) {
      $this->$field = $value;
    }
  }
}