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
 */

class Slatwall_Options extends Slatwall_Integration{


        private $url = '/api/option/';


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */


        public function optionListIntegration(){

            $API_URL = $this->url;
            $para = '?pageShow=1000&f:activeFlag=1';
            $result = $this->get_API_Integration($API_URL, 'GET',$para);
            return $result;

        }

}
