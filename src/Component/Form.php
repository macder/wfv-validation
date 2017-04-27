<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

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
	private $action;

	/**
	 * Group of entity instances.
	 *
	 * @since 0.10.0
	 * @access private
	 * @var array
	 */
	private $entities = array();


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
		$this->assign( $components );
	}

	/**
	 * Render an entity value returned from a callback.
	 *
	 * @since 0.10.0
	 *
	 * @param string $entity
	 * @param string $value
	 * @param callable $callback
	 */
	public function render( $entity, $value, callable $callback = null ) {
		$callback = ( null === $callback ) ? 'esc_html' : $callback;
		return $this->employ( $entity )
			->render( $value, $callback );
	}

	/**
	 * Add an entity
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param string $key
	 * @param class $entity
	 */
	private function add_entity( $key, $entity ) {
		$this->entities[ $key ] = $entity;
	}

	/**
	 * Assign group of entities.
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param array $components
	 */
	private function assign( array $components ) {
		foreach( $components as $name => $entity ) {
			$this->add_entity( $name, $entity );
		}
	}

	/**
	 * Get an entity to make use of.
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param string $entity Key indentifier.
	 */
	private function employ( $entity ) {
		return $this->entities[ $entity ];
	}
}
