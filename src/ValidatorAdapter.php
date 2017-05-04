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
	 * @var
	 */
	private $validator;

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param Validator $validator
	 */
	function __construct( Validator $validator ) {
		$this->validator = $validator;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $rule
	 * @param string $field
	 */
	public function add_rule( $rule, $field ) {
		$this->validator->rule( $rule, $field );
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $rule
	 */
	public function add_custom_rule( $rule ) {
		$this->validator->addRule( $rule, function( $field, $value, array $params, array $fields ) use ( $rule ) {
			$rule = explode( ':', $rule );
			$callback = 'wfv__'. $rule[1];
			// TODO: throw exception if no callback, or warning?
			return ( function_exists( $callback ) ) ? $callback( $value ) : false;
		});
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $rule
	 * @param string $field
	 */
	public function validate() {
		$this->validator->validate();
	}
}
