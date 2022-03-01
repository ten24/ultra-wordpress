<?php $related_product_image_url = 'http://placehold.it/510x350'; $token = isset($_SESSION['token'])?$_SESSION['token']:''; $default_states = $default_state_code->stateCodeOptions; 
$sku_ids = array();
if($cart_data->orderItems){
foreach($cart_data->orderItems as $item){
    $sku_ids[] = $item->sku->skuID;
}
}
 $current_month = (int)date('m');
 $month_diff = $current_month-12;
 $months = array(1 => 'January', 2 => 'Febraury',3 => 'March', 4 => 'april', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September',10 => 'Octuber',11 => 'November',12 => 'December');
 $current_year = (int)date('Y');
 //d($cart_data)
 function url_exists($url) {
    $hdrs = @get_headers($url);

   // echo @$hdrs[1]."\n";

    return is_array($hdrs) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$hdrs[0]) : false;
}
?>
<div class="jumbotron jumbotron-fluid product-subscription-main-area">
            <div class="container text-center">
                 <h1 class="display-4"><?php echo $product->productName; ?></h1>

            </div>
        </div>
<div class="container my-5" style="margin-bottom:40px!important;">
            <!-- Display Product Image and product description -->
            <div class="row justify-content-center my-4 pb-5 mb-5">
                <div class="col-lg-4">
                    <?php if(isset($product->images[1]) && $product->images[1] != ''){ ?>
                    <img src="<?php echo DOMAIN.'/'.$product->images[1]; ?>" class="card-img-top" alt="Product SKU Image">
                    <?php } else { ?>
                         <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="Product SKU Image">
                    <?php } ?>
                </div>
                <div class="col-lg-6"><?php echo $product->productDescription; ?></div>
            </div>
            <?php if(isset($product_sku->pageRecords) && $product_sku->pageRecords){ ?>
            <!-- Display Subscription Product SKUs by subscription term -->
            <div class="row justify-content-center">
                <?php foreach($product_sku->pageRecords as $sku){ 
                    if(isset($sku->imagePath) && $sku->imagePath != ''){
                       
                        $related_product_image_url = DOMAIN.'/'.$sku->imagePath;
                    }
                    ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <?php if(url_exists($related_product_image_url)){ ?>
                        <img src="<?php echo $related_product_image_url; ?>" class="card-img-top" alt="<?php echo $sku->calculatedSkuDefinition; ?>">
                        <?php } else { ?>
                             <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="<?php echo $sku->calculatedSkuDefinition; ?>">
                        <?php } ?>
                        <div class="card-body">
                            <!-- Subscription Term -->
                             <h5 class="card-title"><?php echo $sku->calculatedSkuDefinition; ?></h5>
                              <input type="hidden" name="skuID" id="skuID" value="<?php echo $sku->skuID; ?>">
                            <!-- SKU Description -->
                            <p class="card-text"><?php echo $sku->skuDescription; ?></p>
                            <?php if(isset($sku->listPrice) && $sku->listPrice != ''){ ?>
                            <!-- SKU List Price --> <s class="float-right small">$<?php echo price_number_format($sku->listPrice); ?></s>
                            <?php } ?>
                            <!-- SKU Price -->
                            <p>$<?php echo price_number_format($sku->salePrice); ?> <small class="text-muted">/ month</small>
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <?php if($sku->calculatedQATS > 0){ ?>
                            <input type="hidden" class="form-control" name="quantity" id="quantity" aria-describedby="quantity" value="1" required>
              <button type="button" class="add-to-cart subscription-add-to-cart btn btn-primary">Subscribe Now</button>
               <?php } else {
                    echo '<small>Out of Stock</small>';
                } ?>
                            
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        <!-- Subscription Checkout Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="staticBackdropLabel">Complete Your Order</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>

                        </button>
                    </div>
                    <div class="modal-body">
                        
                          <!-- Show alert message if product has already been added to cart -->
                          <div class="alert alert-info already-added" style="display:none;">This subscription product has already been added to your cart. Please
                            continue below to subscribe to this product.</div>
                        <!-- If more items exist
                        in cart, alert and redirect user complete their purchase in shopping cart
                        -->
                        <div class="alert alert-success added-in-cart" style="display:none;">Subscription product has been added to your cart. Please checkout with
                            the rest of your order below.”</div>
                        <div class="text-center p-5 shopping-cart-btn" style="display:none;">
                            <p><a href="/cart/" class="btn btn-primary">Continue to Shopping Cart</a>
                            </p>
                        </div>
                    <div class="subscription_checkout_area" >
                        <!-- Order Item Details -->
                        <div class="p-3 mb-4 bg-light text-center">
                            <h6 class="sub-product-name"><?php echo $cart_data->orderItems[0]->sku->skuDefinition; ?></h6>

                            <p class="mb-0 sub-product-price">$<?php echo price_number_format($cart_data->total); ?> <small class="text-muted sub-product-type">/ monthly subscription</small>
                            </p>
                        </div>
                        <?php if($token == ''){ ?>
                        <!-- Account Login / Create Account -->
                        <?php  $templates->get_template_part( 'content', 'checkout-account',true ); ?>
                        <?php } ?>
                    <!-- /End Account Information -->
                    <div class="step-two" style="display:none;">
                        
                        <div class="billig-payment-area">
                    <!-- Billing Information -->
                    <!-- Display this section only after account login success -->
                     <h6 class="font-weight-bold">Billing Address</h6>
                     
                    <div class="nav nav-tabs justify-content-between mb-3 border-0" id="nav-tab"
                    role="tablist"> 
                        <a class="nav-link border-0 pl-0 <?php echo empty($cart_data->account->accountAddresses)==true?'active':''; ?>" id="nav-addNewAddress-tab"
                        data-toggle="tab" href="#nav-addNewAddress" role="tab" aria-controls="nav-addNewAddress"
                        aria-selected="false">Add New Address</a>
                        <a class="nav-link border-0 pl-0 <?php echo empty($cart_data->account->accountAddresses)==false?'active':'d-none'; ?>" id="nav-selectAddress-tab" data-toggle="tab"
                        href="#nav-selectAddress" role="tab" aria-controls="nav-selectAddress"
                        aria-selected="true">Select Address</a>
 

                    </div>
                     <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade <?php echo empty($cart_data->account->accountAddresses)==false?'show active':''; ?>" id="nav-selectAddress" role="tabpanel"
                        aria-labelledby="nav-selectAddress-tab">
                            <!-- If existing account billing addresses exist, preselect primary billing
                            address with any secondary addresses available to select in dropdown -->
                            <div class="alert alert-success account_billing_address_added" style="display:none;">Billing Address Added successfully</div>
                            <div class="alert alert-info account_billing_address_add_error" style="display:none;">Billing Address Added successfully</div>
                            <select class="custom-select subscription_billing_account_address mb-4 <?php echo empty($cart_data->account->accountAddresses)==true?'d-none':''; ?>" name="billingAddress" style="font-size:100%;">   
                                <?php if(!empty($cart_data->account->accountAddresses)){ $address_count = 1; foreach($cart_data->account->accountAddresses as $address){ ?>
                                <option value="<?php echo $address->accountAddressID; ?>" <?php echo $address_count==1?'selected':''; ?>><?php echo $address->accountAddressName.' - '.$address->address->streetAddress.','.$address->address->city.' '.$address->address->stateCode.' '.$address->address->postalCode; ?></option>
                                <?php $address_count++; } } else {
                                echo '<option>No Address Added</option>';
                            } ?>                              
                            </select>
                        </div>
                         <div class="tab-pane fade <?php echo empty($cart_data->account->accountAddresses)==true?'show active':''; ?>" id="nav-addNewAddress" role="tabpanel" aria-labelledby="nav-addNewAddress-tab">
                    <form action="add_account_billing" id="add-account-billing">
                        <div class="row">
                            
                            
                            <div class="col-lg-6">
                           <div class="form-group">
                            <label for="checkout-fn">Name</label>
                            <input class="form-control required" name="newOrderPayment.billingAddress.name" type="text" id="name">
                            <div class="invalid-feedback">Name Required</div>
                        </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="checkout-address-1">Street Address</label>
                                    <input class="form-control required" name="newOrderPayment.billingAddress.streetAddress" type="text" id="checkout-address">
                                    <div class="invalid-feedback">Street Address Required</div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="checkout-address-2">Street Address 2</label>
                                    <input class="form-control" type="text" name="newOrderPayment.billingAddress.streetAddress2" id="checkout-address-2">
                                </div>
                            </div>
                            <div class="col-lg-6">
                            <div class="form-group">
                            <label for="checkout-city">City</label>
                            <input class="form-control required" type="text" name="newOrderPayment.billingAddress.city" id="checkout-city">
                            <div class="invalid-feedback">City Required</div>
                        </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <?php if(isset($countries)){ ?>
                                            <div class="col-sm-6">
    							<div class="form-group">
    								<label for="checkout-city">Country</label>
                                                                <select class="form-control custom-select county_value required" data-state="billing_state" name="newOrderPayment.billingAddress.countryCode" id="checkout-country">
                                                                    <option value="">Choose Country</option>
                                                                    <?php foreach($countries as $country){ ?>
                                                                    <option value="<?php echo $country->value; ?>" <?php echo $country->value=='US'?'selected':''; ?>><?php echo $country->name; ?></option>
                                                                    <?php } ?>
    								</select>
                                    <div class="invalid-feedback">Country Code Required</div>
    							</div>
    						</div>
                                            <?php } ?>
                            <div class="col-sm-6">
                                        <div class="form-group">
                                                <label for="checkout-state">State</label>
                                                <select class="form-control custom-select required" name="newOrderPayment.billingAddress.stateCode" id="billing_state">
                                                    <option value="">Choose State</option>
                                                    <?php foreach($default_states as $state){
                                                    echo '<option value="'.$state->value.'">'.$state->name.'</option>';
                                                } ?>
                                                </select>
                    <div class="invalid-feedback">State Required</div>
                                        </div>
                                </div>
                           </div>
                        
                        <div class="row"> 
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="checkout-zip">ZIP Code</label>
                                    <input class="form-control required" name="newOrderPayment.billingAddress.postalCode" type="text" id="checkout-zip">
                                    <div class="invalid-feedback">Zip Code Required</div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                            <div class="form-group">
                            <label for="checkout-fn">Nickname</label>
                            <input class="form-control required" name="newOrderPayment.billingAddress.accountAddressName" type="text" id="checkout-name">
                            <div class="invalid-feedback">Nickname Required</div>
                            </div>
                            </div>
                        </div>
                        <!--div class="form-group mt-4">
                            <button class="btn btn-primary btn-block" type="submit">Add Billing</button>
                        </div-->
                    </form>
                         </div>
                     <form  action="" method="POST" class="add-order-payment">
                        <!-- Payment Information -->
                        <div class="add_order_payment"></div>
                         <h6 class="font-weight-bold">Payment Information</h6>
                         <input type="hidden" id="subscription_placeorder" name="subscription_placeorder" value="1">
                        <div class="form-group mb-4">
                            <label for="checkoutPaymentCardNumber">Credit Card Number</label>
                            <input class="form-control number required"  id="checkoutPaymentCardNumber" name="newOrderPayment.creditCardNumber" type="text" required="">
                            <div class="invalid-feedback">Invalid Credit Card #</div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="checkoutPaymentCardName">Name on Card</label>
                            <input class="form-control required" id="checkoutPaymentCardName" name="newOrderPayment.nameOnCreditCard" type="text" required="">
                            <div class="invalid-feedback">Name Required</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group mb-md-0">
                                   
                                    <label for="checkoutPaymentMonth">Expiration Month</label>
                                    <select name="newOrderPayment.expirationMonth" class="custom-select required" id="checkoutPaymentMonth">
                                       <?php foreach($months as $key => $value) {
                                           if ($key >= $current_month){ echo "<option value='$key'>$value</option>";}
                                         } ?>
                                    </select>
                                    <div class="invalid-feedback">Expiration Month Required</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-md-0">
                                    <label for="checkoutPaymentCardYear">Expiration Year</label>
                                    <select name="newOrderPayment.expirationYear" class="custom-select required" id="checkoutPaymentCardYear">
                                      <?php for($i = 0;$i<=10;$i++){ ?>
                                        <option value="<?php echo $current_year+$i; ?>"><?php echo $current_year+$i; ?></option>
                                      <?php  } ?>
                                    </select>
                                    <div class="invalid-feedback">Expiration Year Required</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="checkoutPaymentCardCVV">CVV</label>
                                    <input class="form-control numfieldvalidate required number" name="newOrderPayment.securityCode" id="checkoutPaymentCardCVV" type="text" >
                                    <div class="invalid-feedback">CVV # Required</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <!-- Add order payment and place order -->
                            <button class="btn btn-primary btn-block" type="submit">Place Order</div>
                    </form>
                    </div>
                    <!-- /End Billing Information -->
                    <!-- Order Confirmation -->
                        </div>
                    <!-- Display only after order payment and place order success -->
                    <div class="text-center p-5 order-placed-area" style="display: none;"> <i class="fas fa-check-circle fa-4x text-success mb-3"></i>

                         <h4>Your order has been placed!</h4>

                         <h5 class="mb-4">Order #123456</h5>

                         <p><a href="<?php echo get_site_url().'/'.SLATWALL_MY_ACCOUNT_SLUG; ?>" class="btn btn-primary">Go to My Account</a>
                        </p>
                    </div>
                </div>
                    </div>
            </div>
        </div>
        </div>
        </div>
            
<div  id="qloader" style="display: none;"><div class="loader" style="display: flex;"><i class="fas fa-circle-notch fa-spin fa-3x"></i></div></div>
<script>
var token;
<?php
if(isset($token)){
?>
var token = "<?php echo $token; ?>";
console.log(token.length);
<?php
}
?>
  /********************** Hide and show shipping section based on login ********************/
if (token.length !== 0) {
    console.log(1);
   jQuery('.step-two').show();
} else {
    console.log(2);
  jQuery('.step-two').hide();
}
/********************** End Hide and show shipping section based on login ********************/
jQuery('.checkoutforms').removeClass('col-md-8').removeClass('col-xl-7');
</script>
