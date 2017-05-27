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
	$guard = new InspectionAgent( $action );

	$builder = new FormArtisan( $form );
	$form = ( new Director( $action ) )
		->with( 'input', $guard )
		->with( 'rules' )
		->with( 'errors' )
		->with( 'validator' )
		->compose( $builder );

	if( $form->input()->is_populated() ) {
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
	$factory = ( new ValidatorFactory() )
		->add( $form->rules()->unique() );
	return $form->validate( $factory )->is_valid();
}
