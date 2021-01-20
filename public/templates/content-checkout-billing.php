<?php>
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>

<?php $searchedValue = 'termPayment';
$neededeligiblePaymentMethodDetails = array_filter(
    (array)$eligiblePaymentMethodDetails,
    function ($e) use (&$searchedValue) {

    if($e->paymentMethod->paymentMethodType == $searchedValue){
        $paymentMethodID = $e->paymentMethod->paymentMethodID;
         return $paymentMethodID;
    }

    }
);
//$first_key = array_key_first($neededeligiblePaymentMethodDetails);
$first_key = key($neededeligiblePaymentMethodDetails);
if(isset($neededeligiblePaymentMethodDetails) && !empty($neededeligiblePaymentMethodDetails)){
$paymentMethodID = $neededeligiblePaymentMethodDetails[$first_key]->paymentMethod->paymentMethodID;
}
?>
<!-- Start Body -->
				<div class="col-xl-7 col-md-8 billinginfo" style="display: none;">
                    <!-- Start Payment Info  -->
                    <div class="alert alert-danger small billingnotadded" style="display: none;">Please Select Billing Address</div>
                     <div class="add_order_payment" style="display: none;"></div>
                    <h3 class="mb-3 pt-3 pb-3 border-bottom">Billing Information</h3>

                    <!-- Billing Address -->
                    <h5 class="text-secondary my-4">Select Billing Address</h5>

                    <!-- Billing same as shipping option -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="billingAddress" name="billing_same_as_shipping" value="1" checked>
                        <label class="form-check-label" for="billingAddress">Billing Address is same as Shipping Address</label>
                    </div>
                    <?php  if(!empty($account_address)){ ?>
                    <!-- Select Existing Billing Address option - hide if checkbox above is selected -->
                    <div id="billingAddressBook" class=" collapse show multi-collapse">
                    <div class="row mt-4 billing_account_address" style="display:none;">

                         <?php $count = 1; foreach($account_address as $address){  ?>
                        <div class="col-md-6 mb-4">
                            <!-- Shipping Info -->
                            <a href="javascript:void(0);" class="btn btn-block p-0 text-left account-address <?php echo $count==1?'active':''; ?>" id="<?php echo $address->accountAddressID; ?>">
                                <div class="bg-light p-4 h-100 border">
                                    <i class="far  <?php echo $count==1?'fa-check-circle':''; ?> float-right"></i>
                                    <h6 class="card-title text-muted"><?php echo $address->accountAddressName==''?$address->address->name:$address->accountAddressName; ?></h6>
                                     <address class="small mb-0 text-body">
                                        <?php // echo $address->name; ?><br>
                                         <?php echo $address->address->streetAddress; ?><br>
                                        <?php echo $address->address->city; ?>, <?php echo $address->address->stateCode.' '.$address->address->postalCode; ?><br>
                                        <?php echo $address->address->countryCode; ?>
                                    </address>
                                </div>
                            </a>
                        </div>
                         <?php $count++; } ?>
                            <div class="col-md-12 mb-2">
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="billingAddressBook billingCreateAddress"><i class="fa fa-plus"></i> Add New Address</button>
                            </div>

                        </div>
                    </div>
                    <?php }  ?>
                    <div class="create_new_billing_address" style="display:none;">
                        <div id="billingCreateAddress" class="collapse multi-collapse">
                            <?php if(count((array)$account_address)!==0){ ?>
                            <div class="col-sm-4 text-right pull-right">
                                <button class="btn btn-sm btn-outline-secondary show-address-book" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="billingAddressBook billingCreateAddress">Show Address Book</button>
                            </div>
                            <?php } ?>
                    <!-- Create Billing Address: hide if checkbox for shipping address same as billing address above is selected  -->
                    <h5 class="text-secondary my-4">Create Billing Address</h5>

                    <!-- Billing Address Created Success Message -->
                    <div class="alert alert-success small account_billing_address_added" style="display:none;">Billing Address Created</div>
                    <div class="account_billing_address_add_error"></div>
					<!-- Billing Address Create Error Message -->
					<div class="alert alert-danger small" style="display:none;">Error Creating Billing Address</div>

                    <form action="add_account_billing" id="add-account-billing">
                        <div class="row">
                            <div class="col-sm-6">
                                        <div class="form-group">
                                                <label for="checkout-fn">Nickname</label>
                                                <input class="form-control required" name="accountAddressName" type="text" id="checkout-name">
                    <div class="invalid-feedback">Nickname Required</div>
                                        </div>
                                </div>
                                <div class="col-sm-6">
                                        <div class="form-group">
                                                <label for="checkout-fn">Name</label>
                                                <input class="form-control required" name="name" type="text" id="checkout-name">
                    <div class="invalid-feedback">Name Required</div>
                                        </div>
                                </div>

                        </div>
                        <div class="row">
                             <div class="col-sm-6">
                                        <div class="form-group">
                                                <label for="checkout-fn">Company</label>
                                                <input class="form-control" name="company" type="text" id="checkout-company">
                    <div class="invalid-feedback">Company Required</div>
                                        </div>
                                </div>
                                <div class="col-sm-6">
                                        <div class="form-group">
                                                <label for="checkout-address-1">Street Address 1</label>
                                                <input class="form-control required" name="streetAddress" type="text" id="checkout-address-1">
                    <div class="invalid-feedback">Street Address Required</div>
                                        </div>
                                </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                        <div class="form-group">
                                                <label for="checkout-address-2">Street Address 2</label>
                                                <input class="form-control" type="text" name="street2Address" id="checkout-address-2">
                                        </div>
                                </div>
                                <div class="col-sm-6">
                                        <div class="form-group">
                                                <label for="checkout-city">City</label>
                                                <input class="form-control required" name="city" type="text" id="checkout-city">
                    <div class="invalid-feedback">City Required</div>
                                        </div>
                                </div>

                        </div>
                        <div class="row">
                            <?php if(isset($countries)){ ?>
                                            <div class="col-sm-6">
    							<div class="form-group">
    								<label for="checkout-city">Country Country</label>
                                                                <select class="form-control custom-select county_value required" data-state="billing_state" name="countryCode" id="checkout-country">
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
                                                <select class="form-control custom-select required" name="stateCode" id="billing_state">
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
                            <div class="col-sm-6">
                                        <div class="form-group">
                                                <label for="checkout-zip">ZIP Code</label>
                                                <input class="form-control required" name="postalCode" type="text" id="checkout-zip">
                    <div class="invalid-feedback">Zip Code Required</div>
                                        </div>
                                </div>
                        </div>
                                <div class="form-group w-50 mt-3">
                                        <button class="btn btn-secondary btn-block" type="submit">Save Address <i class="fas fa-circle-notch fa-spin"></i></button>
                                </div>
                        </form>
                    </div>
                                </div>


                    <!-- Select Payment Method -->
                    <h5 class="text-secondary my-4">Select Payment Method</h5>

                    <!-- Payment Method Accordion -->
                    <div id="paymentAccordion">
						<!-- Credit Card Payment Radio Select -->
                		<div class="custom-control custom-radio mb-3">
                			<input class="custom-control-input" id="checkoutPaymentCard" name="payment" type="radio" data-toggle="collapse" data-action="show" data-target="#checkoutPaymentCardCollapse">
                			<label class="custom-control-label font-weight-bold" for="checkoutPaymentCard">
                			Credit Card
                			</label>
                		</div>

						<!-- Credit Card Payment Radio Dropdown -->
                    	<div class="collapse pl-4 pt-1 pb-4" id="checkoutPaymentCardCollapse" data-parent="#paymentAccordion">
                            <!-- Credit Card Payment Error Message -->
							<div class="alert alert-danger small paymenterror" style="display: none;">Error processing credit card payment</div>

							<!-- Credit Card Payment Form -->
                                                        <form action="" method="POST" class="add-order-payment">
                        		<div class="form-row form-group">
                        			<div class="col-12">
                        				<div class="form-group mb-4">
                        					<label for="checkoutPaymentCardNumber">Card Number</label>
                                     <input class="form-control numfieldvalidate required number" id="checkoutPaymentCardNumber" name="newOrderPayment.creditCardNumber" type="text" >
                                    	<div class="invalid-feedback">Invalid Credit Card #</div>
					<div class="invalid-feedback-phone invalid-feedback" style="display: none;">Please enter numbers only</div>														<span class="small text-danger Numerrmsg"></span>
                        				</div>
                        			</div>
                        			<div class="col-12">
                        				<div class="form-group mb-4">
                        					<label for="checkoutPaymentCardName">Name on Card</label>
                                    <input class="form-control required" id="checkoutPaymentCardName" name="newOrderPayment.nameOnCreditCard" type="text" >
                                    <div class="invalid-feedback">Name Required</div>
                        				</div>
                        			</div>
                        			<div class="col-12 col-md-4">
                        				<div class="form-group mb-md-0">
                        					<label for="checkoutPaymentMonth">Expiration Month</label>
                                    <select name="newOrderPayment.expirationMonth" class="custom-select required" id="checkoutPaymentMonth" >
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                        					</select>
                                            <div class="invalid-feedback">Expiration Month Required</div>
                        				</div>
                        			</div>
                        			<div class="col-12 col-md-4">
                        				<div class="form-group mb-md-0">
                        					<label for="checkoutPaymentCardYear">Expiration Year</label>
                                     <select name="newOrderPayment.expirationYear" class="custom-select required" id="checkoutPaymentCardYear" >
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                                <option value="2028">2029</option>
                                                <option value="2028">2030</option>
                        					</select>
                                            <div class="invalid-feedback">Expiration Year Required</div>
                        				</div>
                        			</div>
                        			<div class="col-12 col-md-4">
                        				<div class="form-group">
                                    <label for="checkoutPaymentCardCVV">CVV</label>
                                    <input class="form-control numfieldvalidate required number" name="newOrderPayment.securityCode" id="checkoutPaymentCardCVV" type="text" >
                                    <div class="invalid-feedback">CVV # Required</div>
					<div class="invalid-feedback-phone invalid-feedback" style="display: none;">Please enter numbers only</div>													<span class="small text-danger Numerrmsg"></span>
                        				</div>
                        			</div>
                        		</div>
                                 <input type="hidden" name="order_type" value="credit_card">
                                <div class="form-group w-50">
                                    <!-- Toggle disabled attribute after form submit validation to continue -->
                                    <button class="btn btn-secondary btn-block" type="submit" value="Continue">Continue</button>
                                </div>
                            </form>
                            <!-- /End Credit Card Payment Form -->
                    	</div>
						<!-- /End Credit Card Payment Dropdown -->
                         <?php if(isset($paymentMethodID)){ ?>
                        <!-- Purchase Order Payment Radio Select -->
                		<div class="custom-control custom-radio">
                			<input class="custom-control-input" id="checkoutPaymentPurchaseOrder" name="payment" type="radio" data-toggle="collapse" data-action="hide" data-target="#checkoutPaymentPurchaseOrder">
                			<label class="custom-control-label font-weight-bold" for="checkoutPaymentPurchaseOrder">Purchase Order</label>
                		</div>

						<!-- Purchase Order Payment Dropdown -->
                        <div class="collapse pl-4 pt-3" id="checkoutPaymentPurchaseOrder" data-parent="#paymentAccordion">
                            <!-- Purchase Order Error Message -->

							<!-- Purchase Order Payment Form -->
                                                        <form action="" method="POST" class="add-order-payment">
                                <div class="form-group">
                                    <label for="purchaseOrder">Enter Purchase Order #</label>
                                    <input class="form-control required" type="text" id="purchaseOrder" name="newOrderPayment.purchaseOrderNumber">
                                    <div class="invalid-feedback">Purchase Order # Required</div>
                                </div>
                                <input type="hidden" name="newOrderPayment.paymentMethod.paymentMethodID" value="<?php echo $paymentMethodID; ?>">
                                <input type="hidden" name="order_type" value="purchase_order">
                                <div class="form-group w-50">
                                    <!-- Toggle disabled attribute after form submit validation to continue -->
                                    <button class="btn btn-secondary btn-block" type="submit">Continue <i class="fas fa-circle-notch fa-spin"></i></button>
                                </div>
                            </form>
                            <!-- /End Purchase Order Payment Form -->
                        </div>
						<!-- /End Purchase Order Payment Dropdown -->
                         <?php } ?>
                    </div>
                    <!-- /End Payment Information -->
				</div>
                <!-- /End Body -->
