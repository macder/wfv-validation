<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use \Respect\Validation\Validator;
use \Respect\Validation\Exceptions\NestedValidationException;
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
	 * @var bool
	 */
	protected $optional;

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
	function __construct( Validator $validator, $field, $optional = false ) {
		$this->optional = $optional;
		$this->validator = $validator;
		$this->field = $field;
		$args = func_get_args();
		$this->params = ( isset( $args[3] ) ) ? $args[3] : null;
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
		// WIP
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

		$is_valid = $this->validator->validate( $input );

		// WIP - set error msgs

		return $is_valid;
	}

}
