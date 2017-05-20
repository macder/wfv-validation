<?php
namespace WFV\Agent;
defined( 'ABSPATH' ) || die();


/**
 *
 *
 * @since 0.10.0
 */
class InspectionAgent {

	/**
	 * Action to inspect
	 *
	 * @since 0.10.0
	 * @access private
	 * @var string
	 */
	private $action;

	/**
	 * nonce
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
	public function __construct( $action ) {
		$this->action = $action;
		$this->token = wp_create_nonce( $action );
	}

	/**
	 * Should we take further action with this $_POST data?
	 * Checks if action in post matches $this->action,
	 *  if so, verifies the nonce.
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
	 * Does $_POST have an action key?
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
