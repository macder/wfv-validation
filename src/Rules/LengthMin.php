<?php
namespace WFV\Rules;
defined( 'ABSPATH' ) || die();

use WFV\Rules\AbstractRule;

/**
 *
 *
 * @since 0.11.0
 */
class LengthMin extends AbstractRule {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} must exceed minimum length of {value}',
		'name' => 'length_min',
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
		$min_value = $params[0];

		$v = $this->validator->create();
		return ( $optional )
			? $v->optional( $v->create()->length( $min_value, null ) )->validate( $input )
			: $v->length( $min_value, null )->validate( $input );
	}
}
