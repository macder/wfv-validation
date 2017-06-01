<?php
namespace WFV\Factory;
defined( 'ABSPATH' ) || die();

use WFV\Validators;

/**
 * Flyweight factory for validators
 *
 * @since 0.11.0
 */
class ValidatorFactory {

	/**
	 * Container holds unique validators
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $pool = array();

	/**
	 * Returns the validator for given rule
	 *
	 * @since 0.11.0
	 *
	 * @param string $rule
	 * @return ValidateInterface|bool
	 */
	public function get( $rule ) {
		if ( !isset( $this->pool[ $rule ] ) ) {
			$class = $this->class_name( $rule );
			$this->pool[ $rule ] = new $class();
		}
		return $this->pool[ $rule ];
	}

	/**
	 * Returns the validator class name for given rule
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
