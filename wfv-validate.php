<?php
defined( 'ABSPATH' ) || die();
/*
Plugin Name: WFV - Form Validation
Plugin URI:  https://macder.github.io/wfv/
Description: A simple fluid and concise API to manage user input, validation, feedback, and safe output.
Version:     0.11.0
Author:      Maciej Derulski
Author URI:  https://github.com/macder
License:     BSD 3-Clause
License URI: https://github.com/macder/wp-form-validation/blob/master/LICENSE
*/

define( 'WFV_VALIDATE_VERSION', '0.11.0' );
define( 'WFV_VALIDATE__MINIMUM_WP_VERSION', '3.7' );
define( 'WFV_VALIDATE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WFV_VALIDATE__ACTION_POST', 'validate_form' );

require_once WFV_VALIDATE__PLUGIN_DIR . '/vendor/autoload.php';

use WFV\FormComposite;
use WFV\Agent\InspectionAgent;
use WFV\Artisan\Director;
use WFV\Artisan\FormArtisan;
use WFV\Factory\ValidatorFactory;

/**
 *
 *
 * @since 0.10.0
 *
 * @param string $action
 * @param array $form Form arguments
 * @param bool $trim Trim whitespace from beginning and end of string
 */
function wfv_create( $action, array &$form, $trim = true ) {
	$inspect = new InspectionAgent( $action );
	$input = ( true === $inspect->safe_submit() ) ? $_POST : array();

	$builder = new FormArtisan( $form );
	$form = ( new Director( $action ) )
		->with( 'input', [ $input, $trim ] )
		->with( 'rules' )
		->with( 'errors' )
		->with( 'messages' )
		->with( 'validator' )
		->compose( $builder );

	if( $input ) {
		wfv_validate( $form );
	}
}

/**
 *
 *
 * @since 0.11.0
 *
 * @param FormComposite $form
 * @return bool
 */
function wfv_validate( FormComposite $form ) {
	$rules = $form->rules()->get_array();
	$messages = $form->messages()->get_array();
	$factory = new ValidatorFactory( $messages );

	foreach( $rules as $field => $ruleset ) {
		$optional = in_array('optional', $ruleset);
		if( $optional ) {
			array_shift( $ruleset );
		}
		foreach( $ruleset as $rule ) {
			$params = ( is_array( $rule ) ) ? $rule['params'] : null;
			$rule_name = ( is_string( $rule ) ) ? $rule : $rule['rule'];
			$validator = $factory->create( $rule_name, $field, $params, $optional );
			$form->validate( $validator, $field );
		}
	}
	return $form->is_valid();
}
