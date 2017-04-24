<?php
// namespace WFV;
defined( 'ABSPATH' ) or die();
/*
Plugin Name: WFV - Form Validation
Plugin URI:  https://github.com/macder/wp-form-validation
Description: See README.md
Version:     0.9.0
Author:      Maciej Derulski
Author URI:  https://derulski.com
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

define( 'WFV_VALIDATE_VERSION', '0.9.0' );
define( 'WFV_VALIDATE__MINIMUM_WP_VERSION', '3.7' );
define( 'WFV_VALIDATE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WFV_VALIDATE__ACTION_POST', 'validate_form' );

require_once WFV_VALIDATE__PLUGIN_DIR . '/vendor/autoload.php';

use WFV\Factory\ValidationFactory;

/**
 * Build instance of WFV\Validator using factory
 * Assign by reference the instance, as described by $form.
 *
 * @since 0.3.0
 * @since 0.5.0 $form parameter creates reference
 * @since 0.8.2 uses factory to create object
 *
 * @param array $form Form configuration
 */
function wfv_create( &$form ) {
  ValidationFactory::create_form( $form );

  if( $form->must_validate() ) {
    $validator = ValidationFactory::create_validator( $form );
    wfv_validate( $form, $validator );
  }
}

/**
 *
 *
 * @since 0.8.2
 * @since 0.9.1
 *
 * @param WFV\Form $form
 * @param \Valitron\Validator $validator
 * @return WFV\Form
 */
function wfv_validate( $form, $validator ) {
  ValidationFactory::load_rules( $form, $validator );
}
