<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) || die();

use WFV\Validators\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class Alpha extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} can only contain alphabetic characters',
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
			? $v->optional( $v->create()->alpha() )->validate( $input )
			: $v->alpha()->validate( $input );
	}
}
