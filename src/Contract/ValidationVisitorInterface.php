<?php
namespace WFV\Contract;
defined( 'ABSPATH' ) or die();

use WFV\Component\InputCollection;
use WFV\Component\RuleCollection;

/**
 *
 *
 * @since 0.10.0
 *
 */
interface ValidationVisitorInterface {

	/**
	 * @return
	 */
	public function visit_input( InputCollection $input );

	/**
	 * @return
	 */
	public function visit_rules( RuleCollection $rules );
}
