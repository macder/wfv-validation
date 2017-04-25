<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 * Perfoms input safety checks and validation
 *
 * @since 0.9.1
 */
class Guard {

  /**
   * POST action value
   *
   * @since 0.9.1
   * @access private
   * @var string $request_action
   */
  private $request_action;

  /**
   * POST token value
   *
   * @since 0.9.1
   * @access private
   * @var string $request_token
   */
  private $request_token;

  /**
   * __construct
   *
   * @since 0.9.1
   */

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
   *
   * @return bool
   */
  public function is_nonce_valid( $action, $token ) {
    if ( $this->request_action === $action && $this->request_token === $token ) {
      $nonce = $_REQUEST[ $action.'_token' ];
      return ( wp_verify_nonce( $nonce, $action ) ) ? true : false;
    }
    return false;

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
   * @param WFV\Form $form
   * @param \Valitron\Validator $validator
   * @return bool
   */
  public function validate( $form, $validator ) {
    $is_valid = ( $validator->validate() ) ? true : false;
    if ( false === $is_valid ) {
      $form->errors->set( $validator->errors() );
    }
    $this->trigger_post_validate_action( $form, $is_valid );
    return $is_valid;
  }

  /**
   * Trigger action hook for validation pass or fail
   *
   * @since 0.8.10
   * @access private
   *
   * @param WFV\Form $form
   * @param bool $valid Did the input validate?
   */
  private function trigger_post_validate_action( $form, $is_valid = false ) {
    $action = ( true === $is_valid ) ? $form->action : $form->action .'_fail';
    do_action( $action, $form );
  }
}
