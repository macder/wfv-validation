<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) || die();

use WFV\Validators\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class Max extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} must not exceed {value}',
		'name' => 'max',
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
		$max_value = $params[0];

		$v = $this->validator->create();

		return ( $optional )
			? $v->optional( $v->create()->max( $max_value ) )->validate( $input )
			: $v->max( $max_value )->validate( $input );
	}
}
