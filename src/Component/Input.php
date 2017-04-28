<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

use WFV\Helper\Collection;

/**
 *
 *
 * @since 0.8.0
 */
class Input extends Collection {

	/**
	 * Input data from a form
	 *
	 * @since 0.10.0
	 * @access private
	 * @var array
	 */
	protected $data = array();

	/**
	 * __construct
	 *
	 * @since 0.8.0
	 * @since 0.9.0 Sanitize $_POST moved
	 *
	 */
	function __construct( $action ) {
		if( $this->is_submit( $action ) ) {
			$this->assign_input();
		}
	}

	/**
	 * Assign input properties
	 *
	 * @since 0.9.0
	 * @access private
	 */
	protected function assign_input() {
		// WIP reduce responsibility
		$input = $this->transform_array_leafs( $_POST, 'stripslashes' );
		foreach( $input as $field => $value ) {
			$this->data[ $field ] = $value;
		}
	}

	/**
	 * Check if there was a $_POST for this action
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
