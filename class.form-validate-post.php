<?php defined( 'ABSPATH' ) or die();

/**
 * Summary
 *
 * Description
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
   * @param array $rules Validation rules
   *
   */
  function __construct($rules) {
    $this->sanitize_post();
    $this->create_valitron($rules);
    $this->validate();
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
      $this->input[sanitize_key($key)] = sanitize_text_field($value);
    }
  }

  /**
   * Do the validation
   *
   *
   * @since 0.2.0
   * @access private
   */
  private function validate() {
    $v = $this->valitron;

    if ($v->validate()) {
      echo 'thanks... emailing';
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
    $url_query = null;
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
  private function create_valitron($rules) {
    $this->valitron = new Valitron\Validator($this->input);
    $this->valitron->mapFieldsRules($rules);
  }
}
