<?php defined( 'ABSPATH' ) or die();

/**
 * WFV_Form
 * Configures a unique form
 * Captures $_POST data if action value matches config
 *
 * @since 0.1.0
 * @since 0.6.0 Renamed from Form_Validation
 */
class WFV_Form extends WFV_Validate {

  /**
   * Class constructor
   *
   * @since 0.1.0
   * @since 0.4.0 Reduced to single parameter
   * @param array $form Form configuration (rules, action)
   *
   */
  function __construct( $form ) {
    $this->set( $form );

    if( $this->input->is_loaded() ) {
      $this->trigger_post_action();
    }
  }

  /**
   * Convienience method to access rules property
   *
   * @since 0.7.2
   * @param string (optional) $field The field name
   *
   * @return
   */
  public function rules( $field = null ) {
    return ( $field ) ? $this->rules->get( $field ) : $this->get('rules');
  }

  /**
   * Convienience method to access input property
   *
   * @since 0.6.1
   * @since 0.7.4 Sets field pointer on WFV_Input instance
   * @param string (optional) $field Name of field
   *
   * @return class|string Instance of WFV_Input or field value
   */
  public function input( $field = null ) {
    $this->reset_pointer('input');
    if( $field ) {
      $this->set_pointer('input', $field);
    }
    return $this->input;
  }

  /**
   * Convienience method to access errors property
   *
   * @since 0.6.1
   * @param string $field Name of field
   *
   * @return string Field value
   */
  public function error( $field = null ) {
    if( $field ) {
      $errors = $this->get( 'errors' );
      $error = $errors->$field;
      return $error[0];
    }
    return $this->get('errors');
  }

  /**
   * Assign $form config to properties
   *
   * @since 0.4.0
   * @since 0.5.1 Renamed from set_config
   * @param array $form Form configuration
   * @access private
   */
  private function set( $form ) {
    $this->action = $form['action'];
    $this->rules = new WFV_Rules( $form['rules'] );
    $this->messages = new WFV_Messages( $form['messages'] );
    $this->input = new WFV_Input( $this->action );
    $this->errors = new WFV_Errors();
    $this->create_nonce_field();
  }

  /**
   * Create a wp_nonce_field
   * Assign to $nonce_field property
   *
   * @since 0.3.0
   * @access private
   */
  private function create_nonce_field() {
    $nonce_action = $this->action;
    $nonce_name = $this->action . '_token';
    $this->nonce_field = wp_nonce_field( $nonce_action, $nonce_name, false, false );
  }

  /**
   *
   *
   * @since 0.7.5
   * @access private
   */
  private function reset_pointer( $property_instance ) {
    $this->$property_instance->forget('pointer');
  }

  /**
   *
   *
   * @since 0.7.5
   * @access private
   */
  private function set_pointer( $property_instance, $pointer ) {
    $this->$property_instance->put('pointer', $pointer);
  }

  /**
   * Executes function(s) hooked into validate_form action
   * Passes this class as parameter
   *
   * @since 0.1.0
   * @since 0.2.0 POST logic moved to Form_Validation_Post
   * @access private
   */
  private function trigger_post_action() {
    do_action( WFV_VALIDATE__ACTION_POST, $this );
  }
}
