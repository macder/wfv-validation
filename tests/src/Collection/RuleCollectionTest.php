<?php
namespace WFV\Collection;

use WFV\Collection\RuleCollection;

class RuleCollectionTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $rule_collection;

	/**
	 *
	 *
	 */
	protected function setUp() {
		$rules = array(
			'single'    => 'required',
			'double'    => 'required|email',
			'params'    => 'required_if:field,value',
			'optional'  => 'optional|alpha'
		);

		self::$rule_collection = new RuleCollection( $rules );
	}


	/**
	 * Do multiple rules from config string split into an array?
	 *
	 */
	public function test_rules_splits_ruleset_from_string() {
		$expected = array(
			'required', 'email'
		);
		$rule_array = self::$rule_collection->get_array();
		$result = $rule_array['double'];

		$this->assertEquals( $expected, $result );
	}

	/**
	 * Do rules with parameters get split into array?
	 *
	 */
	public function test_rules_splits_ruleset_with_params_from_string() {
		$expected = array(
			array(
				'rule' => 'required_if',
				'params' => array(
					'field', 'value'
				)
			)
		);

		$rule_array = self::$rule_collection->get_array();
		$result = $rule_array['params'];
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does unique() return flat index array of unique rule types?
	 *
	 */
	public function test_rules_unique_return_flat_array_unique_types() {
		$expected = array(
			'required', 'email', 'required_if', 'alpha'
		);

		$result = self::$rule_collection->unique();
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does get_array(true) return a flat array without params?
	 *
	 */
	public function test_rules_get_array_returns_flat() {
		$expected = array(
			'single' => ['required'],
			'double' => ['required', 'email'],
			'params' => ['required_if'],
			'optional' => [ 1=> 'alpha']
		);
		$result = self::$rule_collection->get_array(true);
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does get_params() return array param?
	 *
	 */
	public function test_rules_get_params_return_array_param_for_field_rule() {
		$expected = array(
			'field', 'value'
		);
		$result = self::$rule_collection->get_params('params', 0);
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does is_optional() return true?
	 *
	 */
	public function test_rules_is_optional_return_true() {
		$result = self::$rule_collection->is_optional('optional');
		$this->assertTrue( $result );
	}

	/**
	 * Does is_optional() return false?
	 *
	 */
	public function test_rules_is_optional_return_false() {
		$result = self::$rule_collection->is_optional('double');
		$this->assertFalse( $result );
	}

}
