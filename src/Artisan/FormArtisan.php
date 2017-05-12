<?php
namespace WFV\Artisan;
defined( 'ABSPATH' ) or die();


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
	private $collection = array();

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var WFV\FormComposite
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
		$this->form = new FormComposite( $action, $this->collection );
		return $this;
	}

	/**
	 * Return the final Form instance
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\FormComposite
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
		$this->collection['errors'] = new ErrorCollection();
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
		$this->collection['input'] = new InputCollection( $data );
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
		// $this->collection['messages'] = new MessageCollection( $messages );
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
		$this->collection['rules'] = new RuleCollection( $rules );
		return $this;
	}
}
