<?php defined( 'ABSPATH' ) or die();

/**
 * Performs the input validation
 *
 * Uses Valitron to validate form
 * If form validates, an action is triggered
 *
 * @since 0.2.0
 */
class Form_Validate_Post {

  /**
   * Sanitized post data
   *
   * @since 0.2.0
   * @access protected
   * @var array Sanitized $_POST
   */
  protected $input = array();


  /**
   * Instance of Valitron\Validator
   *
   * @since 0.2.0
   * @access public
   * @var class $valitron Valitron\Validator.
   */
  public $valitron;


  /**
   * __construct
   *
   * @since 0.2.0
   * @param Object $form The validation properties
   *
   */
  function __construct( $form ) {
    $this->validate_nonce( $form->action );
    $this->sanitize_post();
    $this->create_valitron( $form );
    $this->validate( $form );
  }

  /**
   * Verify the nonce
   * Prevents CSFR exploits
   *
   *
   * @since 0.2.2
   * @param string $action
   * @access private
   */
  private function validate_nonce( $action ) {
    $nonce = $_REQUEST[$action.'_token'];
    if ( ! wp_verify_nonce( $nonce, $action ) ) {
      die( 'invalid token' );
    }
  }

  /**
   * Sanitize input and keys in $_POST
   * Assign the sanitized data to $sane_post property
   *
   *
   * @since 0.2.0
   * @access private
   */
  private function sanitize_post() {
    foreach ( $_POST as $key => $value ) {
      $key = sanitize_key( $key );
      $value = sanitize_text_field( $value );
      $this->input[ $key ] = $value;
      // $this->input[sanitize_key( $key )] = sanitize_text_field( $value );
    }
  }

  /**
   * Do the validation
   *
   *
   * @since 0.2.0
   * @access private
   */
  private function validate( $form ) {
    $v = $this->valitron;

    if ( $v->validate() ) {
      do_action( $form->action, $this->input );
    } else {
      $this->validate_fail();
    }
  }


  /**
   * Validation failed
   *
   *
   * @since 0.2.0
   * @access private
   */
  private function validate_fail() {
    $url = add_query_arg( $this->input, wp_get_referer() );
    wp_safe_redirect( $url );
  }

  /**
   * Create an instance of Valitron\Validator, assign to $valitron property
   * Map $rules property Valitron
   *
   *
   * @since 0.2.0
   * @param array $rules Validation rules
   * @access private
   */
  private function create_valitron( $rules ) {
    $this->valitron = new Valitron\Validator( $this->input );
    $this->valitron->mapFieldsRules( $rules );
  }
}
