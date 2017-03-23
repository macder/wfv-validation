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
   * @access public
   * @var array Sanitized $_POST
   */
  public $input = array();

  function __construct($rules) {
    $this->sanitize_post();

    print_r($this);
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
}
