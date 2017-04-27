<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

use WFV\ValidationInterface;

/**
 *
 *
 * @since 0.8.0
 */
class Input implements ValidationInterface {

  /**
   * __construct
   *
   * @since 0.8.0
   * @since 0.9.0 Sanitize $_POST moved
   *
   */
  function __construct( $action ) {
    if( $this->is_submit( $action ) ) {
      $this->copy_input();
    }
  }

  /**
   * Check if property exists
   *
   * @since 0.8.0
   *
   * @param string $property
   * @return bool
   */
  private function has( $property ) {
    return ( true === property_exists( $this, $property ) ) ? true : false;
  }


  /**
   *
   *
   * @since 0.9.0
   *
   * @param string $field
   * @param string|array (optional) $callback
   * @return string|null
   */
  public function render( $field, callable $callback ) {
    if( is_string( $field ) ) {
      return ( $this->has( $field ) ) ? $this->call_func( $callback, $this->$field ) : null;
    }
    return null;
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
  public function transform( $input, $callback ) {
    if( is_array( $input ) ) {
      return $this->transform_array_leafs( $input, $callback );
    }
    return $this->call_func( $callback, $input );
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
   * Assign input properties
   *
   * @since 0.9.0
   * @access private
   */
  private function copy_input() {
    // WIP reduce responsibility
    $input = $this->transform_array_leafs( $_POST, 'stripslashes' );

    foreach( $input as $field => $value ) {
      $this->$field = $value;
    }
  }
}
