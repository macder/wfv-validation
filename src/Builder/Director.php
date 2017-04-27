<?php
namespace WFV\Builder;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.10.0
 *
 */
class Director {

	private $config = [];

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param BuilderInterface $builder
	 * @return class
	 */
	public function build( BuilderInterface $builder ) {
		foreach( $this->config['component'] as $entity => $attributes ) {
			$builder->$entity( $attributes );
		}
		$builder->create( $this->config['action'] );

		return $builder->deliver();
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $type
	 * @param string $attribute
	 * @return
	 */
	public function give_attribute( $type, $attribute ) {
		$this->config[ $type ] = $attribute ;
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $entity
	 * @param string|array $attributes
	 * @return
	 */
	public function with_entity( $entity, $attributes ) {
		$this->config['component'][$entity] = $attributes;
		return $this;
	}
}
