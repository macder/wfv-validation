<?php
namespace WFV;
defined( 'ABSPATH' ) || die();

use WFV\Artisan\FormArtisan;
use WFV\Contract\ValidateInterface;
use WFV\RuleFactory;

/**
 * Form Composition
 *
 * @since 0.10.0
 */
class FormComposite {

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var string
	 */
	protected $alias;

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access protected
	 * @var array
	 */
	protected $collection;

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param ArtisanInterface $builder
	 */
	public function __construct( FormArtisan $builder ) {
		$this->alias = $builder->action;
		$this->collection = $builder->collection;
	}

	/**
	 * Convenience method to repopulate checkbox input
	 *
	 * @since 0.10.0
	 *
	 * @param string $field Field name.
	 * @param string $value Value to compare against.
	 * @return string|null
	 */
	public function checked_if( $field = null, $value = null ) {
		return $this->string_or_null( 'checked', $field, $value );
	}

	/**
	 * Echo the encoded value of given field from a callback
	 * Default callback is esc_html()
	 * Also returns the encoded string for assignment
	 *
	 * @since 0.10.1
	 *
	 * @param string (optional) $field
	 * @param callable (optional) $callback
	 * @return string
	 */
	public function display( $field = null, callable $callback = null ) {
		echo $input = $this->utilize('input')->escape( $field );
		return $input;
	}

	/**
	 * Use error collection
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Collection\ErrorCollection
	 */
	public function errors() {
		return $this->utilize('errors');
	}

	/**
	 * Convenience method to check if form has input errors
	 *
	 *
	 * @since 0.12.0
	 *
	 * @return bool
	 */
	public function has_errors() {
		return $this->utilize('errors')->is_populated();
	}

	/**
	 * Use input collection
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Collection\InputCollection
	 */
	public function input() {
		return $this->utilize('input');
	}

	/**
	 * Convenience method to check if validation passed
	 *
	 * @since 0.12.0
	 *
	 * @return bool
	 */
	public function is_valid() {
		return ( $this->input()->is_populated() ) &&
			!$this->has_errors();
	}

	/**
	 * Return the form name/action
	 *
	 * @since 0.11.3
	 *
	 * @return string
	 */
	public function name() {
		return $this->alias;
	}

	/**
	 * Use rules collection
	 *
	 * @since 0.11.0
	 *
	 * @return WFV\Collection\RuleCollection
	 */
	public function rules() {
		return $this->utilize('rules');
	}

	/**
	 * Convenience method to repopulate select input
	 *
	 * @since 0.10.0
	 *
	 * @param string $field Field name.
	 * @param string $value Value to compare against.
	 * @return string|null
	 */
	public function selected_if( $field = null, $value = null ) {
		return $this->string_or_null( 'selected', $field, $value );
	}

	/**
	 * Convienience method to print the hidden fields
	 *  for token and action
	 *
	 * @since 0.10.0
	 *
	 */
	public function token_fields() {
		// TODO - Move markup into something - perhaps a renderable interface?
		$token_name = $this->alias . '_token';
		echo $nonce_field = wp_nonce_field( $this->alias, $token_name, false, false );
		echo $action_field = '<input type="hidden" name="action" value="'. $this->alias .'">';
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access protected
	 *
	 * @param string $response
	 * @param string (optional) $field
	 * @param string (optional) $value
	 * @return string|null
	 */
	protected function string_or_null( $response, $field = null, $value = null ) {
		$input = $this->utilize('input');
		return ( $input->contains( $field, $value ) ) ? $response : null;
	}

	/**
	 * Use a component.
	 *
	 * @since 0.10.0
	 * @access protected
	 *
	 * @param string $component Key indentifier.
	 */
	protected function utilize( $component ) {
		return $this->collection[ $component ];
	}
}
