<?php
namespace WFV\Collection;
defined( 'ABSPATH' ) or die();

use WFV\Abstraction\Collectable;

/**
 *
 *
 * @since 0.10.0
 */
class InputCollection extends Collectable {


	/**
	 * __construct
	 *
	 * @since 0.10.0
	 *
	 * @param array $data
	 */
	function __construct( array $data = array() ) {
		$this->data = $this->transform_array_leafs( $data, 'stripslashes' );
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
}
