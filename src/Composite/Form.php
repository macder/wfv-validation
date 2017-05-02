<?php
namespace WFV\Composite;
defined( 'ABSPATH' ) or die();

use WFV\Abstraction\Composable;

/**
 *
 *
 * @since 0.10.0
 */
class Form extends Composable {


	/**
	 *
	 *
	 * @since 0.10.0
	 * @access protected
	 * @var array
	 */
	protected $component;

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $alias
	 * @param array $components
	 */
	function __construct( $alias, array $components = [] ) {
		$this->alias = $alias;
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
		return $this->utilize('errors');
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
		return $this->utilize('input');
	}

}
