<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.8.0
 */
class Errors implements ValidationInterface {

  use AccessorTrait;
  use MutatorTrait;

  /**
   * __construct
   *
   * @since 0.8.0
   *
   */
  function __construct() {
  }

  /**
   * Convienience method to get first error on field.
   *
   * @since 0.9.1
   *
   * @param string $field Name of field
   * @return string First error message.
   */
  public function first( $field ) {
    $errors = $this->$field;
    return $errors[0];
  }
}
