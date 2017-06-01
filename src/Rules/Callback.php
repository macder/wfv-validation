<?php
namespace WFV\Rules;
defined( 'ABSPATH' ) || die();

use WFV\Rules\AbstractRule;

/**
 *
 *
 * @since 0.11.0
 */
class Callback extends AbstractRule {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} is not valid',
		'name' => 'callback',
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

		$v = $this->validator->create();
		return ( $optional )
			? $v->optional( $v->create()->callback( $params[0] ) )->validate( $input )
			: $v->callback( $params[0] )->validate( $input );
	}
}
