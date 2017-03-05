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
 * Summary.
 *
 * Description.
 *
 * @since 0.0.1
 */
class Form_Validation {

	/**
	 * Form name
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var array $form_name
	 */
	protected $form_name;

	/**
	 * Validation rules
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var array $rules Form validation rules.
	 */
	protected $rules;

	/**
	 *
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var
	 */
	public $errors;

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
	protected $sane_post;

	/**
	 * Class constructor
	 *
	 * @since 0.0.1
	 * @param string $form_name The name of the form for validation
	 * @param array $rules Validation rules
	 *
	 */
	function __construct($form, $rules) {
		$this->form_name = $form;
		$this->rules = $rules;

		$this->create_valitron();
		$this->add_actions();
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
		$this->valitron = new Valitron\Validator($_POST);
		$this->valitron->mapFieldsRules($this->rules);
	}

	/**
	 * Creates the action hooks for contact form post
	 *
	 * @since 0.0.1
	 * @access private
	 */
	private function add_actions() {
		add_action( 'admin_post_nopriv_'. $this->form_name .'_form', array( $this, 'validate' ) );
		add_action( 'admin_post_'. $this->form_name .'_form', array( $this, 'validate' ) );
	}

	/**
	 * Callback for post action
	 *
	 * Prepares $_POST data for sanitation and validation
	 *
	 * @since 0.0.1
	 */
	public function validate() {

		$this->valitron->validate();
		print_r($this->valitron);

	}

}
