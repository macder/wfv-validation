<?php
namespace WFV\Contract;
defined( 'ABSPATH' ) or die();


/**
 *
 *
 * @since 0.10.0
 *
 */
interface ValidateInterface {

	/**
	 * @return
	 */
	// public function constrain();

	/**
	 * @return array
	 */
	public function errors();

	/**
	 * @return bool
	 */
	public function validate();
}
