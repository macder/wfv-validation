<?php
namespace WFV\Rules;
defined( 'ABSPATH' ) || die();

use WFV\Rules\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class Date extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} is not a valid date',
		'name' => 'date',
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
		$params = isset( $args[2] ) ? $args[2]: false;
		$format = ( isset( $params[0] ) ) ? $params[0] : null;

		$v = $this->validator->create();
		return ( $optional )
			? $v->optional( $v->create()->date( $format ) )->validate( $input )
			: $v->date( $format )->validate( $input );
	}
}
