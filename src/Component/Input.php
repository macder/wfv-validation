<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

use WFV\Abstraction\Collectable;

/**
 * Keeper of the input data
 *
 * @since 0.8.0
 */
class Input extends Collectable {

	/**
	 * Data vault
	 *
	 * @since 0.10.0
	 * @access protected
	 * @var array
	 */
	protected $data = array();


}
