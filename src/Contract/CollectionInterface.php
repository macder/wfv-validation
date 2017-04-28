<?php
namespace WFV\Contract;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.10.0
 */
interface CollectionInterface {
	public function has( $key );
	public function is_not_empty();
	public function render( $value, callable $callback );
	public function transform( $value, callable $callback );
}
