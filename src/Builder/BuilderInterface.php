<?php
namespace WFV\Builder;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.9.2
 *
 */
interface BuilderInterface {

	/**
	 * @return mixed
	 */
	public function create();

	/**
	 * @return mixed
	 */
	public function result();
}
