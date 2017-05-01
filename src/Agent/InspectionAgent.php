<?php
namespace WFV\Agent;
defined( 'ABSPATH' ) or die();


/**
 *
 *
 * @since 0.10.0
 */
class InspectionAgent {

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var string
	 */
	private $action;

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var string
	 */
	private $token;

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $action
	 */
	function __construct( $action ) {
		$this->action = $action;
		$this->token = wp_create_nonce( $action );
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return bool
	 */
	public function safe_submit() {
		if( $this->submit_has_action() ) {
			return ( $_POST['action'] === $this->action ) ? $this->nonce() : false;
		}
		return false;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return bool
	 */
	private function submit_has_action() {
		return isset( $_POST['action'] );
	}

	/**
	 * Verify nonce.
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @return bool
	 */
	private function nonce() {
		$nonce = $_REQUEST[ $this->action.'_token' ];
		return ( wp_verify_nonce( $nonce, $this->action ) ) ? true : false;
	}

}
