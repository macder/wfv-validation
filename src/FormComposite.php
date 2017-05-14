<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

use WFV\Abstraction\Composable;
use WFV\Contract\ValidateInterface;

/**
 * Form Composition
 *
 * @since 0.10.0
 */
class FormComposite extends Composable {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $strategies = array();

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $validator;

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $alias
	 * @param array $collected
	 */
	function __construct( $alias, array $collected = [], array $strategies = [] ) {
		$this->alias = $alias;
		$this->install( $collected );
		$this->strategies = $strategies;
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param string $field Field name.
	 */
	public function add_validator( Validator $validator ) {
		$this->validator = $validator;
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
	 * Echo the encoded value of given field from a callback
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
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Collection\ErrorCollection
	 */
	public function errors() {
		return $this->utilize('errors');
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
	 * Validate the input
	 *
	 * @since 0.10.0
	 *
	 * @return bool
	 */
	public function validate() {
		// WIP - incomplete

		$input = $this->utilize('input')->get_array( false );

		foreach( $input as $field => $value ) {
			if( $this->strategies[ $field ] ) {
				foreach( $this->strategies[ $field ] as $strategy ) {
					// echo $validator->validate( $value );
					$this->validator->validate( $strategy, $input );
				}
			}
		}
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access protected
	 *
	 * @param string $response
	 * @param string (optional) $field
	 * @param string (optional) $value
	 * @return string|null
	 */
	protected function string_or_null( $response, $field = null, $value = null ) {
		return ( $this->input( $field )->contains( $field, $value ) ) ? $response : null;
	}

	/**
	 * Trigger action hook for validation pass or fail
	 *
	 * @since 0.10.0
	 * @access protected
	 *
	 * @param bool $is_valid
	 */
	protected function trigger_post_validate_action( $is_valid = false ) {
		$action = ( true === $is_valid ) ? $this->alias : $this->alias .'_fail';
		do_action( $action, $this );
	}
}
