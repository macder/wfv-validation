<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use WFV\Validators\AbstractValidator;

/**
 *
 *
 * @since 0.11.0
 */
class Date extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var
	 */
	protected $template = [
		'message' => '{label} is not a valid date',
		'name' => 'date',
	];

	/**
	 * Set the validation constraints that make this rule
	 *
	 * @since 0.11.0
	 *
	 */
	public function set_policy( $optional = false ) {
		$format = ( isset( $this->params[0] ) ) ? $this->params[0] : null;

		$v = $this->validator;
		$v = ( $optional )
			? $v->optional( $v->create()->date( $format ) )
			: $v->date( $format );
		return $this;
	}
}
