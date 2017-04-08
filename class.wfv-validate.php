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
   * Do the validation
   *
   * @since 0.2.0
   * @since 0.6.0 Public access
   */
  public function validate() {
    $this->validate_nonce();
    $v = $this->create_valitron();

    if ( $v->validate() ) {
      do_action( $this->action, $this );
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
   * @access protected
   */
  protected function sanitize_post() {
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
   * @access protected
   */
  protected function create_valitron() {
    $valitron = new Valitron\Validator( $this->input );
    $this->rules->push( $valitron, $this->messages );
    return $valitron;
  }

  /**
   * Verify the nonce
   * Prevents CSFR exploits
   *
   * @since 0.2.2
   * @param string $action
   * @access protected
   */
  protected function validate_nonce() {
    $nonce = $_REQUEST[ $this->action.'_token' ];
    if ( ! wp_verify_nonce( $nonce, $this->action ) ) {
      die( 'invalid token' );
    }
  }
}
