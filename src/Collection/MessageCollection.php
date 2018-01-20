<?php
namespace WFV\Collection;
defined( 'ABSPATH' ) || die();
use WFV\Abstraction\Collectable;
/**
 *
 *
 * @since 0.11.0
 */
class MessageCollection extends Collectable {

	/**
	 * __construct
	 *
	 * @since 0.11.0
	 *
	 * @param array $form Config array
	 */
	public function __construct( array $form ) {
		$this->set_messages( $form );
	}

	/**
	 * Return the message array
	 *
	 * @since 0.11.0
	 *
	 * @return array
	 */
	public function get_array() {
		return $this->data;
	}

	/**
	 * Return a custom error message for a field's rule
	 *
	 * @since 0.11.0
	 *
	 * @param string $field
	 * @param string $rule
	 * @return array|null
	 */
	public function get_msg( $field, $rule ) {
		return ( isset( $this->data[ $field ][ $rule ] ) )
			? $this->data[ $field ][ $rule ]
			: null;
	}

	/**
	 * Filter out fields that do not have custom error messages
	 *  from the config array
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param array $form
	 * @return array
	 */
	protected function filter_config( array $form ) {
		return array_filter( $form, function( $item ) {
			if ( array_key_exists('messages', $item ) ) {
				return !empty($item['messages']);
			}
		});
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param array
	 */
	protected function make_array( array $filtered ) {
		$messages = array();
		foreach( $filtered as $field => $options ) {
			$messages[ $field ] = $options['messages'];
		}
		return $messages;
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param array $form
	 */
	protected function set_messages( array $form ) {
		$filtered = $this->filter_config( $form );
		$this->data = $this->make_array( $filtered );
	}
}
