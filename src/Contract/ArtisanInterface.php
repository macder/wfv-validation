<?php
namespace WFV\Contract;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.10.0
 *
 */
interface ArtisanInterface {

	/**
	 * @return
	 */
	public function create( $action, $adaptation );

	/**
	 * @return
	 */
	public function actualize();
}
