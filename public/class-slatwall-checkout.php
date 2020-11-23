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


class Slatwall_Checkout extends Slatwall_Integration{

        
        private $addBillingAddress = '/api/scope/addBillingAddress/';
        
        private $addBillingByAccountAddress = '/api/scope/addBillingAddressUsingAccountAddress/';
        
        private $addOrderShippingAddress = '/api/scope/addOrderShippingAddress/';
        
        private $addPickupFulfillmentLocation = '/api/scope/addPickupFulfillmentLocation/';
        
        private $addOrderShippingByAccountAddress = '/api/scope/addShippingAddressUsingAccountAddress/';
        
        private $getShippingMethodOptions = '/api/scope/getShippingMethodOptions/';
        
        private $getAvailableShippingMethods = '/api/scope/getAvailableShippingMethods/';
        
        private $getAvailablePaymentMethods = '/api/scope/getAvailablePaymentMethods/';
        
        private $addOrderPayment = '/api/scope/addOrderPayment/';
        
        private $placeOrder = '/api/scope/placeOrder/';
        
//        private $cfid;
//        
//        private $cftoken;
//        
//        private $JSESSIONID;
//        
//        private $SLATWALL_NPSID;
//        
//        private $SLATWALL_PSID;
//        
//        private $cookies;
        
        
        public function __construct() {
//             $this->cfid = $_SESSION['cfid']??'';
//            $this->cftoken = $_SESSION['cftoken']??'';
//            $this->JSESSIONID = $_SESSION['JSESSIONID']??'';
//            $this->SLATWALL_NPSID = $_SESSION['SLATWALL-NPSID']??'';
//            $this->SLATWALL_PSID = $_SESSION['SLATWALL-PSID']??'';
//            $this->cookies = "Cookie: PRINTQUEUE=; cfid=$this->cfid; cftoken=$this->cftoken; SLATWALL-NPSID=$this->SLATWALL_NPSID; SLATWALL-PSID=$this->SLATWALL_PSID; JSESSIONID=$this->JSESSIONID";
//	           
        }
        
       public function add_billing_address($token,$request){
            $result =  $this->userAccountPost($this->addBillingAddress,$token,$request,'POST');
           return $result;
       }
       
        public function add_billing_by_account_address($token,$request){
            $result =  $this->userAccountPost($this->addBillingByAccountAddress,$token,$request,'POST');
           return $result;
       }
       
       public function add_shipping_address($token,$request){
           $result =  $this->userAccountPost($this->addOrderShippingAddress,$token,$request, 'POST');
           return $result;
       }
       
       public function add_shipping_by_account_address($token,$request){
           $result =  $this->userAccountPost($this->addOrderShippingByAccountAddress,$token,$request, 'POST');
           return $result;
       }
       
       public function add_pickup_only($token,$request){
           $result =  $this->userAccountPost($this->addPickupFulfillmentLocation,$token,$request, 'POST');
           return $result;
       }
       
        public function get_shipping_method($token){
           $result =  $this->userAccountGet($this->getShippingMethodOptions,$token,array(),'GET');
            return $result;
       }
       
       public function get_availale_shipping_method($token){
            $result =  $this->userAccountGet($this->getAvailableShippingMethods,$token,array(),'GET');
           return $result;
       }
       
       public function get_availale_payment_method($token){
            $result =  $this->userAccountGet($this->getAvailablePaymentMethods,$token,array(),'GET');
           return $result;
       }
       
        
       public function add_order_payment($token,$request){
         
           $result =  $this->userAccountPost($this->addOrderPayment,$token,$request,'POST');
           return $result;
       }
       
        public function place_order($token,$request){
            
            $result =  $this->userAccountPost($this->placeOrder,$token,$request,'POST');
           return $result;
       }
        
}
