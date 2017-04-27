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
	 * @since 0.10.0
	 *
	 * @return
	 */
	public function create( $action ) {
		$this->form = new Form( $action, $this->components );
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return
	 */
	public function deliver() {
		return $this->form;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return
	 */
	public function input( $action ) {
		$this->components['input'] = new Input( $action );
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return
	 */
	public function messages() {
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return
	 */
	public function rules( array $rules ) {
		$this->components['rules'] = new Rules( $rules );
		return $this;
	}
}
