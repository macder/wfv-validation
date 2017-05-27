<?php
namespace WFV\Collection;
defined( 'ABSPATH' ) || die();

use WFV\Abstraction\Collectable;
use WFV\Agent\InspectionAgent;

/**
 *
 *
 * @since 0.10.0
 */
class InputCollection extends Collectable {

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access private
	 * @var InspectionAgent
	 */
	private $guard;

	/**
	 * __construct
	 *
	 * @since 0.10.0
	 *
	 * @param array $data
	 * @param bool $trim
	 */
	public function __construct( InspectionAgent $guard, $trim = true ) {
		$this->guard = $guard;
		$this->populate( $trim );
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param bool $tokens With or without token and action attributes.
	 * @return array
	 */
	public function get_array( $tokens = true ) {
		return ( $tokens ) ? $this->data : $this->neat_array();
	}

	/**
	 * Returns input array with out token and action attributes
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @return array
	 */
	protected function neat_array() {
		$input = $this->data;
		unset( $input[ $input['action'] .'_token'] );
		unset( $input['action'] );
		return $input;
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 */
	protected function populate( $trim ) {
		if( $this->guard->safe_submit() ) {
			$data = $this->transform_array_leafs( $_POST, 'stripslashes' );

			$this->data = ( $trim )
				? $this->transform_array_leafs( $data, 'trim' )
				: $data;
		}
	}
}
