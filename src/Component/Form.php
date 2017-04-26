<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.9.2
 */
abstract class Form {

  protected $action;

  protected $input;

  /**
   * Check if property exists
   *
   * @since 0.8.0
   *
   * @param string $property
   * @return bool
   */
  public function has( $property ) {
    return ( true === property_exists( $this, $property ) ) ? true : false;
  }

  /**
   *
   *
   * @since 0.9.2
   *
   * @param string $property
   * @param mixed $value
   */
  public function set( $property, $value ) {
    if( $this->has( $property ) ) {
      if( is_null( $this->$property ) ) {
        $this->$property = $value;
      }
    }
  }
}