<?php
namespace WFV\Artisan;
defined( 'ABSPATH' ) || die();

use WFV\Agent\InspectionAgent;
use WFV\Contract\ArtisanInterface;
use WFV\Collection\ErrorCollection;
use WFV\Collection\InputCollection;
use WFV\Collection\MessageCollection;
use WFV\Collection\RuleCollection;

use WFV\RuleFactory;
use WFV\FormComposite;
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
	 * @since 0.11.3
	 * @var string
	 */
	public $action;

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
	 * @since 0.11.2
	 * @var \WFV\RuleFactory
	 */
	public $factory;

	/**
	 *
	 *
	 * @since 0.11.0
	 * @var \WFV\Validator
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
	 * @var \WFV\FormComposite
	 */
	protected $form;

	/**
	 *
	 *
	 * @since 0.11.0
	 *
	 * @param array $config
	 * @param string $action
	 */
	public function __construct( array $config, $action ) {
		$this->config = $config;
		$this->action = $action;
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
	public function create() {
		$this->form = new FormComposite( $this );
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
	 *
	 *
	 * @since 0.11.2
	 *
	 * @return WFV\Artisan\FormArtisan
	 */
	public function factory() {
		$this->factory = new RuleFactory();
		return $this;
	}

	/**
	 * Create instance of InputCollection
	 * Save it in $collection array property
	 *
	 * @since 0.10.0
	 *
	 * @return WFV\Artisan\FormArtisan
	 */
	public function input() {
		$guard = new InspectionAgent( $this->action );
		$this->collection['input'] = new InputCollection( $guard );
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
		$rules = array();
		foreach( $this->config as $field => $options ) {
			$rules[ $field ] = $options['rules'];
		}
		$this->collection['rules'] = new RuleCollection( $rules );
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
		$this->validator = new Validator( new MessageCollection( $this->config ) );
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
}
