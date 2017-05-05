<?php
namespace WFV\Contract;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.10.0
 *
 */
interface ValidationInterface {

	/**
	 * @return
	 */
	//public function add_message( $response );

	/**
	 * @return
	 */
	public function add_rule( $rule, $field );

	/**
	 * @return
	 */
	public function add_custom_rule( $rule );

	/**
	 * @return
	 */
	//public function validate();

}
