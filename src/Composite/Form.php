<?php
namespace WFV\Composite;
defined( 'ABSPATH' ) or die();

use WFV\Abstraction\Composable;
use WFV\Contract\ValidationInterface;
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
	 *
	 * @param string $alias
	 * @param array $components
	 */
	function __construct( $alias, array $components = [], ValidationInterface $adapter ) {
		$this->alias = $alias;
		$this->adapter = $adapter;
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

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $rule
	 * @return
	 */
	public function add_rule( $rule, $field ) {
		$this->adapter('validator')->add_rule( $rule, $field );
	}
}
