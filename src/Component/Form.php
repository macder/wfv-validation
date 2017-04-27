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
   * Action name
   *
   * @since 0.9.2
   * @access private
   * @var string
   */
  private $action;

  /**
   * Group of entity instances
   *
   * @since 0.9.2
   * @access private
   * @var array
   */
  private $entities = [];

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
	public function __construct( $action, $rules, $input ) {
		$this->action = $action;
		$this->input = $input;
		$this->rules = $rules;
	}
}
