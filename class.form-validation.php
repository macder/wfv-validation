<?php defined( 'ABSPATH' ) or die();

/**
 * Form_Validation validate a form
 *
 * Validates a form against an array of rules using Valitron
 *
 * @since 0.1.0
 */
class Form_Validation {

  /**
   * Form identifier
   *
   * @since 0.1.0
   * @access public
   * @var string $action
   */
  public $action;

  /**
   * Validation rules
   *
   * @since 0.1.0
   * @access public
   * @var array $rules Form validation rules.
   */
  public $rules;

  /**
   * User input from failed validation
   *
   * @since 0.2.1
   * @access public
   * @var array $input Form validation rules.
   */
  public $input;

  /**
   * Result from wp_nonce_field()
   *
   * @since 0.3.0
   * @access public
   * @var string $nonce_field WP rendered nonce field.
   */
  public $nonce_field;


  /**
   * Class constructor
   * check if action parameter matches sane $_POST action value
   * init only if true
   *
   * @since 0.1.0
   * @since 0.4.0 Reduced to single parameter
   * @param array $form Form configuration (rules, action)
   *
   */
  function __construct( $form ) {
    $this->is_retry();
    $this->action = $form['action'];
    $this->rules = $form['rules'];
    $this->create_nonce_field();
    $this->add_actions();
  }

  /**
   * Create a wp_nonce_field
   * Assign it to public $nonce_field property
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
   * Check if this is a retry
   * If form validation failed, there will be get vars
   * Assign them to property so theme can re-populate fields
   *
   * @since 0.2.1
   * @access private
   */
  private function is_retry() {
    if ($_GET){
      foreach ( $_GET as $key => $value ) {
        $this->input[sanitize_key( $key )] = sanitize_text_field( $value );
      }
    }
  }

  /**
   * Creates unique action hooks for the form POST
   *
   * @since 0.1.0
   * @access private
   */
  private function add_actions() {
    add_action( 'admin_post_nopriv_'. $this->action, array( $this, 'validate' ) );
    add_action( 'admin_post_'. $this->action, array( $this, 'validate' ) );
  }

  /**
   * Callback for POST action
   * Executes function(s) hooked into validate_form action
   * Passes this class as parameter
   *
   * @since 0.1.0
   * @since 0.2.0 POST logic moved to Form_Validation_Post
   * @access public
   */
  public function validate() {
    do_action( FORM_VALIDATION__ACTION_POST, $this );
  }
}
