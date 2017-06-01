<?php
namespace WFV\Rules;
defined( 'ABSPATH' ) || die();

use WFV\Rules\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class Digit extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} must be a digit',
		'name' => 'digit',
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
		$v = $this->validator->create();
		return ( $optional )
			? $v->optional( $v->create()->digit()->length(1,1) )->validate( $input )
			: $v->digit()->length(1,1)->validate( $input );
	}
}
