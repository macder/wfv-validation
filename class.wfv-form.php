<?php defined( 'ABSPATH' ) or die();

/**
 * WFV_Form
 * Configures a unique form
 * Captures $_POST data if action value matches config
 *
 * @since 0.1.0
 * @since 0.6.0 Renamed from Form_Validation
 */
// class Form_Validation {
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
  }

  /**
   * Return property value
   *
   * @since 0.6.1
   * @param string $property Property key name
   *
   * @return string|array Property value
   */
  public function get( $property ) {
    return ( true === property_exists( $this, $property ) ) ? $this->$property : null;
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
    return ( $field ) ? $this->rules->get( $field ) : $this->rules;
  }

  /**
   * Return field value from $input property
   *
   * @since 0.6.1
   * @param string $field Name of field
   *
   * @return string Field value
   */
  public function get_input( $field ) {
    return $this->input[ $field ];
  }

  /**
   * Return fields $error property
   * By default returns all errors
   * If $field_name is supplied a string, only error for the field
   * $bag is array of messages, false returns first error as string
   *
   * @since 0.6.1
   * @param string (optional) $field_name Only errors for $field_name
   * @param bool (optional) $bag true return array error bag for field
   *
   * @return string|array String if $field is string and $bag = false, array otherwise
   */
  public function get_error( $field_name = null, $bag = false ) {
    if( $field_name ) {
      return ( true == $bag ) ? $this->errors[ $field_name ] : $this->errors[ $field_name ][0];
    }
    return $this->errors;
  }


  /*public function rule( $field ) {
    return $this->rules->get( $field );
  }*/

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
    $this->rules = new WFV_rules( $form['rules'] );
    $this->messages = new WFV_Messages( $form['messages'] );
    $this->create_nonce_field();
    $this->catch_post();
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
   * Executes function(s) hooked into validate_form action
   * Passes this class as parameter
   *
   * @since 0.1.0
   * @since 0.2.0 POST logic moved to Form_Validation_Post
   * @access private
   */
  private function trigger_post_action() {
    do_action( FORM_VALIDATION__ACTION_POST, $this );
  }
}
