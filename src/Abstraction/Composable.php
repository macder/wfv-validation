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
	 * @access private
	 * @var string
	 */
	protected $alias;

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access protected
	 * @var array
	 */
	protected $collection;

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var string
	 */
	protected $adapter;

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access protected
	 *
	 * @param string $name
	 * @param class $component
	 */
	protected function adapter( $adapter ) {
		return $this->adapter;
	}

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
		$this->collection[ $name ] = $component;
	}

	/**
	 * Use a component.
	 *
	 * @since 0.10.0
	 * @access protected
	 *
	 * @param string $component Key indentifier.
	 */
	protected function utilize( $component ) {
		return $this->collection[ $component ];
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