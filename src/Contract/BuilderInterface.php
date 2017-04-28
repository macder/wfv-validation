<?php
namespace WFV\Contract;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.10.0
 *
 */
interface BuilderInterface {

	/**
	 * @return
	 */
	public function create( $action );

	/**
	 * @return
	 */
	public function deliver();
}
