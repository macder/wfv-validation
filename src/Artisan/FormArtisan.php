<?php
namespace WFV\Artisan;
defined( 'ABSPATH' ) or die();

use WFV\ValidatorAdapter;
use WFV\Contract\ArtisanInterface;
use WFV\Collection\ErrorCollection;
use WFV\Collection\MessageCollection;
use WFV\Collection\InputCollection;
use WFV\Collection\RuleCollection;

use WFV\FormComposite;

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
	public function create( $action, $validator ) {
		$adapter = new ValidatorAdapter( $validator );

		$this->form = new FormComposite( $action, $this->components, $adapter );
		return $this;
	}

	/**
	 * Return the final Form instance
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Component\FormComposite
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
		$this->components['errors'] = new ErrorCollection();
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
	public function input( array $data = [] ) {
		$this->components['input'] = new InputCollection( $data );
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Artisan\FormArtisan
	 */
	public function messages( array $messages = [] ) {
		$this->components['messages'] = new MessageCollection( $messages );
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
	public function rules( array $rules = [] ) {
		$this->components['rules'] = new RuleCollection( $rules );
		return $this;
	}
}
