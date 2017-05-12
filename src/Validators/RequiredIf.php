<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use WFV\Contract\ValidateInterface;

/**
 *
 *
 * @since 0.11.0
 */
class RequiredIf implements ValidateInterface {

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 */
	const CONSTANT = 'required_if';

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var
	 */
	protected $validator;

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param
	 */
	function __construct( $validator ) {
		$this->validator = $validator;
		$this->set_policy();
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param
	 */
	public function errors() {

	}

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param string|array $input
	 * @return bool
	 */
	public function validate( $input ) {
		return $this->validator->validate( $input );
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access private
	 *
	 * @param
	 */
	private function set_policy() {
		$this->validator->notEmpty();
	}
}
