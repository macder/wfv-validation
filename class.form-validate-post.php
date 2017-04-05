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
// class Form_Validate_Post {
class WFV_Validate {
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
  function __construct( /*$form*/ ) {
    /*$this->validate_nonce( $form->action );
    $this->sanitize_post();
    $this->create_valitron( $form );
    $this->validate( $form );*/
    // print_r($this);
  }

  public function test() {
    echo 'test';
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
      $this->input[ sanitize_key( $key ) ] = sanitize_text_field( $value );
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
   * Create an instance of Valitron\Validator with our rules / messages
   * Assign to $valitron property
   *
   *
   * @since 0.2.0
   * @param array $form Form configuration array
   */
  public function create_valitron( $form ) {
    $this->valitron = new Valitron\Validator( $this->input );
    $rules_to_map = $this->custom_message_rules( $form );
    $this->valitron->mapFieldsRules( $rules_to_map );
  }

  /**
   * Check for custom error messages in $form config
   * Add rules with custom messages individually to Valitron
   *
   *
   * @since 0.5.0
   *
   * @param array $form Form configuration array
   * @return array Form rules that didn't have custom messages
   */
   private function custom_message_rules( $form ) {
    foreach( $form->rules as $field => $rules ) {
      // check if this field has any custom error msgs
      if ( array_key_exists( $field, $form->messages ) ) {
        foreach ( $form->messages[ $field ] as $rule => $message ) {
          // add the rule with custom error message
          $this->valitron->rule( $rule, $field )->message( $message );
          // remove the rule from $form config or it will get mapped again later
          $key = array_search( $rule, $rules );
          unset( $form->rules[ $field ][ $key ] );
        }
      }
    }
    return $form->rules;
  }
}
