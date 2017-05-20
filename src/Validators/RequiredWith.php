<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) || die();

use WFV\Validators\AbstractValidator;

/**
 * Required with other field
 *  ie. This field is required when other field is not empty
 *
 *
 * @since 0.11.0
 */
class RequiredWith extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} is required',
		'name' => 'required_with',
	];

	/**
	 * Set the validation constraints that make this rule
	 *
	 * @since 0.11.0
	 *
	 */
	public function set_policy( $optional = false ) {
		$other_field = $this->params[0];
		$v = $this->validator;

		$v->when(
			$v->create()->key( $other_field, $v->create()->notEmpty() ),
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
