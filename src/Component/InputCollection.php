<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

use WFV\Abstraction\Collectable;

/**
 *
 *
 * @since 0.8.0
 */
class InputCollection extends Collectable {


	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param array $data
	 */
	function __construct( array $data = array() ) {
		$this->data = $this->transform_array_leafs( $data, 'stripslashes' );
	}
}
