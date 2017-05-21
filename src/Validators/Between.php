<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) || die();

use WFV\Validators\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class Between extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} must be within a range',
		'name' => 'between',
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
		$start = $params[0];
		$end = $params[1];

		$v = $this->validator->create();
		return ( $optional )
			? $v->optional( $v->create()->between( $start, $end ) )->validate( $input )
			: $v->between( $start, $end )->validate( $input );
	}
}
