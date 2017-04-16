<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.8.0
 */
class Validator extends Form implements ValidationInterface {

  /**
   * Error message bag
   *
   * @since 0.6.1
   * @since 0.7.3 WFV\Errors instance
   * @access protected
   * @var class $errors Instance of WFV_Errors.
   */
  protected $errors;

  /**
   * Error message overrides
   *
   * @since 0.4.0
   * @since 0.7.0 WFV\Messages instance
   * @access protected
   * @var class $messages Instance of WFV_Messages.
   */
  protected $messages;

  /**
   * Validation rules
   *
   * @since 0.1.0
   * @since 0.7.0 WFV\Rules instance
   * @access protected
   * @var class $rules Instance of WFV_Rules.
   */
  protected $rules;

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
  function __construct( $action, Rules $rules, Input $input, Messages $messages, Errors $errors ) {
    $properties = array(
      'action' => $action,
      'rules' => $rules,
      'messages' => $messages,
      'input' => $input,
      'errors' => $errors,
      'token' => wp_create_nonce( $action ),
    );
    $this->set( $properties );
  }

  /**
   * Convienience method to get first error on field.
   *
   * @since 0.6.1
   * @since 0.8.4 simple pure function
   *
   * @param string $field Name of field
   * @return string First error message.
   */
  public function error( $field ) {
    $errors = $this->errors;
    $error = $errors->$field;
    return $error[0];
  }

  /**
   * Check if input action is for this instance.
   * Dies if nonce invalid.
   *
   * @since 0.8.0
   *
   * @return bool True if $this->action is $input->action and nonce is valid.
   */
  public function is_safe( ) {
    if( $this->has_request_action() ) {
      $safe = ( $this->is_legal( $this->input->action ) ) ? true : false;
    }
    return ( true === $safe ) ? $this->check_nonce() : false;
  }

  /**
   *
   *
   * @since 0.8.0
   *
   * @param string (optional) $field
   */
  public function rules( $field = null ) {
    return $this->rules->get( $field );
  }

  /**
   * Do the validation
   *
   * @since 0.2.0
   * @since 0.6.0 Public access
   */
  public function validate() {
    $v = $this->create();
    if ( $v->validate() ) {
      do_action( $this->action, $this );
    } else {
      $errors = $v->errors();
      $this->errors->set( $errors );
      do_action( $this->action .'_fail', $this );
    }
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
   * Check if $this->input has action property
   *
   * @since 0.8.0
   * @access private
   *
   * @return bool
   */
  private function has_request_action() {
    return ( $this->input->has('action') ) ? true : false;
  }

  /**
   * Safety method.
   * Verifies if the input action matches action on this instance.
   * Very unlikely to get false, unless sneaky things happening...
   *
   * @since 0.8.0
   * @access private
   *
   * @param string $action String to compare against $this->action.
   * @return bool
   */
  private function is_legal( $action ) {
    return ( $action === $this->action ) ? true : false;
  }
}
