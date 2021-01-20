<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */

/**
 * The file that defines the core slatwallclass
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.slatwallcommerce.com/
 * @since      1.0.0
 *
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/includes
 */

/**
 * The core slatwallclass.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this slatwallas well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    SLATWALL
 * @subpackage SLATWALL/includes
 */


class Slatwall {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      SLATWALL_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $slatwall;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the slatwallname and the slatwallversion that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'SLATWALL_VERSION' ) ) {
			$this->version = SLATWALL_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'slatwall';

		$this->load_dependencies();
		//$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - SLATWALL_Loader. Orchestrates the hooks of the plugin.
	 * - SLATWALL_i18n. Defines internationalization functionality.
	 * - SLATWALL_Admin. Defines all hooks for the admin area.
	 * - SLATWALL_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-slatwall-loader.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-slatwall-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-slatwall-public.php';

		$this->loader = new Slatwall_Loader();

	}


	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$slatwall = new Slatwall_Admin( $this->get_slatwall(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $slatwall, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $slatwall, 'enqueue_scripts' );
                $this->loader->add_action( 'admin_menu', $slatwall, 'menu_options' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$slatwall_public = new Slatwall_Public( $this->get_slatwall(), $this->get_version() );
                $token = $this->get_token();
                $this->loader->add_action( 'wp_head', $slatwall_public, 'wp_head_script',1 );
		$this->loader->add_action( 'wp_enqueue_scripts', $slatwall_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $slatwall_public, 'enqueue_scripts' );
                $this->loader->add_action( 'init', $slatwall_public, 'start_session' );
                $this->loader->add_filter( 'pre_get_document_title', $slatwall_public, 'slatwall_wp_title_filter',100);
                if($token){
                $this->loader->add_shortcode( 'home-page', $slatwall_public, 'home_page' );
                $this->loader->add_shortcode( 'product-listing', $slatwall_public, 'product_listing' );
                $this->loader->add_shortcode( 'product-listing-search', $slatwall_public, 'product_listing_search' );
                $this->loader->add_shortcode( 'product-search-form', $slatwall_public, 'product_search_form' );
                $this->loader->add_shortcode( 'product-listing-brand', $slatwall_public, 'product_listing_brand' );
                $this->loader->add_shortcode( 'product-listing-category', $slatwall_public, 'product_listing_category' );
                $this->loader->add_shortcode( 'product-listing-option', $slatwall_public, 'product_listing_option' );
                $this->loader->add_shortcode( 'product-listing-type', $slatwall_public, 'product_listing_type' );
                $this->loader->add_shortcode( 'product-details', $slatwall_public, 'product_details' );
                $this->loader->add_shortcode( 'my-account', $slatwall_public, 'my_account' );
                $this->loader->add_shortcode( 'shopping-cart', $slatwall_public, 'shopping_cart' );
                $this->loader->add_shortcode( 'mini-cart', $slatwall_public, 'mini_cart' );
                $this->loader->add_shortcode( 'checkout', $slatwall_public, 'checkout' );

                }

        }

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the slatwallused to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_slatwall() {
		return $this->slatwall;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    SLATWALL_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

        private function get_token(){
            global $table_prefix, $wpdb;
           $result = $wpdb->get_row("SELECT domain,token,status FROM ".$table_prefix."slatwall_login WHERE status = '1'");
           if($result && $result->token){
               define('DOMAIN', $result->domain);
           return $result->token;
           } else {
               return false;
           }
        }

}
