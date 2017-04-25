<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.8.0
 */
class Rules implements ValidationInterface {

  use AccessorTrait;
  use MutatorTrait;

  /**
   * __construct
   *
   * @since 0.8.0
   *
   * @param array (optional) $rules
   */
  function __construct( $rules ) {
    $this->set( $rules );
  }

  /**
   * Check if rule is custom
   *
   * @since 0.7.0
   *
   * @param string $rule
   * @return bool
   */
  public function is_custom( $rule ) {
    return ( false !== strpos( $rule, 'custom:' ) ) ? true: false;
  }
}
