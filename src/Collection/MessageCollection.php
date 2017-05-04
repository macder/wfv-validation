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

	// public function
}
