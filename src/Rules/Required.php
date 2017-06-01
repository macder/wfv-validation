<?php
namespace WFV\Rules;
defined( 'ABSPATH' ) || die();

use WFV\Rules\AbstractRule;

/**
 * Required field
 *  ie. field must not be empty
 *
 * @since 0.11.0
 */
class Required extends AbstractRule {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $template = [
		'name' => 'required',
		'message' => '{label} is required'
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
		$v = $this->validator->create()->notEmpty();
		return $v->validate( $input );
	}
}
