<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.10.0
 */
class Rules {

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param array $rules
	 * @return
	 */
	public function __construct( $rules ) {
		$this->assign( $rules );
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
	 * @since 0.10.0
	 *
	 * @param array $rules
	 * @return
	 */
	private function assign( $rules ) {
		foreach( $rules as $field => $ruleset ) {
			$this->$field = $ruleset;
		}
	}
}
