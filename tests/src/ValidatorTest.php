<?php
namespace WFV;

use WFV\FormComposite;
use WFV\RuleFactory;
use WFV\Validator;
use WFV\Artisan\Director;
use WFV\Artisan\FormArtisan;
use WFV\Collection\MessageCollection;

class ValidatorTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $builder;

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $form;

	/**
	 *
	 *
	 * @access protected
	 * @var array
	 */
	protected static $http_post;

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $messages;

	/**
	 *
	 *
	 */
	protected function setUp() {
		$form = array(
		  'first_name' => [
		    'label' => 'First Name',
		    'rules' => 'required',
		  ],
		  'email' => [
		    'label' => 'Email',
		    'rules' => 'required|email',
		    'messages' => [
		      'required' => 'Custom required validation error msg',
		      'email'    => 'No email? No soup for you!',
		    ],
		  ],
		);

		self::$messages = new MessageCollection( $form );

		self::$http_post = array(
			'first_name' => 'Foo Bar',
			'email' => 'foo@bar.com',
			'action' => 'phpunit',
			'phpunit_token' => wp_create_nonce( 'phpunit' ),
		);

		$_REQUEST[ 'phpunit_token' ] = self::$http_post['phpunit_token'];


		self::$builder = new FormArtisan( $form, 'phpunit' );
		self::$form = ( new Director() )
			->with( 'rules' )
			->with( 'errors' );
	}

	/**
	 * Reset
	 *
	 */
	protected function tearDown() {
		$_POST = null;
		$_REQUEST = null;
		self::$form = null;
	}

	/**
	 * Does validate() return true when input valid?
	 *
	 */
	public function test_validator_returns_true() {
		$_POST = self::$http_post;

		$form = self::$form
			->with( 'input' )
			->compose( self::$builder );

		$result = ( new Validator( new RuleFactory(), self::$messages ) )->validate( $form );
		$this->assertTrue( $result );
	}

	/**
	 * Does validate() return false when input invalid?
	 *
	 */
	public function test_validator_returns_false() {
		$_POST = self::$http_post;
		$_POST['email'] = 'invalid email';

		$form = self::$form
			->with( 'input' )
			->compose( self::$builder );

		$result = ( new Validator( new RuleFactory(), self::$messages ) )->validate( $form );
		$this->assertFalse( $result );
	}
}
