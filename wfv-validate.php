<?php
defined( 'ABSPATH' ) || die();
/*
Plugin Name: WFV - Form Validation
Plugin URI:  https://macder.github.io/wfv/
Description: A simple fluid and concise API to manage user input, validation, feedback, and safe output.
Version:     0.11.3
Author:      Maciej Derulski
Author URI:  https://github.com/macder
License:     BSD 3-Clause
License URI: https://github.com/macder/wfv-validation/blob/master/LICENSE
*/

define( 'WFV_VALIDATE_VERSION', '0.11.3' );
define( 'WFV_VALIDATE__MINIMUM_WP_VERSION', '3.7' );
define( 'WFV_VALIDATE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once WFV_VALIDATE__PLUGIN_DIR . '/vendor/autoload.php';

use WFV\FormComposite;
use WFV\RuleFactory;
use WFV\Validator;
use WFV\Artisan\Director;
use WFV\Artisan\FormArtisan;
use WFV\Collection\MessageCollection;

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
	$messages = new MessageCollection( $form );

	$builder = new FormArtisan( $form, $action );
	$form = ( new Director() )
		->with( 'input' )
		->with( 'rules' )
		->with( 'errors' )
		->compose( $builder );

	if( $form->input()->is_populated() ) {
		( new Validator( new RuleFactory(), $messages ) )->validate( $form );
	}
}
