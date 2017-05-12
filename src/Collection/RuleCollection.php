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
	 *
	 *
	 * @since 0.11.0
	 * @access private
	 *
	 * @param string $rule
	 * @return bool
	 */
	private function extract_name( $rule ) {
		return strstr( $rule, ':', true );
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access private
	 *
	 * @param string $rule
	 * @return bool
	 */
	private function extract_params( $rule ) {
		return ltrim( strstr($rule, ':'), ':');
	}

	/**
	 * Checks if a rule string has parameters
	 *
	 * @since 0.11.0
	 * @access private
	 *
	 * @param string $rule
	 * @return bool
	 */
	private function has_parameters( $rule ) {
		return strpos( $rule, ':' );
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access private
	 *
	 * @param array $rules
	 * @return array
	 */
	private function parse_rules( array $rules ) {

		// WIP - not working properly... simplify!
		$rules = $this->split_rules( $rules );
		return array_map( function( $item ) {
			foreach( $item as $rule ) {
				if ( $this->has_parameters( $rule ) ) {
					$array_rule = array([
						'rule' => $this->extract_name( $rule ),
						'params' => explode( ',', $this->extract_params( $rule ) )
					]);
				}
			}
			return ( $array_rule ) ? $array_rule : $item;
		}, $rules );
	}

	/**
	 * Converts string ruleset to index array
	 *
	 * @since 0.11.0
	 * @access private
	 *
	 * @param array $rules
	 * @return array
	 */
	private function split_rules( array $rules ) {
		// perhaps the $rules array structure should be validated here?...
		return array_map( function( $item ) {
			return explode( '|', $item );
		}, $rules );
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
}
