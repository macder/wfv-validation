<?php
namespace WFV\Artisan;
defined( 'ABSPATH' ) or die();

use WFV\Contract\ArtisanInterface;
use WFV\Component\Guard;
use WFV\Component\Input;

/**
 *
 *
 * @since 0.10.0
 */
class GuardArtisan implements ArtisanInterface {

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
	 * @var WFV\Component\Guard
	 */
	private $guard;

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $action
	 * @return WFV\Artisan\GuardArtisan
	 */
	public function create( $action ) {
		$this->guard = new Guard( $action );
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Component\Guard
	 */
	public function actualize() {
		return $this->guard;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $action
	 * @return WFV\Artisan\GuardArtisan
	 */
	public function input() {
		$this->components['input'] = new Input( $this->action );
		return $this;
	}

}
