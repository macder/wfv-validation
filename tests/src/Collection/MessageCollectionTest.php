<?php
namespace WFV\Collection;

use WFV\Collection\MessageCollection;

class MessageCollectionTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 *
	 * @access protected
	 * @var
	 */
	protected static $message_collection;

	/**
	 *
	 *
	 */
	protected function setUp() {

		$form_config = array(
		  'first_name' => [
		    'label' => 'First name',
		    'rules' => 'required',

		  ],
		  'email' => [
		    'label' => 'Email',
		    'rules' => 'required|email',
		    'messages' => [
		      'required' => 'No email? No soup for you!',
		      'email'    => 'Whoaaa, that is not an email',
		    ],
		  ],
		  'phone' => [
		    'label' => 'Phone',
		    'rules' => 'required_if:first_name,foobar',
		    'messages' => [
		      'required_if' => 'Since you are foobar, phone is required',
		    ],
		  ],
		);

		self::$message_collection = new MessageCollection( $form_config );

	}

	/**
	 *
	 *
	 */
	protected function tearDown() {
	}

	/**
	 * Does get_array() return an array of messages?
	 *
	 */
	public function test_messages_get_array_returns_array() {
		$expected = array(
			'email' => array(
        'required' => 'No email? No soup for you!',
        'email' => 'Whoaaa, that is not an email',
			),
			'phone' => array(
				'required_if' => 'Since you are foobar, phone is required'
			),
		);

		$result = self::$message_collection->get_array();
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does get_msg() return message when it exists?
	 *
	 */
	public function test_messages_get_msg_returns_message() {
		$expected = 'No email? No soup for you!';
		$result = self::$message_collection->get_msg('email', 'required');
		$this->assertEquals( $expected, $result );
	}

	/**
	 * Does get_msg() return null when it does not exist?
	 *
	 */
	public function test_messages_get_msg_returns_null() {
		$expected = null;
		$result = self::$message_collection->get_msg('phone', 'phone');
		$this->assertEquals( $expected, $result );
	}

}
