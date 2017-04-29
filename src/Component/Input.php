<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

use WFV\Abstraction\Collection;

/**
 * Keeper of the input data
 *
 * @since 0.8.0
 */
class Input extends Collection {

	/**
	 * Data vault
	 *
	 * @since 0.10.0
	 * @access protected
	 * @var array
	 */
	protected $data = array();

	/**
	 * __construct
	 *
	 * @param string $action
	 * @since 0.8.0
	 */
	function __construct( $action ) {
		if( $this->is_submit( $action ) ) {
			$this->store();
		}
	}

	/**
	 * Convenience method to repopulate checkbox or radio.
	 *
	 * @since 0.8.5
	 *
	 * @param string $field Field name.
	 * @param string $value Value to compare against.
	 * @return string|null
	 */
	public function checked_if( $field, $value ) {
		return ( $this->contains( $field, $value ) ) ? 'checked' : null;
	}

	/**
	 * Convenience method to repopulate select dropdown.
	 *
	 * @since 0.8.6
	 *
	 * @param string $field Field name.
	 * @param string $value Value to compare against.
	 * @return string|null
	 */
	public function selected_if( $field, $value ) {
		return ( $this->contains( $field, $value ) ) ? 'selected' : null;
	}

	/**
	 * Data in to the vault
	 *
	 * @since 0.9.0
	 * @access private
	 */
	private function store() {
		$input = $this->transform_array_leafs( $_POST, 'stripslashes' );
		foreach( $input as $field => $value ) {
			$this->data[ $field ] = $value;
		}
	}

	/**
	 * Does the $_POST concern this instance?
	 *
	 * @since 0.7.2
	 *
	 * @param string $action The forms action value
	 * @return bool
	 */
	private function is_submit( $action ) {
		return ( $_POST && $_POST['action'] === $action ) ? true : false;
	}
}
