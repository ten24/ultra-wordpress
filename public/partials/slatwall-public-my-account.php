<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */

               switch (true) {
    case (($account == "dashboard" && isset($_SESSION['token']))||($account == "my-account" && isset($_SESSION['token']))):
       $templates->set_template_data( $templates, 'templates' )->set_template_data( $account_details, 'accounts' )->set_template_data( $all_orders, 'orders' )->get_template_part( 'content', 'account-dashboard',true );
        break;
    case ($account == "address-book" && isset($_SESSION['token'])):
       $templates->set_template_data( $templates, 'templates' )->set_template_data( $default_state_code->stateCodeOptions, 'default_states' )->set_template_data( $countries, 'countries' )->set_template_data( $account_details, 'accounts' )->get_template_part( 'content', 'account-address-book',true );
        break;
    case ($account == "carts-quotes" && isset($_SESSION['token'])):
          $templates->set_template_data( $templates, 'templates' )->set_template_data( $all_cart_quotes, 'cart_quotes' )->get_template_part( 'content', 'account-carts-quotes',true );
        break;
     case ($account == "email-addresses" && isset($_SESSION['token'])):
       $templates->set_template_data( $templates, 'templates' )->set_template_data( $account_details, 'accounts' )->get_template_part( 'content', 'account-email-addresses',true );
        break;
     case ($account == "login-information-update" && isset($_SESSION['token'])):
       $templates->set_template_data( $templates, 'templates' )->set_template_data( $account_details, 'accounts' )->get_template_part( 'content', 'account-login-information-update',true );
        break;
     case ($account == "my-subscriptions" && isset($_SESSION['token'])):
       $templates->set_template_data( $templates, 'templates' )->get_template_part( 'content', 'account-my-subscriptions',true );
        break;
    case ($account == "order-history" && isset($_SESSION['token'])):
        $templates->set_template_data( $templates, 'templates' )->set_template_data( $account_details, 'accounts' )->set_template_data( $all_orders, 'orders' )->get_template_part( 'content', 'account-all-orders',true );
//  $templates->set_template_data( $templates, 'templates' )->set_template_data( $all_order_history, 'order_history' )->get_template_part( 'content', 'account-order-history',true );
        break;
    case ($account == "phone-numbers" && isset($_SESSION['token'])):
       $templates->set_template_data( $templates, 'templates' )->set_template_data( $account_details, 'accounts' )->get_template_part( 'content', 'account-phone-numbers',true );
        break;
    case ($account == "profile-update" && isset($_SESSION['token'])):
       $templates->set_template_data( $templates, 'templates' )->set_template_data( $account_details, 'account_details' )->get_template_part( 'content', 'account-profile-update',true );
        break;
    case ($account === "forget-password" && !isset($_SESSION['token'])):
       $templates->get_template_part( 'content', 'account-forget-password',true );
        break;
    case ($account === "reset-password" || isset($_GET['swprid'])):
         $templates->get_template_part( 'content', 'account-reset-password',true );
          break;
    case ($account === "order-details" && isset($_SESSION['token'])):
            $templates->set_template_data( $templates, 'templates' )->set_template_data($order_details,'order_details')->get_template_part( 'content', 'account-order-details',true );
             break;
         case ($account === "cart-details" && isset($_SESSION['token'])):
            $templates->set_template_data( $templates, 'templates' )->set_template_data($order_details,'order_details')->get_template_part( 'content', 'account-cart-details',true );
             break;
    default:
       $templates->get_template_part( 'content', 'account-login-registration',true );
}
