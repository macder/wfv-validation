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
	public function __construct( array $rules ) {
		$this->data = $this->parse_rules( $rules );
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
		// WIP - needs adjusting to new rule string format
		if ( false === is_array( $rule ) ){
			return ( false !== strpos( $rule, 'custom:' ) ) ? true : false;
		}
	}

	/**
	 * Extract rule name from a rule string
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param string $rule
	 * @return bool
	 */
	protected function extract_name( $rule ) {
		return strstr( $rule, ':', true );
	}

	/**
	 * Extract rule parameters from a rule string
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param string $rule
	 * @return bool
	 */
	protected function extract_params( $rule ) {
		return ltrim( strstr($rule, ':'), ':');
	}

	/**
	 * Checks if a rule string has parameters
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param string $rule
	 * @return bool
	 */
	protected function has_parameters( $rule ) {
		return strpos( $rule, ':' );
	}

	/**
	 * Split each string ruleset from config array
	 *  into a machine friendly multi-dimensional array
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param array $rules
	 * @return array
	 */
	protected function parse_rules( array $rules ) {
		// WIP - works, but confusing - simplify or breakdown into small methods
		$this->split_rules( $rules );
		foreach( $rules as $field => $ruleset ) {
			$parsed[ $field ] = array_map( function( $rule ) {
				if ( $this->has_parameters( $rule ) ) {
					return array(
						'rule' => $this->extract_name( $rule ),
						'params' => explode( ',', $this->extract_params( $rule ) )
					);
				}
				return $rule;
			}, $ruleset );
		}
		return $parsed;
	}

	/**
	 * Converts string ruleset to index array
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param array $rules
	 * @return array
	 */
	protected function split_rules( array &$rules ) {
		// perhaps the $rules array structure should be validated here?...
		$rules = array_map( function( $item ) {
			return explode( '|', $item );
		}, $rules );
	}
}
