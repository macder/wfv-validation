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
		);

		self::$rule_collection = new RuleCollection( $rules );
	}

	/**
	 *
	 *
	 */
	public function test_rules_is_instance() {
		$expected = 'WFV\Collection\RuleCollection';
		$result = self::$rule_collection;

		$this->assertInstanceOf( $expected, $result );
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

}
