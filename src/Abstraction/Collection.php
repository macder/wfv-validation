<?php
namespace WFV\Abstraction;
defined( 'ABSPATH' ) or die();

use WFV\Contract\CollectionInterface;

/**
 *
 *
 * @since 0.10.0
 */
abstract class Collection implements CollectionInterface {

  /**
   *
   *
   * @since 0.8.6
   *
   * @return bool
   */
  public function contains( $key, $value = null ) {
    // WIP
    // TODO: do a 'has' check
    if ( is_array( $this->data[ $key ] ) ) {
      return ( in_array( $value, $this->data[ $key ] ) ) ? true : false;
    }
    return ( $this->data[ $key ] === $value ) ? true : false;
  }

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $property
	 * @return bool
	 */
	public function has( $key ) {
		if( array_key_exists( $key, $this->data ) ) {
			return ( $this->data[ $key ] ) ? true : false;
		}
		return false;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return bool
	 */
	public function is_not_empty() {
		return ( count( $this->data ) > 0 ) ? true : false;
	}

	/**
	 *
	 *
	 * @since 0.9.0
	 *
	 * @param string $field
	 * @param string|array (optional) $callback
	 * @return string|null
	 */
	public function render( $field, callable $callback = null ) {
		if( is_string( $field ) ) {
			$callback = ( null === $callback ) ? 'esc_html' : $callback;
			return ( true === $this->has( $field ) ) ? $this->call_func( $callback, $this->data[ $field ] ) : null;
		}
		return null;
	}

	/**
	 * Transform a string or array leafs using a callback.
	 * When $value is an array, only the leafs (no keys) are transformed.
	 * Infinite array traversal.
	 *
	 * @since 0.9.0
	 *
	 * @param string|array $value
	 * @param string $callback
	 * @return string|array
	 */
	public function transform( $input, callable $callback ) {
		if( is_array( $input ) ) {
			return $this->transform_array_leafs( $input, $callback );
		}
		return $this->call_func( $callback, $input );
	}

	/**
	 * Trigger a callback function
	 *
	 * @since 0.9.0
	 * @access private
	 *
	 * @param string|array $callback
	 * @param string (optional) $input The input string
	 * @return
	 */
	protected function call_func( $callback, $input = null ) {
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

	/**
	 * Transform the $array leafs, traversing infinite dimensions
	 *
	 * @since 0.9.0
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
}
