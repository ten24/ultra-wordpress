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

class Slatwall_Logout extends Slatwall_Integration{


        private $url = '/api/scope/logout/';

        private $slatwall;

	private $version;

	public function __construct( $slatwall, $version ) {

            $this->slatwall = $slatwall;
            $this->version = $version;


	}

	public function logout($token,$request = array()){

            $result = $this->userAccountPost($this->url,$token,$request);

            if($result){
               return $result;
            } else {
            return false;
            }

        }


}
