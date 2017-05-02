<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

use WFV\Abstraction\Collectable;

/**
 *
 *
 * @since 0.10.0
 */
class RuleCollection extends Collectable {

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param array $rules
	 */
	public function __construct( $rules ) {
		$this->data = $rules;
	}

	/**
	 * Check if rule is custom
	 *
	 * @since 0.10.0
	 *
	 * @param string $rule
	 * @return bool
	 */
	public function is_custom( $rule ) {
		// return ( false !== strpos( $rule, 'custom:' ) ) ? true: false;
	}
}
