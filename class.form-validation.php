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
	 * @access protected
	 * @var array $action
	 */
	protected $action;

	/**
	 * Validation rules
	 *
	 * @since 0.1.0
	 * @access protected
	 * @var array $rules Form validation rules.
	 */
	protected $rules;

	/**
	 * Instance of Valitron\Validator
	 *
	 * @since 0.1.0
	 * @access public
	 * @var class $valitron Valitron\Validator.
	 */
	public $valitron;

	/**
	 * Sanitized post data
	 *
	 * @since 0.1.0
	 * @access public
	 * @var array Sanitized $_POST
	 */
	public $sane_post = array();

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
	 * Sanitize input and keys in $_POST
	 * Assign the sanitized data to $sane_post property
	 *
	 *
	 * @since 0.1.0
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
	 * @since 0.1.0
	 * @access private
	 */
	private function create_valitron() {
		$this->valitron = new Valitron\Validator($this->sane_post);
		$this->valitron->mapFieldsRules($this->rules);
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
	 */
	public function validate() {
		/*$this->sanitize();
		$this->create_valitron();*/

		$validate = new Form_Validate_Post();

		// do_action('validate_'. $this->action, $this);
	}

}
