<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use WFV\Validators\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class Boolean extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var
	 */
	protected $template = [
		'message' => '{label} is not valid',
		'name' => 'boolean',
	];

	/**
	 * Set the validation constraints that make this rule
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 */
	protected function set_policy() {
		$v = $this->validator;
		$v = ( $this->optional )
			? $v->optional( $v->create()->boolVal() )
			: $v->boolVal();
	}
}
