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
    
        private function api_time_log($API_url,$start_time,$request){
            //$log  = "Time: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL;
        $web_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $d = new DateTime();
        $endTime = $d->format("d-m-Y H:i:s.v");
        $log  = "Start: ".$start_time.PHP_EOL.
        "API url: ".$API_url.PHP_EOL.
        "End Time: ".$endTime.PHP_EOL.
        "Web URL: ".$web_link.PHP_EOL.
        "-------------------------".PHP_EOL;
        $api_log['api_url'] =  $API_url;
        $api_log['request'] = $request;
        $api_log['start_time'] =  $start_time;
        $api_log['end_time'] =  $endTime;
        $api_log['web_url'] =  $web_link;
        $log_data = file_get_contents (ABSPATH.'api_time.json');
        $log_data_array = json_decode($log_data);
        $log_data_array[] = $api_log;
        $api_log_json = json_encode($log_data_array);
        file_put_contents(ABSPATH.'api_time.json', $api_log_json);
//Save string to log, use FILE_APPEND to append.
file_put_contents(ABSPATH.'/api_time.log', $log, FILE_APPEND);
        }

        private function getKeyValue(){
            global $table_prefix, $wpdb;
           $result = $wpdb->get_row("SELECT * FROM ".$table_prefix."slatwall_login WHERE status = '1'");
           if($result){
           return $result;
           } else {
               return false;
           }
        }
        
        private function fetch_api_result($full_api_url,$method,$post_field_data = '',$http_header = ''){
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
            
            if($method == 'POST'){
               $content_data = wp_remote_post($full_api_url, $post_field_arg);
            }else {
                $content_data = wp_remote_get($full_api_url, $post_field_arg);
            }
            
            return $content_data;
        }
        
        private function cookies_data($set_cookies){
            $cookies_data = array();
            if(isset($set_cookies) && !empty($set_cookies)){
         foreach($set_cookies as $cookie){
                $cookie_array = explode('=',$cookie);
                $cookie_array_value_split = explode(';',$cookie_array[1]);
                if($cookie_array_value_split[0] != ""){
                $cookie_key = (string)$cookie_array[0];
                if($cookie_key != 'SLATWALL-NPSID' && $cookie_key != 'SLATWALL-PSID'){
                    $cookie_value = str_replace('; Path', '', $cookie_array[1]);
                    $cookie_value = str_replace(';Path', '', $cookie_value);
                $cookies_data[$cookie_key] = $cookie_value;
                }
                }
            }  
            }
            return $cookies_data;
        }

         protected function get_API_Integration(string $API_URL,string $method = 'GET',string $urlParameter = '',array $post_field_data = array()){
            $d = new DateTime();
             $start_time = $d->format("d-m-Y H:i:s.v");
             $auth = SLATWALL_AUTHORIZATION;
            $key_data = $this->getKeyValue();
            if($key_data){
            $token = $key_data->token;
            $domain = $key_data->domain;
            $access_key = $key_data->access_key;
            $access_key_secret = $key_data->access_key_secret;
            $full_api_url = $domain.$API_URL.$urlParameter;
            $http_header = array();
            $http_header["Authorization"] = "Basic ".$auth;
             $content_data = $this->fetch_api_result($full_api_url,$method,$post_field_data, $http_header);
               // $content_data = wp_remote_get($full_api_url, $post_field_arg);
                if( !is_wp_error( $content_data ) ) {
                    $this->api_time_log($full_api_url,$start_time,$post_field_data);
                 $content = $content_data['body'];
                //d($content1);
                $headerResult = wp_remote_retrieve_headers($content_data);
            $set_cookies =$headerResult->getAll()['set-cookie'];
            $cookies_data = $this->cookies_data($set_cookies);
            $content_obj = json_decode($content);
            $cookies = (object) $cookies_data;
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
            $d = new DateTime();
            $start_time = $d->format("d-m-Y H:i:s.v");
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
            $content_data = $this->fetch_api_result($full_api_url,$method,$post_field_data, $http_header);
               // $content_data = wp_remote_post($full_api_url, $post_field_arg);
                if( !is_wp_error( $content_data ) ) {
                    $this->api_time_log($full_api_url,$start_time,$request);
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
             $d = new DateTime();
             $start_time = $d->format("d-m-Y H:i:s.v");
            $auth = SLATWALL_AUTHORIZATION;
            $key_data = $this->getKeyValue();
            if($key_data){
            $token = $key_data->token;
            unset($request['registration']);
            $post_field_data = $request;
            $domain = $key_data->domain;
            $full_api_url = $domain.$API_URL;
              $http_header["Cookie"] = $cookies;
            if($auth){
                $http_header["Authorization"] = "Basic ".$auth;
            }
            
            $content_data = $this->fetch_api_result($full_api_url,$method,$post_field_data, $http_header);
            //$content_data = wp_remote_post($full_api_url, $post_field_arg);
                 if( !is_wp_error( $content_data ) ) {
                     $this->api_time_log($full_api_url,$start_time,$request);
                $response = $content_data['body'];
                $headerResult = wp_remote_retrieve_headers($content_data);
            $set_cookies =$headerResult->getAll()['set-cookie'];
            $cookies_data = $this->cookies_data($set_cookies);
            $content_obj = json_decode($response);
            $content_obj->cookies = $cookies_data;
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
                 $d = new DateTime();
               $start_time = $d->format("d-m-Y H:i:s.v");
                $auth = SLATWALL_AUTHORIZATION;
                $key_data = $this->getKeyValue();
                $post_field_data = $request;
            if($key_data){
                $domain = $key_data->domain;
            $full_api_url = $domain.$API_URL;
             $http_header["Cookie"] = $cookies;
            if($auth){
                $http_header["Authorization"] = "Basic ".$auth;
            }
                
                 $content_data = $this->fetch_api_result($full_api_url,$method,$post_field_data, $http_header);  
               // $content_data = wp_remote_post($full_api_url, $post_field_arg);
                
                 if( !is_wp_error( $content_data ) ) {
                     $this->api_time_log($full_api_url,$start_time,$request);
                $response = $content_data['body'];
                $headerResult = wp_remote_retrieve_headers($content_data);
            $set_cookies =$headerResult->getAll()['set-cookie'];
            $cookies_data = $this->cookies_data($set_cookies);
            $content_obj = json_decode($response);
            $cookies = $cookies_data;
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
             $d = new DateTime();
             $start_time = $d->format("d-m-Y H:i:s.v");
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
            if(isset($request['recipients'])){
            $http_header["Content-Type"] = "application/json";
            
            $post_field_data = json_encode($request);
            }
            //d($post_field_data);
            $domain = $key_data->domain;
            $full_api_url = $domain.$API_URL;
            $content_data = $this->fetch_api_result($full_api_url,$method,$post_field_data, $http_header);
                if( !is_wp_error( $content_data ) ) {
                $this->api_time_log($full_api_url,$start_time,$request);
                $content = $content_data['body'];
                //d($content1);
                $headerResult = wp_remote_retrieve_headers($content_data);
            $set_cookies = isset($headerResult->getAll()['set-cookie'])?$headerResult->getAll()['set-cookie']:'';
            //if($set_cookies){
            $cookies_data = $this->cookies_data($set_cookies);
            $content_obj = json_decode($content);
            $cookies = (object) $cookies_data;
            $content_obj->cookies = $cookies;
            
           // d($content_obj);
             return json_encode($content_obj);
//            } else {
//                return false;
//            }
                } else {
                    return false;
                }
            


            }

             protected function userAccountGet(string $API_URL,$token = '',array $request = array(),string $method = 'GET',$cookies = 'Cookie: cftoken=0;'){
            $auth = SLATWALL_AUTHORIZATION;
             $d = new DateTime();
            $start_time = $d->format("d-m-Y H:i:s.v");
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
            $content_data = $this->fetch_api_result($full_api_url,$method,$post_field_data, $http_header);
            //    $content_data = wp_remote_get($full_api_url, $post_field_arg);
                if( !is_wp_error( $content_data ) ) {
                    $this->api_time_log($full_api_url,$start_time,$request);
                
                $response = $content_data['body'];
            return $response;
                } else {
                    return false;
                }

            }


            protected function stateCode_integration(array $request,string $API_URL,string $method = 'GET',$cookies = 'Cookie: cftoken=0;'){
              $d = new DateTime();
                $start_time = $d->format("d-m-Y H:i:s.v");
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
              $post_field_data = $request;
             $content_data = $this->fetch_api_result($full_api_url,$method,$post_field_data, $http_header);
             //   $content_data = wp_remote_get($full_api_url, $post_field_arg);
                if( !is_wp_error( $content_data ) ) {
                    $this->api_time_log($full_api_url,$start_time,$request);
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
