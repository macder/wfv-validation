<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use \Respect\Validation\Validator as v;
use WFV\Validators\AbstractValidator;

/**
 * Value must be an email
 *  This only validates if the string is formatted as an email
 *  ie. foo@bar.com
 *
 * @since 0.11.0
 */
class Email extends AbstractValidator {

	const CONSTANT = 'email';

	/**
	 * Set the validation constraints that make this rule
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 */
	protected function set_policy() {
		$this->validator->optional( v::email() );
	}
}
