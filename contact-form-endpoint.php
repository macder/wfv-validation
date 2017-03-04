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


/**
 * Require GUMP for data validation and filtering
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
	 * @var array $rules Form validation rules.
	 */
	protected $rules;

	/**
	 * Class constructor
	 *
	 * @since 0.0.1
	 *
	 */
	function __construct() {
		$this->add_actions();
		$this->set_rules();
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

	/**
	 * sets $rules property
	 *
	 * @since 0.0.1
	 * @access private
	 */
	private function set_rules() {
		$this->rules = array(
		    'name' => 'required|alpha_numeric',
		    'email' => 'valid_email'
		);
	}

	/**
	 * callback for contact_form post action
	 *
	 * prepares $_POST data for sanitation and validation
	 *
	 * @since 0.0.1
	 */
	public function post_entry() {
		// 1. Sanitize input data
		// 2. Validate input data
		// 3. Format input data
	}

}

$Contact_Form_Endpoint = new Contact_Form_Endpoint();
