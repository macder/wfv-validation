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
	 * @return string
	 */
	public function first( $field ) {
		return $this->data[ $field ][0];
	}

	/**
	 * Populates the collection if it's empty with given errors
	 * Does nothing if collection is populated
	 *
	 * @since 0.10.0
	 *
	 * @param array $errors
	 * @return self
	 */
	public function set_errors( array $errors = [] ) {
		$this->data = ( $this->is_populated() ) ? $this->data : $errors;
		return $this;
	}
}
