<?php
namespace WFV\Abstraction;
defined( 'ABSPATH' ) or die();

use WFV\Contract\CollectionInterface;

/**
 *
 *
 * @since 0.10.0
 */
abstract class Collectable implements CollectionInterface {

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access protected
	 * @var array
	 */
	protected $data = array();

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return bool
	 */
	public function contains( $key = null, $value = null ) {
		// WIP
		if( $this->has( $key ) ) {
			if ( is_array( $this->data[ $key ] ) ) {
				return ( in_array( $value, $this->data[ $key ] ) ) ? true : false;
			}
			return ( $this->data[ $key ] === $value ) ? true : false;
		}
		return false;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $property
	 * @return bool
	 */
	public function has( $key = null ) {
		return array_key_exists( $key, $this->data );
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return bool
	 */
	public function is_populated() {
		return ( count( $this->data ) > 0 ) ? true : false;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $field
	 * @param string|array (optional) $callback
	 * @return string|null
	 */
	public function render( $key, callable $callback = null ) {
		if( is_string( $key ) ) {
			$callback = ( null === $callback ) ? 'esc_html' : $callback;
			return ( true === $this->has( $key ) ) ? $this->call_func( $callback, $this->data[ $key ] ) : null;
		}
		return null;
	}

	/**
	 * WIP
	 *
	 * @since 0.10.0
	 *
	 * @param string|array $value
	 * @param string $callback
	 * @return string|array
	 */
	public function transform( $key = null, callable $callback ) {
		// WIP
		if( true === $this->has( $key ) ) {
			if( is_array( $this->data[ $key ] ) ) {
				return $this->transform_array_leafs( $this->data[ $key ], $callback );
			}
		}
	}

	/**
	 * Transform the $array leafs, traversing infinite dimensions
	 *
	 * WIP
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param array $array
	 * @param string|array $callback
	 * @return array
	 */
	protected function transform_array_leafs( array $array, $callback ) {
		array_walk_recursive( $array, function( &$item, $key ) use( $callback ) {
			$item = $this->call_func( $callback, $item );
		} );
		return $array;
	}

	/**
	 * Trigger a callback function
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param string|array $callback
	 * @param string (optional) $input The input string
	 * @return
	 */
	private function call_func( $callback, $input = null ) {
		// WIP - simplify
		if( is_array( $callback ) ) {
			$method = $callback[0];
			$args = $callback[1];
			if ( $input ) {
				array_unshift( $args, $input );
			}
			return call_user_func_array( $method, $args );
		}
		return $callback( $input );
	}
}
