<?php
namespace WFV\Abstraction;
defined( 'ABSPATH' ) or die();

use WFV\Contract\AdmissionInterface;

/**
 *
 *
 * @since 0.10.0
 */
abstract class Admission implements AdmissionInterface {

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var array
	 */
	protected $component;

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access protected
	 *
	 * @param string $key
	 * @param class $entity
	 */
	protected function confine( $attribute, $composition ) {
		$this->component[ $attribute ] = $composition;
	}

	/**
	 * Assign group of entities.
	 *
	 * @since 0.10.0
	 * @access protected
	 *
	 * @param array $components
	 */
	protected function congregate( array $attributes ) {
		foreach( $attributes as $attribute => $composition ) {
			$this->confine( $attribute, $composition );
		}
	}
}
