<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
 ?>

<?php //d($availale_payment_method);
//echo $_SESSION['token'];
if(isset($cart_data->orderID) && $cart_data->orderID){
$complete_step_required = array('account','fulfillment','payment');
if(isset($cart_data->orderRequiredStepsList) && $cart_data->orderRequiredStepsList != ''){
   $complete_step_required = explode(',', $cart_data->orderRequiredStepsList);
}
$show_shipping_step = in_array('fulfillment', $complete_step_required);
$eligiblePaymentMethodDetails = $cart_data->eligiblePaymentMethodDetails;
$orderFulfillmentID = '';
$selected_shipping = isset($cart_data->cart->orderFulfillments[0]->shippingMethod)?$cart_data->cart->orderFulfillments[0]->shippingMethod:'';

$shipping_address = isset($cart_data->cart->orderFulfillments[0]->shippingAddress)?$cart_data->cart->orderFulfillments[0]->shippingAddress:'';
foreach($cart_data->orderFulfillments as $orderFulfillments){
      if(isset($orderFulfillments->fulfillmentMethod->fulfillmentMethodType) && $orderFulfillments->fulfillmentMethod->fulfillmentMethodType == 'shipping'){
           $orderFulfillmentID = $orderFulfillments->orderFulfillmentID;
           break;
        }
}
$account_address = new stdClass();
if(isset($_SESSION['token'])){
$account = json_decode($account);
$account_address = $account->accountAddresses;
}
}
?>
		<!-- Start Container-->
		<div class="container mb-5 checkoutpage">
			<!-- Page Title -->
            <div class="mt-4 d-flex justify-content-between align-items-center checkout_heading_section">
                <h1>Checkout</h1>
                <a href="<?php echo get_site_url().'/'.CART; ?>" class="btn btn-link btn-sm backtocart">Go Back to My Cart</a>
            </div>
                        <!-- Start Row -->
                        <div class="row mt-3 printarea">

             <?php  if(isset($cart_data->orderID) && $cart_data->orderID){  if(!isset($_SESSION['token'])){
                 /* Login And Registration */
                 $templates->get_template_part( 'content', 'checkout-account',true );
               }
               if($show_shipping_step == 1){
               /* Add And Select Shipping Address */
               $templates->set_template_data( $cart_data->orderItems, 'orderItems' )->set_template_data( $orderFulfillmentID, 'orderFulfillmentID' )->set_template_data( $selected_shipping, 'selected_shipping' )->set_template_data( $default_state_code->stateCodeOptions, 'default_states' )->set_template_data( $countries, 'countries' )->set_template_data( $availale_shipping_method, 'availale_shipping_method' )->set_template_data( $account_address, 'account_address' )->get_template_part( 'content', 'checkout-shipping',true );
               }
               /* Add And Select Billing Address */
               $templates->set_template_data( $eligiblePaymentMethodDetails, 'eligiblePaymentMethodDetails' )->set_template_data( $account_address, 'account_address' )->set_template_data( $default_state_code->stateCodeOptions, 'default_states' )->set_template_data( $countries, 'countries' )->get_template_part( 'content', 'checkout-billing',true );

               /* Order Review */
               $templates->set_template_data( $cart_data, 'cart_data' )->get_template_part( 'content', 'checkout-order-review',true );

               /* Order Confirm */
               $templates->set_template_data( $cart_data, 'cart_data' )->get_template_part( 'content', 'checkout-order-confirm',true );

               /* Sidebar for price details */
               $templates->set_template_data( $cart_data, 'cart_data' )->get_template_part( 'content', 'checkout-sidebar',true );
               } else { ?>
                            <div class="col-xl-4 col-sm-12">No Items In Your Shopping Cart</div>
               <?php }
             ?>
                        </div>
                </div>



<div  id="qloader" style="display: none;"><div class="loader" style="display: flex;"><i class="fa-circle-o-notch fa-spin fa-3x"></i></div></div>
<script>
var token;
<?php
if(isset($_SESSION['token'])){
?>
var token = "<?php echo $_SESSION['token']; ?>";
var show_shipping_step = "<?php echo $show_shipping_step; ?>";
<?php
}
?>
  /********************** Hide and show shipping section based on login ********************/
if (typeof token !== 'undefined') {
    if(show_shipping_step == 1){
  jQuery('.shippinginfo').show();
    } else {
        jQuery('.billinginfo').show();
        jQuery('#billingAddress').parent().hide();
        jQuery('#billingAddress').attr("checked",false);
                jQuery('.billing_account_address').css('display','flex');
    }
	jQuery('.checkoutforms').hide();
} else {
  jQuery('.checkoutforms').show();
	jQuery('.shippinginfo').hide();
}
/********************** End Hide and show shipping section based on login ********************/

</script>
