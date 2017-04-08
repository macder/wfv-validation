<?php defined( 'ABSPATH' ) or die();

/**
 * Performs the input validation
 *
 * Uses Valitron to validate form
 * If form validates, an action is triggered
 *
 * @since 0.2.0
 * @since 0.6.0 renamed from Form_Validate_Post
 */
class WFV_Validate {

  /**
   * Form identifier
   *
   * @since 0.1.0
   * @access protected
   * @var string $action
   */
  protected $action;

  /**
   * Validation rules
   *
   * @since 0.1.0
   * @access protected
   * @var array $rules Form validation rules.
   */
  protected $rules;

  /**
   * Error message overrides
   *
   * @since 0.4.0
   * @access protected
   * @var array $messages The field/rule paired messages.
   */
  protected $messages;

  /**
   * User input from failed validation
   *
   * @since 0.2.1
   * @access protected
   * @var array $input Form validation rules.
   */
  protected $input = array();

  /**
   * Result from wp_nonce_field()
   *
   * @since 0.3.0
   * @access protected
   * @var string $nonce_field WP rendered nonce field.
   */
  protected $nonce_field;

  /**
   * Error message bag
   *
   * @since 0.6.1
   * @access protected
   * @var array Error messages for fields.
   */
  protected $errors;


  /**
   * __construct
   *
   * @since 0.2.0
   *
   */
  function __construct() {

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

  /**
   * Do the validation
   *
   * @since 0.2.0
   * @since 0.6.0 Public access
   */
  public function validate() {
    $this->validate_nonce();
    $v = $this->create_valitron();

    if ( $v->validate() ) {
      do_action( $this->action, $this->input );
    } else {
      $this->errors = $v->errors();
    }
  }

  /**
   * Sanitize input and keys in $_POST
   * Assign the sanitized data to $sane_post property
   *
   * @since 0.2.0
   * @since 0.6.0 Public access
   */
  public function sanitize_post() {
    foreach ( $_POST as $key => $value ) {
      $this->input[ sanitize_key( $key ) ] = sanitize_text_field( $value );
    }
  }

  /**
   * Create an instance of Valitron\Validator with our rules / messages
   * Assign to $valitron property
   *
   * @since 0.2.0
   * @param array $form Form configuration array
   */
  public function create_valitron() {

    $valitron = new Valitron\Validator( $this->input );

    foreach( $this->rules as $field => $rules ) {
      foreach( $rules as $rule ){
        if( $this->messages[$field][$rule] ){
          $message = $this->messages[$field][$rule];
          $valitron->rule( $rule, $field )->message( $message );
        }
        else {
          $valitron->rule( $rule, $field );
        }
      }
    }
    return $valitron;
  }

  /**
   * Verify the nonce
   * Prevents CSFR exploits
   *
   * @since 0.2.2
   * @param string $action
   * @access private
   */
  protected function validate_nonce() {
    $nonce = $_REQUEST[ $this->action.'_token' ];
    if ( ! wp_verify_nonce( $nonce, $this->action ) ) {
      die( 'invalid token' );
    }
  }
}
