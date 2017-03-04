<?php defined( 'ABSPATH' ) or die();
/*
Plugin Name: Contact Form Endpoint
Plugin URI:  https://github.com/macder/wp-contact-form-endpoint
Description: Simple api endpoint to post data from a contact form. Intended for developers
Version:     0.0.1
Author:      Maciej Derulski
Author URI:  https://derulski.com
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

require "vendor/wixel/gump/gump.class.php";

/**
 * Summary.
 *
 * Description.
 *
 * @since 0.0.1
 */
class Contact_Form_Endpoint {

	/**
	 * Summary.
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var array $validation_rules Form validation rules.
	 */
	protected $validation_rules;

	/**
	 * Class constructor
	 *
	 * @since 0.0.1
	 *
	 */
	function __construct() {
		$this->add_actions();
	}

	/**
	 * creates the action hooks for contact form post
	 *
	 * @since 0.0.1
	 * @access private
	 */
	private function add_actions() {
		add_action( 'admin_post_nopriv_contact_form', array( $this, 'post_entry' ) );
		add_action( 'admin_post_contact_form', array( $this, 'post_entry' ) );
	}

	private function validation_rules() {

	}

	/**
	 * callback for contact_form post action
	 *
	 * prepares $_POST data for sanitation and validation
	 *
	 * @since 0.0.1
	 */
	public function post_entry() {
		// where the magic starts
	}

}

$Contact_Form_Endpoint = new Contact_Form_Endpoint();
