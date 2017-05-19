<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

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
	 * @var
	 */
	protected $template = [
		'message' => '{label} must be within a range',
		'name' => 'between',
	];

	/**
	 * Set the validation constraints that make this rule
	 *
	 * @since 0.11.0
	 *
	 */
	public function set_policy( $optional = false ) {
		$start = $this->params[0];
		$end = $this->params[1];

		$v = $this->validator;
		$v = ( $optional )
			? $v->optional( $v->create()->between( $start, $end ) )
			: $v->between( $start, $end );
		return $this;
	}
}
