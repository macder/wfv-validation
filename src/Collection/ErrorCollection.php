<?php
namespace WFV\Collection;
defined( 'ABSPATH' ) or die();

use WFV\Abstraction\Collectable;

/**
 *
 *
 * @since 0.10.0
 */
class ErrorCollection extends Collectable {

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param array $errors
	 */
	function __construct( array $errors = [] ) {
		$this->data = $errors;
	}

	/**
	 * Returns the first error message for a field
	 *
	 * @since 0.10.0
	 *
	 * @param string $field
	 * @return string|null
	 */
	public function first( $field ) {
		return ( $this->data[ $field ] )
			? array_values( $this->data[ $field ] )[0]
			: null;
	}

	/**
	 * Populates the collection if it's empty with given errors
	 * Does nothing if collection is populated
	 *
	 * @since 0.10.0
	 *
	 * @param array $errors
	 */
	public function set_errors( array $errors = [] ) {
		$this->data = ( $this->is_populated() ) ? $this->data : $errors;
	}
}
