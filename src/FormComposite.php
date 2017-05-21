<?php
namespace WFV;
defined( 'ABSPATH' ) || die();

use WFV\Abstraction\Composable;
use WFV\Artisan\FormArtisan;
use WFV\Contract\ValidateInterface;
use WFV\Factory\ValidatorFactory;

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
	 * @var Validator
	 */
	protected $validator;

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param ArtisanInterface $builder
	 * @param string $action
	 */
	public function __construct( FormArtisan $builder, $action ) {
		$this->alias = $action;
		$this->install( $builder->collection );
		$this->validator = $builder->validator;
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
	 * Check if the validation passed or failed
	 * Sets the error msgs if a fail
	 * Trigger pass or fail action
	 *
	 * @since 0.11.0
	 *
	 * @return bool
	 */
	public function is_valid() {
		$is_valid = $this->validator->is_valid();
		if( false === $is_valid ) {
			$this->utilize('errors')->set_errors( $this->validator->errors() );
		}
		$this->trigger_post_validate_action( $is_valid );
		return $is_valid;
	}

	/**
	 * Use message collection
	 *
	 * @since 0.11.0
	 *
	 * @return WFV\Collection\MessageCollection
	 */
	public function messages() {
		return $this->utilize('messages');
	}

	/**
	 * Use rules collection
	 *
	 * @since 0.11.0
	 *
	 * @return WFV\Collection\RuleCollection
	 */
	public function rules() {
		return $this->utilize('rules');
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
	 * Perform the validation cycle
	 *
	 * @since 0.11.0
	 *
	 * @param ValidatorFactory $factory
	 * @return self
	 */
	public function validate( ValidatorFactory $factory ) {
		$rule_collection = $this->utilize('rules');
		$rules = $rule_collection->get_array( true );
		foreach( $rules as $field => $ruleset ) {
			$input = $this->field_value( $field );
			$optional = $rule_collection->is_optional( $field );
			foreach( $ruleset as $index => $rule ) {
				$params = $rule_collection->get_params( $field, $index );
				$this->validator->validate( $factory->get( $rule ), $field, $input, $optional, $params );
			}
		}
		return $this;
	}

	/**
	 * Returns the input value for a field
	 * When not present, returns null
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param string $field
	 */
	protected function field_value( $field ) {
		$input = $this->utilize('input');
		if( $input->has( $field ) ) {
			$input = $input->get_array( false );
			return $input[ $field ];
		}
		return null;
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
