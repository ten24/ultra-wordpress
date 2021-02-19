<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */

/**
 * The slatwallbootstrap file
 *
 * @link              https://www.slatwallcommerce.com/
 * @since             1.0.0
 * @package           Slatwall_Ecommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Slatwall Commerce
 * Plugin URI:        https://www.slatwallcommerce.com/
 * Description:       Connect the Slatwall Commerce platform with WordPress.
 * Version:           1.0.0
 * Author:            Slatwall Commerce Team
 * Author URI:        https://www.slatwallcommerce.com/
 * Text Domain:       Slatwall Ecommerce
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently slatwallversion.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your slatwalland update it as you release new versions.
 */
define('SLATWALL_VERSION', '1.0.0' );
define('SLATWALL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define('AUTHORIZATION','dGVuMjQ6NDBCbHVlOTY=');
define('SLATWALL_PLUGIN_DIR_ULR',plugin_dir_url( __FILE__ ));
define('PRODUCT_SINGLE_SLUG','product');
define('PRODUCT_SEARCH_SLUG','search-product');
define('MY_ACCOUNT_SLUG','my-account');
define('BRAND_SLUG','brand');
define('CATEGORY_SLUG','category');
define('OPTION_SLUG','option');
define('TYPE_SLUG','type');
define('CHECKOUT','checkout');
define('CART','cart');
define('PRODUCT_LISTING_SLUG','/');
define('MERCHANDISED_PRODUCT', 'merchandised-product-listing');
define('DEFAULT_LOCATION', '2c9180856c26ea22016c2f7615460210');
define('API_CACHE_EXPIRE_TIME',604800);
register_activation_hook( __FILE__, 'install' );

/**
 * The code that runs during slatwallactivation.
 * This action is documented in includes/class-slatwall-activator.php
 */
function activate_slatwall() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-slatwall-activator.php';
	Slatwall_Activator::activate();
}

/**
 * The code that runs during slatwalldeactivation.
 * This action is documented in includes/class-slatwall-deactivator.php
 */
function deactivate_slatwall() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-slatwall-deactivator.php';
	Slatwall_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_slatwall' );
register_deactivation_hook( __FILE__, 'deactivate_slatwall' );

/**
 * The core slatwallclass that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-slatwall.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the slatwallis registered via hooks,
 * then kicking off the slatwallfrom this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_slatwall() {

	$slatwall = new Slatwall();
	$slatwall->run();

}

if( ! class_exists( 'Slatwall_Template_Loader' ) ) {
	require plugin_dir_path( __FILE__ ) . 'public/class-slatwall-template-loader.php';
}
require plugin_dir_path( __FILE__ ) . 'public/class-sw-template-loader.php';

function slatwall_shortcode() {

	$templates = new SW_Template_Loader;

	ob_start();
	$templates->get_template_part( 'content', 'header' );
	$templates->get_template_part( 'content', 'middle' );
	$templates->get_template_part( 'content', 'footer' );
	return ob_get_clean();

}
add_shortcode( 'slatwall-sample', 'slatwall_shortcode' );


run_slatwall();

function dd($data){
    echo '<pre>';
             print_r($data);
             echo '</pre>';
             die;
}
function d($data){
    echo '<pre>';
             print_r($data);
             echo '</pre>';
}

add_filter('query_vars', 'add_product_var', 0, 1);
function add_product_var($vars){
    $vars[] = 'pslug';
    return $vars;
}
add_filter('query_vars', 'add_account_var', 0, 1);
function add_account_var($vars){
    $vars[] = 'maslug';
    return $vars;
}
add_filter('query_vars', 'add_brand_var', 0, 1);
function add_brand_var($vars){
    $vars[] = 'bslug';
    return $vars;
}
add_filter('query_vars', 'add_category_var', 0, 1);
function add_category_var($vars){
    $vars[] = 'cslug';
    return $vars;
}
add_filter('query_vars', 'add_option_var', 0, 1);
function add_option_var($vars){
    $vars[] = 'oslug';
    return $vars;
}
add_filter('query_vars', 'add_type_var', 0, 1);
function add_type_var($vars){
    $vars[] = 'tslug';
    return $vars;
}
add_action( 'init', 'add_alexes_rules', 10, 0 );
function add_alexes_rules() {
    $page_slug = PRODUCT_SINGLE_SLUG;
    add_rewrite_rule('^'.$page_slug.'/([^/]*)/?','index.php?pagename='.$page_slug.'&pslug=$matches[1]','top');
}
add_action( 'init', 'add_alexes_rules_my_account', 10, 0 );
function add_alexes_rules_my_account() {
    $page_slug = MY_ACCOUNT_SLUG;
    add_rewrite_rule('^'.$page_slug.'/([^/]*)/?','index.php?pagename='.$page_slug.'&maslug=$matches[1]','top');
}

add_action( 'init', 'add_alexes_rules_brand', 10, 0 );
function add_alexes_rules_brand() {
    $page_slug = BRAND_SLUG;
    add_rewrite_rule('^'.$page_slug.'/([^/]*)/?','index.php?pagename='.$page_slug.'&bslug=$matches[1]','top');
}

add_action( 'init', 'add_alexes_rules_category', 10, 0 );
function add_alexes_rules_category() {
    $page_slug = CATEGORY_SLUG;
    add_rewrite_rule('^'.$page_slug.'/([^/]*)/?','index.php?pagename='.$page_slug.'&cslug=$matches[1]','top');
}

add_action( 'init', 'add_alexes_rules_option', 10, 0 );
function add_alexes_rules_option() {
    $page_slug = OPTION_SLUG;
    add_rewrite_rule('^'.$page_slug.'/([^/]*)/?','index.php?pagename='.$page_slug.'&oslug=$matches[1]','top');
}

add_action( 'init', 'add_alexes_rules_type', 10, 0 );
function add_alexes_rules_type() {
    $page_slug = TYPE_SLUG;
    add_rewrite_rule('^'.$page_slug.'/([^/]*)/?','index.php?pagename='.$page_slug.'&tslug=$matches[1]','top');
}
add_action('init', 'do_output_buffer');
function do_output_buffer()
{
     ob_start();
}

function price_number_format($amount){

    return number_format((float)$amount, 2, '.', '');
}

function my_plugin_body_class($classes) {
    $classes[] = 'slatwall-body';
    if(get_query_var('tslug') != '' || get_query_var('oslug') != '' || get_query_var('cslug') != '' || get_query_var('bslug') != ''){
        $classes[] = 'slatwall-taxonomy';
    }
    return $classes;
}

add_filter('body_class', 'my_plugin_body_class');
