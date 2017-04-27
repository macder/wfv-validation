<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.9.2
 */
class Form {

  /**
   *
   *
   * @since 0.9.2
   * @access protected
   * @var string
   */
  private $action;

  /**
   *
   *
   * @since 0.9.2
   * @access protected
   * @var
   */
  private $rules;

	/**
	 *
	 *
	 * @since 0.9.2
	 *
	 * @return
	 */
	public function __construct( $action, $rules ) {
		$this->action = $action;
		$this->rules = $rules;
	}
}
