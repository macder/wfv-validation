<?php
namespace WFV\Factory;
defined( 'ABSPATH' ) || die();

use WFV\Contract\ValidateInterface;

/**
 *
 *
 * @since 0.11.0
 */
abstract class AbstractFactory {

	abstract public function create( $rule, $field, $params, $optional = false );
}
