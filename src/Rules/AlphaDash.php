<?php
namespace WFV\Rules;
defined( 'ABSPATH' ) || die();

use WFV\Rules\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class AlphaDash extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} can only contain alphabetic characters, dashes, and underscores',
		'name' => 'alpha',
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
			? $v->optional( $v->create()->alpha('-_') )->validate( $input )
			: $v->alpha('-_')->validate( $input );
	}
}
