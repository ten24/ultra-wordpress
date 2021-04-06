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
            $auth = AUTHORIZATION;
            $key_data = $this->getKeyValue();
            if($key_data){
            $token = $key_data->token;
            $domain = $key_data->domain;
            $access_key = $key_data->access_key;
            $access_key_secret = $key_data->access_key_secret;
            $full_api_url = $domain.$API_URL.$urlParameter;

            try {
                $ch = curl_init();

                // Check if initialization had gone wrong*
                if ($ch === false) {
                    throw new Exception('failed to initialize');
                }

                curl_setopt_array($ch, array(
                CURLOPT_URL => $full_api_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_HEADER => 1,
                CURLOPT_VERBOSE => 1,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_SSL_VERIFYHOST => FALSE,
                CURLOPT_SSL_VERIFYPEER => FALSE,
                CURLOPT_POSTFIELDS => $post_field_data,
                CURLOPT_HTTPHEADER => array(
                  "Access-Key: $access_key",
                  "Access-Key-Secret: $access_key_secret",
                  "Authorization: Basic $auth"
                ),
              ));

                $content = curl_exec($ch);
                $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($content, 0, $header_size);
            preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $header, $matches);
            $cookies = array();
            foreach($matches[1] as $item) {
                parse_str($item, $cookie);
                $cookies = array_merge($cookies, $cookie);
            }
            $content = substr($content, $header_size);
                // Check the return value of curl_exec(), too
                if($content === false) {
                    throw new Exception(curl_error($ch), curl_errno($ch));
                }

                /* Process $content here */

                // Close curl handle
                curl_close($ch);
            } catch(Exception $e) {

            if($e->getCode() !== 6){
              $content = trigger_error(sprintf(
                    'Curl failed with error #%d: %s',
                    $e->getCode(), $e->getMessage()),
                    E_USER_ERROR);
                    } else {
                      $error_msg = $e->getMessage();
                            $content = '{"errors" : "'.$error_msg.'"}';
                    }

            }
            $content_obj = json_decode($content);
            $content_obj->cookies = $cookies;
             return $content_obj;
           } else {
               return false;
           }

        }

        protected function post_API_integration(array $request,string $API_URL,string $method = 'POST'){
            $auth = AUTHORIZATION;
            $key_data = $this->getKeyValue();
            if($key_data){
            $token = $key_data->token;
            unset($request['registration']);
            $post_field_data = $request;
            $domain = $key_data->domain;
            $full_api_url = $domain.$API_URL;
            //print_r($post_field_data);
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $full_api_url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => $method,
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_POSTFIELDS => $post_field_data,
              CURLOPT_HTTPHEADER => array(
                "Auth-Token: Bearer $token",
                "Authorization: Basic $auth"
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
           // print_R($response); die("registration");
            return $response;
            } else {
                return false;
            }

            }

            protected function register_integration(array $request,string $API_URL,string $method = 'POST',$cookies = 'Cookie: cftoken=0;'){
            $auth = AUTHORIZATION;
            $key_data = $this->getKeyValue();
            if($key_data){
            $token = $key_data->token;
            unset($request['registration']);
            $post_field_data = $request;
            $domain = $key_data->domain;
            $full_api_url = $domain.$API_URL;
            //print_r($post_field_data);
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $full_api_url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
                CURLOPT_HEADER => 1,
                  CURLOPT_VERBOSE => 1,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => $method,
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_POSTFIELDS => $post_field_data,
              CURLOPT_HTTPHEADER => array(
                "Auth-Token: Bearer $token",
                "Authorization: Basic $auth",
                  $cookies
              ),
            ));

            $response = curl_exec($curl);
                $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $header, $matches);
            $cookies = array();
            foreach($matches[1] as $item) {
                parse_str($item, $cookie);
                $cookies = array_merge($cookies, $cookie);
            }
            $response = substr($response, $header_size);
            curl_close($curl);
           $response_json = json_decode($response);
                $response_json->cookies = $cookies;
                return $response_json;
            } else {
                return false;
            }

            }

            protected function login_integration(array $request,string $API_URL,string $method = 'POST',$cookies = 'Cookie: cftoken=0;'){

                $auth = AUTHORIZATION;
                $key_data = $this->getKeyValue();
            if($key_data){
                $domain = $key_data->domain;
            $full_api_url = $domain.$API_URL;

                $post_data = $request;
                 $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => $full_api_url,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_HEADER => 1,
                  CURLOPT_VERBOSE => 1,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_SSL_VERIFYHOST => FALSE,
                  CURLOPT_SSL_VERIFYPEER => FALSE,
                  CURLOPT_CUSTOMREQUEST => $method,
                  CURLOPT_POSTFIELDS => $post_data,
                  CURLOPT_HTTPHEADER => array(
                    "Authorization: Basic $auth",
                      $cookies
                  ),
                ));

                $response = curl_exec($curl);
                $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $header, $matches);
            $cookies = array();
            foreach($matches[1] as $item) {
                parse_str($item, $cookie);
                $cookies = array_merge($cookies, $cookie);
            }
            $response = substr($response, $header_size);

                curl_close($curl);
                $response_json = json_decode($response);
                $response_json->cookies = $cookies;
                return $response_json;
            } else {
                return false;
            }
            }


            protected function userAccountPost(string $API_URL,$token = '',array $request = array(),string $method = 'POST',$cookies = 'Cookie: cftoken=0;'){
            $auth = AUTHORIZATION;
            $key_data = $this->getKeyValue();

            $post_field_data = $request;
            $domain = $key_data->domain;
            $full_api_url = $domain.$API_URL;
            $curl = curl_init();
             curl_setopt_array($curl, array(
              CURLOPT_URL => $full_api_url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
                 CURLOPT_HEADER => 1,
                  CURLOPT_VERBOSE => 1,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => $method,
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_POSTFIELDS => $post_field_data,
              CURLOPT_HTTPHEADER => array(
                "Auth-Token: Bearer $token",
                "Authorization: Basic $auth",
                  $cookies
              ),
            ));

            $response = curl_exec($curl);
            $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $header, $matches);
            $cookies = array();
            foreach($matches[1] as $item) {
                parse_str($item, $cookie);
                $cookies = array_merge($cookies, $cookie);
            }
            $response = substr($response, $header_size);
                curl_close($curl);
                $response_json = json_decode($response);
                $response_json->cookies = $cookies;
            return json_encode($response_json);


            }

             protected function userAccountGet(string $API_URL,$token = '',array $request = array(),string $method = 'GET',$cookies = 'Cookie: cftoken=0;'){
            $auth = AUTHORIZATION;
            $key_data = $this->getKeyValue();

            $post_field_data = $request;
            $domain = $key_data->domain;
            $full_api_url = $domain.$API_URL;
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $full_api_url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => $method,
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_POSTFIELDS => $post_field_data,
              CURLOPT_HTTPHEADER => array(
                "Auth-Token: Bearer $token",
                "Authorization: Basic $auth",
                  $cookies
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;


            }


            protected function stateCode_integration(array $request,string $API_URL,string $method = 'GET',$cookies = 'Cookie: cftoken=0;'){

              $auth = AUTHORIZATION;
              $key_data = $this->getKeyValue();
          if($key_data){
              $domain = $key_data->domain;
          $full_api_url = $domain.$API_URL;

              $post_data = $request;
               $curl = curl_init();
              curl_setopt_array($curl, array(
                CURLOPT_URL => $full_api_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_HEADER => 1,
                CURLOPT_VERBOSE => 1,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYHOST => FALSE,
                CURLOPT_SSL_VERIFYPEER => FALSE,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_POSTFIELDS => $post_data,
                CURLOPT_HTTPHEADER => array(
                  "Authorization: Basic $auth",
                    $cookies
                ),
              ));

              $response = curl_exec($curl);
              $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
          $header = substr($response, 0, $header_size);
          preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $header, $matches);
          $cookies = array();
          foreach($matches[1] as $item) {
              parse_str($item, $cookie);
              $cookies = array_merge($cookies, $cookie);
          }
          $response = substr($response, $header_size);

              curl_close($curl);
              $response_json = json_decode($response);
              $response_json->cookies = $cookies;
             // print_r($response_json); die("result");
              return $response_json;
          } else {
              return false;
          }
          }

}
