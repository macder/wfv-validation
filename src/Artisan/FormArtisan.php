<?php
namespace WFV\Artisan;
defined( 'ABSPATH' ) or die();

use \Respect\Validation\Validator as RespectValidator;

use WFV\Contract\ArtisanInterface;
use WFV\Collection\ErrorCollection;
use WFV\Collection\InputCollection;
use WFV\Collection\RuleCollection;

use WFV\FormComposite;
use WFV\Validators;
use WFV\Validator;

/**
 *
 *
 * @since 0.10.0
 */
class FormArtisan implements ArtisanInterface {

	/**
	 *
	 *
	 * @since 0.10.0
	 * @var array
	 */
	public $collection = array();

	/**
	 *
	 *
	 * @since 0.11.0
	 * @var array
	 */
	public $strategies = array();

	/**
	 *
	 *
	 * @since 0.11.0
	 * @var WFV\Validator
	 */
	public $validator;

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access protected
	 * @var array
	 */
	protected $config = array();

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access protected
	 * @var WFV\FormComposite
	 */
	protected $form;

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param array $config
	 */
	function __construct( array $config ) {
		$this->config = $config;
	}

	/**
	 * Return the final Form instance
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\FormComposite
	 */
	public function actualize() {
		return $this->form;
	}

	/**
	 * Creates the instance of FormComposite
	 *
	 * @since 0.10.0
	 *
	 * @param string $action
	 * @return WFV\Artisan\FormArtisan
	 */
	public function create( $action ) {
		$this->form = new FormComposite( $this, $action );
		return $this;
	}

	/**
	 * Create instance of ErrorCollection
	 * Save it in $collection array property
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Artisan\FormArtisan
	 */
	public function errors() {
		$this->collection['errors'] = new ErrorCollection( $this->labels() );
		return $this;
	}

	/**
	 * Returns an array of human friendly field labels
	 *  as defined in the config array
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 * @return array
	 */
	protected function labels() {
		return array_map( function( $item ) {
			return $item['label'];
		}, $this->config);
	}

	/**
	 * Create instance of InputCollection
	 * Save it in $collection array property
	 *
	 * @since 0.10.0
	 *
	 * @param array $data
	 * @return WFV\Artisan\FormArtisan
	 */
	public function input( array $data = [] ) {
		$input = $data[0];
		$trim = $data[1];
		$this->collection['input'] = new InputCollection( $input, $trim );
		return $this;
	}

	/**
	 * Create instance of RuleCollection
	 * Save it in $collection array property
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Artisan\FormArtisan
	 */
	public function rules() {
		foreach( $this->config as $field => $options ) {
			$rules[ $field ] = $options['rules'];
		}
		$this->collection['rules'] = new RuleCollection( $rules );
		$this->resolve_strategies();
		return $this;
	}

	/**
	 * Create instance of WFV\Validator
	 * Save it in $validator property
	 *
	 * @since 0.11.0
	 *
	 * @return WFV\Artisan\FormArtisan
	 */
	public function validator() {
		$this->validator = new Validator();
		return $this;
	}

	/**
	 * Creates a validator (strategy) for each rule
	 * Save it in $strategies property
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 */
	protected function resolve_strategies() {
		// WIP - simplify/breakdown - perhaps a factory or another builder?
		// Stopgap solution...

		$optional = false;
		$rules = $this->collection['rules']->get_array();

		foreach( $rules as $field => $ruleset ) {

			$optional = in_array("optional", $ruleset);

			foreach( $ruleset as $rule ) {

				if( 'optional' !== $rule ){

					$rule_name = ( is_string( $rule ) ) ? $rule : $rule['rule'];
					$class = str_replace(' ', '', ucwords( str_replace('_', ' ', $rule_name ) ) );
					$class = 'WFV\Validators\\'.$class;

					$message = ( isset( $this->config[ $field ]['messages'][ $rule_name ] ) )
						? $this->config[ $field ]['messages'][ $rule_name ]
						: false;

					$strategies[ $field ][ $rule_name ] = ( is_string( $rule ) )
						? new $class( new RespectValidator(), $field, $optional, $message )
						: new $class( new RespectValidator(), $field, $optional, $message, $rule['params'] );
				}
			}
		}
		$this->strategies = $strategies;
	}
}
