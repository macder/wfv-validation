<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use WFV\Validators\AbstractValidator;

/**
 *
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
	 *
	 *
	 * @since 0.11.0
	 * @access private
	 *
	 * @param
	 */
	protected function set_policy() {
		$this->validator->notEmpty();
	}
}
