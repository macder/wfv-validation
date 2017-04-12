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
   * Error message bag
   *
   * @since 0.6.1
   * @since 0.7.3 WFV_Errors instance
   * @access protected
   * @var class $errors Instance of WFV_Errors.
   */
  protected $errors;

  /**
   * User input from failed validation
   *
   * @since 0.2.1
   * @since 0.7.2 WFV_Input instance
   * @access protected
   * @var class $input Instance of WFV_Input.
   */
  protected $input;

  /**
   * Error message overrides
   *
   * @since 0.4.0
   * @since 0.7.0 WFV_Messages instance
   * @access protected
   * @var class $messages Instance of WFV_Messages.
   */
  protected $messages;

  /**
   * Result from wp_nonce_field()
   *
   * @since 0.3.0
   * @access protected
   * @var string $nonce_field WP rendered nonce field.
   */
  protected $nonce_field;

  /**
   * Validation rules
   *
   * @since 0.1.0
   * @since 0.7.0 WFV_Rules instance
   * @access protected
   * @var class $rules Instance of WFV_Rules.
   */
  protected $rules;

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
    return ( true === property_exists( $this, $property ) ) ? $this->$property : $this;
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
      $this->errors->set( $errors );
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
    $this->rules->load( $valitron, $this->messages );
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
