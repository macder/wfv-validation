<?php
// namespace WFV;
defined( 'ABSPATH' ) or die();
/*
Plugin Name: WFV - Form Validation
Plugin URI:  https://github.com/macder/wp-form-validation
Description: See README.md
Version:     0.9.1
Author:      Maciej Derulski
Author URI:  https://derulski.com
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

define( 'WFV_VALIDATE_VERSION', '0.9.1' );
define( 'WFV_VALIDATE__MINIMUM_WP_VERSION', '3.7' );
define( 'WFV_VALIDATE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WFV_VALIDATE__ACTION_POST', 'validate_form' );

require_once WFV_VALIDATE__PLUGIN_DIR . '/vendor/autoload.php';

use WFV\Builder\FormBuilder;
use WFV\Builder\Director;

/**
 * Build instance of WFV\Validator using factory
 * Assign by reference the instance, as described by $form.
 *
 * @since 0.3.0
 * @since 0.10.0
 *
 * @param array $form Form configuration
 */
function wfv_create( $action, &$form ) {
  $builder = new FormBuilder();
  $form = ( new Director() )
    ->give_attribute( 'action', $action )
    ->with_entity( 'rules', $form['rules'] )
    ->with_entity( 'input', $action )
    ->enact( $builder );
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
