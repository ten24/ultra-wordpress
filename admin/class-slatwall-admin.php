<?php

/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */

/**
 * The admin-specific functionality of the slatwall.
 *
 * @link       https://www.slatwallcommerce.com/
 * @since      1.0.0
 *
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/admin
 */

/**
 * The admin-specific functionality of the slatwall.
 *
 * Defines the Slatwall Ecommerce, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/admin
 */
class Slatwall_Admin {

	/**
	 * The ID of this slatwall.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $slatwall    The ID of this slatwall.
	 */
	private $slatwall;

	/**
	 * The version of this slatwall slatwall.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this slatwall slatwall.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $slatwall       The name of this slatwall.
	 * @param      string    $version    The version of this slatwall.
	 */
	public function __construct( $slatwall, $version ) {

		$this->slatwall = $slatwall;
		$this->version = $version;

                add_action( 'wp_ajax_nopriv_send_key_data', array( $this, 'send_key_data' ) );
    add_action( 'wp_ajax_send_key_data', array( $this, 'send_key_data' ) );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->slatwall.'_slatwall_admin_css', plugin_dir_url( __FILE__ ) . 'css/slatwall-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->slatwall.'_slatwall_admin_bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Slatwall_Ecommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Slatwall_Ecommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->slatwall.'_slatwall_jquery', plugin_dir_url( __FILE__ ) . 'js/jquery.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->slatwall.'_slatwall_admin', plugin_dir_url( __FILE__ ) . 'js/slatwall-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->slatwall.'_slatwall_admin_bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );

	}

        public function menu_options(){
            $this->plugin_screen_hook_suffix = add_menu_page('Slatwall', 'Slatwall', 'manage_options', 'slatwall', array( $this, 'dashboard' ));
        }

        public function dashboard(){

            global $table_prefix, $wpdb;
           $result = $wpdb->get_row("SELECT * FROM ".$table_prefix."slatwall_login WHERE status = '1'");

           require 'partials/slatwall-admin-display.php';
        }

        public function send_key_data(){
            $data_array = $_POST['form_data'];
              $result = $this->integration($data_array);
          echo $result;
            exit;
        }

        private function integration(array $data_array){
            foreach($data_array as $data_value){
                if(!isset($data_value['send_option'])){
                $key_data[$data_value['name']] = $data_value['value'];
                } else {
                    $send_option = $data_value['send_option'];
                }
            }
            $access_key = $key_data['access_key'];
            $access_key_secret = $key_data['access_key_secret'];
           $API_URL = $this->apiUrl($key_data['domain']);

           if($API_URL){
            try {
                $ch = curl_init();

                // Check if initialization had gone wrong*
                if ($ch === false) {
                    throw new Exception('failed to initialize');
                }

                curl_setopt_array($ch, array(
              CURLOPT_URL => $API_URL,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_HTTPHEADER => array(
                "Access-Key: $access_key",
                "Access-Key-Secret: $access_key_secret",
                "Authorization: Basic $auth"
              ),
            ));

                $content = curl_exec($ch);

                // Check the return value of curl_exec(), too
                if($content === false) {
                    throw new Exception(curl_error($ch), curl_errno($ch));
                } else {
                    $response_obj = json_decode($content);
                    if(!empty($response_obj) && isset($response_obj->token))
                    {
                        $key_data['token'] = $response_obj->token;
                        $key_data['status'] = 1;
                        if($send_option == 'submit-key'){
                      $insert_result =  $this->keyStore($key_data);
                        }
                    }


                }

                /* Process $content here */

                // Close curl handle
                curl_close($ch);
            } catch(Exception $e) {

            if($e->getCode() !== 6){
              $content = trigger_error(sprintf(
                    'Curl failed with error #%d: %s',
                    $e->getCode(), $e->getMessage()),
                    E_USER_ERROR);
                    } else {
                      $error_msg = $e->getMessage();
                            $content = '{"errors" : "'.$error_msg.'"}';
                    }

            }
             return $content;
           } else {
               return '{"errors" : "Not Valid URL"}';
           }

        }

        private function apiUrl($domain){
            if (filter_var($domain, FILTER_VALIDATE_URL)) {
            $url = $domain."/api/auth/login/";
            return $url;
            } else {
            return false;
            }
        }

        private function keyStore(array $key_data){
            global $table_prefix,$wpdb;
            $tblname = 'slatwall_login';
            $wp_slatwall_table = $table_prefix . "$tblname";
            $wpdb->query("TRUNCATE TABLE $wp_slatwall_table");
                if($wpdb->insert($wp_slatwall_table, $key_data)){
                    return true;
                } else {
                    return false;
                }
            }


}
