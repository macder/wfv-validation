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
	function __construct( array $form ) {
		$this->set_messages( $form );
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @return array
	 */
	public function get_array() {
		return $this->data;
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
			return array_key_exists('messages', $item );
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
