<?php defined( 'ABSPATH' ) or die();
/*
Plugin Name: WFV - Form Validation
Plugin URI:  https://github.com/macder/wp-form-validation
Description: See README.md
Version:     0.7.6
Author:      Maciej Derulski
Author URI:  https://derulski.com
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

define( 'WFV_VALIDATE_VERSION', '0.7.6' );
define( 'WFV_VALIDATE__MINIMUM_WP_VERSION', '4.7' ); // not tested with other versions
define( 'WFV_VALIDATE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

define( 'WFV_VALIDATE__ACTION_POST', 'validate_form' );

require_once( WFV_VALIDATE__PLUGIN_DIR . '/vendor/vlucas/valitron/src/Valitron/Validator.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'class.wfv-errors.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'class.wfv-input.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'class.wfv-rules.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'class.wfv-messages.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'class.wfv-validate.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'class.wfv-form.php' );

/**
 * Instantiate and return a new WFV_VALIDATE
 * Specific to the form defined in $name
 *
 * @since 0.3.0
 * @since 0.4.0 reduced to single array parameter
 * @since 0.5.0 $form parameter creates reference
 *
 * @param array $form Form configuration (rules, action)
 */
function wfv_create( &$form ) {
  $form = new WFV_Form( $form );
}

add_action( WFV_VALIDATE__ACTION_POST, 'validate' );
function validate( $form ) {
  $form->validate();
}
