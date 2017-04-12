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
