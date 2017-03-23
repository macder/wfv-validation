<?php defined( 'ABSPATH' ) or die();

/**
 * Form_Validation validate a form
 *
 * Validates a form against an array of rules using Valitron
 *
 * @since 0.1.0
 */
class Form_Validation {

	/**
	 * Form identifier
	 *
	 * @since 0.1.0
	 * @access public
	 * @var array $action
	 */
	public $action;

	/**
	 * Validation rules
	 *
	 * @since 0.1.0
	 * @access public
	 * @var array $rules Form validation rules.
	 */
	public $rules;


	/**
	 * Class constructor
	 * check if action parameter matches sane $_POST action value
	 * init only if true
	 *
	 * @since 0.1.0
	 * @param string $action Action that identifies the form
	 * @param array $rules Validation rules
	 *
	 */
	function __construct($action, $rules) {
		$this->action = $action;
		$this->rules = $rules;
		$this->add_actions();
	}

	/**
	 * Creates unique action hooks for the form POST
	 *
	 * @since 0.1.0
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
	 * @since 0.1.0
	 * @access public
	 */
	public function validate() {
		// $this->result = new Form_Validate_Post( $this->rules );
		do_action(FORM_VALIDATION__ACTION_POST, $this->rules);
	}

}
