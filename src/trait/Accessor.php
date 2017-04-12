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
   * __get magic method
   *
   * @since 0.8.0
   * @param string $property
   *
   * @return
   */
  public function __get( $property ) {
    return ( true === $this->has( $property ) ) ? $this->$property : null;
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
