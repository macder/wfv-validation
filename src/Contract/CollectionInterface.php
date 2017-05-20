<?php
namespace WFV\Contract;
defined( 'ABSPATH' ) || die();

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
	 * @return bool
	 */
	public function is_populated();

	/**
	 * @return string|null
	 */
	public function escape( $key, callable $callback = null );

	/**
	 * @return
	 */
	// public function transform( $value, callable $callback );
}
