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
	 * @param array $collected
	 * @param ValidationInterface $adapter
	 */
	function __construct( $alias, array $collected = [], ValidationInterface $adapter ) {
		$this->alias = $alias;
		$this->install( $collected );
		$this->adapter = $adapter;
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

		$this->adapter('validator')
			->constrain( $rules, $messages );

		//echo 'hi';

		// print_r($messages);

		// WIP - array_map could be more useful here..
		// loop the field
		/*foreach( $rules->get_array() as $field => $ruleset ) {
			// loop this field rules - a field can have many rules
			foreach( $ruleset as $rule ) {
				if( $rules->is_custom( $rule ) ) {
					$this->add_custom_rule( $rule );
				}

				// TODO: check if this field/rule has a custom error message

				$this->add_rule( $rule, $field );
			}
		}*/
		return $this;
	}

	/**
	 * Use error collection
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Component\ErrorCollection
	 */
	public function errors() {
		$errors = $this->adapter('validator')
			->errors();

		return $this->utilize('errors')
			->set_errors( $errors );
	}

	/**
	 * Use input collection
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Component\InputCollection
	 */
	public function input() {
		return $this->utilize('input');
	}

	/**
	 * Use message collection
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Component\InputCollection
	 */
	public function messages() {
		return $this->utilize('messages');
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
		// WIP
		if ( false === $this->adapter('validator')->validate() ) {
			$errors = $this->adapter('validator')->errors();
			$this->utilize('errors')->set_errors( $errors );
		}
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
