<?php
namespace WFV\Builder;
defined( 'ABSPATH' ) or die();

class Director{

	public function build( BuilderInterface $builder ) {

		$builder->create();
		$builder->add_action();
		$builder->add_rules();

		return $builder->get_validation();

	}
}