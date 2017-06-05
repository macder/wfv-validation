<?php
namespace WFV;
defined( 'ABSPATH' ) || die();

use WFV\FormComposite;
use WFV\Collection\InputCollection;
use WFV\Collection\MessageCollection;
use WFV\Contract\ValidateInterface;

/**
 * Validates field/rule pairs using provided strategy classes
 *
 * @since 0.11.0
 */
class Validator {

	/**
	 * Container for error messages for rule/field pairs
	 * Only contains messages for validations that failed
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var array
	 */
	protected $errors = [];

	/**
	 *
	 *
	 * @since 0.11.3
	 * @access protected
	 * @var RuleFactory
	 */
	protected $factory;

	/**
	 *
	 *
	 * @since 0.11.3
	 * @access protected
	 * @var MessageCollection
	 */
	protected $messages;

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param RuleFactory $factory
	 */
	public function __construct( RuleFactory $factory, MessageCollection $messages ) {
		$this->factory = $factory;
		$this->messages = $messages;
	}

	/**
	 *
	 *
	 * @since 0.11.3
	 *
	 * @param FormComposite $form
	 * @return bool
	 */
	public function validate( FormComposite $form ) {
		$rule_collection = $form->rules();
		$rules = $rule_collection->get_array( true );

		foreach( $rules as $field => $ruleset ) {
			$input = $this->field_value( $form->input(), $field );
			$optional = $rule_collection->is_optional( $field );

			foreach( $ruleset as $index => $rule ) {
				$params = $rule_collection->get_params( $field, $index );
				$this->is_valid( $this->factory->get( $rule ), $field, $input, $optional, $params );
			}
		}
		return $this->result( $form );
	}

	/**
	 * Add a single error msg for a field's rule if it failed validating
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param string $field
	 * @param array $template
	 */
	protected function add_error( $field, array $template ) {
		$message = ( $this->messages->has( $field ) )
			? $this->messages->get_msg( $field, $template['name'] )
			: $template['message'];
		$this->errors[ $field ][ $template['name'] ] = $message;
	}

	/**
	 * Returns the array of error messages
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @return array
	 */
	protected function errors() {
		return $this->errors;
	}

	/**
	 * Returns the input value for a field
	 * When not present, returns null
	 *
	 * @since 0.11.0
	 * @since 0.11.3 Moved from FormComposite
	 * @access protected
	 *
	 * @param InputCollection $input
	 * @param string $field
	 * @return string|array|null
	 */
	protected function field_value( InputCollection $input, $field ) {
		if( $input->has( $field ) ) {
			$input = $input->get_array();
			return $input[ $field ];
		}
		return null;
	}

	/**
	 * Validate a single input using provided rule (strategy)
	 *
	 * @since 0.11.0
	 *
	 * @param ValidateInterface $rule
	 * @param string $field
	 * @param string|array $value
	 * @param bool $optional
	 * @param array (optional) $params
	 */
	protected function is_valid( ValidateInterface $rule, $field, $value, $optional, $params = false ) {
		$params[] = ( $params ) ? $field : false;
		$valid = $rule->validate( $value, $optional, $params );
		if( !$valid ){
			$this->add_error( $field, $rule->template() );
		}
	}

	/**
	 * Did the full validation cycle pass or fail?
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param FormComposite $form
	 * @return bool
	 */
	protected function result( FormComposite $form ) {
		$valid = empty( $this->errors );
		if( !$valid ) {
			$form->errors()->set_errors( $this->errors );
		}
		$this->trigger_post_validate_action( $form, $valid );
		return $valid;
	}

	/**
	 * Trigger action hook for validation pass or fail
	 *
	 * @since 0.10.0
	 * @since 0.11.3 Moved from FormComposite
	 * @access protected
	 *
	 * @param FormComposite $form
	 * @param bool $is_valid
	 */
	protected function trigger_post_validate_action( FormComposite $form, $is_valid = false ) {
		$action = ( true === $is_valid ) ? $form->name() : $form->name() .'_fail';
		do_action( $action, $form );
	}
}
