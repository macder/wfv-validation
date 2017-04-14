<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.8.0
 */
class Input implements ValidationInterface {

  use AccessorTrait;
  use MutatorTrait;

  /**
   * __construct
   *
   * @since 0.8.0
   *
   */
  function __construct( $action ) {
    if( $this->is_submit( $action ) ) {
      $this->set( $this->sanitize() );
    }
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
      $sane_key = sanitize_key( $key );
      $sane[ $sane_key ] = ( true === is_array( $value ) ) ? $this->sanitize_array( $value ) : sanitize_text_field( $value );
    }
    return $sane;
  }

  /**
   * Sanitize the values of an index array
   *
   * @since 0.8.3
   * @access private
   *
   * @return array Index array or sanitized values
   */
  protected function sanitize_array( $array ) {
    foreach( $array as $input ) {
      $sane_array[] = sanitize_text_field( $input );
    }
    return $sane_array;
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
}
