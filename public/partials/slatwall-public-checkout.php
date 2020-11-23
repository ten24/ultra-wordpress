<?php //d($availale_payment_method);
//echo $_SESSION['token'];
$cart_data = json_decode($cart_data);

$eligiblePaymentMethodDetails = $cart_data->eligiblePaymentMethodDetails;
$orderFulfillmentID = '';
$selected_shipping = isset($cart_data->cart->orderFulfillments[0]->shippingMethod)?$cart_data->cart->orderFulfillments[0]->shippingMethod:'';
$countries_obj = json_decode($countries_data);
$countries = $countries_obj->countryCodeOptions;
$shipping_address = isset($cart_data->cart->orderFulfillments[0]->shippingAddress)?$cart_data->cart->orderFulfillments[0]->shippingAddress:'';
foreach($cart_data->orderFulfillments as $orderFulfillments){
      if(isset($orderFulfillments->fulfillmentMethod->fulfillmentMethodType) && $orderFulfillments->fulfillmentMethod->fulfillmentMethodType == 'shipping'){
           $orderFulfillmentID = $orderFulfillments->orderFulfillmentID;
           break;
        }   
}
$account = json_decode($account);
$account_address = $account->accountAddresses;
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

             <?php  if($cart_data->orderID){  if(!isset($_SESSION['token'])){
                 /* Login And Registration */
                 $templates->get_template_part( 'content', 'checkout-account',true );
               }

               /* Add And Select Shipping Address */
               $templates->set_template_data( $cart_data->orderItems, 'orderItems' )->set_template_data( $orderFulfillmentID, 'orderFulfillmentID' )->set_template_data( $selected_shipping, 'selected_shipping' )->set_template_data( $default_state_code->stateCodeOptions, 'default_states' )->set_template_data( $countries, 'countries' )->set_template_data( $availale_shipping_method, 'availale_shipping_method' )->set_template_data( $account_address, 'account_address' )->get_template_part( 'content', 'checkout-shipping',true );

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
<?php
}
?>
  /********************** Hide and show shipping section based on login ********************/
if (typeof token !== 'undefined') {
  jQuery('.shippinginfo').show();
	jQuery('.checkoutforms').hide();
} else {
  jQuery('.checkoutforms').show();
	jQuery('.shippinginfo').hide();
}
/********************** End Hide and show shipping section based on login ********************/

</script>

