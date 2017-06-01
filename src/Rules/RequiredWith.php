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
		$field = $params[1];

		$v = $this->validator->create();

		return $v->when(
			$v->create()->key( $other_field, $v->create()->notEmpty() ),
			$v->create()->key( $field, $v->create()->notEmpty() ),
			$v->create()->key( $field, $v->create()->alwaysValid() )
		)->validate( $_POST );
	}
}
