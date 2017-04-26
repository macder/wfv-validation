<?php
namespace WFV\Builder;
defined( 'ABSPATH' ) or die();

use WFV\Component\Form;
use WFV\Component\Rules;
/**
 *
 *
 * @since 0.9.2
 */
class FormBuilder implements BuilderInterface {

  /**
   *
   *
   * @since 0.9.2
   * @access protected
   * @var array $config
   */
	protected $config;

  /**
   *
   *
   * @since 0.9.2
   * @access protected
   * @var
   */
	protected $form;

  /**
   *
   *
   * @since 0.9.2
   *
   * @return
   */
	public function __construct( $config ) {
		$this->config = $config;
	}

  /**
   *
   *
   * @since 0.9.2
   *
   * @return
   */
	public function add_action() {
		$this->form->set( 'action', $this->config['action'] );
	}

  /**
   *
   *
   * @since 0.9.2
   *
   * @return
   */
	public function add_rules() {
	}

  /**
   *
   *
   * @since 0.9.2
   *
   * @return
   */
	public function add_input() {

	}

  /**
   *
   *
   * @since 0.9.2
   *
   * @return
   */
	public function create() {

		$this->form = new Form();

	}

  /**
   *
   *
   * @since 0.9.2
   *
   * @return
   */
	public function get_form() {
		return $this->form;
	}

}