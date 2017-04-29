<?php
namespace WFV\Artisan;
defined( 'ABSPATH' ) or die( 'envois' );

use WFV\Contract\ArtisanInterface;

/**
 * Genesis
 *
 * @since 0.10.0
 *
 */
class Director {

  /**
   * Nature
   *
   * @since 0.10.0
   * @access protected
   * @var array
   */
  protected $aspect = array();

  /**
   * Identity
   *
   * @since 0.10.0
   * @access protected
   * @var string
   */
  protected $unique;

  /**
   * Chronicle
   *
   * @since 0.10.0
   * @access private
   * @var array
   */
  private $scribe = array();

  /**
   * Introduce
   *
   * @since 0.10.0
   *
   * @param string $identity
   */
  function __construct( $identity = null ) {
    $this->unique = $identity;
  }

  /**
   * Inscribe quality
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
   * Invoke new Creation.
   *
   * Bring into existence,
   *   entity from void.
   *
   * @since 0.10.0
   *
   * @param ArtisanInterface $artisan
   * @return Composite
   */
  public function compose( ArtisanInterface $artisan ) {
    $this->orchestrate( $this->aspect, $artisan );
    return $artisan
      ->create( $this->unique )
      ->actualize();
  }

  /**
   *
   *
   * @since 0.10.0
   *
   * @param string $quality
   * @param string|array (optional) $attributes
   * @return WFV\Artisan\Director
   */
  public function with( $quality, $attributes = null ) {
    $this->aspect[ $quality ] = $attributes;
    return $this;
  }

  /**
   *
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
