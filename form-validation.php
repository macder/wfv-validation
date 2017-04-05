<?php defined( 'ABSPATH' ) or die();
/*
Plugin Name: Form Validation
Plugin URI:  https://github.com/macder/wp-form-validation
Description: See README.md
Version:     0.5
Author:      Maciej Derulski
Author URI:  https://derulski.com
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

define( 'FORM_VALIDATION_VERSION', '0.5' );
define( 'FORM_VALIDATION__MINIMUM_WP_VERSION', '4.7' ); // not tested with other versions
define( 'FORM_VALIDATION__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

define( 'FORM_VALIDATION__ACTION_POST', 'validate_form' );

require_once( FORM_VALIDATION__PLUGIN_DIR . '/vendor/vlucas/valitron/src/Valitron/Validator.php' );
require_once( FORM_VALIDATION__PLUGIN_DIR . 'class.wfv-validate.php' );
require_once( FORM_VALIDATION__PLUGIN_DIR . 'class.wfv-form.php' );

/**
 * Instantiate and return a new Form_Validation
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

add_action( FORM_VALIDATION__ACTION_POST, 'validate' );
function validate( $form ) {
  $form->validate();
}
