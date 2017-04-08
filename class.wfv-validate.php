<?php defined( 'ABSPATH' ) or die();

/**
 * Performs the input validation
 *
 * Uses Valitron to validate form
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
   * @var class $rules Instance of WFV_Rules.
   */
  protected $rules;

  /**
   * Error message overrides
   *
   * @since 0.4.0
   * @access protected
   * @var class $messages Instance of WFV_Messages.
   */
  protected $messages;

  /**
   * User input from failed validation
   *
   * @since 0.2.1
   * @access protected
   * @var class $input Instance of WFV_Input.
   */
  protected $input;

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
      $errors = $v->errors();
      $this->errors = new WFV_Errors( $errors );
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
    $input = $this->input->get_array();
    $valitron = new Valitron\Validator( $input );
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
