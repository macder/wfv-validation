<?php
namespace WFV\Builder;
defined( 'ABSPATH' ) or die();

use WFV\Component\Validation;
use WFV\Component\Rules;
/**
 *
 *
 * @since 0.9.2
 */
class ValidationBuilder implements BuilderInterface {

	/**
	 *
	 *
	 * @since 0.9.2
	 * @access protected
	 * @var
	 */
	protected $validation;

	/**
	 *
	 *
	 * @since 0.9.2
	 * @access private
	 * @var array $config
	 */
	private $config;

	/**
	 *
	 *
	 * @since 0.9.2
	 *
	 * @return
	 */
	public function __construct( $config ) {
		$this->config = $config;
	}

	/**
	 *
	 *
	 * @since 0.9.2
	 *
	 * @return
	 */
	public function add_action() {
		$this->validation->set( 'action', $this->config['action'] );
	}

	/**
	 *
	 *
	 * @since 0.9.2
	 *
	 * @return
	 */
	public function add_rules() {
		$this->validation->set( 'rules', new Rules( $this->config['rules'] ) );
	}

	/**
	 *
	 *
	 * @since 0.9.2
	 *
	 * @return
	 */
	public function add_input() {

	}

	/**
	 *
	 *
	 * @since 0.9.2
	 *
	 * @return
	 */
	public function create() {

		$this->validation = new Validation();

	}

	/**
	 *
	 *
	 * @since 0.9.2
	 *
	 * @return
	 */
	public function get_validation() {
		return $this->validation;
	}
}
