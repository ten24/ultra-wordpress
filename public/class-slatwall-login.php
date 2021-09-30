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


class Slatwall_Login extends Slatwall_Integration{


        private $url = '/api/auth/login/';

        private $forget_url = '/api/scope/forgotPassword/';

        private $reset_url='/api/scope/resetPasswordUpdate';

        private $slatwall;

	private $version;

        private $cfid;

        private $cftoken;

        private $JSESSIONID;

//        private $SLATWALL_NPSID;
//
//        private $SLATWALL_PSID;

        private $cookies;

	public function __construct( $slatwall, $version ) {

            $this->slatwall = $slatwall;
            $this->version = $version;
            $this->cfid = $_SESSION['cfid']??'';
            $this->cftoken = $_SESSION['cftoken']??'';
            $this->JSESSIONID = $_SESSION['JSESSIONID']??'';
//            $this->SLATWALL_NPSID = $_SESSION['SLATWALL-NPSID']??'';
//            $this->SLATWALL_PSID = $_SESSION['SLATWALL-PSID']??'';
            $this->cookies = "cfid=$this->cfid; cftoken=$this->cftoken; JSESSIONID=$this->JSESSIONID;";
	}

	public function login($request){

             unset($request['account']);
            $result = $this->login_integration($request, $this->url,'POST',$this->cookies);
            if($result){
               return $result;
            } else {
            return false;
            }

        }

        public function forget_password($request){
             $result = $this->post_API_integration($request, $this->forget_url);
            if($result){
               return $result;
            } else {
            return false;
            }
        }

        public function reset_password_account($request){
                $result = $this->post_API_integration($request, $this->reset_url);
               if($result){
                  return $result;
               } else {
               return false;
               }
           }


}
