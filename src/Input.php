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
    print_r($_POST);
  }


  /**
   * escape on output
   *
   * @since 0.9.0
   *
   * @param
   * @return
   */
  public function get( $field, $html = true ) {
    if ( $this->has( $field ) ) {
      return ( true === $html ) ? htmlspecialchars( $this->$field ) : $this->$field;
    }
    return null;
  }

  /**
   *
   *
   * @since 0.9.0
   * @access private
   *
   * @param string|array $data
   * @param string $callback
   * @return
   */
  public function clean( $data, $callback ) {

    // function_exists ( $callback )

    if( is_array( $data ) ) {

      return array_map( $callback, $data );
    }
    return $callback( $data );
  }

  /**
   *
   *
   * @since 0.9.0
   *
   * @param array $request The POST array
   * @return array
   */
  public function clean_array( $array, $callback ) {
    return array_map( function( $row ) use ( $callback ) {

      if( is_array( $row ) ) {
        foreach( $row as $key => $value ) {
          $test[$key] = $this->clean( $value, $callback );
        }
        return $test;
      } else {
        return $this->clean( $row, $callback );
      }

    }, $array );
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
    $input = $this->clean_array( $_POST, 'stripslashes' );
    $this->set( $input );
  }
}
