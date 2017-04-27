<?php
namespace WFV\Component;

use WFV\Component\Form;

class FormTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 */
	protected function setUp() {
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
		$form = array(
		  'rules'   => array(
		    'name'      => ['required'],
		  ),
		  'messages' => [
		    'name' => array(
		      'required' => 'Cause reasons'
		    )
		  ]
		);

		$result = new Form('phpunit', $form);
		$this->assertInstanceOf( Form::class, $result );
	}
}
