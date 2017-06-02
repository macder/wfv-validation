<?php
namespace WFV\Contract;
defined( 'ABSPATH' ) || die();

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
	public function create();

	/**
	 * @return
	 */
	public function actualize();
}
