<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use \Respect\Validation\Validator;
use WFV\Contract\ValidateInterface;

/**
 *
 *
 * @since 0.11.0
 */
abstract class AbstractValidator implements ValidateInterface {

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
	abstract protected function set_policy();

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param
	 */
	function __construct( Validator $validator ) {
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

}
