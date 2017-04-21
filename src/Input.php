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
   * @since 0.9.0 Sanitize $_POST moved
   *
   */
  function __construct( $action ) {
    if( $this->is_submit( $action ) ) {
      $this->set_input();
    }
  }

  /**
   *
   *
   * @since 0.9.0
   *
   * @param string $field
   * @param string|array $callback
   * @return mixed
   */
  public function render( $field, $callback = 'htmlspecialchars' ) {
    return ( $this->has( $field ) ) ? $this->call_func( $callback, $this->$field ) : null;
  }

  /**
   * Transform a string or array leafs using a callback.
   * When $value is an array, only the leafs (no keys) are transformed.
   * Infinite array traversal.
   *
   * @since 0.9.0
   *
   * @param string|array $value
   * @param string $callback
   * @return string|array
   */
  public function transform( $value, $callback ) {

    if( is_array( $value ) ) {
      return $this->transform_array_leafs( $value, $callback );
    }
    return $this->call_func( $callback, $value );
  }

  /**
   * Trigger a callback function
   *
   * @since 0.9.0
   * @access private
   *
   * @param string|array $callback
   * @param string (optional) $input The input string
   * @return
   */
  private function call_func( $callback, $input = null ) {
    if( is_array( $callback ) ) {
      $method = $callback[0];
      $args = $callback[1];

      if ( $input ) {
        array_unshift( $args, $input );
      }
      return call_user_func_array( $method, $args );
    }
    return $callback( $input );
  }

  /**
   * Transform the $array leafs, traversing infinite dimensions
   *
   * @since 0.9.0
   * @access private
   *
   * @param array $array
   * @param string|array $callback
   * @return array
   */
  private function transform_array_leafs( $array, $callback ) {
    array_walk_recursive( $array, function( &$item, $key ) use( $callback ) {
      $item = $this->call_func( $callback, $item );
    } );
    return $array;
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
  /*protected function sanitize() {
    foreach ( $_POST as $field => $value ) {
      $sane[ sanitize_key( $field ) ] = ( is_array( $value ) ) ? $this->sanitize_array( $value ) : sanitize_text_field( $value );
    }
    return $sane;
  }*/

  /**
   * Sanitize the values of an index array
   *
   * @since 0.8.3
   * @access private
   *
   * @return array Index array of sanitized values
   */
  /*protected function sanitize_array( $array ) {
    foreach( $array as $input ) {
      $sane_array[] = sanitize_text_field( $input );
    }
    return $sane_array;
  }*/

  /**
   * Check if there was a $_POST for this action
   *
   * @since 0.7.2
   *
   * @param string $action The forms action value
   * @return bool
   */
  private function is_submit( $action ) {
    return ( $_POST && $_POST['action'] === $action ) ? true : false;
  }

  /**
   * Set the properties
   *
   * @since 0.9.0
   * @access private
   */
  private function set_input() {
    $input = $this->transform_array_leafs( $_POST, 'stripslashes' );
    $this->set( $input );
  }
}
