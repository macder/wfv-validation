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
	 * @return self
	 */
	public function constrain() {
		$rules = $this->utilize('rules');
		$messages = $this->utilize('messages');

		$this->adapter('validator')
			->constrain( $rules, $messages );
		return $this;
	}

	/**
	 * Echo the encoded value of given field
	 *  from a callback
	 * Default callback is esc_html()
	 * Also returns the encoded string for assignment
	 *
	 * @since 0.10.1
	 *
	 * @param string (optional) $field
	 * @param callable (optional) $callback
	 * @return string
	 */
	public function display( $field = null, callable $callback = null ) {
		echo $input = $this->utilize('input')->escape( $field );
		return $input;
	}

	/**
	 * Use error collection
	 * Populates error collection if there are validation errors
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Collection\ErrorCollection
	 */
	public function errors() {
		$errors = $this->adapter('validator')->errors();
		return $this->utilize('errors')
			->set_errors( $errors );
	}

	/**
	 * Use input collection
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Collection\InputCollection
	 */
	public function input() {
		return $this->utilize('input');
	}

	/**
	 * Use message collection
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Collection\InputCollection
	 */
	public function messages() {
		return $this->utilize('messages');
	}

	/**
	 * Convienience method to print the hidden fields
	 *  for token and action
	 *
	 * @since 0.10.0
	 *
	 */
	public function token_fields() {
		// TODO - Move markup into something - perhaps a renderable interface?
		$token_name = $this->alias . '_token';
		echo $nonce_field = wp_nonce_field( $this->alias, $token_name, false, false );
		echo $action_field = '<input type="hidden" name="action" value="'. $this->alias .'">';
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
	 * Validate the input
	 *
	 * @since 0.10.0
	 *
	 * @return bool
	 */
	public function validate() {
		$is_valid = $this->adapter('validator')->validate();

		if ( false === $is_valid ) {
			$errors = $this->adapter('validator')->errors();
			$this->utilize('errors')->set_errors( $errors );
		}
		$this->trigger_post_validate_action( $is_valid );
		return $is_valid;
	}

	/**
	 * Trigger action hook for validation pass or fail
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param bool $is_valid
	 */
	private function trigger_post_validate_action( $is_valid = false ) {
		$action = ( true === $is_valid ) ? $this->alias : $this->alias .'_fail';
		do_action( $action, $this );
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
