<?php
namespace WFV\Builder;
defined( 'ABSPATH' ) or die();

use WFV\Component\Form;
use WFV\Component\Input;
use WFV\Component\Rules;

/**
 *
 *
 * @since 0.10.0
 */
class FormBuilder implements BuilderInterface {

	// private $action;

	private $components;

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var
	 */
	private $form;

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var array
	 */
	private $config;

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
	public function input() {
		$this->components['input'] = new Input( $this->config['action'] );
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.9.2
	 *
	 * @return
	 */
	public function rules() {
		$this->components['rules'] = new Rules( $this->config['rules'] );
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.9.2
	 *
	 * @return
	 */
	public function create() {
		$this->form = new Form( $this->config['action'], $this->components );
	}

	/**
	 *
	 *
	 * @since 0.9.2
	 *
	 * @return
	 */
	public function result() {
		return $this->form;
	}
}
