<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

use WFV\Abstraction\Admission;

/**
 *
 *
 * @since 0.10.0
 */
class Form {

	/**
	 * Action name
	 *
	 * @since 0.10.0
	 * @access private
	 * @var string
	 */
	protected $action;

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
		$this->install( $components );
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
	 * Get an component to make use of.
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param string $trait Key indentifier.
	 */
	private function employ( $component ) {
		return $this->component[ $component ];
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access protected
	 *
	 * @param string $key
	 * @param class $entity
	 */
	protected function add_component( $name, $component ) {
		$this->component[ $name ] = $component;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access protected
	 *
	 * @param array $components
	 */
	protected function install( array $components ) {
		foreach( $components as $name => $component ) {
			$this->add_component( $name, $component );
		}
	}
}
