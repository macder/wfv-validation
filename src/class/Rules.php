<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.8.0
 */
class Rules implements Validation {

  use Accessor;
  use Mutator;

  /**
   * __construct
   *
   * @since 0.8.0
   *
   */
  function __construct() {

  }
  /**
   * Check if rule is custom
   *
   * @since 0.7.0
   * @param string $rule
   * @access private
   *
   * @return string|bool
   */
  private function is_custom( $rule ) {
    return ( false !== strpos( $rule, 'custom:' ) ) ? $rule : false;
  }
}
