<?php
namespace WFV\Contract;
defined( 'ABSPATH' ) || die();


/**
 *
 *
 * @since 0.11.0
 *
 */
interface FormInterface {

	/**
	 * @return
	 */
	public function checked_if( $field = null, $value = null );

	/**
	 * @return
	 */
	public function display( $field = null, callable $callback = null );

	/**
	 * @return
	 */
	public function errors();

	/**
	 * @return
	 */
	public function input();

	/**
	 * @return
	 */
	public function rules();

	/**
	 * @return
	 */
	public function selected_if( $field = null, $value = null );

	/**
	 * @return
	 */
	public function token_fields();

	/**
	 * @return
	 */
	public function is_valid( $factory );

}
