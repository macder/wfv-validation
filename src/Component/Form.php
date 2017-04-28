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
	private $entity = array();


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
	 * Add an entity
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param string $key
	 * @param class $entity
	 */
	private function add_entity( $key, $entity ) {
		$this->entity[ $key ] = $entity;
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
		return $this->entity[ $entity ];
	}
}
