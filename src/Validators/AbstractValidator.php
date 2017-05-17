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
	 * @param RespectValidator $validator
	 * @param string $field
	 * @param bool (optional) $optional
	 * @param string (optional) $message
	 */
	function __construct( RespectValidator $validator, $field, $optional = false, $message = false ) {
		// WIP - simplify - parameter overload...

		$this->optional = $optional;
		$this->validator = $validator;
		$this->field = $field;

		$args = func_get_args();

		$this->params = ( isset( $args[4] ) ) ? $args[4] : null;

		if( $message ) {
			$this->set_message( $message );
		}

		$this->set_policy();
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

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param
	 */
	protected function set_message( $message ) {
		$this->template['message'] = $message;
	}
}
