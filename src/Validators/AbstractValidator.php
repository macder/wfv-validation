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
	 * @var string
	 */
	protected $field;

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $params;

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var Validator
	 */
	protected $validator;

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 */
	abstract protected function set_policy();

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param Validator $validator
	 */
	function __construct( Validator $validator, $field ) {
		$this->validator = $validator;
		$this->field = $field;
		$args = func_get_args();
		$this->params = ( isset( $args[2] ) ) ? $args[2] : null;
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
