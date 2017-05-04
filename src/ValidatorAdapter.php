<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

use \Valitron\Validator;
use WFV\Contract\ValidationInterface;
/**
 *
 *
 * @since 0.10.0
 */
class ValidatorAdapter implements ValidationInterface {

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var array
	 */
	private $validator;

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param
	 */
	function __construct( Validator $validator ) {
		$this->validator = $validator;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param
	 * @param
	 */
	public function add_rule( $rule, $field ) {
		$this->validator->rule( $rule, $field );
	}
}
