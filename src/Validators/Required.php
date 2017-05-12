<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use WFV\Validators\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class Required extends AbstractValidator {

	const CONSTANT = 'required';

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param
	 */
	protected function set_policy() {
		$this->validator->notOptional();
	}
}
