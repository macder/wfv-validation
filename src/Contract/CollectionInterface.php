<?php
namespace WFV\Contract;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.8.0
 */
interface CollectionInterface {
	public function has( $key );
	public function render( $value, callable $callback );
	public function transform( $value, callable $callback );
}
