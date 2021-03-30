<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.slatwallcommerce.com/
 * @since      1.0.0
 *
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/public
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
 */


class Slatwall_Account extends Slatwall_Integration{

        private $url = '/api/scope/getAccount/';

        private $update_url = '/api/scope/updateAccount/';

        private $get_all_orders = '/api/scope/getAllOrdersOnAccount/';

        private $get_all_cart_quotes = '/api/scope/getAllCartsAndQuotesOnAccount/';

        private $get_all_order_history = '/api/scope/getAllOrderDeliveryOnAccount/';

        private $addAdressAccount = '/api/scope/addNewAccountAddress/';

        private $get_order_details = '/api/scope/getOrderDetails';

        private $duplicateOrder = '/api/scope/duplicateOrder';

        private $editAdressAccount = '/api/scope/updateAccountAddress/';

        private $deleteAddressAccount = '/api/scope/deleteAccountAddress/';

        private $account_change_password = '/api/scope/changePassword/';

        private $setPrimaryAddressAccount = '/api/scope/setPrimaryAccountAddress/';

        private $setPrimaryEmailAccount = '/api/scope/setPrimaryEmailAddress/';

        private $deleteEmailAccount = '/api/scope/deleteAccountEmailAddress/';

        private $setPrimaryPhoneAccount = '/api/scope/setPrimaryPhoneNumber/';

        private $deletePhoneAccount = '/api/scope/deleteAccountPhoneNumber/';

        private $addEmailAddresss = '/api/scope/addAccountEmailAddress/';

        private $addAccountPhoneNumber = '/api/scope/AddAccountPhoneNumber/';

//        private $cfid;
//        private $cftoken;
//        private $JSESSIONID;
//        private $SLATWALL_NPSID;
//        private $SLATWALL_PSID;
//        private $cookies;

        private $slatwall;

	private $version;

	public function __construct( $slatwall, $version ) {
            $this->slatwall = $slatwall;
            $this->version = $version;
//               $this->cfid = $_SESSION['cfid']??'';
//            $this->cftoken = $_SESSION['cftoken']??'';
//            $this->JSESSIONID = $_SESSION['JSESSIONID']??'';
//            $this->SLATWALL_NPSID = $_SESSION['SLATWALL-NPSID']??'';
//            $this->SLATWALL_PSID = $_SESSION['SLATWALL-PSID']??'';
//            $this->cookies = "Cookie: PRINTQUEUE=; cfid=$this->cfid; cftoken=$this->cftoken; SLATWALL-NPSID=$this->SLATWALL_NPSID; SLATWALL-PSID=$this->SLATWALL_PSID; JSESSIONID=$this->JSESSIONID";
//
	}

	public function get_account($token,$request = array()){

            $result = $this->userAccountGet($this->url,$token,$request,'GET');

            if($result){
               return $result;
            } else {
            return false;
            }

        }

        public function update_profile($token,$request = array()){

            $result = $this->userAccountPost( $this->update_url,$token,$request,'POST');
            if($result){
            return $result;
            } else {
                return false;
            }

        }



        public function get_all_orders($token,$request = array()){

            $result = $this->userAccountPost($this->get_all_orders,$token,$request,'POST');
            if($result){
            return $result;
            } else {
                return false;
            }
        }

        public function get_order_details($token,$request = array()){

            $result = $this->userAccountPost($this->get_order_details,$token,$request,'GET');
            if($result){
            return $result;
            } else {
                return false;
            }
        }

        public function cart_reorder($token,$request = array()){

            $result = $this->userAccountPost($this->duplicateOrder,$token,$request,'POST');
            if($result){
            return $result;
            } else {
                return false;
            }
        }

        public function get_all_cart_quotes($token,$request = array()){

            $result = $this->userAccountPost($this->get_all_cart_quotes,$token,$request,'POST');
            if($result){
            return $result;
            } else {
                return false;
            }
        }

        public function get_all_order_history($token,$request = array()){

            $result = $this->userAccountPost($this->get_all_order_history,$token,$request,'POST');
            if($result){
            return $result;
            } else {
                return false;
            }
        }


        public function add_account_address($token,$request){
            $result =  $this->userAccountPost($this->addAdressAccount,$token,$request,'POST');
            return $result;
        }


        public function edit_account_address($token,$request){
            $result =  $this->userAccountPost($this->editAdressAccount,$token,$request,'POST');
            return $result;
        }

        public function delete_account_address($token,$request){
            $result =  $this->userAccountPost($this->deleteAddressAccount,$token,$request,'POST');
            return $result;
        }

        public function change_password_account($token,$request){
            $result =  $this->userAccountPost($this->account_change_password,$token,$request,'POST');
            return $result;
        }

        public function set_primary_address($token,$request){
            $result =  $this->userAccountPost($this->setPrimaryAddressAccount,$token,$request,'POST');
            return $result;
        }

        public function add_email_address($token,$request){
            $result =  $this->userAccountPost($this->addEmailAddresss ,$token,$request,'POST');
            return $result;
        }

        public function set_primary_email($token,$request){
           $result =  $this->userAccountPost($this->setPrimaryEmailAccount,$token,$request,'POST');
            return $result;
        }

        public function delete_account_email($token,$request){
            $result =  $this->userAccountPost($this->deleteEmailAccount,$token,$request,'POST');
            return $result;
        }

        public function set_primary_phone($token,$request){
            $result =  $this->userAccountPost($this->setPrimaryPhoneAccount,$token,$request,'POST');
            return $result;
        }

        public function add_phone($token,$request){
            $result =  $this->userAccountPost($this->addAccountPhoneNumber,$token,$request,'POST');
            return $result;
        }

        public function delete_account_phone($token,$request){
           $result =  $this->userAccountPost($this->deletePhoneAccount,$token,$request,'POST');
            return $result;
        }

}
