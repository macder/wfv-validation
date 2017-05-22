<?php
namespace WFV\Collection;

use WFV\Collection\ErrorCollection;

class ErrorCollectionTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $errors;

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $error_collection;

	/**
	 *
	 *
	 */
	protected function setUp() {
		$labels = array(
			'first_name' => 'First name',
			'email' => 'email'
		);

		self::$errors = array(
			'first_name' => array(
				'required' => '{label} is required',
				'alpha_dash' => '{label} can only contain alpha_dash'
			),
		);

		self::$error_collection = new ErrorCollection( $labels );
	}

	/**
	 *
	 *
	 */
	protected function tearDown() {
	}

	/**
	 * Does set_errors() populate the collection?
	 *
	 */
	public function test_errors_set_errors_populates() {
		self::$error_collection->set_errors( self::$errors );
		$result = self::$error_collection->is_populated();
		$this->assertTrue( $result );
	}

	/**
	 * Does first() return message when it exists?
	 *
	 */
	public function test_errors_first_return_message_with_label() {
		self::$error_collection->set_errors( self::$errors );
		$expected = 'First name is required';
		$result = self::$error_collection->first('first_name');
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does first() return null when it does not exist?
	 *
	 */
	public function test_errors_first_return_null() {
		self::$error_collection->set_errors( self::$errors );
		$expected = null;
		$result = self::$error_collection->first('email');
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does get() return array of errors for field when it exist?
	 *
	 */
	public function test_errors_get_return_array() {
		self::$error_collection->set_errors( self::$errors );
		$expected = array(
			'required' => 'First name is required',
			'alpha_dash' => 'First name can only contain alpha_dash'
		);
		$result = self::$error_collection->get('first_name');
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does get() return null when no errors on field?
	 *
	 */
	public function test_errors_get_return_null() {
		self::$error_collection->set_errors( self::$errors );
		$expected = null;
		$result = self::$error_collection->get('email');
		$this->assertEquals( $expected, $result );
	}
}
