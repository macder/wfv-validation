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
require "vendor/vlucas/valitron/src/Valitron/Validator.php";

/**
 * Form_Validation validate a form
 *
 * Validates a form against an array of rules using Valitron
 *
 * @since 0.0.1
 */
class Form_Validation {

	/**
	 * Form identifier
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var array $action
	 */
	protected $action;

	/**
	 * Validation rules
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var array $rules Form validation rules.
	 */
	protected $rules;

	/**
	 * Instance of Valitron\Validator
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var class $valitron Valitron\Validator.
	 */
	protected $valitron;

	/**
	 * Sanitized post data
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var array Sanitized $_POST
	 */
	protected $sane_post = array();

	/**
	 * Class constructor
	 * check if action parameter matches sane $_POST action value
	 * init only if true
	 *
	 * @since 0.0.1
	 * @param string $action Action that identifies the form
	 * @param array $rules Validation rules
	 *
	 */
	function __construct($action, $rules) {
		$sane_action = sanitize_text_field( $_POST['action'] );

		if ($sane_action == $action) {
			$this->action = $sane_action;
			$this->rules = $rules;
			$this->add_actions();
		}
	}

	/**
	 * Sanitize input and keys in $_POST
	 * Assign the sanitized data to $sane_post property
	 *
	 *
	 * @since 0.0.1
	 * @access private
	 */
	private function sanitize() {
		foreach ( $_POST as $key => $value ) {
			$this->sane_post[sanitize_key($key)] = sanitize_text_field($value);
		}
	}

	/**
	 * Create an instance of Valitron\Validator, assign to $valitron property
	 * Map $rules property Valitron
	 *
	 *
	 * @since 0.0.1
	 * @access private
	 */
	private function create_valitron() {
		$this->valitron = new Valitron\Validator($this->sane_post);
		$this->valitron->mapFieldsRules($this->rules);
	}

	/**
	 * Creates the action hooks for contact form post
	 *
	 * @since 0.0.1
	 * @access private
	 */
	private function add_actions() {
		add_action( 'admin_post_nopriv_'. $this->action, array( $this, 'validate' ) );
		add_action( 'admin_post_'. $this->action, array( $this, 'validate' ) );
	}

	/**
	 * Callback for post action
	 *
	 * Prepares $_POST data for sanitation and validation
	 *
	 * @since 0.0.1
	 */
	public function validate() {
		$this->sanitize();
		$this->create_valitron();

		$this->valitron->validate();
		do_action('validate_'. $this->action, $this);
	}

}
