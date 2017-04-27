<?php
namespace WFV\Builder;

use WFV\Builder\FormBuilder;
use WFV\Builder\Director;
use WFV\Component\Form;

class DirectorTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Instance of WFV\Builder\Director.
	 *
	 * @access protected
	 * @var WFV\Builder\Director $director
	 */
	protected static $director;

	/**
	 * Instantiate Director
	 *
	 */
	protected function setUp() {
		self::$director = new Director();
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$director = null;
	}

	/**
	 * Does give_attribute method return an instance of this director?
	 *
	 */
	public function testDirectorAttributeReturnSelfInstance() {
		$result = self::$director
			->attribute( 'phpunit', 'tested' );

		$this->assertInstanceOf( Director::class, $result );
	}

	/**
	 * Does with_entity method return an instance of this director?
	 *
	 */
	public function testDirectorInstallReturnSelfInstance() {
		$result = self::$director
			->install( 'phpunit', array('lorem', 'ipsum') );

		$this->assertInstanceOf( Director::class, $result );
	}

	/**
	 * When using FormBuilder, does invoke return an instance of Form?
	 *
	 */
	public function testDirectorInvokeReturnInstanceOfForm() {
		$builder = new FormBuilder();

		$result = self::$director
			->attribute( 'action', 'phpunit' )
			->invoke($builder);

		$this->assertInstanceOf( Form::class, $result );
	}
}
