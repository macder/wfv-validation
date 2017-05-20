<?php
namespace WFV\Factory;
defined( 'ABSPATH' ) || die();

use WFV\Factory\AbstractFactory;
use WFV\Validators;

/**
 *
 *
 * @since 0.11.0
 */
class ValidatorFactory extends AbstractFactory {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $messages = array();

	/**
	 * __construct
	 *
	 * @since 0.11.0
	 *
	 * @param array $messages Custom error messages
	 */
	public function __construct( array $messages ) {
		$this->messages = $messages;
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param string $rule
	 * @param string $field
	 * @param array $params
	 * @param bool (optional) $optional
	 * @return ValidateInterface
	 */
	public function create( $rule, $field, $params, $optional = false ) {
		$class = $this->class_name( $rule );
		$validator = ( new $class( $field, $params ) )->set_policy( $optional );
		if( isset( $this->messages[ $field ][ $rule ] ) ) {
			$validator->set_message( $this->messages[ $field ][ $rule ] );
		}
		return $validator;
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param string $rule
	 * @return string
	 */
	protected function class_name( $rule ){
		$name = str_replace(' ', '', ucwords( str_replace('_', ' ', $rule ) ) );
		return 'WFV\Validators\\'.$name;
	}
}
