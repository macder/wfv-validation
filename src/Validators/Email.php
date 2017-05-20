<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use WFV\Validators\AbstractValidator;

/**
 * Value must be an email
 *  This only validates if the string is formatted as an email
 *  ie. foo@bar.com
 *
 * @since 0.11.0
 */
class Email extends AbstractValidator {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'message' => '{label} is not a valid email address',
		'name' => 'email',
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
			? $v->optional( $v->create()->email() )
			: $v->email();
		return $this;
	}
}
