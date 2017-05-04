<?php
namespace WFV\Composite;
defined( 'ABSPATH' ) or die();

use WFV\Abstraction\Composable;
use WFV\Contract\ValidationInterface;

/**
 *
 *
 * @since 0.10.0
 */
class Form extends Composable {

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $alias
	 * @param array $components
	 */
	function __construct( $alias, array $components = [], ValidationInterface $adapter ) {
		$this->alias = $alias;
		$this->adapter = $adapter;
		$this->install( $components );
	}

	/**
	 * Convenience method to repopulate checkbox input
	 *
	 * @since 0.10.0
	 *
	 * @param string $field Field name.
	 * @param string $value Value to compare against.
	 * @return string|null
	 */
	public function checked_if( $field = null, $value = null ) {
		return $this->string_or_null( 'checked', $field, $value );
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $rule
	 * @param string $field
	 */
	public function constrain() {
		$rules = $this->utilize('rules');

		// loop the field
		foreach( $rules->get_array() as $field => $ruleset ) {
			// loop this field rules - a field can have many rules
			foreach( $ruleset as $rule ) {
        if( $rules->is_custom( $rule ) ) {
          $this->add_custom_rule( $rule );
        }
				$this->add_rule( $rule, $field );
			}
		}
		return $this;
	}

	/**
	 * Get input instance
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Component\ErrorCollection
	 */
	public function errors() {
		return $this->utilize('errors');
	}

	/**
	 * Get input instance
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Component\InputCollection
	 */
	public function input() {
		return $this->utilize('input');
	}

	/**
	 * Convenience method to repopulate select input
	 *
	 * @since 0.10.0
	 *
	 * @param string $field Field name.
	 * @param string $value Value to compare against.
	 * @return string|null
	 */
	public function selected_if( $field = null, $value = null ) {
		return $this->string_or_null( 'selected', $field, $value );
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 */
	public function validate() {
		$this->adapter('validator')->validate();
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param string $rule
	 */
	private function add_custom_rule( $custom_rule ) {
		$this->adapter('validator')->add_custom_rule( $custom_rule );
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $rule
	 * @param string $field
	 */
	private function add_rule( $rule, $field ) {
		$this->adapter('validator')->add_rule( $rule, $field );
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param string $response
	 * @param string (optional) $field
	 * @param string (optional) $value
	 * @return string|null
	 */
	private function string_or_null( $response, $field = null, $value = null ) {
		return ( $this->input( $field )->contains( $field, $value ) ) ? $response : null;
	}
}
