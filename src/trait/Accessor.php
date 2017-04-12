<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 * General class accessor methods
 *
 * @since 0.8.0
 */
trait Accessor {

  /**
   * Get property value
   *
   * @since 0.8.0
   * @param string $property
   *
   * @return
   */
  public function get( $property ){
    return $this->$property;
  }

  /**
   * Check if property exists
   *
   * @since 0.8.0
   * @param string $property
   *
   * @return bool
   */
  public function has( $property ) {
    return ( true === property_exists( $this, $property ) ) ? true : false;
  }

}
