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
				'premium' => array(
					'platinum',
					'gold',
					'silver',
					'<script>alert("xss pwned?!~");</script>',
				),
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
		$collection = self::$collection;

		$result = $collection->has('name');
		$this->assertTrue( $result );
	}

	/**
	 * has() returns false when key is NOT in $data property
	 *
	 */
	public function test_collection_has_returns_false() {
		$collection = self::$collection;

		$result = $collection->has( 'this_key_is_not_there' );
		$this->assertFalse( $result);
	}

	/**
	 * has() returns false when key is null
	 *
	 */
	public function test_collection_has_returns_false_when_key_null() {
		$collection = self::$collection;
		$result = $collection->has(null);

		$this->assertFalse( $result );
	}

	/**
	 * contains() returns true when key value is a string that matches
	 *
	 */
	public function test_collection_contains_returns_true_when_string() {
		$collection = self::$collection;

		$result = $collection->contains( 'email', 'foo@bar.com' );
		$this->assertTrue( $result );
	}

	/**
	 * contains() returns true when key value is an array, and the string is in array
	 *
	 */
	public function test_collection_contains_returns_true_when_array() {
		$collection = self::$collection;

		$result = $collection->contains( 'color', 'green' );
		$this->assertTrue( $result );
	}

	/**
	 * contains() returns false when string NOT there
	 *
	 */
	public function test_collection_contains_returns_false_when_string() {
		$collection = self::$collection;

		$result = $collection->contains( 'email', 'im_not_there' );
		$this->assertFalse( $result );
	}

	/**
	 * contains() returns false when key value is an array, and string is not there
	 *
	 */
	public function test_collection_contains_returns_false_when_array() {
		$collection = self::$collection;

		$result = $collection->contains( 'color', 'im_not_there' );
		$this->assertFalse( $result );
	}

	/**
	 * contains() returns false when $key is empty string
	 *
	 */
	public function test_collection_contains_returns_false_when_key_is_empty_string() {
		$collection = self::$collection;

		$result = $collection->contains( '', 'im_not_there' );
		$this->assertFalse( $result );
	}

	/**
	 * contains() returns false when $key is not there
	 *
	 */
	public function test_collection_contains_returns_false_when_key_is_not_there() {
		$collection = self::$collection;

		$result = $collection->contains( 'im_not_there', 'red' );
		$this->assertFalse( $result );
	}

	/**
	 * contains() returns false when $key is null
	 *
	 */
	public function test_collection_contains_returns_false_when_key_is_null() {
		$collection = self::$collection;

		$result = $collection->contains( null, 'red' );
		$this->assertFalse( $result );
	}

	/**
	 * contains() returns false when $key rxists but $value null
	 *
	 */
	public function test_collection_contains_returns_false_when_key_exists_but_value_null() {
		$collection = self::$collection;

		$result = $collection->contains( 'color', null );
		$this->assertFalse( $result );
	}

	/**
	 * contains() returns false when $key and $value null
	 *
	 */
	public function test_collection_contains_returns_false_when_key_value_nulls() {
		$collection = self::$collection;

		$result = $collection->contains( null, null );
		$this->assertFalse( $result );
	}

	/**
	 * is_populated() returns true
	 *
	 */
	public function test_collection_is_populated_returns_true() {
		$collection = self::$collection;

		$result = $collection->is_populated();
		$this->assertTrue( $result );
	}

	/**
	 * is_populated() returns false when $data is empty array
	 *
	 */
	public function test_collection_is_populated_returns_false() {
		$collection = new Collection( $data = array() );

		$result = $collection->is_populated();
		$this->assertFalse( $result );
	}

	/**
	 * escape() returns escaped html
	 *
	 */
	public function test_collection_escape_default_returns_encoded_string() {
		$expected = esc_html( self::$data['html_input'] );
		$result = self::$collection->escape('html_input');

		// $result = ( $expected === $result ) ? true : false;

		$this->assertEquals( $expected, $result );
	}

	/**
	 * escape() returns encoded string from a callable
	 *
	 */
	public function test_collection_escape_returns_encoded_string_from_callable() {
		$expected = strip_tags( self::$data['html_input'] );
		$result = self::$collection->escape('html_input', 'strip_tags');

		$this->assertEquals( $expected, $result );
	}

	/**
	 * escape() returns result from closure
	 *
	 */
	public function test_collection_escape_returns_string_from_closure() {
		$expected = 'phpunit';
		$result = self::$collection->escape('name', function( $input ) {
			return 'phpunit';
		});

		$this->assertEquals( $expected, $result );
	}

	/**
	 * escape() returns null when key is not found
	 *
	 */
	public function test_collection_escape_returns_null_when_key_not_there() {
		$expected = null;
		$result = self::$collection->escape('im_not_there');

		$this->assertEquals( $expected, $result );
	}

	/**
	 * transform() returns nested array with all leafs as result from callable
	 *
	 */
	/*public function test_collection_transform_returns_nested_array_transformed() {
		$expected = self::$data['color'];
		array_walk_recursive( $expected, function( &$item, $key ) {
			$item = strip_tags( $item );
		});

		$result = self::$collection->transform( 'color', 'strip_tags' );
		$this->assertEquals( $expected, $result );
	}*/

	/**
	 * transform() returns
	 *
	 */
	/*public function test_collection_transform() {
		$expected = self::$data;
		array_walk_recursive( $expected, function( &$item, $key ) {
			$item = strip_tags( $item );
		});

		$result = self::$collection->transform( false, 'strip_tags' );

		$this->assertEquals( $expected, $result );
	}*/
}
