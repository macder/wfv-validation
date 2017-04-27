<?php
namespace WFV\Builder;
defined( 'ABSPATH' ) or die();

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
