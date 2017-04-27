<?php
namespace WFV\Builder;
defined( 'ABSPATH' ) or die();

class Director {

	/**
	 *
	 *
	 * @since 0.9.2
	 *
	 * @param
	 * @return
	 */
	public function build( BuilderInterface $builder ) {
		$builder->rules()
			->create();

		return $builder->result();
	}
}
