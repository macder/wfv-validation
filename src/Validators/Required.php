<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use WFV\Validators\AbstractValidator;

/**
 * Required field
 *  ie. field must not be empty
 *
 * @since 0.11.0
 */
class Required extends AbstractValidator {

	const CONSTANT = 'required';

	/**
	 * Set the validation constraints that make this rule
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param
	 */
	protected function set_policy() {
		$this->validator->notOptional()->setName( $this->field );
	}
}
