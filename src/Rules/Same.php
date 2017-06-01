<?php
namespace WFV\Rules;
defined( 'ABSPATH' ) || die();

use WFV\Rules\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class Same extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} must have the same value as {field}',
		'name' => 'same',
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
	public function validate( $input = null, $optional = false ) {
		$args = func_get_args();
		$params = $args[2];
		$other_field = $params[0];
		$field = $params[1];

		$v = $this->validator->create();

		return $v->keyValue( $other_field, 'equals', $field )->validate( $_POST );
	}
}
