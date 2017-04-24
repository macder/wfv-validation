<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.8.0
 */
class Guard implements ValidationInterface {



  /**
   * __construct
   *
   * @since 0.8.0
   *
   * @param string
   * @param WFV\Rules $rules
   * @param WFV\Input $input
   * @param WFV\Messages $messages
   * @param WFV\Errors $errors
   *
   */

  use AccessorTrait;
  use MutatorTrait;

  function __construct() {
  }

  /**
   * Validate the input with Valitron
   * Trigger pass or fail action hook
   * Return true or false
   *
   * @since 0.2.0
   * @since 0.6.0 Public access
   * @since 0.8.10 Return bool
   *
   * @return bool
   */
  public function validate() {
    $valitron = $this->create();

    $is_valid = ( $valitron->validate() ) ? true : false;
    if ( false === $is_valid ) {
      $this->errors->set( $valitron->errors() );
    }
    $this->trigger_post_validate_action( $is_valid );
    return $is_valid;
  }

  /**
   * Verify the nonce
   * Prevents CSFR exploits
   *
   * @since 0.2.2
   * @since 0.8.0 no params
   * @access protected
   */
  protected function check_nonce() {
    $nonce = $_REQUEST[ $this->action.'_token' ];
    return ( wp_verify_nonce( $nonce, $this->action ) ) ? true : false;
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
