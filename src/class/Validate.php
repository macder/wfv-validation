<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.8.0
 */
class Validate implements Validation {

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
  // protected $rules;

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
    $this->action = $action;
    $this->rules = $rules;
  }

  /**
   *
   * @param
   * @since 0.8.0
   *
   */
  public function rules() {

  }
}
