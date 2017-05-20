<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) || die();

use WFV\Validators\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class AlphaNum extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} can only contain alpha-numeric characters',
		'name' => 'alpha_num',
	];

	/**
	 * Set the validation constraints that make this rule
	 *
	 * @since 0.11.0
	 *
	 * @param bool (optional) $optional
	 * @return self
	 */
	public function set_policy( $optional = false ) {
		$v = $this->validator;
		$v = ( $optional )
			? $v->optional( $v->create()->alnum() )
			: $v->alnum();
		return $this;
	}
}
