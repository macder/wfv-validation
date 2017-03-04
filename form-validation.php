<?php defined( 'ABSPATH' ) or die();
/*
Plugin Name: Form Validation
Plugin URI:  https://github.com/macder/wp-form-validation
Description: TBD
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
class Form_Validation {

	/**
	 * Validation rules
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var array $rules Form validation rules.
	 */
	protected $rules;

	/**
	 * Instance of GUMP class
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var class $gump Instance of GUMP.
	 */
	protected $gump;

	/**
	 * Sanitized post data
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var array Sanitized $_POST
	 */
	protected $sane_post;

	/**
	 * Class constructor
	 *
	 * @since 0.0.1
	 *
	 */
	function __construct() {
		$this->create_gimp();
		$this->add_actions();
		$this->set_rules();
	}

	/**
	 * Create an instance of GUMP and assign it to $gump property
	 *
	 *
	 * @since 0.0.1
	 * @access private
	 */
	private function create_gimp() {
		$this->gump = new GUMP();
	}

	/**
	 * Creates the action hooks for contact form post
	 *
	 * @since 0.0.1
	 * @access private
	 */
	private function add_actions() {
		add_action( 'admin_post_nopriv_contact_form', array( $this, 'post_entry' ) );
		add_action( 'admin_post_contact_form', array( $this, 'post_entry' ) );
	}

	/**
	 * Sets the $rules property
	 *
	 * @since 0.0.1
	 * @access private
	 */
	private function set_rules() {
		$this->rules = array(
		    'name' => 'required|alpha_numeric',
		    'email' => 'required|valid_email'
		);
	}

	/**
	 *
	 * Sanitize the post data and assign to $sane_post property
	 *
	 * @since 0.0.1
	 * @access private
	 */
	private function sanitize() {
		$this->sane_post = $this->gump->sanitize( $_POST );
	}

	/**
	 * Callback for contact_form post action
	 *
	 * Prepares $_POST data for sanitation and validation
	 *
	 * @since 0.0.1
	 */
	public function post_entry() {
		$gump = $this->gump;

		// sanitize post data - just in case WordPress doesn't
		$this->sanitize();

		$gump->validation_rules( $this->rules );

		// $this->$gump->filter_rules();

		$valid_data = $gump->run( $this->sane_post );

		if( $valid_data === false ) {
		    echo $gump->get_readable_errors( true );
		} else {
		    print_r( $valid_data ); // validation successful
		}
	}

}

$Form_Validation = new Form_Validation();
