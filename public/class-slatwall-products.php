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

class Slatwall_Products extends Slatwall_Integration{


        private $url = '/api/scope/getProductList/';

      //  private $url = '/api/product/';

        private $detail_url = '/api/product/';

        private $bundle_product = '/api/scope/getProductBundles';

        private $slatwall;

	private $version;

	public function __construct( $slatwall, $version ) {

            $this->slatwall = $slatwall;
            $this->version = $version;


	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */


        protected function productListIntegration(string $urlPara = ''){


            $API_URL = $this->url;
            $result = $this->get_API_Integration($API_URL, 'GET',$urlPara);
            return $result;

        }

         protected function productDetailIntegration(string $urlPara = ''){


            $API_URL = $this->detail_url;
            $result = $this->get_API_Integration($API_URL, 'GET',$urlPara);
            return $result;

        }

        protected function productBundleIntegration($request = array()){


            $API_URL = $this->bundle_product;
            $result = $this->post_API_integration($request,$API_URL);
            return $result;

        }

        protected function product_loop_data(){

        }


}
