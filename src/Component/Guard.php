<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();


/**
 *
 *
 * @since 0.10.0
 */
class Guard {

	/**
	 * Action name
	 *
	 * @since 0.10.0
	 * @access private
	 * @var string
	 */
	private $action;

	/**
	 * Group of entity instances.
	 *
	 * @since 0.10.0
	 * @access private
	 * @var array
	 */
	private $entity = array();

	/**
	 * __construct
	 *
	 * @since 0.10.0
	 *
	 */
	function __construct( $action ) {
		$this->action = $action;
	}
}
