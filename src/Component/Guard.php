<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

use WFV\Abstraction\Admission;

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
	protected $entity = array();

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var array
	 */
	private $token;

	/**
	 * __construct
	 *
	 * @since 0.10.0
	 *
	 */
	function __construct( $action ) {
		$this->action = $action;
		$this->make_nonce();
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 */
	private function make_nonce() {
		$this->token = wp_create_nonce( $this->action );
	}
}
