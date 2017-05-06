<?php
namespace WFV\Collection;
defined( 'ABSPATH' ) or die();

use WFV\Abstraction\Collectable;

/**
 *
 *
 * @since 0.10.0
 */
class MessageCollection extends Collectable {

	/**
	 * __construct
	 *
	 * @since 0.10.0
	 *
	 * @param array (optional) $messages
	 */
	function __construct( array $messages = [] ) {
		$this->data = $messages;
	}

	/**
	 * Retrieve a custom error message
	 *
	 * @since 0.10.0
	 *
	 * @param string $field
	 * @param string $rule
	 */
	public function get( $field, $rule ) {
		return $this->data[ $field ][ $rule ];
	}
}
