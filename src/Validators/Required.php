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

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var
	 */
	protected $template = [
		'name' => 'required',
		'message' => '{label} is required'
	];

	/**
	 * Set the validation constraints that make this rule
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 */
	protected function set_policy() {
		$this->validator->notEmpty();
	}
}
