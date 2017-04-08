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
  function __construct( $errors ) {
    $this->set( $errors );
    // print_r($this);
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
    return ( true === property_exists( $this, $property ) ) ? $this->$property : null;
  }

  /**
   *
   *
   * @since 0.7.3
   * @param array $errors Validation rules
   * @access private
   */
  private function set( $errors ) {
    foreach( $errors as $field => $error ) {
      $this->$field = $error;
    }
  }
}
