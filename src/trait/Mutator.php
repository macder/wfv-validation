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
   * @param string $property Property name to assign $value
   * @param string $value The value being assiged to property
   */
  public function put( $property, $value ){
    $this->$property = $value;
  }

  /**
   * Set associative array as properties
   *
   * @since 0.8.0
   * @param array $properties The property / value pairs
   */
  public function set( $array ) {
    foreach( $array as $property => $value ) {
      $this->$property = $value;
    }
  }
}
