<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

use WFV\Abstraction\Composable;
use WFV\Contract\ValidationInterface;

/**
 * Form Composition
 *
 * @since 0.10.0
 */
class FormComposite extends Composable {

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $alias
	 * @param array $components
	 * @param ValidationInterface $adapter
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
	 * Activate validator with the rules and messages
	 *  via adapter
	 *
	 * @since 0.10.0
	 *
	 * @param string $rule
	 * @param string $field
	 */
	public function constrain() {
		$rules = $this->utilize('rules');
		$messages = $this->utilize('messages');

		// WIP - array_map could be more useful here..
		// loop the field
		foreach( $rules->get_array() as $field => $ruleset ) {
			// loop this field rules - a field can have many rules
			foreach( $ruleset as $rule ) {
				if( $rules->is_custom( $rule ) ) {
					$this->add_custom_rule( $rule );
				}

				// TODO: check if this field/rule has a custom error message

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
	 * Loads a custom rule into a validator via adapter
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param string $custom_rule
	 */
	private function add_custom_rule( $custom_rule ) {
		$this->adapter('validator')->add_custom_rule( $custom_rule );
	}

	/**
	 * Add a rule to a field
	 *  Only for built-in rules
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param string $rule
	 * @param string $field
	 */
	private function add_rule( $rule, $field, $message = null ) {
		$this->adapter('validator')->add_rule( $rule, $field, $message );
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
