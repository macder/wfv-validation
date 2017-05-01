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
	 * @param
	 */
	function __construct( $data ) {
		$this->data = $data;
	}

}
