<?php
namespace WFV\Contract;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.10.0
 */
interface CollectionInterface {

	/**
	 * @return bool
	 */
	public function contains( $key = null, $value = null );

	/**
	 * @return bool
	 */
	public function has( $key = null );

	/**
	 * @return
	 */
	// public function is_not_empty();

	/**
	 * @return
	 */
	// public function render( $value, callable $callback );

	/**
	 * @return
	 */
	// public function transform( $value, callable $callback );
}
