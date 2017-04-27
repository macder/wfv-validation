<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.9.2
 */
class Form {

  /**
   * Action name
   *
   * @since 0.9.2
   * @access private
   * @var string
   */
  private $action;

  /**
   * Group of entity instances
   *
   * @since 0.9.2
   * @access private
   * @var array
   */
  private $entities = [];


	/**
	 *
	 *
	 * @since 0.9.2
	 *
	 * @param string $action
	 * @param array $components
	 */
	function __construct( $action, $components ) {
		$this->action = $action;
		$this->assign( $components );
	}

	/**
	 * Render an entity value returned from a callback
	 *
	 * @since 0.9.2
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
   * Assign group of entities
   *
   * @since 0.9.2
   * @access private
   *
   * @param array $components
   */
  private function assign( $components ) {
    foreach( $components as $name => $entity ) {
      $this->add_entity( $name, $entity );
    }
  }

  /**
   * Add an entity
   *
   * @since 0.9.2
   * @access private
   *
   * @param string $key
   * @param class $entity
   */
  private function add_entity( $key, $entity ) {
    $this->entities[ $key ] = $entity;
  }

	/**
	 * Return entity instance
	 *
	 * @since 0.9.2
	 * @access private
	 *
	 * @param string $entity Key indentifier
	 */
	private function employ( $entity ) {
		return $this->entities[ $entity ];
	}
}
