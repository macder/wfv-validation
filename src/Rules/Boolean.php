<?php
namespace WFV\Rules;
defined( 'ABSPATH' ) || die();

use WFV\Rules\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class Boolean extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} is not valid',
		'name' => 'boolean',
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
			? $v->optional( $v->create()->boolVal() )->validate( $input )
			: $v->boolVal()->validate( $input );
	}
}
