<?php
namespace WFV\Artisan;
defined( 'ABSPATH' ) or die();

use \Respect\Validation\Validator as RespectValidator;

use WFV\Contract\ArtisanInterface;
use WFV\Collection\ErrorCollection;
use WFV\Collection\MessageCollection;
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
	 * @access private
	 * @var array
	 */
	private $collection = array();

	/**
	 *
	 *
	 * @since 0.10.0
	 * @access private
	 * @var WFV\FormComposite
	 */
	private $form;

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access private
	 * @var
	 */
	private $validator;

	/**
	 *
	 *
	 * @since 0.11.0
	 * @access private
	 * @var
	 */
	private $strategies = array();

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
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $action
	 * @return WFV\Artisan\FormArtisan
	 */
	public function create( $action ) {
		$this->form = new FormComposite( $action, $this->collection, $this->strategies );
		$this->form->add_validator( $this->validator );
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Artisan\FormArtisan
	 */
	public function errors() {
		$this->collection['errors'] = new ErrorCollection();
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param string $action
	 * @return WFV\Artisan\FormArtisan
	 */
	public function input( array $data = [] ) {
		$this->collection['input'] = new InputCollection( $data );
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Artisan\FormArtisan
	 */
	public function messages( array $messages = [] ) {
		// $this->collection['messages'] = new MessageCollection( $messages );
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.10.0
	 *
	 * @param array $rules
	 * @return WFV\Artisan\FormArtisan
	 */
	public function rules( array $rules = [] ) {
		$this->collection['rules'] = new RuleCollection( $rules );
		$this->resolve_strategies();
		return $this;
	}

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param array $rules
	 * @return WFV\Artisan\FormArtisan
	 */
	public function validator() {
		$this->validator = new Validator();
		return $this;
	}

	/**
	 * Creates a validator for each rule
	 *
	 * @since 0.11.0
	 * @access protected
	 *
	 */
	protected function resolve_strategies() {
		// WIP - simplify/breakdown - perhaps a factory for this?

		$optional = false;
		$rules = $this->collection['rules']->get_array();

		foreach( $rules as $field => $ruleset ) {

			$optional = in_array("optional", $ruleset);

			foreach( $ruleset as $rule ) {

				if( 'optional' !== $rule ){

					$rule_name = ( is_string( $rule ) ) ? $rule : $rule['rule'];
					$class = str_replace(' ', '', ucwords( str_replace('_', ' ', $rule_name ) ) );
					$class = 'WFV\Validators\\'.$class;

					$strategies[ $field ][ $rule_name ] = ( is_string( $rule ) )
						? new $class( new RespectValidator(), $field, $optional )
						: new $class( new RespectValidator(), $field, $optional, $rule['params'] );
				}
			}
		}
		$this->strategies = $strategies;
	}
}
