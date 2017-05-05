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

	protected $data = array();

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param
	 */
	function __construct( array $errors = [] ) {
		$this->data = $errors;
	}

	/**
	 *
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
	 *
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
