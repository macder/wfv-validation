<?php
namespace WFV\Builder;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.10.0
 *
 */
interface BuilderInterface {

	/**
	 * @return mixed
	 */
	public function create( $action );

	/**
	 * @return mixed
	 */
	public function deliver();
}
