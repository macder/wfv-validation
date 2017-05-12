<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use \Respect\Validation\Validator as v;
use WFV\Validators\AbstractValidator;

/**
 * Required if other field equals a specific value
 *  ie. field is optional unless other field has specific value
 *
 * @since 0.11.0
 */
class RequiredIf extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 */
	const CONSTANT = 'required_if';

	/**
	 * Set the validation constraints that make this rule
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 */
	protected function set_policy() {
		$other_field = $this->params[0];
		$other_value = $this->params[1];

		$this->validator->when(
			v::key( $other_field, v::equals( $other_value ) ),
			v::key( $this->field, v::notEmpty() ),
			v::key( $this->field, v::alwaysValid() )
		);
	}

	/**
	 * Override to use $_POST data so other field can be checked
	 *
	 * @since 0.11.0
	 *
	 * @param string|array $input
	 * @return bool
	 */
	public function validate( $input ){
		return $this->validator->validate( $_POST );
	}
}
