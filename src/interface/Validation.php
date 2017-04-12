<?php
namespace WFV;

/**
 *
 *
 * @since 0.8.0
 */
interface Validation {
  public function __get( $property );
  public function has( $property );
  public function put( $property, $value );
  public function set( $array );
}
