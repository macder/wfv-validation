<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use \Respect\Validation\Validator as v;
use WFV\Validators\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class Callback extends AbstractValidator {

	const CONSTANT = 'callback';

	/**
	 * Set the validation constraints that make this rule
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 */
	protected function set_policy() {
		$this->validator->callback( $this->params[0] );
	}
}
