<?php
namespace WFV\Rules;
defined( 'ABSPATH' ) || die();

use \Respect\Validation\Validator as RespectValidator;
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
	 * @var RespectValidator
	 */
	protected $validator;

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 */
	public function __construct() {
		$this->validator = new RespectValidator();
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
}
