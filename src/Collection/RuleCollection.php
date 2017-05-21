<?php
namespace WFV\Collection;
defined( 'ABSPATH' ) || die();

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
	 * When $flat is true, returns array without params
	 *
	 * @since 0.10.0
	 *
	 * @param bool (optional) $flat
	 * @return array
	 */
	public function get_array( $flat = false ) {
		return ( $flat ) ? $this->remove_params() : $this->data;
	}

	/**
	 * Return a rule's parameters or false if none
	 *
	 * @since 0.11.0
	 *
	 * @param string $field
	 * @param int $index
	 * @return array|bool
	 */
	public function get_params( $field, $index ) {
		return ( $this-> has_params( $field, $index ) )
			? $this->data[ $field ][ $index ]['params']
			: false;
	}

	/**
	 * Returns true if field is optional
	 *
	 * @since 0.11.0
	 *
	 * @param string $field
	 * @return bool
	 */
	public function is_optional( $field ) {
		return in_array('optional', $this->data[ $field ] );
	}

	/**
	 * Get array of unique rule types
	 *
	 * @since 0.11.0
	 *
	 * @return array
	 */
	public function unique() {
		$flat = $this->flatten( $this->remove_params() );
		return array_values( array_unique( $flat ) );
	}

	/**
	 * Extract rule name from a rule string
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param string $rule
	 * @return string
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
	 * @return string
	 */
	protected function extract_params( $rule ) {
		return ltrim( strstr($rule, ':'), ':');
	}

	/**
	 * Returns a flat index array of rules
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param array $array
	 * @return array
	 */
	protected function flatten( array $array ) {
		$flat = array();
		foreach( $array as $rule ) {
			if( is_array( $rule ) ){
				$flat = array_merge( $flat, $this->flatten( $rule ) );
			} else {
				$flat[] = $rule;
			}
		}
		return $flat;
	}

	/**
	 * Returns true when a rule has parameters
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param string $field
	 * @param int $index
	 * @return bool
	 */
	protected function has_params( $field, $index ) {
		return is_array( $this->data[ $field ][ $index ] );
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
	protected function string_has_params( $rule ) {
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
		$parsed = array();
		$this->split_rules( $rules );
		foreach( $rules as $field => $ruleset ) {
			$parsed[ $field ] = array_map( function( $rule ) {
				if ( $this->string_has_params( $rule ) ) {
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
	 * Flatens rules with parameters in the collection
	 *  and returns the new array.
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @return array
	 */
	protected function remove_params() {
		return array_map( function( $item ) {
			foreach( $item as $rule ) {
				if( $rule !== 'optional' ) {
					$rules[] = ( is_string( $rule ) ) ? $rule : $rule['rule'];
				}
			}
			return $rules;
		}, $this->data );
	}

	/**
	 * Converts string ruleset to index array
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param array $rules
	 */
	protected function split_rules( array &$rules ) {
		// perhaps the $rules array structure should be validated here?...
		$rules = array_map( function( $item ) {
			return explode( '|', $item );
		}, $rules );
	}
}
