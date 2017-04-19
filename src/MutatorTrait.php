<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 * Generic property setters
 *
 * @since 0.8.0
 */
trait MutatorTrait {

  /**
   * Drop property and value
   * Removes key and value
   *
   * @since 0.8.12
   *
   * @param string $property Property name.
   * @return mixed|null
   */
  public function drop( $property ) {
    $property_return = ( true === $this->has($property) ) ? $this->$property : null;

    if( $property_return ){
      unset( $this->$property );
    }
    return $property_return;
  }

  /**
   * Null a property value.
   *
   * @since 0.8.0
   *
   * @param string $property Property name.
   */
  public function forget( $property ) {
    $this->$property = null;
  }

  /**
   * Set a property and value
   *
   * @since 0.8.0
   *
   * @param string $property Property name to assign $value
   * @param string $value The value being assiged to property
   */
  public function put( $property, $value ){
    $this->$property = $value;
  }

  /**
   * Associative array to instance properties.
   * Creates new property for each array key, and assigns its value.
   * array( $Key => $value ) becomes $value = $this->$key
   *
   * @since 0.8.0
   *
   * @param array $properties The property / value pairs
   */
  public function set( $array ) {
    foreach( $array as $property => $value ) {
      $this->$property = $value;
    }
  }
}
