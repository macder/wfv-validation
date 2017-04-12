<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.8.0
 */
class Input implements Validation {

  use Accessor;
  use Mutator;

  /**
   * __construct
   *
   * @since 0.8.0
   *
   */
  function __construct() {
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
   * Sanitize $_POST array
   *
   * @since 0.2.0
   * @since 0.7.2 Returns result, does not set $input property
   * @access protected
   *
   * @return array Sanitized keys and values from $_POST
   */
  protected function sanitize() {
    // TODO: Simplify this; break into several simple pure functions

    foreach ( $_POST as $key => $value ) {
      $sane_key = sanitize_key( $key );
      // edge case for checkboxes - array input
      if( true === is_array( $value ) ) {
        foreach( $value as $input ) {
          $sane[ $sane_key ][] = sanitize_text_field( $input );
        }
      } else { // default - string input
        $sane[ $sane_key ] = sanitize_text_field( $value );
      }
    }
    return $sane;
  }
}
