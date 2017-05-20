<?php
namespace WFV\Contract;
defined( 'ABSPATH' ) || die();


/**
 *
 *
 * @since 0.11.0
 *
 */
interface ValidateInterface {

	/**
	 * @return array
	 */
	public function error_msg();

	/**
	 * @return string
	 */
	public function field_name();

	/**
	 * @return array
	 */
	public function template();

	/**
	 * @return bool
	 */
	public function validate( $input );
}
