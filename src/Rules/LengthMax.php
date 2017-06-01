<?php
namespace WFV\Rules;
defined( 'ABSPATH' ) || die();

use WFV\Rules\AbstractRule;

/**
 *
 *
 * @since 0.11.0
 */
class LengthMax extends AbstractRule {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} cannot exceed maximum length of {value}',
		'name' => 'length_max',
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
			? $v->optional( $v->create()->length( null, $max_value ) )->validate( $input )
			: $v->length( null, $max_value )->validate( $input );
	}
}
