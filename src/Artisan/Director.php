<?php
namespace WFV\Artisan;
defined( 'ABSPATH' ) || die();

use WFV\Contract\ArtisanInterface;

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
	 * @access protected
	 * @var array
	 */
	protected $component = array();

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param ArtisanInterface $builder
	 * @return object
	 */
	public function compose( ArtisanInterface $builder ) {
		$this->amalgamate( $this->component, $builder );
		return $builder
			->create()
			->actualize();
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $name
	 * @param string|array|object (optional) $params
	 * @return self
	 */
	public function with( $name, $params = null ) {
		$this->component[ $name ] = $params;
		return $this;
	}

	/**
	 * Amalgamate
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param array $components
	 * @param ArtisanInterface $builder
	 */
	private function amalgamate( array $components, ArtisanInterface &$builder ) {
		foreach( $components as $component => $params ) {
			$builder->$component( $params );
		}
	}
}
