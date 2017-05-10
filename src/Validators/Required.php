<?php
namespace WFV\Validators;
defined( 'ABSPATH' ) or die();

use Respect\Validation\Validator as v;
use Respect\Validation\Rules;

class Required {

	/**
	 * The arrangment of rules
	 *
	 * @since 0.11.0
	 * @access private
	 * @var
	 */
	private $policy;

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param
	 */
	function __construct() {

		$this->policy = new Rules\AllOf(
			new Rules\NotOptional()
		);

	}

}
