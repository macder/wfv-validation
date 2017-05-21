<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) || die();

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
	 * @var array
	 */
	protected $template = [
		'message' => '{label} is required',
		'name' => 'required_if',
	];

	/**
	 * Validate an input value
	 *
	 * @since 0.11.0
	 *
	 * @param string|array (optional) $input
	 * @param bool (optional) $optional
	 * @return bool
	 */
	public function validate( $input = null, $optional = false ){
		$args = func_get_args();
		$params = $args[2];
		$other_field = $params[0];
		$other_value = $params[1];
		$field = $params[2];

		$v = $this->validator->create();

		return $v->when(
			$v->create()->key( $other_field, $v->create()->equals( $other_value ) ),
			$v->create()->key( $field, $v->create()->notEmpty() ),
			$v->create()->key( $field, $v->create()->alwaysValid() )
		)->validate( $_POST );
	}
}
