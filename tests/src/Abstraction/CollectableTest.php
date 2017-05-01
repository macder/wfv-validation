<?php
namespace WFV\Abstraction;

use WFV\Abstraction\Collectable;

class Collection extends Collectable {

	function __construct( $data ) {
		$this->data = $data;
	}

}

class CollectableTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $collection;

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $data;

	/**
	 *
	 *
	 */
	protected function setUp() {

		self::$data = array(
			'action' => 'phpunit',
			'name' => 'Foo Bar',
			'email' => 'foo@bar.com',
			'shades' => array(
				'lightest',
				'light',
				'dark',
				'darkest',
			),
			'color' => array(
				'red',
				'green',
				'blue',
			),
			'html_input' => '<h1>Im a H1</h1><p>This is a paragraph</p>'
		);

		self::$collection = new Collection( self::$data );

		// print_r(self::$collection);
	}

	/**
	 *
	 *
	 */
	protected function tearDown() {

	}

	/**
	 * has() returns true when key exists in $data property
	 *
	 */
	public function test_collection_has_returns_true() {
		$result = self::$collection->has( 'name' );
		$this->assertTrue( $result );
	}

	/**
	 * has() returns false when key is NOT in $data property
	 *
	 */
	public function test_collection_has_returns_false() {
		$result = self::$collection->has( 'this_key_is_not_there' );
		$this->assertFalse( $result );
	}

	/**
	 * has() returns false when key is null
	 *
	 */
	public function test_collection_has_returns_false_when_key_null() {
		$result = self::$collection->has( null );
		$this->assertFalse( $result );
	}

	/**
	 * contains() returns true when key value is a string that matches
	 *
	 */
	public function test_collection_contains_returns_true_when_string() {
		$result = self::$collection->contains( 'email', 'foo@bar.com' );
		$this->assertTrue( $result );
	}

	/**
	 * contains() returns true when key value is an array, and the string is in array
	 *
	 */
	public function test_collection_contains_returns_true_when_array() {
		$result = self::$collection->contains( 'color', 'green' );
		$this->assertTrue( $result );
	}

	/**
	 * contains() returns false when string NOT there
	 *
	 */
	public function test_collection_contains_returns_false_when_string() {
		$result = self::$collection->contains( 'email', 'im_not_there' );
		$this->assertFalse( $result );
	}

	/**
	 * contains() returns false when key value is an array, and string is not there
	 *
	 */
	public function test_collection_contains_returns_false_when_array() {
		$result = self::$collection->contains( 'color', 'im_not_there' );
		$this->assertFalse( $result );
	}

	/**
	 * contains() returns false when $key is empty string
	 *
	 */
	public function test_collection_contains_returns_false_when_key_is_empty_string() {
		$result = self::$collection->contains( '', 'im_not_there' );
		$this->assertFalse( $result );
	}

	/**
	 * contains() returns false when $key is not there
	 *
	 */
	public function test_collection_contains_returns_false_when_key_is_not_there() {
		$result = self::$collection->contains( 'im_not_there', 'red' );
		$this->assertFalse( $result );
	}

	/**
	 * contains() returns false when $key is null
	 *
	 */
	public function test_collection_contains_returns_false_when_key_is_null() {
		$result = self::$collection->contains( null, 'red' );
		$this->assertFalse( $result );
	}

	/**
	 * contains() returns false when $key rxists but $value null
	 *
	 */
	public function test_collection_contains_returns_false_when_key_exists_but_value_null() {
		$result = self::$collection->contains( 'color', null );
		$this->assertFalse( $result );
	}

	/**
	 * contains() returns false when $key and $value null
	 *
	 */
	public function test_collection_contains_returns_false_when_key_value_nulls() {
		$result = self::$collection->contains( null, null );
		$this->assertFalse( $result );
	}

	/**
	 * is_populated() returns true
	 *
	 */
	public function test_collection_is_populated_returns_true() {
		$result = self::$collection->is_populated();
		$this->assertTrue( $result );
	}

	/**
	 * is_populated() returns false when $data is empty array
	 *
	 */
	public function test_collection_is_populated_returns_false() {
		$result = new Collection( $data = array() );
		$this->assertFalse( $result->is_populated() );
	}

	/**
	 * render() returns escaped html
	 *
	 */
	public function test_collection_render_default_returns_encoded_string() {
		$expected = esc_html( self::$data['html_input'] );
		$result = self::$collection->render('html_input');

		// $result = ( $expected === $result ) ? true : false;

		$this->assertEquals( $expected, $result );
	}

	/**
	 * render() returns encoded string from a callable
	 *
	 */
	public function test_collection_render_returns_encoded_string_from_callable() {
		$expected = strip_tags( self::$data['html_input'] );
		$result = self::$collection->render('html_input', 'strip_tags');

		$this->assertEquals( $expected, $result );
	}

	/**
	 * render() returns result from closure
	 *
	 */
	public function test_collection_render_returns_string_from_closure() {
		$expected = 'phpunit';
		$result = self::$collection->render('name', function( $input ) {
			return 'phpunit';
		});

		$this->assertEquals( $expected, $result );
	}

	/**
	 * render() returns null when key is not found
	 *
	 */
	public function test_collection_render_returns_null_when_key_not_there() {
		$expected = null;
		$result = self::$collection->render('im_not_there');

		$this->assertEquals( $expected, $result );
	}
}
