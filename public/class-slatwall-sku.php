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


class Slatwall_Sku extends Slatwall_Integration{

        
        private $url = '/api/public/sku/';
        

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	
       
        public function getProductSku($product_id){
             $para = "?f:product.productID=$product_id";
            $API_URL = $this->url;
            $result = $this->get_API_Integration($API_URL, 'GET',$para);
            return $result;
           
        }
        
        public function getSpecificSku($sku_id){
              $para = "?f:SkuID=$sku_id";
              $API_URL = $this->url;
            $result = $this->get_API_Integration($API_URL, 'GET',$para);
            return $result;
           
        }
        
}
