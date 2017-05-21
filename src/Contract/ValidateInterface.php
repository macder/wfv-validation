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
	 * @return bool
	 */
	public function validate( $input = null, $optional = false );
}
