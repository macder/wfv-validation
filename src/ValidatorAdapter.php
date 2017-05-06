<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

use \Valitron\Validator;
use WFV\Collection\MessageCollection;
use WFV\Collection\RuleCollection;
use WFV\Contract\ValidationInterface;

/**
 * Adapter for 3rd party validator
 * Prevents API changes if different library is used
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
	 * Loads the rules and custom messages into Validator
	 *
	 * @since 0.10.0
	 *
	 * @param RuleCollection $rules
	 * @param MessageCollection $messages
	 */
	public function constrain( RuleCollection $rules, MessageCollection $messages ) {
		// WIP
		// loop the field
		foreach( $rules->get_array() as $field => $ruleset ) {
			// loop this field rules - a field can have many rules
			foreach( $ruleset as $rule ) {
				if( $rules->is_custom( $rule ) ) {
					$this->add_custom_rule( $rule );
				}
				$message = ( $messages->has( $field ) ) ? $messages->get( $field, $rule ) : null;

				$this->add_rule( $rule, $field, $message );
			}
		}
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return array
	 */
	public function errors() {
		return $this->validator->errors();
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return bool
	 */
	public function validate() {
		return $this->validator->validate();
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param string $rule
	 * @param string $field
	 * @param string (optional) $message
	 */
	private function add_rule( $rule, $field, $message = null ) {
		$validator = $this->validator->rule( $rule, $field );
		if( $message ){
			$validator->message( $message );
		}
	}

	/**
	 * Add a custom rule, triggers callable
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param string $rule
	 */
	private function add_custom_rule( $rule ) {
		$this->validator->addRule( $rule, function( $field, $value, array $params, array $fields ) use ( $rule ) {
			$rule = explode( ':', $rule );
			$callback = 'wfv__'. $rule[1];
			// TODO: throw exception if no callback, or warning?
			return ( function_exists( $callback ) ) ? $callback( $value ) : false;
		});
	}
}
