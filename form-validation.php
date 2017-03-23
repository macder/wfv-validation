<?php defined( 'ABSPATH' ) or die();
/*
Plugin Name: Form Validation
Plugin URI:  https://github.com/macder/wp-form-validation
Description: See README.md
Version:     0.2
Author:      Maciej Derulski
Author URI:  https://derulski.com
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

define( 'FORM_VALIDATION_VERSION', '0.2' );
define( 'FORM_VALIDATION__MINIMUM_WP_VERSION', '4.7' ); // not tested with other versions
define( 'FORM_VALIDATION__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

define( 'FORM_VALIDATION__ACTION_POST', 'validate_form' );
define( 'FORM_VALIDATION__PASS', 'valid_' );

require_once( FORM_VALIDATION__PLUGIN_DIR . '/vendor/vlucas/valitron/src/Valitron/Validator.php' );
require_once( FORM_VALIDATION__PLUGIN_DIR . 'class.form-validation.php' );
require_once( FORM_VALIDATION__PLUGIN_DIR . 'class.form-validate-post.php' );

add_action(FORM_VALIDATION__ACTION_POST, 'validate', 10, 1);
function validate($rules) {
    $result = new Form_Validate_Post($rules);
    // test();
    // print_r($v);
}
