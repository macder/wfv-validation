<?php
namespace WFV\Builder;
defined( 'ABSPATH' ) or die();

use WFV\Contract\BuilderInterface;

/**
 *
 *
 * @since 0.10.0
 *
 */
class Director {

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var array
	 */
	private $config = array();

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var array
	 */
	private $components = array();

	/**
	 * Give an attribute
	 *
	 * @since 0.10.0
	 *
	 * @param string $type
	 * @param string $attribute
	 * @return WFV\Builder\Director
	 */
	public function attribute( $type, $attribute ) {
		$this->config[ $type ] = $attribute;
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param BuilderInterface $builder
	 * @return class
	 */
	public function invoke( BuilderInterface $builder ) {
		$this->integrate( $this->components, $builder );

		return $builder
			->create( $this->config['action'] )
			->deliver();
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
