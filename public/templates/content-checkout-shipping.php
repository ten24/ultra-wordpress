<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>
<?php $shipping_methods = json_decode(isset($availale_shipping_method->scalar)?$availale_shipping_method->scalar:'');
$shipping_flag = 0;
$pickup_flag = 0;

function multiple_in_array2($cart_data_items,$seach_value){
    foreach($cart_data_items as $cart_data_item){

        if($cart_data_item->orderItemID == $seach_value){
            return $cart_data_item;
        }
    }
    return false;
}
$bundle_items = array();
$normal_items = array();
foreach($orderItems as $item){
    if(isset($item->parentOrderItemID) && $item->parentOrderItemID !== ''){
        $value =  multiple_in_array2($cart_data->orderItems, $item->parentOrderItemID);
        if(isset($value) && !isset($bundle_items[$value->orderItemID])){
        $bundle_items[$value->orderItemID] = (array)$value;
        $bundle_items[$value->orderItemID]['items'] = array();
        }
        array_push($bundle_items[$value->orderItemID]['items'], array($item));

    } else {
        $normal_items[$item->orderItemID] = $item;
    }
}
foreach($bundle_items as $item_key => $item){
                                //d($item_key);
                                if(isset($normal_items[$item_key])){
                                    unset($normal_items[$item_key]);
                                }
}
$orderItems = array_merge($bundle_items, $normal_items);
foreach($orderItems as $item){
    $item = (object)$item;
    if(isset($item->skuFulfillmentMethods)){
   foreach($item->skuFulfillmentMethods as $skuFulfillmentMethod){
     if($skuFulfillmentMethod->fulfillmentMethodType === 'shipping'){
         $shipping_flag = 1;
     }
     if($skuFulfillmentMethod->fulfillmentMethodType === 'pickup'){
         $pickup_flag = 1;
     }
   }
  }
}

?>
<!-- Start Body -->
<div class="col-xl-7 col-md-8 shippinginfo" style="display:none">

    <div id="shipping_step_one" style="display:<?php echo $pickup_flag==1?'block':'none'; ?>">
    <?php if($shipping_flag){ ?>
	<!-- Shipping Info -->
	<h3 class="mb-3 pt-3 pb-3 border-bottom">Shipping & Pickup</h3>

        <!-- Shipping Info Header -->
                    <div class="row ">
                        <div class="col-md-12 mb-4">
                            <p>Select the items you would like shipped to your address or select store pickup options.</p>
                        </div>
                    </div>

         <!-- Select Preferences for Pickup & Shipping -->


                        <div class="row ">
                            <div class="col-md-12 mb-0">

                                <!--- <p class="mb-3">Items on your shipment <span class="badge badge-secondary">2</span></p> --->

                                <ul class="list-unstyled mb-0 shipping_pickup_items">
                                    <?php foreach($orderItems as $item){
                                         $item = (object)$item;
                                        $product_single_url = get_site_url().'/'.SLATWALL_PRODUCT_SINGLE_SLUG.'/'.$item->sku->product->urlTitle;
                                        ?>
                                    <li class="media mb-4 pb-4 border-bottom">
                                        <img src="<?php echo DOMAIN.'/'.$item->sku->imagePath; ?>" alt="<?php echo $item->sku->product->productName; ?>" class="img-fluid mr-3" width="45" height="45">
                                        <div class="media-body">
                                            <div class="row justify-content-between">
                                                <div class="col-md-6">
                                                    <a class="text-body font-weight-bold product-name" href="<?php echo $product_single_url; ?>" data-skuID="<?php echo $item->orderItemID; ?>"><?php echo $item->sku->product->productName; ?></a>
                                                    <br> <small>Qty: <?php echo $item->quantity; ?></small><?php echo $item->sku->skuDefinition?', '.$item->sku->skuDefinition:''; ?></small>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <?php $fulfillment_count = 1; foreach ($item->skuFulfillmentMethods as $fulfillment){
                                                        if($fulfillment->fulfillmentMethodType == 'shipping' || $fulfillment->fulfillmentMethodType == 'pickup'){
                                                        ?>
                                                    <button data-type="<?php echo $fulfillment->fulfillmentMethodType; ?>" class="btn btn-<?php echo $fulfillment_count==1?'primary':'secondary'; ?> m-2 btn-sm fulfillment_select <?php echo $fulfillment_count==1?'active disabled':''; ?>" id="<?php echo $fulfillment->fulfillmentMethodID; ?>"><?php echo $fulfillment_count==1?'<i class="fa fa-check"></i>':''; ?> <?php echo $fulfillment->fulfillmentMethodName; ?></button>
                                                        <?php $fulfillment_count++; } } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>

                                </ul>
                                <button class="btn btn-primary shipping_pickup" type="button" data-type="shipping_pickup">Continue</button>
                            </div>
                        </div>
         <?php } else { ?>
         <div id="shippingAddressBook" class="collapse show multi-collapse">
                        <h5 class="text-secondary my-4">Store Pickup</h5>

                        <div class="row ">
                            <div class="col-md-12 mb-2">
                                <h5>Your order can be picked up in store.</h5>
                                <p>Please visit out store for to pick up your order. Please bring a copy of your receipt.</p>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-6 mb-2">
                                <button class="btn btn-primary shipping_pickup" type="button" data-type="pickup">Continue to Payment</button>
                            </div>
                        </div>
         </div>
         <?php } ?>
    </div>
    <div id="shipping_step_two" style="display:<?php echo $pickup_flag==1?'none':'block'; ?>;">
        <?php //if(isset($shipping_methods->availableShippingMethods) && isset($shipping_methods->availableShippingMethods[0]->value)){ ?>
        <div id="shippingCreateAddress" class="collapse multi-collapse <?php echo count((array)$account_address)==0?'show':''; ?>">

            <div class="row mb-4 mt-3">
                            <div class="col-sm-8">
                                <h5 class="text-secondary">Create Shipping Address</h5>
                            </div>
                            <!--- Only Show if there are address book entries --->
                            <?php if(count((array)$account_address)!==0){ ?>
                            <div class="col-sm-4 text-right">
                                <button class="btn btn-sm btn-outline-secondary show-address-book" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="shippingAddressBook shippingCreateAddress">Show Address Book</button>
                            </div>
                            <?php } ?>
                        </div>

	<!-- Shipping Address -->

	<!-- Shipping Address Create Error Message -->
	<div class="shipmentnotadded"></div>
    <form action="add_shipping_address" method="POST" id="account-shipping">
                        <div class="row">
    						<div class="col-sm-6">
    							<div class="form-group">
    								<label for="checkout-fn">Name</label>
                                                                <input class="form-control required" name="name" type="text" id="checkout-n">
                                    <div class="invalid-feedback">Name Required</div>
    							</div>
    						</div>
    						<div class="col-sm-6">
    							<div class="form-group">
    								<label for="checkout-ln">Company</label>
                                                                <input class="form-control" name="company" type="text" id="checkout-company">
                                    <div class="invalid-feedback">Company Required</div>
    							</div>
    						</div>
    					</div>
    					<div class="row">
    						<div class="col-sm-6">
    							<div class="form-group">
    								<label for="checkout-address-1">Street Address 1</label>
                                                                <input class="form-control required" type="text" name="streetAddress" id="checkout-address-1">
                                    <div class="invalid-feedback">Street Address Required</div>
    							</div>
    						</div>
    						<div class="col-sm-6">
    							<div class="form-group">
    								<label for="checkout-address-2">Street Address 2</label>
                                                                <input class="form-control" type="text" name="street2Address" id="checkout-address-2">
    							</div>
    						</div>
    					</div>
    					<div class="row">
    						<div class="col-sm-6">
    							<div class="form-group">
    								<label for="checkout-city">City</label>
                                                                <input class="form-control required" name="city" type="text" id="checkout-city">
                                    <div class="invalid-feedback">City Required</div>
    							</div>
    						</div>
                                            <?php if(isset($countries)){ ?>
                                            <div class="col-sm-6">
    							<div class="form-group">
    								<label for="checkout-city">Country</label>
                                                                <select class="form-control custom-select county_value required" data-state="shipping_state" name="countryCode" id="checkout-country">
                                                                    <option value="">Choose Country</option>
                                                                    <?php foreach($countries as $country){ ?>
                                                                    <option value="<?php echo $country->value; ?>" <?php echo $country->value=='US'?'selected':''; ?>><?php echo $country->name; ?></option>
                                                                    <?php } ?>
    								</select>
                                    <div class="invalid-feedback">Country Code Required</div>
    							</div>
    						</div>
                                            <?php } ?>

    					</div>
    					<div class="row">
                                            <div class="col-sm-6">
    							<div class="form-group">
    								<label for="checkout-state">State</label>
                                                                <select class="form-control custom-select required" name="stateCode" id="shipping_state">
                                                                    <option value="">Choose State</option>
                                                                    <?php foreach($default_states as $state){
                                                                    echo '<option value="'.$state->value.'">'.$state->name.'</option>';
                                                                } ?>
    								</select>
                                    <div class="invalid-feedback">State Required</div>
    							</div>
    						</div>
    						<div class="col-sm-6">
    							<div class="form-group">
    								<label for="checkout-zip">ZIP Code</label>
                      <input class="form-control numfieldvalidate required number" name="postalCode" type="text" id="checkout-zip">
                      <div class="invalid-feedback">Zip Code Required</div>
                      <div class="invalid-feedback-phone invalid-feedback" style="display: none;">Please enter numbers only</div>
											<span class="small text-danger Numerrmsg"></span>
    							</div>
    						</div>
    					</div>
                    </form>
 </div>
        <div id="shippingAddressBook" class="collapse show multi-collapse">
                     <div class="account_address_for_shipping">
                     <?php if(count((array)$account_address)){ ?>
                    <!-- Select Existing Shipping Address -->
                    <h5 class="text-secondary my-4">Select Shipping Address</h5>

                    <div class="row">
                        <?php $count = 1; foreach($account_address as $address){  ?>
                        <div class="col-md-6 mb-4 account_address_item">
                            <!-- Shipping Info -->
                            <a href="javascript:void(0);" class="btn btn-block p-0 text-left account-address <?php echo $count==1?'active':''; ?>" id="<?php echo $address->accountAddressID; ?>">
                                <div class="bg-light p-4 h-100 border">
                                    <i class="fas <?php echo $count==1?'fa-check-circle':''; ?> float-right"></i>
                                    <h6 class="card-title text-muted"><?php echo $address->accountAddressName==''?$address->address->name:$address->accountAddressName; ?></h6>
                                    <address class="small mb-0 text-body">
                                        <?php //echo $address->address->name; ?><br>
                                         <?php echo $address->address->streetAddress; ?><br>
                                        <?php echo $address->address->city; ?>, <?php echo $address->address->stateCode.' '.$address->address->postalCode; ?><br>
                                        <?php echo $address->address->countryCode; ?>
                                    </address>
                                </div>
                            </a>
                        </div>
                        <?php $count++; } ?>
                        <div class="col-md-12 mb-2">
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="shippingAddressBook shippingCreateAddress"><i class="fa fa-plus"></i> Add New Address</button>
                            </div>
                    </div>

                    <?php } ?>
                    </div>
        </div>
        <span data-fulfillment="<?php echo $orderFulfillmentID->scalar; ?>" id="order_fulfillment_id"></span>
                                        <div class="select_shipping_area">
                    <?php if(isset($shipping_methods->availableShippingMethods) && isset($shipping_methods->availableShippingMethods[0]->value)){ ?>
                    <!-- Shipping Fulfillment -->
                    <h5 class="text-secondary my-4">Select Shipping Fulfillment</h5>
                    <?php $count_shipping = 1;  foreach($shipping_methods->availableShippingMethods as $method){ ?>
                    <div class="form-check mb-3">
                        <?php
                        $selected_shipping_method = '';
                        if(isset($selected_shipping->shippingMethodID)){
                        $selected_shipping_method = $selected_shipping->shippingMethodID;
                        }
                        ?>
                	    <input class="form-check-input" type="radio" name="shipping_method" id="shipping<?php echo $count_shipping; ?>" value="<?php echo $method->value; ?>" <?php echo $selected_shipping_method==$method->value?'checked':''; ?>>
                	    <label class="form-check-label" for="shipping<?php echo $count_shipping; ?>"><?php echo $method->name; ?></label>
                    </div>
                    <?php $count_shipping++; } ?>

                    <?php } else {
                        echo '<p>No Shipping Method Added in the Product, Please choose another Product to checkout</p>';
                    } ?>
                                        </div>
                    <div class="form-group w-50 mt-5">
                        <!-- Toggle disabled attribute after form submit validation to continue -->

                        <button class="btn btn-secondary btn-block" id="shipping_countinue" type="button">Continue</button>

                    </div>


	<!-- /End Shipping Info -->
        <?php //} ?>
    </div>
</div>
<!-- /End Body -->
