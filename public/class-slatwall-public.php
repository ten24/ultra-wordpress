<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.slatwallcommerce.com/
 * @since      1.0.0
 *
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/includes
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the slatwallname, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @since      1.0.0
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/public
 * @author     Yash <raj.yash@orangemantra.in>
 */
require SLATWALL_PLUGIN_DIR . 'includes/class-slatwall-integration.php';
require 'class-slatwall-products.php';
require 'class-slatwall-brands.php';
require 'class-slatwall-category.php';
require 'class-slatwall-types.php';
require 'class-slatwall-registration.php';
require 'class-slatwall-login.php';
require 'class-slatwall-stateCode.php';
require 'class-slatwall-logout.php';
require 'class-slatwall-account.php';
require 'class-slatwall-product-reviews.php';
require 'class-slatwall-related-products.php';
require 'class-slatwall-sku.php';
require 'class-slatwall-cart.php';
require 'class-slatwall-checkout.php';
require 'class-slatwall-option.php';
require SLATWALL_PLUGIN_DIR . 'includes/class-slatwall-paginator.php';
//require plugin_dir_path( __FILE__ ) . 'class-sw-template-loader.php';

class Slatwall_Public extends Slatwall_Products {

	/**
	 * The ID of this slatwall.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $slatwall    The ID of this slatwall.
	 */
	private $slatwall;

	/**
	 * The version of this slatwall.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this slatwall.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $slatwall       The name of the slatwall.
	 * @param      string    $version    The version of this slatwall.
	 */


	public function __construct( $slatwall, $version ) {

		$this->slatwall = $slatwall;
		$this->version = $version;



                /* product filter ajax funcition define */
                add_action( 'wp_ajax_nopriv_product_filter_data', array( $this, 'product_filter_data' ) );
                add_action( 'wp_ajax_product_filter_data', array( $this, 'product_filter_data' ) );

                /* sku data get ajax funcition define */
                add_action( 'wp_ajax_nopriv_get_sku_data', array( $this, 'get_sku_data' ) );
                add_action( 'wp_ajax_get_sku_data', array( $this, 'get_sku_data' ) );

                /* add to cart ajax funcition define */
                add_action( 'wp_ajax_nopriv_add_to_cart', array( $this, 'add_to_cart' ) );
                add_action( 'wp_ajax_add_to_cart', array( $this, 'add_to_cart' ) );
                
                /* add to cart ajax funcition define */
                add_action( 'wp_ajax_nopriv_header_append_data', array( $this, 'header_append_data' ) );
                add_action( 'wp_ajax_header_append_data', array( $this, 'header_append_data' ) );
                
                /* remove to cart ajax funcition define */
                add_action( 'wp_ajax_nopriv_remove_cart_item', array( $this, 'remove_cart_item' ) );
                add_action( 'wp_ajax_remove_cart_item', array( $this, 'remove_cart_item' ) );


                 /* update to cart ajax funcition define */
                add_action( 'wp_ajax_nopriv_update_cart_item', array( $this, 'update_cart_item' ) );
                add_action( 'wp_ajax_update_cart_item', array( $this, 'update_cart_item' ) );

                /* remove to cart ajax funcition define */
                add_action( 'wp_ajax_nopriv_add_promo', array( $this, 'add_promo' ) );
                add_action( 'wp_ajax_add_promo', array( $this, 'add_promo' ) );


                 /* remove to cart ajax funcition define */
                add_action( 'wp_ajax_nopriv_remove_promo', array( $this, 'remove_promo' ) );
                add_action( 'wp_ajax_remove_promo', array( $this, 'remove_promo' ) );

                 /* add billing checkout ajax funcition define */
                add_action( 'wp_ajax_nopriv_add_billing_address', array( $this, 'add_billing_address' ) );
                add_action( 'wp_ajax_add_billing_address', array( $this, 'add_billing_address' ) );

                /* add shipping checkout ajax funcition define */
                add_action( 'wp_ajax_nopriv_add_shipping_address', array( $this, 'add_shipping_address' ) );
                add_action( 'wp_ajax_add_shipping_address', array( $this, 'add_shipping_address' ) );
                
                /* add pickup checkout ajax funcition define */
                add_action( 'wp_ajax_nopriv_pickup', array( $this, 'pickup' ) );
                add_action( 'wp_ajax_pickup', array( $this, 'pickup' ) );
                
                /* add pickup shipping checkout ajax funcition define */
                add_action( 'wp_ajax_nopriv_pickup_shipping', array( $this, 'pickup_shipping' ) );
                add_action( 'wp_ajax_pickup_shipping', array( $this, 'pickup_shipping' ) );

                  /* Login ajax funcition define */
                add_action( 'wp_ajax_nopriv_user_login', array( $this, 'user_login' ) );
                add_action( 'wp_ajax_user_login', array( $this, 'user_login' ) );

                  /* Register ajax funcition define */
                add_action( 'wp_ajax_nopriv_user_register', array( $this, 'user_register' ) );
                add_action( 'wp_ajax_user_register', array( $this, 'user_register' ) );

                  /* Clear Cart ajax funcition define */
                add_action( 'wp_ajax_nopriv_clear_cart', array( $this, 'clear_cart' ) );
                add_action( 'wp_ajax_clear_cart', array( $this, 'clear_cart' ) );
                
                  /* Reopen Cart ajax funcition define */
                add_action( 'wp_ajax_nopriv_reopen_cart', array( $this, 'reopen_cart' ) );
                add_action( 'wp_ajax_reopen_cart', array( $this, 'reopen_cart' ) );

                  /* Add order Payment ajax funcition define */
                add_action( 'wp_ajax_nopriv_add_order_payment', array( $this, 'add_order_payment' ) );
                add_action( 'wp_ajax_add_order_payment', array( $this, 'add_order_payment' ) );

                  /* Place Order ajax funcition define */
                add_action( 'wp_ajax_nopriv_place_order', array( $this, 'place_order' ) );
                add_action( 'wp_ajax_place_order', array( $this, 'place_order' ) );

                /* add account address ajax funcition define */
                add_action( 'wp_ajax_nopriv_add_account_address', array( $this, 'add_account_address' ) );
                add_action( 'wp_ajax_add_account_address', array( $this, 'add_account_address' ) );

                /* edit account address ajax funcition define */
                add_action( 'wp_ajax_nopriv_edit_account_address', array( $this, 'edit_account_address' ) );
                add_action( 'wp_ajax_edit_account_address', array( $this, 'edit_account_address' ) );

                /* delete account address ajax funcition define */
                add_action( 'wp_ajax_nopriv_delete_account_address', array( $this, 'delete_account_address' ) );
                add_action( 'wp_ajax_delete_account_address', array( $this, 'delete_account_address' ) );

                /* set primary address account  ajax funcition define */
                add_action( 'wp_ajax_nopriv_set_primary_address', array( $this, 'set_primary_address' ) );
                add_action( 'wp_ajax_set_primary_address', array( $this, 'set_primary_address' ) );

                /* add email address ajax funcition define */
                add_action( 'wp_ajax_nopriv_add_email_address', array( $this, 'add_email_address' ) );
                add_action( 'wp_ajax_add_email_address', array( $this, 'add_email_address' ) );

                /* delete account email ajax funcition define */
                add_action( 'wp_ajax_nopriv_delete_account_email', array( $this, 'delete_account_email' ) );
                add_action( 'wp_ajax_delete_account_email', array( $this, 'delete_account_email' ) );

                /* add phone account  ajax funcition define */
                add_action( 'wp_ajax_nopriv_add_account_phone_number', array( $this, 'add_account_phone_number' ) );
                add_action( 'wp_ajax_add_account_phone_number', array( $this, 'add_account_phone_number' ) );

                /* set primary phone account  ajax funcition define */
                add_action( 'wp_ajax_nopriv_set_primary_phone', array( $this, 'set_primary_phone' ) );
                add_action( 'wp_ajax_set_primary_phone', array( $this, 'set_primary_phone' ) );

                /* delete account phone ajax funcition define */
                add_action( 'wp_ajax_nopriv_delete_account_phone', array( $this, 'delete_account_phone' ) );
                add_action( 'wp_ajax_delete_account_phone', array( $this, 'delete_account_phone' ) );

                /* set primary email account  ajax funcition define */
                add_action( 'wp_ajax_nopriv_set_primary_email', array( $this, 'set_primary_email' ) );
                add_action( 'wp_ajax_set_primary_email', array( $this, 'set_primary_email' ) );


                 /* change password ajax funcition define */
                 add_action( 'wp_ajax_nopriv_change_password_account', array( $this, 'change_password_account' ) );
                 add_action( 'wp_ajax_change_password_account', array( $this, 'change_password_account' ) );

                  /* reset password ajax funcition define */
                  add_action( 'wp_ajax_nopriv_reset_password_account', array( $this, 'reset_password_account' ) );
                  add_action( 'wp_ajax_reset_password_account', array( $this, 'reset_password_account' ) );


                  /* reset password ajax funcition define */
                  add_action( 'wp_ajax_nopriv_forget_password_account', array( $this, 'forget_password_account' ) );
                  add_action( 'wp_ajax_forget_password_account', array( $this, 'forget_password_account' ) );

                 /* get state code ajax funcition define */
                 add_action( 'wp_ajax_nopriv_address_state_code', array( $this, 'address_state_code' ) );
                 add_action( 'wp_ajax_address_state_code', array( $this, 'address_state_code' ) );

                 /* update profile ajax funcition define */
                 add_action( 'wp_ajax_nopriv_profile_update_account', array( $this, 'profile_update_account' ) );
                 add_action( 'wp_ajax_profile_update_account', array( $this, 'profile_update_account' ) );
                 
               //  add_filter( 'wp_title', array( $this, 'slatwall_wp_title_filter' ) );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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
                wp_enqueue_style( $this->slatwall.'_bootstrap_min_css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( $this->slatwall.'_fontawesome_min_css', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), $this->version, 'all' );
                // wp_enqueue_style( $this->slatwall.'_popper_min_css', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), $this->version, 'all' );
								wp_enqueue_style( $this->slatwall.'slatwall_public', plugin_dir_url( __FILE__ ) . 'css/slatwall-public.css', array(), $this->version, 'all' );
								// wp_enqueue_style( $this->slatwall.'product_zoom_slider', plugin_dir_url( __FILE__ ) . 'css/xzoom.css', array(), $this->version, 'all' );


	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
            wp_enqueue_script( $this->slatwall.'_popper_min_js', plugin_dir_url( __FILE__ ) . 'js/popper.min.js', array( 'jquery' ), $this->version, false );
            wp_enqueue_script( $this->slatwall.'_bootstrap_min_js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
            wp_enqueue_script( $this->slatwall.'_jquery', plugin_dir_url( __FILE__ ) . 'js/slatwall-public.js', array( 'jquery' ), $this->version, false );
            
            wp_enqueue_script( $this->slatwall.'_product_zoom_jquery', plugin_dir_url( __FILE__ ) . 'js/jquery.elevatezoom.js', array( 'jquery' ), $this->version, false );
            wp_enqueue_script( $this->slatwall.'_jquery_fancybox', plugin_dir_url( __FILE__ ) . 'js/jquery.fancybox.js', array( 'jquery' ), $this->version, false );
            wp_enqueue_script( $this->slatwall.'_jquery_ui', plugin_dir_url( __FILE__ ) . 'js/jquery-ui.min.js', array( 'jquery' ), $this->version, false );
            wp_enqueue_script( $this->slatwall.'_jquery_ui_carousel', plugin_dir_url( __FILE__ ) . 'js/ui-carousel.js', array( 'jquery' ), $this->version, false );

	}

        public function start_session(){
             if(!session_id()) {
        session_start();

    }
        }

        function home_page(){
             ob_start();
         require 'partials/slatwall-public-home-page.php';   
         return ob_get_clean();
        }
        
        
        public function product_listing($atts,$content = null){
         //   $currentPage = ( isset( $_GET['currentpage'] ) ) ? $_GET['currentpage'] : 1;
            $atts = shortcode_atts( array(
      'products' => '',
   ), $atts, 'product-listing' );
             ob_start();
        if($atts['products'] != ''){
            $product_codes = $atts['products'];
             $templates = new SW_Template_Loader;
$typePara = '?pageShow=12&f:publishedFlag=1&f:activeFlag=1&orderBy=productName|ASC&f:productCode:eq='.$product_codes;
$products =  $this->productListIntegration($typePara);
         if(isset($products->cookies)){
               if(!isset($_SESSION['cfid']) && !isset($_SESSION['token'])){
                      
         $_SESSION['cfid'] = $products->cookies['cfid'];
         $_SESSION['cftoken'] = $products->cookies['cftoken'];
             }
         }
         if($products){
                $totalPages =  $products->totalPages;
                $paginator = new Paginator(1, $totalPages);
                $links = 3;
                $pagination = $paginator->createLinks($links, 'pagination justify-content-center');
               
           require 'partials/slatwall-public-specific-product-listing.php';
                }
        } else {
             $templates = new SW_Template_Loader;
             $slatwall_brands = new Slatwall_Brands;
             $slatwall_category = new Slatwall_Categoy;
             $slatwall_types = new Slatwall_Type;
             $slatwall_options = new Slatwall_Options;
           
            $typePara = '?pageShow=12&f:publishedFlag=1&f:activeFlag=1&orderBy=productName|ASC';
            
         $products =  $this->productListIntegration($typePara);
         if(isset($products->cookies)){
               if(!isset($_SESSION['cfid']) && !isset($_SESSION['token'])){
                      
         $_SESSION['cfid'] = $products->cookies['cfid'];
         $_SESSION['cftoken'] = $products->cookies['cftoken'];
             }
         }
         $brands = $slatwall_brands->brandListIntegration();
         $options = $slatwall_options->optionListIntegration();
         $categories = $slatwall_category->categoryListIntegration();
         $types = $slatwall_types->producttypeListIntegration();
            if($products){
                $totalPages =  $products->totalPages;
                $paginator = new Paginator(1, $totalPages);
                $links = 3;
                $pagination = $paginator->createLinks($links, 'pagination justify-content-center');
               
           require 'partials/slatwall-public-product-listing.php';
                }
            }
           return ob_get_clean();
        }
        
        public function product_listing_search(){
         //   $currentPage = ( isset( $_GET['currentpage'] ) ) ? $_GET['currentpage'] : 1;

             $templates = new SW_Template_Loader;
             $slatwall_brands = new Slatwall_Brands;
             $slatwall_category = new Slatwall_Categoy;
             $slatwall_types = new Slatwall_Type;
             $slatwall_options = new Slatwall_Options;
            ob_start();
            $search_val = isset($_GET['search'])?$_GET['search']:'';
            
            $typePara = '?pageShow=12&f:publishedFlag=1&f:activeFlag=1&orderBy=productName|ASC';
            if($search_val){
              $search_val_encoded = urlencode($search_val);
                 $typePara .= "&keywords=$search_val_encoded";
            
         $products =  $this->productListIntegration($typePara);
         if(isset($products->cookies)){
               if(!isset($_SESSION['cfid']) && !isset($_SESSION['token'])){
                      
         $_SESSION['cfid'] = $products->cookies['cfid'];
         $_SESSION['cftoken'] = $products->cookies['cftoken'];
             }
         }
         $brands = $slatwall_brands->brandListIntegration();
         $options = $slatwall_options->optionListIntegration();
         $categories = $slatwall_category->categoryListIntegration();
         $types = $slatwall_types->producttypeListIntegration();
            if($products){
                $totalPages =  $products->totalPages;
                $paginator = new Paginator(1, $totalPages);
                $links = 3;
                $pagination = $paginator->createLinks($links, 'pagination justify-content-center');
               
           require 'partials/slatwall-public-product-listing-search.php';
            }
            
            } else {
                echo '<div class="container"><p>Search Value not found</p></div>';
            }
           return ob_get_clean();
        }
        
         public function product_listing_brand(){
         ob_start();
               $urlTitle_slug = get_query_var('bslug');
              
             $templates = new SW_Template_Loader;
             $slatwall_brands = new Slatwall_Brands;
             $slatwall_category = new Slatwall_Categoy;
             $slatwall_types = new Slatwall_Type;
             $slatwall_options = new Slatwall_Options;
            ob_start();
            $typePara = '?pageShow=12&f:publishedFlag=1&f:activeFlag=1&orderBy=productName|ASC&f:brand.urlTitle='.$urlTitle_slug;
         $products =  $this->productListIntegration($typePara);
         if(isset($products->cookies)){
               if(!isset($_SESSION['cfid']) && !isset($_SESSION['token'])){
                      
         $_SESSION['cfid'] = $products->cookies['cfid'];
         $_SESSION['cftoken'] = $products->cookies['cftoken'];
             }
         }
         $brands = $slatwall_brands->brandListIntegration();
         $options = $slatwall_options->optionListIntegration();
         $categories = $slatwall_category->categoryListIntegration();
         $types = $slatwall_types->producttypeListIntegration();
            if($products){
                $totalPages =  $products->totalPages;
                $paginator = new Paginator(1, $totalPages);
                $links = 3;
                $pagination = $paginator->createLinks($links, 'pagination justify-content-center');
 
           require 'partials/slatwall-public-product-listing-brand.php';
            }
           return ob_get_clean();
        }

         public function product_listing_category(){
         ob_start();
               $urlTitle_slug = get_query_var('cslug');
             $templates = new SW_Template_Loader;
             $slatwall_brands = new Slatwall_Brands;
             $slatwall_category = new Slatwall_Categoy;
             $slatwall_types = new Slatwall_Type;
             $slatwall_options = new Slatwall_Options;
            ob_start();
            $typePara = '?pageShow=12&f:publishedFlag=1&f:activeFlag=1&orderBy=productName|ASC&f:categories.urlTitle:eq='.$urlTitle_slug;
         $products =  $this->productListIntegration($typePara);
         if(isset($products->cookies)){
               if(!isset($_SESSION['cfid']) && !isset($_SESSION['token'])){
                      
         $_SESSION['cfid'] = $products->cookies['cfid'];
         $_SESSION['cftoken'] = $products->cookies['cftoken'];
             }
         }
         $brands = $slatwall_brands->brandListIntegration();
         $options = $slatwall_options->optionListIntegration();
         $categories = $slatwall_category->categoryListIntegration();
         $types = $slatwall_types->producttypeListIntegration();
            if($products){
                $totalPages =  $products->totalPages;
                $paginator = new Paginator(1, $totalPages);
                $links = 3;
                $pagination = $paginator->createLinks($links, 'pagination justify-content-center');
 
           require 'partials/slatwall-public-product-listing-category.php';
            }
           return ob_get_clean();
        }
        
         public function product_listing_option(){
         ob_start();
               $urlTitle_slug = get_query_var('oslug');
             $templates = new SW_Template_Loader;
             $slatwall_brands = new Slatwall_Brands;
             $slatwall_category = new Slatwall_Categoy;
             $slatwall_types = new Slatwall_Type;
             $slatwall_options = new Slatwall_Options;
            ob_start();
            $typePara = '?pageShow=12&f:publishedFlag=1&f:activeFlag=1&orderBy=productName|ASC&f:defaultSku.options.optionName='.$urlTitle_slug;
         $products =  $this->productListIntegration($typePara);
         if(isset($products->cookies)){
               if(!isset($_SESSION['cfid']) && !isset($_SESSION['token'])){
                      
         $_SESSION['cfid'] = $products->cookies['cfid'];
         $_SESSION['cftoken'] = $products->cookies['cftoken'];
             }
         }
         $brands = $slatwall_brands->brandListIntegration();
         $options = $slatwall_options->optionListIntegration();
         $categories = $slatwall_category->categoryListIntegration();
         $types = $slatwall_types->producttypeListIntegration();
            if($products){
                $totalPages =  $products->totalPages;
                $paginator = new Paginator(1, $totalPages);
                $links = 3;
                $pagination = $paginator->createLinks($links, 'pagination justify-content-center');
 
           require 'partials/slatwall-public-product-listing-option.php';
            }
           return ob_get_clean();
        }
        
         public function product_listing_type(){
         ob_start();
               $urlTitle_slug = get_query_var('tslug');
             $templates = new SW_Template_Loader;
             $slatwall_brands = new Slatwall_Brands;
             $slatwall_category = new Slatwall_Categoy;
             $slatwall_types = new Slatwall_Type;
             $slatwall_options = new Slatwall_Options;
            ob_start();
            $typePara = '?pageShow=12&f:publishedFlag=1&f:activeFlag=1&orderBy=productName|ASC&f:productType.urlTitle='.$urlTitle_slug;
         $products =  $this->productListIntegration($typePara);
         if(isset($products->cookies)){
               if(!isset($_SESSION['cfid']) && !isset($_SESSION['token'])){
                      
         $_SESSION['cfid'] = $products->cookies['cfid'];
         $_SESSION['cftoken'] = $products->cookies['cftoken'];
             }
         }
         $brands = $slatwall_brands->brandListIntegration();
         $options = $slatwall_options->optionListIntegration();
         $categories = $slatwall_category->categoryListIntegration();
         $types = $slatwall_types->producttypeListIntegration();
            if($products){
                $totalPages =  $products->totalPages;
                $paginator = new Paginator(1, $totalPages);
                $links = 3;
                $pagination = $paginator->createLinks($links, 'pagination justify-content-center');
 
           require 'partials/slatwall-public-product-listing-type.php';
            }
           return ob_get_clean();
        }
        
         public function product_filter_data(){
            $form_data = ( isset( $_POST['form_data'] ) ) ? $_POST['form_data'] : '';
            $sorting = ( isset( $_POST['sorting'] ) ) ? $_POST['sorting'] : '';
            $specific_products = ( isset( $_POST['specific_products'] ) ) ? $_POST['specific_products'] : '';
            $typePara = '';
            $types = array();
            $categories = array();
            $brands = array();
            $options = array();
            foreach($form_data as $data){
                if($data['name'] == 'types'){
                    $types[] = $data['value'];
                }
                if($data['name'] == 'categories'){
                    $categories[] = $data['value'];
                }
                if($data['name'] == 'brands'){
                    $brands[] = $data['value'];
                }
                if($data['name'] == 'options'){
                    $options[] = $data['value'];
                }
                if($data['name'] == 'search'){
                    $search_val = $data['value'];
                }
                if($data['name'] == 'fix_range'){
                    $fix_range = $data['value'];
                }
                if($data['name'] == 'min'){
                    $min = $data['value'];
                }
                if($data['name'] == 'max'){
                    $max = $data['value'];
                }
            }


           if($types){
               $typeString = implode(',', $types);
            $typePara = "&f:productType.productTypeID=$typeString";
           }
           if($brands){
                $brandString = implode(',', $brands);
            $typePara .= "&f:brand.brandID=$brandString";
           }
           if($categories){
                $categoryString = implode(',', $categories);
            $typePara .= "&f:categories.categoryID:eq=$categoryString";
           }
           
           if($options){
                $optionString = implode(',', $options);
            $typePara .= "&f:defaultSku.options.optionID=$optionString";
           }
           
           if($sorting){
               $typePara .= "&orderBy=$sorting";
           }
           if($specific_products){
                               $typePara .= "&f:productCode:eq=$specific_products";
           }
            if($max || $min){
                $calculatedMinPrice = isset($min)?$min:0;
                $calculatedMaxPrice = isset($max)?$max:0;
                $calculatedSalePrice = $calculatedMinPrice.'^'.$calculatedMaxPrice;
                $typePara .= "&r:calculatedSalePrice=$calculatedSalePrice";
            } else if($fix_range){
                 $typePara .= "&r:calculatedSalePrice=$fix_range";
            }
           if($search_val){
              $search_val = urlencode($search_val);
                 $typePara .= "&keywords=$search_val";
            }
            $typePara .= '&pageShow=12&f:publishedFlag=1&f:activeFlag=1';
            $currentPage = ( isset( $_POST['id'] ) ) ? $_POST['id'] : 1;
            $urlPara = "?p:current=$currentPage$typePara";
            $products =  $this->productListIntegration($urlPara); 
            if($products->pageRecords){
                echo '<span id="records_count" data-records="'.$products->recordsCount.'"></span>';
                 $templates = new SW_Template_Loader;
                foreach($products->pageRecords as $product){

                 $templates->set_template_data( $product, 'product' )->get_template_part( 'content', 'product-loop',true );
                }
                $totalPages =  $products->totalPages;
                $paginator = new Paginator($currentPage, $totalPages);
                $links = 3;
              echo $pagination = $paginator->createLinks($links, 'pagination justify-content-center');

            } else {
                echo 'No Result Found';
            }
            die;
        }

        public function product_details(){
               ob_start();
               $product_slug = get_query_var('pslug');
               if($product_slug){
                   global $product_single_data;
            
              $product = $product_single_data->pageRecords[0];
              if(isset($product_single_data->cookies)){
               if(!isset($_SESSION['cfid']) && !isset($_SESSION['token'])){                     
                $_SESSION['cfid'] = $product_single_data->cookies['cfid'];
                $_SESSION['cftoken'] = $product_single_data->cookies['cftoken'];
                
                    }
                }
              if($product){
                  $templates = new SW_Template_Loader;
          
                  $product_id = $product->productID;
                  $product_reviews = new Slatwall_Reviews();
                  $reviews = $product_reviews->getProductReviews($product_id);
                  $related_products = new Slatwall_Related_Product();
                  $related_product_data = $related_products->getRelatedProducts($product_id);
                  $sku = new Slatwall_Sku();
                  $product_sku = $sku->getProductSku($product_id);
                  $cart = new Slatwall_Cart();
                $token = isset($_SESSION['token'])?$_SESSION['token']:'';
                $result = $cart->get_cart($token);
                $cart_data = json_decode($result);
                
                  require 'partials/slatwall-public-product-details.php';
              }
                }
                return ob_get_clean();
        }

        public function my_account(){
               ob_start();
               $templates = new SW_Template_Loader;
               $account = get_query_var('maslug');
               $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 
                $uri_segments = explode('/', $uri_path);
                if((in_array('order-details',$uri_segments) || in_array('cart-details',$uri_segments))&& isset($_SESSION['token']))
                {
                    $orderId=$uri_segments[count($uri_segments)-2];
                    $order_details=$this->order_details($_SESSION['token'],array('orderID' =>$orderId,'returnJSONObjects' => 'account'));
                } 
               if($account == 'logout' && isset($_SESSION['token'])){
                  $this->logout($_SESSION['token']);

               }
               if(isset($_POST['account']) && $_POST['account'] == 'register'){
               $registration = new Slatwall_Registration($this->slatwall, $this->version);
               $_POST['returnTokenFlag'] = 1;
               $registration_data = $registration->registration($_POST);
              //  $registration_array = json_decode($registration_data);
               if(in_array('public:account.create',$registration_array->successfulActions)){
                   echo 'Registration success';
                       $_SESSION['token'] = $registration_data->token;
                        unset($_SESSION['cfid']);
                        unset($_SESSION['cftoken']);

                       $_SESSION['login_status'] = 1;
                        wp_redirect(get_site_url().'/'.MY_ACCOUNT_SLUG.'/dashboard');
               } else {
                   echo 'Registration Failed';
               }
               } else if(isset($_POST['account']) && $_POST['account'] == 'forget-password'){
                     $forget = new Slatwall_Login($this->slatwall, $this->version);
                    $result = $forget->forget_password($_POST);

               } else if(isset($_POST['account']) && $_POST['account'] == 'login'){
                   $login = new Slatwall_Login($this->slatwall, $this->version);
                   $login_status = $login->login($_POST);
                   $login_array = $login_status;
                   if($login_array && isset($login_array->token)){

                       $_SESSION['token'] = $login_array->token;
                        unset($_SESSION['cfid']);
                        unset($_SESSION['cftoken']);
                        unset($_SESSION['JSESSIONID']);
                       $_SESSION['login_status'] = 1;
                        wp_redirect(get_site_url().'/'.MY_ACCOUNT_SLUG.'/dashboard');
                 
                   }
               } else if(isset($_POST['account']) && $_POST['account'] == 'profile_update' && isset($_SESSION['token'])){

               unset($_POST['account']);
                   $update_profile = $this->user_profile_update($_SESSION['token'],$_POST);
                  
               }
                if(isset($_SESSION['token'])){
                 $account_details = $this->account($_SESSION['token']);
                 $account_id = $account_details->accountID;

                    if(!$account_id){
                     $this->logout($_SESSION['token']);
                     
                    } else {
                        $request = array('accountID' => $account_id,'pageRecordsShow' => 2000,'currentPage' => 1,'orderBy','createdDateTime|DESC');
                      $all_orders = $this->all_orders($_SESSION['token'], $request);
                   
                      $all_cart_quotes = $this->all_cart_quotes($_SESSION['token'], $request);
                      

                    }
               }
               $countries_data = $this->get_countries();
               $countries_data_obj = json_decode($countries_data);
               $countries = $countries_data_obj->countryCodeOptions;
               $stateCode = new Slatwall_stateCode($this->slatwall, $this->version);
               $parameter = '?countryCode=US';
               $default_state_code = json_decode($stateCode->stateCode($parameter));
               require 'partials/slatwall-public-my-account.php';
               return ob_get_clean();
        }
        private function logout($token,$redirect = true){
            $logout_class = new Slatwall_Logout($this->slatwall, $this->version);
                  $result = $logout_class->logout($token);
                  if($result){
                    $result = json_decode($result);
                  }
                   if(in_array('public:account.logout', $result->successfulActions)){
                        unset($_SESSION['token']);
                        unset($_SESSION['cfid']);
                        unset($_SESSION['JSESSIONID']);
                        session_destroy();
                        if($redirect){
                        wp_redirect(get_site_url().'/'.MY_ACCOUNT_SLUG);
                        }
                    } else {

                        wp_redirect(get_site_url());
                    }
        }

        private function order_details($token,$request){
            $account_class = new Slatwall_Account($this->slatwall, $this->version);
            $order_detail = $account_class->get_order_details($token,$request);
            if($order_detail){
                return json_decode($order_detail);
            } else {
                return false;
            }
        }

        private function account($token){
            $account_class = new Slatwall_Account($this->slatwall, $this->version);
            $account = $account_class->get_account($token);

            if($account){
                return json_decode($account);
            } else {
                return false;
            }
        }

        private function all_orders($token,$request){
             $account_class = new Slatwall_Account($this->slatwall, $this->version);
            $all_orders = $account_class->get_all_orders($token,$request);
            if($all_orders){
                return json_decode($all_orders);
            } else {
                return false;
            }
        }


        private function all_cart_quotes($token,$request){
            $account_class = new Slatwall_Account($this->slatwall, $this->version);
           $all_orders = $account_class->get_all_cart_quotes($token,$request);
           if($all_orders){
               return json_decode($all_orders);
           } else {
               return false;
           }
       }

       private function all_order_history($token,$request){
        $account_class = new Slatwall_Account($this->slatwall, $this->version);
       $all_orders = $account_class->get_all_order_history($token,$request);
       if($all_orders){
           return json_decode($all_orders);
       } else {
           return false;
       }
   }


        private function user_profile_update($token, $request){
             $account_class = new Slatwall_Account($this->slatwall, $this->version);
             $profile_update = $account_class->update_profile($token, $request);

             if($profile_update){

                return json_decode($profile_update);
            } else {
                return false;
            }
        }



       public function get_sku_data(){
           $id = isset($_POST['id'])?$_POST['id']:'';
           $sku = new Slatwall_Sku();
            $result = $sku->getSpecificSku($id);
            if($result){
            echo json_encode($result->pageRecords[0]);
            }
            die;
       }

       public function add_to_cart(){
           $id = isset($_POST['id'])?$_POST['id']:'';
           $qty = isset($_POST['qty'])?$_POST['qty']:1;
           $cart = new Slatwall_Cart();
           $request = array('skuID' => $id,'quantity' => $qty,'returnJSONObjects' => 'cart');
           $token = isset($_SESSION['token'])?$_SESSION['token']:'';
           
           $cart_result = $cart->add_to_cart($token,$request);
           $result_json = json_decode($cart_result);
           if(isset($result_json->token) && $result_json->token !== ""){
               $_SESSION['token'] = $result_json->token;
           }
           $_SESSION['JSESSIONID'] = $result_json->cookies->JSESSIONID;
           echo json_encode($result_json);

            die;
       }

       public function shopping_cart(){
           ob_start();
           $cart = new Slatwall_Cart();
           $token = isset($_SESSION['token'])?$_SESSION['token']:'';
           $result = $cart->get_cart($token);
           $cart_data = json_decode($result);


           require 'partials/slatwall-public-shopping-cart.php';
            return ob_get_clean();
       }


       public function remove_cart_item(){
           $token = isset($_SESSION['token'])?$_SESSION['token']:'';
           $item_id = $_POST['id'];
           $request = array('orderItemID' => $item_id);
           $request['returnJSONObjects'] = 'cart';
            $cart = new Slatwall_Cart();
           $result = $cart->remove_cart_item($token, $request);
           echo $result;
           die;

       }

       public function clear_cart(){
           $token = isset($_SESSION['token'])?$_SESSION['token']:'';
            $cart = new Slatwall_Cart();
            $request['returnJSONObjects'] = 'cart';
           $result = $cart->clear_cart($token,$request);
           $_SESSION['token'] = json_decode($result)->token;
           echo $result;
           die;

       }
       
        public function reopen_cart(){
           $token = isset($_SESSION['token'])?$_SESSION['token']:'';
            $cart = new Slatwall_Cart();
            $request['returnJSONObjects'] = 'cart';
            $request['orderID'] = $_POST['orderID'];
           $result = $cart->change_order($token,$request);
           echo $result;
           die;

       }

       public function update_cart_item(){
              $token = isset($_SESSION['token'])?$_SESSION['token']:'';
                 $sku_id = $_POST['id'];
                  $qty = $_POST['qty'];
                  $request = array('orderItem.sku.skuID' => $sku_id, 'orderItem.qty' => $qty);
                  $request['returnJSONObjects'] = 'cart';
                  $cart = new Slatwall_Cart();
                 echo $result = $cart->update_cart($token, $request);
                 die;

       }

       public function add_promo(){
            $cart = new Slatwall_Cart();
           $token = isset($_SESSION['token'])?$_SESSION['token']:'';
           $form_data = $_POST['form_data'];
           $request = array_combine(array_column($form_data, 'name'), array_column($form_data, 'value'));
            if($request){
                $request['returnJSONObjects'] = 'cart';
             $promo_apply_result = $cart->add_promo($token, $request);
             echo $promo_apply_result;
             die;
             }
       }

       public function remove_promo(){
           $token = isset($_SESSION['token'])?$_SESSION['token']:'';
              $promo_code = $_POST['id'];
              if($promo_code){
               $request = array('promotionCode' => $promo_code,'returnJSONObjects' => 'cart');
               $cart = new Slatwall_Cart();
                 echo $result = $cart->remove_promo($token, $request);
              }
                 die;

       }

       public function checkout(){
           ob_start();
           $templates = new SW_Template_Loader;
         $token = isset($_SESSION['token'])?$_SESSION['token']:'';
         $this->auth_check();
           $account_class = new Slatwall_Account($this->slatwall, $this->version);
           $request = array('returnJSONObjects','account');
           $account = $account_class->get_account($token,$request);
           $countries_data = $this->get_countries();
           $cart = new Slatwall_Cart();
           $cart_data = $cart->get_cart($token);
           $checkout = new Slatwall_Checkout();
           $availale_payment_method = $checkout->get_availale_payment_method($token);
           $availale_shipping_method = $checkout->get_availale_shipping_method($token);
           $stateCode = new Slatwall_stateCode($this->slatwall, $this->version);
               $parameter = '?countryCode=US';
               $default_state_code = json_decode($stateCode->stateCode($parameter));
            require 'partials/slatwall-public-checkout.php';

            return ob_get_clean();
       }


       public function add_billing_address(){
         $form_data = $_POST['form_data'];
         if(isset($_SESSION['token'])){
        $request = array_combine(array_column($form_data, 'name'), array_column($form_data, 'value'));
           $request['returnJSONObjects'] = 'account';
        $checkout = new Slatwall_Checkout();

        echo $result = $checkout->add_billing_address($_SESSION['token'], $request);

        die;
       }
       }

       public function add_shipping_address(){
          $form_data = $_POST['form_data'];
          $request = array();
         $account_address_id = $_POST['account_address_id'];
         $shipping_id = $_POST['shipping_id'];
          $checkout = new Slatwall_Checkout();
         if(isset($_SESSION['token'])){
             $request['fulfillmentID'] = $_POST['order_fulfillment_id'];
             $request['returnJSONObjects'] = 'cart';
             $request['shippingMethodID'] = $shipping_id;

             if($account_address_id){
               $request['accountAddressID'] = $account_address_id;
                echo $result = $checkout->add_shipping_by_account_address($_SESSION['token'], $request);
               } else {

                $request_form = array_combine(array_column($form_data, 'name'), array_column($form_data, 'value'));
                $request_all = array_merge($request,$request_form);
                $account = new Slatwall_Account($this->slatwall, $this->version);
                $account->add_account_address($_SESSION['token'], $request_all);
                echo $result = $checkout->add_shipping_address($_SESSION['token'], $request_all);
                 
                }
                $cart_order = json_decode($result);
                $_SESSION['slawall_current_order_id'] = $cart_order->cart->orderID;
            }
            die;
       }
       
       public function pickup(){
          $checkout = new Slatwall_Checkout();
          $request = array('value' => DEFAULT_LOCATION,'returnJSONObjects' => 'cart');
          
          echo $result = $checkout->add_pickup_only($_SESSION['token'], $request);
            die;
       }
       
       public function pickup_shipping(){
           $cart = new Slatwall_Cart();
           $checkout = new Slatwall_Checkout();
           $token = $_SESSION['token'];              
           $add_pickup_location = $_POST['add_pickup_location'];
           $request = array('returnJSONObjects' => 'cart','orderItemIDList' => $_POST['sku_ids'],'fulfillmentMethodID' => $_POST['fulfillment_ids']);
           $result = $cart->change_order_fulfillment($token, $request);
           $availale_shipping_method = $checkout->get_availale_shipping_method($token);
            $shipping_methods = json_decode($availale_shipping_method);
            $cart_object->cart_data = json_decode($result);
            $cart_object->shipping_methods = $shipping_methods;
            if($add_pickup_location == true){
          $request_pickup = array('value' => DEFAULT_LOCATION,'returnJSONObjects' => 'cart');
          
          $result_pickup = $checkout->add_pickup_only($token, $request_pickup);
            }
            echo json_encode($cart_object);
          die;
       }

       public function add_order_payment(){
         $form_data = $_POST['form_data'];
         $same_shipping = $_POST['same_shipping'];
         $account_address_id = $_POST['account_address_id'];
         $token = $_SESSION['token'];
         if(isset($token)){
        $request = array_combine(array_column($form_data, 'name'), array_column($form_data, 'value'));
         $cart = new Slatwall_Cart();
           $cart_data_json = $cart->get_cart($token);
           $cart_data = json_decode($cart_data_json);
        if($same_shipping){
      
          $shipping_address = isset($cart_data->cart->orderFulfillments[0]->shippingAddress)?$cart_data->cart->orderFulfillments[0]->shippingAddress:'';
       $request['newOrderPayment.billingAddress.name'] = $shipping_address->name;
       $request['newOrderPayment.billingAddress.streetAddress'] = $shipping_address->streetAddress;
       $request['newOrderPayment.billingAddress.street2Address'] = $shipping_address->street2Address;
       $request['newOrderPayment.billingAddress.city'] = $shipping_address->city;
       $request['newOrderPayment.billingAddress.statecode'] = $shipping_address->stateCode;
       $request['newOrderPayment.billingAddress.postalcode'] = $shipping_address->postalCode;
       $request['newOrderPayment.billingAddress.countrycode'] = $shipping_address->countrycode;
        } else {
            $account_class = new Slatwall_Account($this->slatwall, $this->version);
           $account = $account_class->get_account($token);
           $account = json_decode($account,true);
           $account_address = $account['accountAddresses'];
           $account_address = array_filter($account_address, function($ar)  use ($account_address_id)  {
                return ($ar['accountAddressID'] == $account_address_id);
            });
            $key_value = array_key_first($account_address);
            if(isset($account_address[$key_value])){
           $request['newOrderPayment.billingAddress.name'] = $account_address[$key_value]['accountAddressName'];
       $request['newOrderPayment.billingAddress.streetAddress'] = $account_address[$key_value]['address']['streetAddress'];
       $request['newOrderPayment.billingAddress.street2Address'] = $account_address[$key_value]['address']['street2Address'];
       $request['newOrderPayment.billingAddress.city'] = $account_address[$key_value]['address']['city'];
       $request['newOrderPayment.billingAddress.statecode'] = $account_address[$key_value]['address']['stateCode'];
       $request['newOrderPayment.billingAddress.postalcode'] = $account_address[$key_value]['address']['postalCode'];
       $request['newOrderPayment.billingAddress.countrycode'] = $account_address[$key_value]['address']['countryCode'];
            }
        }
      // $request['newOrderPayment.billingAddress.amount'] = $cart_data->cart->total;
       $_SESSION['slawall_current_order_id'] = $cart_data->cart->orderID;
       $request['returnJSONObjects'] = 'cart';
       unset($request['order_type']);
          $checkout = new Slatwall_Checkout();
        echo $result = $checkout->add_order_payment($token, $request);
        die;
       }
       }

       public function user_register(){

           $registration = new Slatwall_Registration($this->slatwall, $this->version);
           $form_data = $_POST['form_data'];
             $request = array_combine(array_column($form_data, 'name'), array_column($form_data, 'value'));
             $request['returnTokenFlag'] = 1;
           //  dd($request);
               $registration_data = $registration->registration($request);
            //    echo $registration_data;
                $login_array = $registration_data;
                   if($login_array && $login_array->token){
                       $_SESSION['token'] = $registration_data->token;
                       unset($_SESSION['cfid']);
                       unset($_SESSION['cftoken']);
                       unset($_SESSION['JSESSIONID']);

                       $_SESSION['login_status'] = 1;

                       $cart = new Slatwall_Cart();
                        $token = isset($_SESSION['token'])?$_SESSION['token']:'';
                        $cart_result = $cart->get_cart($token);
                        $cart_data = json_decode($cart_result);
                         $account_class = new Slatwall_Account($this->slatwall, $this->version);
                         $account = $account_class->get_account($token);
                         $account = json_decode($account);
                         $account_address = $account->accountAddresses;
                         $checkout = new Slatwall_Checkout();
                         $availale_shipping_method = $checkout->get_availale_shipping_method($token);
                         $shipping_methods = json_decode($availale_shipping_method);
                         unset($login_array->cookies);
                         $login_array->cart_data = $cart_data;
                           $login_array->account_address = $account_address;
                           $login_array->shipping_methods = $shipping_methods;
                   }

                   echo json_encode($login_array);
               die;
       }

       public function user_login(){
            $login = new Slatwall_Login($this->slatwall, $this->version);
            $form_data = $_POST['form_data'];
             $request = array_combine(array_column($form_data, 'name'), array_column($form_data, 'value'));
               $request['returnJSONObjects'] = 'cart';
                   $login_status = $login->login($request);
                   $login_array = $login_status;
                   if($login_array && $login_array->token){
                        $_SESSION['token'] = $login_array->token;
                        unset($_SESSION['cfid']);
                        unset($_SESSION['cftoken']);
                        unset($_SESSION['JSESSIONID']);

                       $_SESSION['login_status'] = 1;

                       $cart = new Slatwall_Cart();
                        $token = isset($_SESSION['token'])?$_SESSION['token']:'';
                        $cart_result = $cart->get_cart($token);
                        $cart_data = json_decode($cart_result);
                         $account_class = new Slatwall_Account($this->slatwall, $this->version);
                         $account = $account_class->get_account($token);
                         $account = json_decode($account);
                         $account_address = $account->accountAddresses;
                         $checkout = new Slatwall_Checkout();
                         $availale_shipping_method = $checkout->get_availale_shipping_method($token);
                         $shipping_methods = json_decode($availale_shipping_method);
                         unset($login_status->cookies);
                         $login_status->cart_data = $cart_data;
                           $login_status->account_address = $account_address;
                           $login_status->shipping_methods = $shipping_methods;
                   }

                   echo json_encode($login_status);
                   die;
       }

       private function auth_check(){
           if(isset($_SESSION['token'])){
                 $account_details = $this->account($_SESSION['token']);
                 $account_id = $account_details->accountID;
                    if(!$account_id){
                     $this->logout($_SESSION['token'],false);//session id , redirect after logout true,false (defaul true)
                     return false;
                    } else {
                        return true;
                    }
               } else {
                   return false;
               }
       }

       public function place_order(){
           $this->account($_SESSION['token']);
           if(isset($_SESSION['token'])){
               $checkout = new Slatwall_Checkout();
               $request = array('returnJSONObjects' => 'account');
             
             $result = $checkout->place_order($_SESSION['token'],$request);
             $order_placed = json_decode($result);
             $_SESSION['token'] = $order_placed->token;
             if($order_placed->successfulActions > 0){
             $order_details=$this->order_details($_SESSION['token'],array('orderID' =>$_SESSION['slawall_current_order_id']));
           
             }
             $response = array('order_placed' => $order_placed,'order_id' => $order_details->orderDetails->orderInfo[0]->orderNumber);
             echo json_encode($response);
           }
           die;
       }


       public function add_account_address(){

        $form_data = $_POST['form_data'];
         $checkout = new Slatwall_Account($this->slatwall, $this->version);
        if(isset($_SESSION['token'])){

               $request = array_combine(array_column($form_data, 'name'), array_column($form_data, 'value'));
               $request['company'] = stripslashes($request['company']);
               $request['returnJSONObjects'] = 'account';

               echo $result = $checkout->add_account_address($_SESSION['token'], $request);

      }
      die;
      }

      public function edit_account_address(){

        $form_data = $_POST['form_data'];
        $addressID = $_POST['addressID'];
         $checkout = new Slatwall_Account($this->slatwall, $this->version);
        if(isset($_SESSION['token'])){

               $request = array_combine(array_column($form_data, 'name'), array_column($form_data, 'value'));
               $request['company'] = stripslashes($request['company']);
               $request['accountAddressID'] = $addressID;
               $request['returnJSONObjects'] = 'account';
               echo $result = $checkout->edit_account_address($_SESSION['token'], $request);

      }
      die;
      }


      public function delete_account_address(){

        $form_data = $_POST['form_data'];

         $checkout = new Slatwall_Account($this->slatwall, $this->version);
        if(isset($_SESSION['token'])){

               $request = $form_data;
               $request['returnJSONObjects'] = 'account';

               echo $result = $checkout->delete_account_address($_SESSION['token'], $request);

      }
      die;
      }

      public function set_primary_address(){

        $form_data = $_POST['form_data'];

         $checkout = new Slatwall_Account($this->slatwall, $this->version);
        if(isset($_SESSION['token'])){

               $request = $form_data;

               echo $result = $checkout->set_primary_address($_SESSION['token'], $request);

      }
      die;
      }


      public function delete_account_email(){

        $form_data = $_POST['form_data'];

         $checkout = new Slatwall_Account($this->slatwall, $this->version);
        if(isset($_SESSION['token'])){

               $request = $form_data;
               $request['returnJSONObjects'] = 'account';

               echo $result = $checkout->delete_account_email($_SESSION['token'], $request);

      }
      die;
      }

      public function set_primary_email(){

        $form_data = $_POST['form_data'];
         $checkout = new Slatwall_Account($this->slatwall, $this->version);
        if(isset($_SESSION['token'])){

               $request = $form_data;
               echo $result = $checkout->set_primary_email($_SESSION['token'], $request);
      }
      die;
      }

      public function add_email_address(){
          $form_data = $_POST['form_data'];
          $request = array_combine(array_column($form_data, 'name'), array_column($form_data, 'value'));
         $checkout = new Slatwall_Account($this->slatwall, $this->version);
         if(isset($_SESSION['token'])){
            echo $result = $checkout->add_email_address($_SESSION['token'], $request);
         }

         die;

      }

      public function delete_account_phone(){

        $form_data = $_POST['form_data'];

         $checkout = new Slatwall_Account($this->slatwall, $this->version);
        if(isset($_SESSION['token'])){

               $request = $form_data;
               $request['returnJSONObjects'] = 'account';

               echo $result = $checkout->delete_account_phone($_SESSION['token'], $request);

      }
      die;
      }

      public function set_primary_phone(){

        $form_data = $_POST['form_data'];

         $checkout = new Slatwall_Account($this->slatwall, $this->version);
        if(isset($_SESSION['token'])){

               $request = $form_data;

               echo $result = $checkout->set_primary_phone($_SESSION['token'], $request);


      }
      die;
      }

      public function add_account_phone_number(){

        $phoneNumber = $_POST['phoneNumber'];

         $checkout = new Slatwall_Account($this->slatwall, $this->version);
        if(isset($_SESSION['token'])){
               $request = array('phoneNumber' => $phoneNumber);
               echo $result = $checkout->add_phone($_SESSION['token'], $request);
      }
      die;
      }


      public function change_password_account(){
        $form_data = $_POST['form_data'];
         $checkout = new Slatwall_Account($this->slatwall, $this->version);
        if(isset($_SESSION['token'])){

               $request = array_combine(array_column($form_data, 'name'), array_column($form_data, 'value'));
               $request['returnJSONObjects'] = 'account';
               echo $result = $checkout->change_password_account($_SESSION['token'], $request);

      }
      die;
   }

   public function forget_password_account(){
    $form_data = $_POST['form_data'];
     $resetPassword = new Slatwall_Login($this->slatwall, $this->version);
           $request = array_combine(array_column($form_data, 'name'), array_column($form_data, 'value'));
           $request['returnJSONObjects'] = 'account';
          // $request['swprid'] = '2c91808471403dfc01714910da83017173edb93e3b02cf3b6575d515fd2cbdce';
           echo $result = $resetPassword->forget_password( $request);
           die;
}

   public function reset_password_account(){
    $form_data = $_POST['form_data'];
     $resetPassword = new Slatwall_Login($this->slatwall, $this->version);
           $request = array_combine(array_column($form_data, 'name'), array_column($form_data, 'value'));
          // $request['swprid'] = '2c91808471403dfc01714910da83017173edb93e3b02cf3b6575d515fd2cbdce';
           echo $result = $resetPassword->reset_password_account( $request);
           die;
}

   public function profile_update_account(){
    $form_data = $_POST['form_data'];
     $checkout = new Slatwall_Account($this->slatwall, $this->version);
    if(isset($_SESSION['token'])){

           $request = array_combine(array_column($form_data, 'name'), array_column($form_data, 'value'));
           $request['company'] = stripslashes($request['company']);
           $request['returnJSONObjects'] = 'account';
           echo $result = $checkout->update_profile($_SESSION['token'], $request);

  }
  die;
}


   public function address_state_code(){
    $stateCode = new Slatwall_stateCode($this->slatwall, $this->version);
    $form_data = $_POST['form_data'];
     $parameter = '?countryCode='.$form_data;
          echo  $state_code = $stateCode->stateCode($parameter);
           die;
}

        public function get_countries(){
            $stateCode = new Slatwall_stateCode($this->slatwall, $this->version);
           $countries = $stateCode->countryCode();
           return $countries;
        }

        public function mini_cart(){
            ob_start();
           $cart = new Slatwall_Cart();
           $token = isset($_SESSION['token'])?$_SESSION['token']:'';
           $result = $cart->get_cart($token);
           $cart_data = json_decode($result);
           $templates = new SW_Template_Loader;
           $templates->set_template_data( $cart_data, 'cart_data' )->get_template_part( 'content', 'mini-cart',true );
            return ob_get_clean();
        }
        
        public function product_search_form(){
            ob_start();
           $templates = new SW_Template_Loader;
           $templates->get_template_part( 'content', 'product-search-form',true );
            return ob_get_clean();
        }
        public function header_append_data(){
            
           $cart = new Slatwall_Cart();
           $token = isset($_SESSION['token'])?$_SESSION['token']:'';
           $result = $cart->get_cart($token);
           $cart_data = json_decode($result);
           $templates = new SW_Template_Loader;
           $templates->set_template_data( $cart_data, 'cart_data' )->get_template_part( 'content', 'mini-cart',true );
           $templates->get_template_part( 'content', 'product-search-form',true );
            die;
        }
        
        public function slatwall_wp_title_filter($title){    
            $product_slug = get_query_var('pslug');
            if($product_slug != ''){
                global $product_single_data; 
                $urlPara = "?f:urlTitle=$product_slug";
            $product_single_data =  $this->productListIntegration($urlPara);
            $product_name = $product_single_data->pageRecords[0]->productName;
            $site_title = get_bloginfo();
                $title = $product_name.' - '.$site_title;
            }
            return $title;
        }


        public function wp_head_script(){
            $_SESSION['added_into_cart'] = 0;
               $_SESSION['added_into_cart_error'] = 0;
            if(isset($_POST['add_to_cart']) && $_POST['add_to_cart'] === 'submit'){
                       unset($_POST['add_to_cart']);
                       $request = $_POST;
           $token = isset($_SESSION['token'])?$_SESSION['token']:'';
           $cart = new Slatwall_Cart();
           $request['returnJSONObjects'] = 'cart';
           $cart_result = $cart->add_to_cart($token,$request);
           $cart_added = json_decode($cart_result);
           if(isset($cart_added->successfulActions[0]) && $cart_added->successfulActions[0] == 'public:cart.addOrderItem'){
               if(isset($cart_added->token)){
                    $_SESSION['token'] = $cart_added->token;
               }
               $_SESSION['added_into_cart'] = 1;
               $_SESSION['added_into_cart_error'] = 0;
           } else {
               $_SESSION['added_into_cart_error'] = 1;
               $_SESSION['added_into_cart'] = 0;
           }
                   }
            ?>
            <script>
            localStorage.setItem("SITEURL","<?php echo get_site_url(); ?>");
            localStorage.setItem("PRODUCT_SINGLE_SLUG","<?php echo PRODUCT_SINGLE_SLUG; ?>");
            localStorage.setItem("DOMAIN","<?php echo DOMAIN; ?>");
            localStorage.setItem("CART","<?php echo CART; ?>");
            </script>
            <?php
        }



}
