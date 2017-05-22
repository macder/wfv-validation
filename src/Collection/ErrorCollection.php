<?php
namespace WFV\Collection;
defined( 'ABSPATH' ) || die();

use WFV\Abstraction\Collectable;

/**
 *
 *
 * @since 0.10.0
 */
class ErrorCollection extends Collectable {

	/**
	 * Human friendly labels for the fields
	 *
	 * @since 0.11.0
	 * @var array
	 */
	protected $labels = array();

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param array $labels Human friendly labels for the fields
	 */
	function __construct( array $labels = [] ) {
		$this->labels = $labels;
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
		return ( isset( $this->data[ $field ] ) )
			? array_values( $this->data[ $field ] )[0]
			: null;
	}

	/**
	 * Returns all errors for given field
	 *
	 * @since 0.11.0
	 *
	 * @param string $field
	 * @return array|null
	 */
	public function get( $field ) {
		return ( isset( $this->data[ $field ] ) )
			? $this->data[ $field ]
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
		$this->data = ( $this->is_populated() )
			? $this->data
			: $this->with_labels( $errors );
	}

	/**
	 * Return the defined label for a field
	 * If label is undefined, returns field name
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param string $field
	 * @return string
	 */
	protected function label( $field ) {
		return ( isset( $this->labels[ $field ] ) )
			? $this->labels[ $field ]
			: $field;
	}

	/**
	 * Replaces {label} in error msg strings with a field label
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @param array $errors
	 * @return array
	 */
	protected function with_labels( $errors ) {
		$labeled = array();
		foreach( $errors as $field => $messages ) {
			$label = $this->label( $field );
			$labeled[ $field ] = str_replace( '{label}', $label, $errors[ $field ] );
		}
		return $labeled;
	}
}
