<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

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
	 * @access protected
	 * @var
	 */
	protected $template = [
		'message' => '{label} is required',
		'name' => 'required_if',
	];

	/**
	 * Set the validation constraints that make this rule
	 *
	 * @since 0.11.0
	 *
	 */
	public function set_policy( $optional = false ) {
		$other_field = $this->params[0];
		$other_value = $this->params[1];
		$v = $this->validator;
		$v->when(
			$v->create()->key( $other_field, $v->create()->equals( $other_value ) ),
			$v->create()->key( $this->field, $v->create()->notEmpty() ),
			$v->create()->key( $this->field, $v->create()->alwaysValid() )
		);
		return $this;
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
