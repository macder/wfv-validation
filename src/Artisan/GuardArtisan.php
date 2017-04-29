<?php
namespace WFV\Builder;
defined( 'ABSPATH' ) or die();

use WFV\Contract\BuilderInterface;
use WFV\Component\Guard;
use WFV\Component\Input;
/**
 *
 *
 * @since 0.10.0
 */
class GuardBuilder implements BuilderInterface {

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
	 * @return WFV\Builder\GuardBuilder
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
	public function deliver() {
		return $this->guard;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $action
	 * @return WFV\Builder\GuardBuilder
	 */
	public function input() {
		$this->components['input'] = new Input( $this->action );
		return $this;
	}

}
