<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

use WFV\Abstraction\Admission;

/**
 *
 *
 * @since 0.10.0
 */
class Form extends Admission {

	/**
	 * Action name
	 *
	 * @since 0.10.0
	 * @access private
	 * @var string
	 */
	private $action;

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $action
	 * @param array $components
	 */
	function __construct( $action, array $components = [] ) {
		$this->action = $action;
		$this->congregate( $components );
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $field
	 * @return WFV\Component\Errors
	 */
	public function errors( $field = null ) {
		return $this->employ('errors');
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $field
	 * @return WFV\Component\Input
	 */
	public function input( $field = null ) {
		return $this->employ('input');
	}

	/**
	 * Get an trait to make use of.
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param string $trait Key indentifier.
	 */
	private function employ( $component ) {
		return $this->component[ $component ];
	}
}
