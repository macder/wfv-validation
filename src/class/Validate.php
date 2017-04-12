<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.8.0
 */
class Validate extends Form implements Validation {
// class Validator extends Form implements Validation {
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
   * Error message overrides
   *
   * @since 0.4.0
   * @since 0.7.0 WFV_Messages instance
   * @access protected
   * @var class $messages Instance of WFV_Messages.
   */
  protected $messages;

  /**
   * Validation rules
   *
   * @since 0.1.0
   * @since 0.7.0 WFV_Rules instance
   * @access protected
   * @var class $rules Instance of WFV_Rules.
   */
  protected $rules;

  use Accessor;
  use Mutator;

  /**
   * __construct
   *
   * @since 0.8.0
   * @param array $form
   *
   */
  function __construct( $action, Rules $rules, Input $input = null ) {
    $properties = array(
      'action' => $action,
      'rules' => $rules,
      'input' => $input,
      'token' => wp_create_nonce( $action ),
    );
    $this->set( $properties );
  }

  /**
   *
   * @param
   * @since 0.8.0
   *
   */
  public function input( $field = null ) {
    return ( $field ) ? $this->input->get( $field ) : null;
  }

  /**
   *
   * @param
   * @since 0.8.0
   *
   */
  public function rules( $field = null ) {
    return $this->rules->get( $field );
  }

}
