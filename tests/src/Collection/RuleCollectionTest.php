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
			'name'      => 'required',
			'title'     => 'required',
			'phone'     => 'required',
			'email'     => 'required|email',
			'gender'    => 'required',
			'skills'    => 'required',
			'postal'    => 'required',
			'website'   => 'required',
			'msg'       => 'required'
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
	public function test_rules_() {

		// WIP -
		$this->assertTrue(true);
	}

}
