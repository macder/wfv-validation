<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.8.0
 */
class Form {
  /**
   * Form identifier
   *
   * @since 0.1.0
   * @access protected
   * @var string $action
   */
  protected $action;

  /**
   * User input
   *
   * @since 0.2.1
   * @since 0.7.2 WFV_Input instance
   * @access protected
   * @var class $input Instance of WFV\Input.
   */
  protected $input;

  /**
   * CSFR token
   * Token generated by wp_nonce()
   *
   * @since 0.8.0
   * @access protected
   * @var string $token Token value from wp_nonce()
   */
  protected $token;

  /**
   * __construct
   *
   * @since 0.8.0
   *
   */
  function __construct() {
  }

  /**
   * Convenience method to repopulate checkbox or radio.
   * Returns 'checked' string if field has value in POST.
   *
   * @since 0.8.5
   *
   * @param string $field Field name.
   * @param string $needle Value to compare against.
   * @return string 'checked' or ''
   */
  public function checked_if( $field, $needle ) {
    if( $this->input->has( $field ) ) {
      if ( is_array( $this->input->$field ) ) { // hmmmm....
        return ( in_array( $needle, $this->input->$field ) ) ? 'checked' : '';
      }
      return ( $this->input->$field === $needle ) ? 'checked' : '';
    }
  }

  /**
   * Convenience method into $this->input.
   * Makes access more declarative.
   * $this->input is an instance of WFV\Input.
   *
   * @since 0.8.0
   *
   * @param string (optional) $field Property to retrieve value from.
   * @return class|string WFV\Input or $field string value.
   */
  public function input( $field = null ) {
    return ( $field ) ? $this->input->$field : $this->input;
  }

  /**
   * TEMP - upcoming re-work
   *
   * Returns markup for required hidden fields
   * Makes theme file cleaner
   *
   * @since 0.8.0
   */
  public function get_token_fields() {
    // TODO - Move markup into a view
    $token_name = $this->action . '_token';

    echo $nonce_field = wp_nonce_field( $this->action, $token_name, false, false );
    echo $action_field = '<input type="hidden" name="action" value="'. $this->action .'">';
  }
}
