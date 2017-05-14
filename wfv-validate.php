<?php
defined( 'ABSPATH' ) or die();
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

use WFV\Agent\InspectionAgent;
use WFV\Artisan\Director;
use WFV\Artisan\FormArtisan;

/**
 *
 *
 * @since 0.10.0
 *
 * @param string $action
 * @param array $form Form arguments
 */
function wfv_create( $action, array &$form ) {
	$inspect = new InspectionAgent( $action );
	$input = ( true === $inspect->safe_submit() ) ? $_POST : array();

	$artisan = new FormArtisan();
	$form = ( new Director( $action ) )
		->with( 'input', $input )
		->with( 'rules', $form['rules'] )
		->with( 'errors' )
		->compose( $artisan );

	if( $input ) {
		$form->validate();
	}
}
