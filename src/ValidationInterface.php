<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.8.0
 */
interface ValidationInterface {
  public function render( $value, callable $callback );
}
