<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

use WFV\Contract\ValidateInterface;

/**
 * Validates field/rule pairs using provided strategy classes
 *
 * @since 0.11.0
 */
class Validator {

	/**
	 * Container for error messages for rule/field pairs
	 * Only contains messages for validations that failed
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $errors = [];

	/**
	 * Returns the array of error messages
	 *
	 * @since 0.11.0
	 *
	 * @return array
	 */
	public function errors() {
		return $this->errors;
	}

	/**
	 * Did the full validation cycle pass or fail?
	 *
	 * @since 0.11.0
	 *
	 * @return bool
	 */
	public function is_valid() {
		return empty( $this->errors );
	}

	/**
	 * Validate a single input using provided rule (strategy)
	 *
	 * @since 0.11.0
	 *
	 * @param ValidateInterface $rule
	 * @param string|array $value
	 */
	public function validate( ValidateInterface $rule, $field, $value ) {
		$valid = $rule->validate( $value );
		if( !$valid ){
			$this->add_error( $field, $rule->template() );
		}
	}

	/**
	 * Add a single error msg for a field's rule if it failed validating
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param string $field
	 * @param array $template
	 */
	protected function add_error( $field, array $template ) {
		$this->errors[ $field ][ $template['name'] ] = $template['message'];
	}
}
