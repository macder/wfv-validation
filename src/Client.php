<?php
namespace WFV;
defined( 'ABSPATH' ) || die();

use WFV\FormComposite;
use WFV\Contract\FormInterface;

/**
 *
 *
 * @since 0.11.0
 */
class Client extends FormComposite implements FormInterface {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 * @var FormComposite
	 */
	protected $form;

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param FormComposite $form
	 */
	public function __construct( FormComposite $form ) {
		$this->form = $form;
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
		echo $this->form->string_or_null( 'checked', $field, $value );
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
		echo $input = $this->form->utilize('input')->escape( $field );
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
		return $this->form->utilize('errors');
	}

	/**
	 * Use input collection
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Collection\InputCollection
	 */
	public function input() {
		return $this->form->utilize('input');
	}

	/**
	 * Use rules collection
	 *
	 * @since 0.11.0
	 *
	 * @return WFV\Collection\RuleCollection
	 */
	public function rules() {
		return $this->form->utilize('rules');
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
		return $this->form->string_or_null( 'selected', $field, $value );
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
		$token_name = $this->form->alias . '_token';
		echo $nonce_field = wp_nonce_field( $this->form->alias, $token_name, false, false );
		echo $action_field = '<input type="hidden" name="action" value="'. $this->form->alias .'">';
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 */
	public function is_valid( $factory ) {
		return $this->form->validate( $factory );
	}

}
