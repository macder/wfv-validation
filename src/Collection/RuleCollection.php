<?php
namespace WFV\Collection;
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
	public function __construct( array $rules = [] ) {
		$this->data = $rules;
	}

	/**
	 * Get rules array
	 *
	 * @since 0.10.0
	 *
	 * @return array
	 */
	public function get_array() {
		return $this->data;
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
		return ( false !== strpos( $rule, 'custom:' ) ) ? true : false;
	}
}
