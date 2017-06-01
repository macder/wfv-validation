<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) || die();

use WFV\Validators\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class Phone extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} is not a valid phone number',
		'name' => 'phone',
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
			? $v->optional( $v->create()->phone() )->validate( $input )
			: $v->phone()->validate( $input );
	}
}
