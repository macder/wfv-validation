<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use \Respect\Validation\Validator as RespectValidator;
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
	 * @var RespectValidator
	 */
	protected $validator;

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 */
	abstract protected function set_policy( $optional = false );

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 */
	function __construct( $field ) {
		$this->validator = new RespectValidator();
		$this->field = $field;
		$args = func_get_args();
		$this->params = ( isset( $args[1] ) ) ? $args[1] : null;
	}

	/**
	 * Returns the error message for the field/rule under validation
	 *
	 * @since 0.11.0
	 *
	 * @return string
	 */
	public function error_msg() {
		return $this->template['message'];
	}

	/**
	 * Return the name of the field under validation
	 *
	 * @since 0.11.0
	 *
	 * @return string
	 */
	public function field_name() {
		return $this->field;
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param
	 */
	public function set_message( $message ) {
		$this->template['message'] = $message;
	}

	/**
	 * Returns the template array for the field under validation
	 *
	 * @since 0.11.0
	 *
	 * @return array
	 */
	public function template() {
		return $this->template;
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param string|array $input
	 * @return bool
	 */
	public function validate( $value ) {
		$is_valid = $this->validator->validate( $value );
		return $is_valid;
	}
}
