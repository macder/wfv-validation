<?php
namespace WFV\Abstraction;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.10.0
 */
abstract class Composable {

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access protected
	 *
	 * @param string $name
	 * @param class $component
	 */
	protected function add_component( $name, $component ) {
		$this->component[ $name ] = $component;
	}

	/**
	 * Get an component to make use of.
	 *
	 * @since 0.10.0
	 * @access protected
	 *
	 * @param string $component Key indentifier.
	 */
	protected function employ( $component ) {
		return $this->component[ $component ];
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