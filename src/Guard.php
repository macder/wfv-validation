<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.8.0
 */
class Guard implements ValidationInterface {

  private $request_action;
  private $request_token;

  /**
   * __construct
   *
   * @since 0.8.0
   *
   */

  use AccessorTrait;
  use MutatorTrait;

  function __construct( $action, $token ) {
    $this->request_action = $action;
    $this->request_token = $token;
  }

  /**
   * Verify the nonce
   * Prevents CSFR exploits
   *
   * @since 0.2.2
   * @since 0.8.0 no params
   * @access protected
   */
  public function is_nonce_valid( $action, $token ) {
    if ( $this->request_action === $action && $this->request_token === $token ) {
      $nonce = $_REQUEST[ $action.'_token' ];
      return ( wp_verify_nonce( $nonce, $action ) ) ? true : false;
    }
    return false;

  }

  /**
   * Create an instance of Valitron\Validator with our rules / messages
   * Assign to $valitron property
   *
   * @since 0.2.0
   * @access protected
   *
   * @param array $form Form configuration array
   */
  private function create() {
    $input = $this->input->get_array();
    $valitron = new \Valitron\Validator( $input );
    $this->rules->load( $valitron, $this->messages );
    return $valitron;
    // void in abyss...
  }

  /**
   * Trigger action hook for validation pass or fail
   *
   * @since 0.8.10
   * @access private
   *
   * @param bool $valid Did the input validate?
   */
  private function trigger_post_validate_action( $is_valid = false ) {
    $action = ( true === $is_valid ) ? $this->action : $this->action .'_fail';
    do_action( $action, $this );
  }
}
