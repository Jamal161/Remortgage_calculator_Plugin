<?php
/**
 * Plugin Name: Calculator 
 * Description: This plugin is a guide to how much you'd pay monthly, Bi-weekly or weekly on mortgage, car finance and so on.. 
 * Version:     1.2
 * Author:      Md Jamal Uddin
 */
if ( ! defined( 'ABSPATH' ) ) exit;
wp_enqueue_script('jquery');
function calculator_guide_myplugin_ajaxurl() {
   echo '<script type="text/javascript">
           var calculator_guide_ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
add_action('wp_head', 'calculator_guide_myplugin_ajaxurl');

function calculator_guide_call_after_install(){
define('CALCULATOR_GUIDE_PATH', dirname(__FILE__) . '/'); 
$installpath = explode('wp-content', CALCULATOR_GUIDE_PATH);
$path = plugin_dir_path( __FILE__ ) . 'system/wc_calculator_guide.sql';
$sql = file_get_contents($path);
require_once( $installpath[0] . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
}
register_activation_hook( __FILE__, 'calculator_guide_call_after_install' );

function calculator_guide_call_after_uninstall() {
global $wpdb;
$wpdb->query( 'DROP TABLE IF EXISTS wc_calculator_guide' );
}
register_uninstall_hook( __FILE__, 'calculator_guide_call_after_uninstall' );

function calculator_guide_ajax_request() {
require dirname( __FILE__ ) . '/include/calculator_guide_postit.php';
}
add_action( 'wp_ajax_calculator_guide_ajax_request', 'calculator_guide_ajax_request' );
add_action( 'wp_ajax_nopriv_calculator_guide_ajax_request', 'calculator_guide_ajax_request' );

function home_calculator_guide(){
require dirname( __FILE__ ) . '/include/calculator_guide_myform.php';
}

function calculator_guide_scripts(){
	wp_enqueue_style( 'formstyle', plugins_url( 'css/formstyle.css', __FILE__ ));
	wp_enqueue_script('postit', plugins_url('js/postit.js', __FILE__ ));       
}
add_action( 'wp_enqueue_scripts', 'calculator_guide_scripts' );

function calculator_guide_admin_menu() {
    add_menu_page( 'Calculator Guide', 'Calculator Guide', 'null', 'administrator_calculator_guide');
    add_submenu_page( 'administrator_calculator_guide', 'Settings', 'Settings', 'manage_options', 'settings_calculator_guide', 'calculator_guide_settings' );
	add_submenu_page( 'administrator_calculator_guide', __( 'Help', 'administrator_calculator_guide' ), __( 'Help', 'administrator_calculator_guide' ), 'manage_options', 'help_calculator_guide', 'calculator_guide_help');
	
}
function calculator_guide_settings(){
	global $wpdb;
	require plugin_dir_path( __FILE__ ) . 'system/msg.inc.php';
	require plugin_dir_path( __FILE__ ) . 'admin/calculator_guide_form.php';
}
function calculator_guide_help(){
	require plugin_dir_path( __FILE__ ) . 'admin/calculator_guide_help.php';
}
add_action('admin_menu', 'calculator_guide_admin_menu');


add_shortcode('calculator-guide', 'home_calculator_guide');







