<?php
namespace WFV\Rules;

use \Respect\Validation\Validator as RespectValidator;

class RequiredTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Does required validation return true when input has some value?
	 *
	 */
	public function test_required_returns_true_when_input_not_empty() {
		$required = new Required( new RespectValidator() );
		$result = $required->validate('lorem ipsum');
		$this->assertTrue( $result );
	}

	/**
	 * Does required validation return false when input is blank?
	 *
	 */
	public function test_required_returns_false_when_input_is_empty() {
		$required = new Required( new RespectValidator() );
		$result = $required->validate('');
		$this->assertFalse( $result );
	}
}
