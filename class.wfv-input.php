<?php defined( 'ABSPATH' ) or die();

/**
 * Container for user input
 *
 *
 * @since 0.7.2
 */
class WFV_Input {

  /**
   * Property pointer
   * When accesing this instance using convienience method,
   *  the pointer is the name of property interacted with.
   * eg. $input = $my_form->input('email'), 'email' is the pointer.
   * This enables method chaining from the convienience method context.
   * eg. $match = $my_form->input('email')->has('foo@bar.com')
   *
   * @since 0.7.4
   * @access private
   * @var string $pointer
   */
  private $pointer;

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
   *
   *
   * @since 0.7.4
   *
   * @return
   */
  function __toString() {
    $property = ( $this->is_loaded() ) ? $this->pointer : null;
    return ( property_exists( $this, $property ) ) ? $this->$property : '';

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
  public function get( $property = null ) {
    return ( $property ) ? $this->$property : $this;
  }

  /**
   * Return input as array
   *
   * @since 0.7.2
   * @param string $property Property key name
   *
   * @return array This instance as an array
   */
  public function get_array() {
    return ( $this->is_loaded() ) ? get_object_vars( $this ) : array();
  }

  /**
   * Check if field or input has $string
   *
   * @since 0.7.4
   * @param string $needle Search string
   * @param string (optional) $property Name of field
   *
   * @return bool
   */
  public function has( $needle, $property = null ) {
    $property = ( true === $this->has_pointer() ) ? $this->pointer : $property;
    if( $property ) {
      return ( $this->contains( $needle, $this->$property ) ) ? true : false;
    }
    // no haystack, search entire input, return true on first match
    foreach( $this as $value ) {
      if( $this->contains( $needle, $value ) ) {
        return true;
      }
    }
    // no match, return false
    return false;
  }

  /**
   * Put value to property on this instance
   *
   * @since 0.7.4
   * @param string $property Property name
   * @param string $value Value to set property
   *
   */
  public function put( $property, $value ) {
    $this->$property = $value;
  }

  /**
   * Remove a property value
   *
   * @since 0.7.5
   * @param string $property Property name
   */
  public function forget( $property ) {
    $this->$property = null;
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
    // TODO: maybe array_map() this?
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

  /**
   * Check if property value contains some string
   *
   * @since 0.7.5
   * @param string $needle
   * @param string $property Property name
   *
   * @return bool
   */
  private function contains( $needle, $property ) {
    if ( true === is_array( $property ) ) {
      return ( true === in_array( $needle, $property ) ) ? true : false;
    }
    return ( $needle === $property ) ? true : false;
  }

  /**
   * Check if $pointer property is set.
   *
   * @since 0.7.4
   *
   * @return bool
   */
  private function has_pointer() {
    return ( $this->pointer ) ? true : false;
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
   * @access private
   */
  private function set( $input ) {
    foreach( $input as $field => $value ) {
      $this->$field = $value;
    }
  }
}