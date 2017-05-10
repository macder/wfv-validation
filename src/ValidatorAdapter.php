<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

// use \Valitron\Validator;
use \Respect\Validation\Validator;
use WFV\Collection\MessageCollection;
use WFV\Collection\RuleCollection;
use WFV\Contract\ValidateInterface;

/**
 * Adapter for 3rd party validator
 * Prevents API changes if different library is used
 *
 * @since 0.10.0
 */
class ValidatorAdapter implements ValidateInterface {

	/**
	 * Valitron Validator
	 *
	 * @since 0.10.0
	 * @access private
	 * @var \Valitron\Validator
	 */
	private $validator;

	/**
	 * Assign a validator to $validator property
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

	}

	/**
	 * Return array of error messages from validator
	 *
	 * @since 0.10.0
	 *
	 * @return array
	 */
	public function errors() {
		// return $this->validator->errors();
	}

	/**
	 * Run the validation and return bool result
	 *
	 * @since 0.10.0
	 *
	 * @return bool
	 */
	public function validate() {
		// return $this->validator->validate();
	}

	/**
	 * Assigns a single rule/field pair to the validator
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param
	 */
	// public function add_rule( Validation $rule ) {
	public function add_rule( $rule ) {
		$this->validator->NotOptional()->NotEmpty();
	}

	/**
	 * Add a custom rule, triggers callable
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param string $rule
	 */
	private function add_custom_rule() {

	}
}
