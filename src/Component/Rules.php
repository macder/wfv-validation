<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.9.2
 */
class Rules {

	/**
	 *
	 *
	 * @since 0.9.2
	 *
	 * @param array $rules
	 * @return
	 */
	public function __construct( $rules ) {
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

	/**
	 *
	 *
	 * @since 0.9.2
	 *
	 * @param array $rules
	 * @return
	 */
	private function set( $rules ) {
		foreach( $rules as $field => $ruleset ) {
			$this->$field = $ruleset;
		}
	}
}
