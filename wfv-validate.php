<?php
// namespace WFV;
defined( 'ABSPATH' ) or die();
/*
Plugin Name: WFV - Form Validation
Plugin URI:  https://github.com/macder/wp-form-validation
Description: See README.md
Version:     0.8.0
Author:      Maciej Derulski
Author URI:  https://derulski.com
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

define( 'WFV_VALIDATE_VERSION', '0.8.0' );
define( 'WFV_VALIDATE__MINIMUM_WP_VERSION', '4.7' ); // not tested with other versions
define( 'WFV_VALIDATE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

define( 'WFV_VALIDATE__ACTION_POST', 'validate_form' );

require_once( WFV_VALIDATE__PLUGIN_DIR . '/vendor/vlucas/valitron/src/Valitron/Validator.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/ValidationInterface.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/AccessorTrait.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/MutatorTrait.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/Rules.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/Errors.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/Form.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/Input.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/Messages.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/Validator.php' );

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
function wfv_create( &$validation ) {
  // TODO: make a factory for this...
  $action = $validation['action'];
  $rules = new WFV\Rules();
  $rules->set( $validation['rules'] );
  $input = new WFV\Input( $action );
  $messages = new WFV\Messages( $validation['messages'] );
  $errors = new WFV\Errors();
  $validation = new WFV\Validator( $action, $rules, $input, $messages, $errors );
  // action or like this?
  if ( $validation->is_safe() ) {
    $validation->validate();
  }
}
