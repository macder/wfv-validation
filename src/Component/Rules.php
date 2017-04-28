<?php
namespace WFV\Component;
defined( 'ABSPATH' ) or die();

/**
 *
 *
 * @since 0.10.0
 */
class Rules {

	/**
	 * The array of rules for this instance
	 *
	 * @since 0.10.0
	 * @access private
	 * @var array
	 */
	protected $data = array();

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param array $rules
	 * @return
	 */
	public function __construct( $rules ) {
		$this->assign( $rules );
	}

	/**
	 * Check if rule is custom
	 *
	 * @since 0.7.0
	 *
	 * @param string $rule
	 * @return bool
	 */
	public function is_custom( $rule ) {
		// return ( false !== strpos( $rule, 'custom:' ) ) ? true: false;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param array $rules
	 * @return
	 */
	private function assign( $rules ) {
		foreach( $rules as $field => $ruleset ) {
			$this->data[ $field ] = $ruleset;
		}
	}
}
