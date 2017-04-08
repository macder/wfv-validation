<?php defined( 'ABSPATH' ) or die();

/**
 *
 *
 *
 * @since 0.7.0
 */
class WFV_Messages {

  /**
   * _construct
   *
   * @param array $messages
   */
  function __construct( $messages ) {
    $this->set( $messages );
  }

  /**
   * Sets the messages as properties on this class
   *
   * @since 0.7.0
   * @param array $messages
   */
  protected function set( $messages ) {
    foreach($messages as $field => $message){
      $this->$field = $message;
    }
  }
}
