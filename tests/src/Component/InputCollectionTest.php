<?php
namespace WFV\Component;

use WFV\Component\InputCollection;

class InputCollectionTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $http_post;

	/**
	 *
	 *
	 */
  protected function setUp() {
    self::$http_post = array(
      'action' => 'phpunit',
      'name' => 'Foo Bar',
      'email' => 'foo@bar.com',
    );
	}

	/**
	 *
	 *
	 */
	protected function tearDown() {
		self::$http_post = null;
		$_POST = null;
	}
}
