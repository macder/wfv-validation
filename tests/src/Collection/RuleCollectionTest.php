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
	protected static $rules;

	/**
	 *
	 *
	 */
	protected function setUp() {
		self::$rules = array(
			'name'      => ['required'],
			'title'     => ['required'],
			'phone'     => ['required', 'custom:phone'],
			'email'     => ['required', 'email'],
			'gender'    => ['required'],
			'skills'    => ['required'],
			'postal'    => ['custom:postal_code'],
			'website'   => ['required', 'url'],
			'msg'       => ['required']
		);
	}

	/**
	 *
	 *
	 */
	protected function tearDown() {
	}

	/**
	 *
	 *
	 */
	public function test_rules_is_instance_when_null_parameter() {
		$expected = 'WFV\Collection\RuleCollection';
		$result = new RuleCollection();

		$this->assertInstanceOf( $expected, $result );
	}

}
