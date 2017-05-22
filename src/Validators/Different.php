<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use WFV\Validators\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class Different extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} must be different than {other}',
		'name' => 'different',
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
	public function validate( $input = null, $optional = false ){
		$args = func_get_args();
		$params = $args[2];
		$other_field = $params[0];

		$v = $this->validator->create();

		if( $optional ) {
			return $v->optional(
				$v->create()->not( $v->create()->equals( $_POST[ $other_field ] )) )
					->validate( $input );
		}
		return $v->not( $v->create()->equals( $_POST[ $other_field ] ))->validate( $input );
	}
}
