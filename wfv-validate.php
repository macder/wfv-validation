<?php
// namespace WFV;
defined( 'ABSPATH' ) or die();
/*
Plugin Name: WFV - Form Validation
Plugin URI:  https://github.com/macder/wp-form-validation
Description: Fluent, immutable, and declarative API for elegant input validation
Version:     0.10.0
Author:      Maciej Derulski
Author URI:  https://derulski.com
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

define( 'WFV_VALIDATE_VERSION', '0.10.0' );
define( 'WFV_VALIDATE__MINIMUM_WP_VERSION', '3.7' );
define( 'WFV_VALIDATE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WFV_VALIDATE__ACTION_POST', 'validate_form' );

require_once WFV_VALIDATE__PLUGIN_DIR . '/vendor/autoload.php';

use WFV\Artisan\FormArtisan;
use WFV\Artisan\GuardArtisan;
use WFV\Artisan\Director;

/**
 *
 *
 * @since 0.3.0
 * @since 0.10.0
 *
 * @param string $action
 * @param array $form Form arguments
 */
function wfv_create( $action, array &$form ) {

	// wfv_guard( $action );

	$artisan = new FormArtisan();
	$form = ( new Director( $action ) )->describe('action', $action)
		->with( 'rules', $form['rules'] )
		->with( 'input' )
		//->with( 'errors' )
		->compose( $artisan );
}

/**
 *
 *
 *
 * @since 0.10.0
 *
 * @param
 * @param
 * @return
 */
function wfv_guard( $action ) {
	$artisan = new GuardArtisan();
	$guard = ( new Director( $action ) )
		->with( 'input' )
		->compose( $artisan );
}

/**
 *
 *
 *
 * @since 0.9.2
 *
 * @param
 * @param
 * @return
 */
function wfv_validate() {

}
