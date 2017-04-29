<?php
namespace WFV\Artisan;
defined( 'ABSPATH' ) or die();

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
	 * @access private
	 * @var array
	 */
	protected $aspect = array();

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var array
	 */
	protected $unique;

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var array
	 */
	private $scribe = array();

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $entity
	 */
	function __construct( $entity = null ) {
		$this->unique = $entity;
	}

	/**
	 * Inscribe attribute
	 *
	 * @since 0.10.0
	 *
	 * @param string $attribute
	 * @param mixed $characteristic
	 * @return WFV\Artisan\Director
	 */
	public function describe( $attribute, $characteristic ) {
		$this->scribe[ $attribute ] = $characteristic;
		return $this;
	}

	/**
	 * Invoke of Creation
	 * To bring into existence,
	 *   an entity from void
	 *
	 * @since 0.10.0
	 *
	 * @param ArtisanInterface $Artisan
	 * @return class
	 */
	public function compose( ArtisanInterface $artisan ) {
		$this->orchestrate( $this->aspect, $artisan );
		return $artisan
			->create( $this->unique )
			->actualize();
	}

	/**
	 * Encapsulate an attribute into the composite once invoked.
	 *
	 * @since 0.10.0
	 *
	 * @param string $attribute
	 * @param string|array (optional) $attributes
	 * @return WFV\Artisan\Director
	 */
	public function with( $aspect, $attributes = null ) {
		$this->aspect[ $aspect ] = $attributes;
		return $this;
	}

	/**
	 * Invokes Artisan methods to create entities
	 *	for the object under realization.
	 *
	 * @since 0.10.0
	 * @access private
	 *
	 * @param array $aspect
	 * @param ArtisanInterface $artisan
	 */
	private function orchestrate( array $aspect, ArtisanInterface &$artisan ) {
		foreach( $aspect as $attribute => $characteristic ) {
			$artisan->$attribute( $characteristic );
		}
	}
}
