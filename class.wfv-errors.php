<?php defined( 'ABSPATH' ) or die();

/**
 *
 *
 *
 * @since 0.7.3
 */
class WFV_Errors {

  /**
   * _construct
   *
   * @param
   */
  function __construct() {

  }

  /**
   * Check if a field has an error
   *
   * @since 0.7.7
   * @param string $field Name of the field
   *
   * @return bool
   */
  public function has( $field ) {
    return ( true === property_exists( $this, $field ) ) ? true : false;
  }

  /**
   *
   *
   * @since 0.7.3
   * @param array $errors Validation rules
   */
  public function set( $errors ) {
    foreach( $errors as $field => $error ) {
      $this->$field = $error;
    }
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
}
