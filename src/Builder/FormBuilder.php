<?php
namespace WFV\Builder;
defined( 'ABSPATH' ) or die();

use WFV\Component\Form;
use WFV\Component\Input;
use WFV\Component\Rules;

/**
 *
 *
 * @since 0.9.2
 */
class FormBuilder implements BuilderInterface {

	private $action;

	private $input;

	/**
	 *
	 *
	 * @since 0.9.2
	 * @access private
	 * @var
	 */
	private $form;

	/**
	 *
	 *
	 * @since 0.9.2
	 * @access private
	 * @var array
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

	/**
	 *
	 *
	 * @since 0.9.2
	 *
	 * @return
	 */
	public function input() {
		$this->input = new Input( $this->input );
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
		$this->rules = new Rules( $this->rules );
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
		$this->form = new Form( $this->action, $this->rules, $this->input );
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
