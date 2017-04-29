<?php
namespace WFV\Artisan;
defined( 'ABSPATH' ) or die();

use WFV\Contract\ArtisanInterface;
use WFV\Component\Errors;
use WFV\Component\Form;
use WFV\Component\Input;
use WFV\Component\Rules;

/**
 *
 *
 * @since 0.10.0
 */
class FormArtisan implements ArtisanInterface {

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var array
	 */
	private $components = array();

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var array
	 */
	private $config = array();

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var WFV\Component\Form
	 */
	private $form;

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $action
	 * @return WFV\Artisan\FormArtisan
	 */
	public function create( $action ) {
		$this->form = new Form( $action, $this->components );
		return $this;
	}

	/**
	 * Return the final Form instance
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Component\Form
	 */
	public function actualize() {
		return $this->form;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Artisan\FormArtisan
	 */
	public function errors() {
		$this->components['errors'] = new Errors();
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $action
	 * @return WFV\Artisan\FormArtisan
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
	 * @return WFV\Artisan\FormArtisan
	 */
	public function messages() {
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param array $rules
	 * @return WFV\Artisan\FormArtisan
	 */
	public function rules( array $rules ) {
		$this->components['rules'] = new Rules( $rules );
		return $this;
	}
}
