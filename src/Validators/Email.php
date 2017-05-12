<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use WFV\Validators\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class Email extends AbstractValidator {

	const CONSTANT = 'email';

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access private
	 *
	 * @param
	 */
	protected function set_policy() {
		$this->validator->email();
	}
}
