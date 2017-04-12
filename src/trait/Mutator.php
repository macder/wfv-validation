<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 * General class mutator methods
 *
 * @since 0.8.0
 */
trait Mutator {

  /**
   * Remove a property value
   *
   * @since 0.8.0
   * @param string $property
   */
  public function forget( $property ) {
    $this->$property = null;
  }

  /**
   * Set a property and value
   *
   * @since 0.8.0
   * @param string $property
   * @param string $value
   */
  public function put( $property, $value ){
    $this->$property = $value;
  }
}
