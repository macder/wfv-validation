<?php
// namespace WFV;
defined( 'ABSPATH' ) or die();
/*
Plugin Name: WFV - Form Validation
Plugin URI:  https://github.com/macder/wp-form-validation
Description: See README.md
Version:     0.8.1
Author:      Maciej Derulski
Author URI:  https://derulski.com
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

define( 'WFV_VALIDATE_VERSION', '0.8.1' );
define( 'WFV_VALIDATE__MINIMUM_WP_VERSION', '4.7' ); // not tested with other versions
define( 'WFV_VALIDATE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WFV_VALIDATE__ACTION_POST', 'validate_form' );

require_once WFV_VALIDATE__PLUGIN_DIR . '/vendor/autoload.php';

use WFV\Factory\ValidationFactory;

/**
 * Instantiate WFV\Validator and assign it by reference
 *   as described by $form.
 *
 * @since 0.3.0
 * @since 0.5.0 $form parameter creates reference
 * @since 0.8.2 uses factory to create object
 *
 * @param array $form Form configuration
 */
function wfv_create( &$form ) {
  ValidationFactory::create( $form );
  wfv_validate( $form );
}

/**
 *
 *
 * @since 0.8.2
 *
 * @param array $form Form configuration
 */
function wfv_validate( $form ) {
  if ( $form->is_safe() ) {
    return $form->validate();
  }
}
