<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>
 <!-- Account Sidebar Navigation -->
 <?php $account_url = get_site_url().'/'.SLATWALL_MY_ACCOUNT_SLUG; ?>
 <?php //echo $account_url; ?>
 <?php //echo get_site_url(); ?>
 <?php //echo SLATWALL_MY_ACCOUNT_SLUG; ?>


 <?php
 $directoryURI = $_SERVER['REQUEST_URI'];
 $path = parse_url($directoryURI, PHP_URL_PATH);
 $components = explode('/', $path);
 $first_part = $components[1];
 ?>

            <div class="col-md-3 col-sm-12 accountSidebar">
                <div class="mb-4 dashboard-sidebar">
                <a href="<?php echo $account_url; ?>/dashboard" class="list-group-item list-group-item-action <?php if ($_SERVER['REQUEST_URI']=="dashboard") {echo "active"; }?>">
                        My Dashboard
                    </a>
                    <a href="<?php echo $account_url; ?>/email-addresses" class="list-group-item list-group-item-action ">
                        Account Email Addresses
                    </a>

                    <a href="<?php echo $account_url; ?>/phone-numbers" class="list-group-item list-group-item-action ">
                        Account Phone Numbers
                    </a>

                    <a href="<?php echo $account_url; ?>/address-book" class="list-group-item list-group-item-action ">
                        Address Book
                    </a>

                    <a href="<?php echo $account_url; ?>/carts-quotes" class="list-group-item list-group-item-action ">
                        Carts &amp; Quotes
                    </a>

                    <a href="<?php echo $account_url; ?>/login-information-update" class="list-group-item list-group-item-action ">
                        Login Information Update
                    </a>

                    <!-- <a href="<?php //echo $account_url; ?>/my-subscriptions" class="list-group-item list-group-item-action ">
                        My Subscriptions
                    </a> -->

                    <a href="<?php echo $account_url; ?>/order-history" class="list-group-item list-group-item-action ">
                        Order History
                    </a>

                    <a href="<?php echo $account_url; ?>/profile-update" class="list-group-item list-group-item-action ">
                        Profile Update
                    </a>
                </div>
            </div>
