<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use WFV\Validators\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class Callback extends AbstractValidator {

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
