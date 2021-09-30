<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */

/**
 *
 * @link       https://www.slatwallcommerce.com/
 * @since      1.0.0
 *
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/includes
 */


class Slatwall_Integration {

        private function getKeyValue(){
            global $table_prefix, $wpdb;
           $result = $wpdb->get_row("SELECT * FROM ".$table_prefix."slatwall_login WHERE status = '1'");
           if($result){
           return $result;
           } else {
               return false;
           }
        }

         protected function get_API_Integration(string $API_URL,string $method = 'GET',string $urlParameter = '',array $post_field_data = array()){
            $auth = SLATWALL_AUTHORIZATION;
            $key_data = $this->getKeyValue();
            if($key_data){
            $token = $key_data->token;
            $domain = $key_data->domain;
            $access_key = $key_data->access_key;
            $access_key_secret = $key_data->access_key_secret;
            $full_api_url = $domain.$API_URL.$urlParameter;
               $post_field_arg = array('returntransfer'=>true,
                    'encoding'=>'',
                    'maxredirs'=>10,
                    'verbose'=>1,
                    'followlocation'=>true,
                 'timeout' => 10,
                'header'=>1,
                    'headers' => array(
                "Authorization" => "Basic ".$auth
              )
                    
                    );
               //d($auth);
                $content_data = wp_remote_get($full_api_url, $post_field_arg);
                if( !is_wp_error( $content_data ) ) {
                    
                
                $content = $content_data['body'];
                //d($content1);
                $headerResult = wp_remote_retrieve_headers($content_data);
            $set_cookies =$headerResult->getAll()['set-cookie'];
            $cookies1 = array();
            foreach($set_cookies as $cookie){
                $cookie_array = explode('=',$cookie);
                $cookie_array_value_split = explode(';',$cookie_array[1]);
                if($cookie_array_value_split[0] != ""){
                $cookie_key = (string)$cookie_array[0];
                if($cookie_key != 'SLATWALL-NPSID' && $cookie_key != 'SLATWALL-PSID'){
                    $cookie_value = str_replace('; Path', '', $cookie_array[1]);
                    $cookie_value = str_replace(';Path', '', $cookie_value);
                $cookies1[$cookie_key] = $cookie_value;
                }
                }
            }
            $content_obj = json_decode($content);
            $cookies = (object) $cookies1;
            $content_obj->cookies = $cookies;
           // d($content_obj);
             return $content_obj;
                } else {
                    return false;
                }
           } else {
               return false;
           }

        }

        protected function post_API_integration(array $request,string $API_URL,string $method = 'POST'){
            $auth = SLATWALL_AUTHORIZATION;
            $key_data = $this->getKeyValue();
            if($key_data){
            $token = $key_data->token;
            unset($request['registration']);
            $post_field_data = $request;
            $domain = $key_data->domain;
            $full_api_url = $domain.$API_URL;
            $http_header = array();
            if($token != ""){
              $http_header["Auth-Token"] = "Bearer ".$token;
            } 
            if($auth){
                $http_header["Authorization"] = "Basic ".$auth;
            }
            $post_field_arg = array('returntransfer'=>true,
                    'encoding'=>'',
                    'maxredirs'=>10,
                    'verbose'=>1,
                   'body'=>$post_field_data,
                    'followlocation'=>true,
                 'timeout' => 10,
                'header'=>1,
                    'headers' => $http_header
                    
                    );
                $content_data = wp_remote_post($full_api_url, $post_field_arg);
                if( !is_wp_error( $content_data ) ) {
            $response= $content_data['body'];
            return $response;
                } else {
                    return false;
                }
            } else {
                return false;
            }

            }

            protected function register_integration(array $request,string $API_URL,string $method = 'POST',$cookies = 'Cookie: cftoken=0;'){
            $auth = SLATWALL_AUTHORIZATION;
            $key_data = $this->getKeyValue();
            if($key_data){
            $token = $key_data->token;
            unset($request['registration']);
            $post_field_data = $request;
            $domain = $key_data->domain;
            $full_api_url = $domain.$API_URL;
            
            $post_field_arg = array('returntransfer'=>true,
                    'encoding'=>'',
                    'maxredirs'=>10,
                    'verbose'=>1,
                   'body'=>$post_field_data,
                    'followlocation'=>true,
                 'timeout' => 10,
                'header'=>1,
                    'headers' => array(
                "Authorization" => "Basic ".$auth,
                        "Cookie" => $cookies
              )
                    
                    );
                $content_data = wp_remote_post($full_api_url, $post_field_arg);
                 if( !is_wp_error( $content_data ) ) {
                $response = $content_data['body'];
                $headerResult = wp_remote_retrieve_headers($content_data);
            $set_cookies =$headerResult->getAll()['set-cookie'];
            $cookies = array();
            foreach($set_cookies as $cookie){
                $cookie_array = explode('=',$cookie);
                $cookie_array_value_split = explode(';',$cookie_array[1]);
                if($cookie_array_value_split[0] != ""){
                $cookie_key = (string)$cookie_array[0];
                if($cookie_key != 'SLATWALL-NPSID' && $cookie_key != 'SLATWALL-PSID'){
                    $cookie_value = str_replace('; Path', '', $cookie_array[1]);
                    $cookie_value = str_replace(';Path', '', $cookie_value);
                $cookies[$cookie_key] = $cookie_value;
                }
                }
            }
            $content_obj = json_decode($response);
            $content_obj->cookies = $cookies;
                return $content_obj;
                 } else {
                     return false;
                 }
            } else {
                return false;
            }

            }

            protected function login_integration(array $request,string $API_URL,string $method = 'POST',$cookies = 'Cookie: cftoken=0;'){
               // d($cookies);
                $auth = SLATWALL_AUTHORIZATION;
                $key_data = $this->getKeyValue();
            if($key_data){
                $domain = $key_data->domain;
            $full_api_url = $domain.$API_URL;

                $post_data = $request;
                 $post_field_arg = array('returntransfer'=>true,
                    'encoding'=>'',
                    'maxredirs'=>10,
                    'verbose'=>1,
                   'body'=>$post_data,
                    'followlocation'=>true,
                 'timeout' => 10,
                'header'=>1,
                    'headers' => array(
                "Authorization" => "Basic ".$auth,
                        "Cookie" => $cookies
              )
                    
                    );
                   
                $content_data = wp_remote_post($full_api_url, $post_field_arg);
                
                 if( !is_wp_error( $content_data ) ) {
                $response = $content_data['body'];
                $headerResult = wp_remote_retrieve_headers($content_data);
            $set_cookies =$headerResult->getAll()['set-cookie'];
            $cookies1 = array();
          //  d($set_cookies);
            foreach($set_cookies as $cookie){
                $cookie_array = explode('=',$cookie);
                $cookie_array_value_split = explode(';',$cookie_array[1]);
                if($cookie_array_value_split[0] != ""){
                $cookie_key = (string)$cookie_array[0];
               // if($cookie_key != 'SLATWALL-NPSID' && $cookie_key != 'SLATWALL-PSID'){
                    $cookie_value = str_replace('; Path', '', $cookie_array[1]);
                    $cookie_value = str_replace(';Path', '', $cookie_value);
                $cookies1[$cookie_key] = $cookie_value;
                //}
                }
            }
            $content_obj = json_decode($response);
            $cookies = $cookies1;
           // d($cookies1);
            $content_obj->cookies = $cookies;
            //d($content_obj);
                return $content_obj;
                 } else {
                   
                     return false;
                 }
            } else {
                return false;
            }
            }


            protected function userAccountPost(string $API_URL,$token = '',array $request = array(),string $method = 'POST',$cookies = 'Cookie: cftoken=0;'){
            $auth = SLATWALL_AUTHORIZATION;
            $key_data = $this->getKeyValue();
            $http_header = array();
            if($token != ""){
              $http_header["Auth-Token"] = "Bearer ".$token;
            } else {
                $http_header["Cookie"] = $cookies;
            }
            if($auth){
                $http_header["Authorization"] = "Basic ".$auth;
            }
            
            $post_field_data = $request;
            $domain = $key_data->domain;
            $full_api_url = $domain.$API_URL;
            $post_field_arg = array('returntransfer'=>true,
                    'encoding'=>'',
                    'maxredirs'=>10,
                    'verbose'=>1,
                   'body'=>$post_field_data,
                    'followlocation'=>true,
                 'timeout' => 10,
                'header'=>1,
                    'headers' => $http_header
                    
                    );
                $content_data = wp_remote_post($full_api_url, $post_field_arg);
                if( !is_wp_error( $content_data ) ) {
                    
                
                $content = $content_data['body'];
                //d($content1);
                $headerResult = wp_remote_retrieve_headers($content_data);
            $set_cookies =$headerResult->getAll()['set-cookie'];
            $cookies1 = array();
            foreach($set_cookies as $cookie){
                $cookie_array = explode('=',$cookie);
                $cookie_array_value_split = explode(';',$cookie_array[1]);
                if($cookie_array_value_split[0] != ""){
                $cookie_key = (string)$cookie_array[0];
                if($cookie_key != 'SLATWALL-NPSID' && $cookie_key != 'SLATWALL-PSID'){
                    $cookie_value = str_replace('; Path', '', $cookie_array[1]);
                    $cookie_value = str_replace(';Path', '', $cookie_value);
                $cookies1[$cookie_key] = $cookie_value;
                }
                }
            }
            $content_obj = json_decode($content);
            $cookies = (object) $cookies1;
            $content_obj->cookies = $cookies;
           // d($content_obj);
             return json_encode($content_obj);
                } else {
                    return false;
                }
            


            }

             protected function userAccountGet(string $API_URL,$token = '',array $request = array(),string $method = 'GET',$cookies = 'Cookie: cftoken=0;'){
            $auth = SLATWALL_AUTHORIZATION;
            $key_data = $this->getKeyValue();
            $http_header = array();
            if($token != ""){
              $http_header["Auth-Token"] = "Bearer ".$token;
            } else {
                $http_header["Cookie"] = $cookies;
            }
            if($auth){
                $http_header["Authorization"] = "Basic ".$auth;
            }
            
            $post_field_data = $request;
            $domain = $key_data->domain;
            $full_api_url = $domain.$API_URL;
            $post_field_arg = array('returntransfer'=>true,
                    'encoding'=>'',
                    'maxredirs'=>10,
                    'verbose'=>1,
                   'body'=>$post_field_data,
                    'followlocation'=>true,
                 'timeout' => 10,
                'header'=>1,
                    'headers' => $http_header
                    
                    );
                $content_data = wp_remote_get($full_api_url, $post_field_arg);
                if( !is_wp_error( $content_data ) ) {
                    
                
                $response = $content_data['body'];
            return $response;
                } else {
                    return false;
                }

            }


            protected function stateCode_integration(array $request,string $API_URL,string $method = 'GET',$cookies = 'Cookie: cftoken=0;'){

              $auth = SLATWALL_AUTHORIZATION;
              $key_data = $this->getKeyValue();
          if($key_data){
              $domain = $key_data->domain;
          $full_api_url = $domain.$API_URL;
            $http_header = array();
            $http_header["Cookie"] = $cookies;
            if($auth){
                $http_header["Authorization"] = "Basic ".$auth;
            }
              $post_data = $request;
              
              $post_field_arg = array('returntransfer'=>true,
                    'encoding'=>'',
                    'maxredirs'=>10,
                    'verbose'=>1,
                   'body'=>$post_field_data,
                    'followlocation'=>true,
                 'timeout' => 10,
                'header'=>1,
                    'headers' => $http_header
                    
                    );
                $content_data = wp_remote_get($full_api_url, $post_field_arg);
                if( !is_wp_error( $content_data ) ) {
                $content = $content_data['body'];
            $content_obj = json_decode($content);
              return $content_obj;
                } else {
                    return false;
                }
          } else {
              return false;
          }
          }

}
