<?php
namespace WFV;
defined( 'ABSPATH' ) || die();

use WFV\Artisan\FormArtisan;
use WFV\Contract\FormInterface;
use WFV\Contract\ValidateInterface;
use WFV\Factory\ValidatorFactory;

/**
 * Form Composition
 *
 * @since 0.10.0
 */
class FormComposite {

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access protected
	 * @var string
	 */
	protected $alias;

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access protected
	 * @var array
	 */
	protected $collection;

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
		$this->collection = $builder->collection;
		$this->validator = $builder->validator;
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
	protected function valid() {
		$is_valid = $this->validator->is_valid();
		if( false === $is_valid ) {
			$this->utilize('errors')->set_errors( $this->validator->errors() );
		}
		$this->trigger_post_validate_action( $is_valid );
		return $is_valid;
	}

	/**
	 * Perform the validation cycle
	 *
	 * @since 0.11.0
	 *
	 * @param ValidatorFactory $factory
	 * @return self
	 */
	protected function validate( ValidatorFactory $factory ) {
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
		return $this->valid();
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
		return ( $this->utilize('input')->contains( $field, $value ) ) ? $response : null;
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

	/**
	 * Use a component.
	 *
	 * @since 0.10.0
	 * @access protected
	 *
	 * @param string $component Key indentifier.
	 */
	protected function utilize( $component ) {
		return $this->collection[ $component ];
	}
}
