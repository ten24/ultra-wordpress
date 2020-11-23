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


class Slatwall_Cart extends Slatwall_Integration{

        
        private $url = '/api/scope/addOrderItem/';
        
        private $get_cart = '/api/scope/getCartData/';
        
        private $add_promo_url = '/api/scope/addPromotionCode/';
        
        private $get_applied_code = '/api/scope/getAppliedPromotionCodes/';
        
        private $remove_item = '/api/scope/removeOrderItem/';
        
        private $update_item = '/api/scope/updateOrderItemQuantity/';
        
        private $change_order_fulfillment = '/api/scope/changeOrderFulfillment';
        
        private $remove_promo = '/api/scope/removePromotionCode/';
        
        private $clear_cart = '/api/scope/clearOrder/';
        
        private $change_order = '/api/scope/changeOrder/';
        
        private $cfid;
        
        private $cftoken;
        
        private $JSESSIONID;
        
//        private $SLATWALL_NPSID;
//        
//        private $SLATWALL_PSID;
        
        private $cookies;



        /**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
        
        public function __construct() {
            $this->cfid = $_SESSION['cfid']??'';
            $this->cftoken = $_SESSION['cftoken']??'';
            $this->JSESSIONID = $_SESSION['JSESSIONID']??'';
//            $this->SLATWALL_NPSID = $_SESSION['SLATWALL-NPSID']??'';
//            $this->SLATWALL_PSID = $_SESSION['SLATWALL-PSID']??'';
            $this->cookies = "Cookie: PRINTQUEUE=; cfid=$this->cfid; cftoken=$this->cftoken; JSESSIONID=$this->JSESSIONID";
	}
	
        public function add_to_cart($token = '',$request = array()){
        
          $result = $this->userAccountPost($this->url,$token,$request,'POST',$this->cookies);
            return $result;
        }
        
        public function get_cart($token = ''){
          
           $result =  $this->userAccountGet( $this->get_cart,$token, array('returnJSONObjects' => 'cart'),'GET',$this->cookies);
          
            return $result;
        }
        
         public function add_promo($token = '',$request = array()){
            $result =  $this->userAccountPost($this->add_promo_url,$token,$request,'POST',$this->cookies);
           return $result;
        }
        
        public function get_applied_promo($token = ''){
           $result = $this->userAccountGet($this->get_applied_code,$token, array(), 'GET',$this->cookies);
           return $result;
         }
         
         public function remove_cart_item($token = '',$request = array()){
          $result =  $this->userAccountPost($this->remove_item,$token,$request,'POST',$this->cookies);
           return $result;
             
         }
         
          public function clear_cart($token = '',$request = array()){
              $result =  $this->userAccountPost($this->clear_cart,$token,$request,'POST',$this->cookies);
           return $result;
             
         }
         
         public function change_order($token = '',$request = array()){
              $result =  $this->userAccountPost($this->change_order,$token,$request,'POST',$this->cookies);
           return $result;
             
         }
         
         public function update_cart($token = '',$request = array()){
            $result =  $this->userAccountPost($this->update_item,$token,$request,'POST',$this->cookies);
           return $result;
           
         }
         
          public function change_order_fulfillment($token = '',$request = array()){
            $result =  $this->userAccountPost($this->change_order_fulfillment,$token,$request,'POST',$this->cookies);
           return $result;
           
         }
         
         public function remove_promo($token = '',$request = array()){
             $result =  $this->userAccountPost($this->remove_promo,$token,$request,'POST',$this->cookies);
           return $result;
           
         }
         
         
       
       
        
}
