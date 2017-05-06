<?php
namespace WFV\Contract;
defined( 'ABSPATH' ) or die();

use WFV\Collection\MessageCollection;
use WFV\Collection\RuleCollection;

/**
 *
 *
 * @since 0.10.0
 *
 */
interface ValidationInterface {

	/**
	 * @return
	 */
	public function constrain( RuleCollection $rules, MessageCollection $messages );

	/**
	 * @return array
	 */
	public function errors();

	/**
	 * @return bool
	 */
	public function validate();
}
