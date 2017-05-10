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
	 * @param class $collection
	 */
	protected function add_collection( $name, $collection ) {
		$this->collection[ $name ] = $collection;
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
	 * @param array $collections
	 */
	protected function install( array $collections ) {
		foreach( $collections as $name => $collection ) {
			$this->add_collection( $name, $collection );
		}
	}
}
