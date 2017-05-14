<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

use WFV\Contract\ValidateInterface;

/**
 *
 *
 * @since 0.11.0
 */
class Validator {

	protected $errors;

	/**
	 * Validate a single input using provided validator (strategy)
	 *
	 * @since 0.11.0
	 *
	 * @param ValidateInterface $validator
	 * @param string|array $input
	 * @return bool
	 */
	public function validate( ValidateInterface $validator, $input ) {

	}
}
