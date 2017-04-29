<?php
namespace WFV\Artisan;

use WFV\Artisan\Director;
use WFV\Artisan\FormArtisan;
# use WFV\Component\Guard;
use WFV\Component\Form;

class DirectorTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Instance of WFV\Artisan\Director.
	 *
	 * @access protected
	 * @var WFV\Artisan\Director $director
	 */
	protected static $director;

	/**
	 * Instantiate Director
	 *
	 */
	protected function setUp() {
		self::$director = new Director( 'entity' );
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		self::$director = null;
	}

	/**
	 * Does describe method return an instance of this director?
	 *
	 */
	public function test_director_describe_return_self_instance() {
		$result = self::$director
			->describe( 'phpunit', 'tested' );
		$this->assertInstanceOf( 'WFV\Artisan\Director', $result );
	}

	/**
	 * Does with method return an instance of this director?
	 *
	 */
	public function test_director_with_return_self_instance() {
		$result = self::$director
			->with( 'phpunit', array('lorem', 'ipsum') );
		$this->assertInstanceOf( 'WFV\Artisan\Director', $result );
	}

	/**
	 * When using FormArtisan, does compose return an instance of Form?
	 *
	 */
	public function test_director_compose_return_instance_of_form() {
		$artisan = new FormArtisan();
		$result = self::$director
			->compose( $artisan );
		$this->assertInstanceOf( 'WFV\Component\Form', $result );
	}

	/**
	 * When using GuardArtisan, does compose return an instance of Guard?
	 *
	 */
	public function test_director_compose_return_instance_of_guard() {
		$artisan = new GuardArtisan();
		$result = self::$director
			->compose( $artisan );
		$this->assertInstanceOf( 'WFV\Component\Guard', $result );
	}
}
