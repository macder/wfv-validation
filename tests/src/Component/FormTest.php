<?php
namespace WFV\Component;

use WFV\Builder\Director;
use WFV\Builder\FormBuilder;
use WFV\Component\Form;

class FormTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $action;

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $rules = array();

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $fake_http_post = array();

	/**
	 *
	 *
	 * @access protected
	 * @var array
	 */
	protected static $config;

	/**
	 *
	 *
	 */
	protected function setUp() {
		self::$config = array(
		  'rules'  => array(
		    'fname' => ['required', 'custom:phone'],
		    'email'=> ['required', 'email'],
		  ),

		  'messages' => [
		    'email' => array(
		      'required' => 'Your email is required so we can reply back'
		    ),
		  ]
		);
	}

	/**
	 *
	 *
	 */
	protected function tearDown() {
	}

	/**
	 * Does Form instantiation with no component parameter produce instance of Form?
	 *
	 */
	public function testFormInstantiateWithNoComponentsMakesInstanceOfForm() {
		$result = new Form('phpunit');
		$this->assertInstanceOf( Form::class, $result );
	}

	/**
	 * Does Form instantiation with components produce instance of Form?
	 *
	 */
	public function testFormInstantiateWithComponentsMakesInstanceOfForm() {
		$result = new Form('phpunit', self::$config );
		$this->assertInstanceOf( Form::class, $result );
	}
}
