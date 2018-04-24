<?php
namespace WFV;
defined( 'ABSPATH' ) || die();

use \Respect\Validation\Validator as RespectValidator;
use WFV\Rules;

/**
 * Flyweight factory for rules
 *
 * @since 0.11.0
 */
class RuleFactory {

	/**
	 * Container holds unique rules
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $pool = array();

	/**
	 * Returns a rule instance
	 *
	 * @since 0.11.0
	 *
	 * @param string $rule
	 * @return ValidateInterface|bool
	 */
	public function get( $rule ) {
		if ( !isset( $this->pool[ $rule ] ) ) {
			$this->pool[ $rule ] = $this->create( $rule );
		}
		return $this->pool[ $rule ];
	}

	/**
	 * Returns a rule's class name
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param string $rule
	 * @return string
	 */
	protected function class_name( $rule ){
		$name = str_replace(' ', '', ucwords( str_replace('_', ' ', $rule ) ) );
		return 'WFV\Rules\\'.$name;
	}

	/**
	 * Create a ValidationInterface for a rule
	 *
	 * @since 0.12.1
	 *
	 * @param string $rule
	 * @return ValidateInterface
	 */
	protected function create( $rule ) {
		$class = $this->class_name( $rule );
		return new $class( new RespectValidator() );
	}
}
