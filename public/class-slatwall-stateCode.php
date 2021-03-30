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


class Slatwall_stateCode extends Slatwall_Integration{


        private $url = '/api/scope/getStateCodeOptionsByCountryCode/';

        private $get_country_url = '/api/scope/getCountries/';

       // private $forget_url = '/api/scope/forgotPassword/';

        private $slatwall;

	private $version;

	public function __construct( $slatwall, $version ) {

            $this->slatwall = $slatwall;
            $this->version = $version;

        }

	public function stateCode($parameter){
            $full_url = $this->url.$parameter;
           $result = $this->userAccountGet($full_url);
            if($result){
               return $result;
            } else {
            return false;
            }

        }

        public function countryCode(){
           $result = $this->userAccountGet($this->get_country_url);
            if($result){
               return $result;
            } else {
            return false;
            }

        }

}
