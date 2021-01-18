<!-- Start Body -->
<?php $cart_data;
$shipping_address = isset($cart_data->cart->orderFulfillments[0]->shippingAddress)?$cart_data->cart->orderFulfillments[0]->shippingAddress:'';
$billing_address = isset($cart_data->orderPayments[0]->billingAddress)?$cart_data->orderPayments[0]->billingAddress:'';
$credit_card_last_four = isset($cart_data->orderPayments[0]->creditCardLastFour)?$cart_data->orderPayments[0]->creditCardLastFour:'';

$payment_mathod_name = isset($cart_data->orderPayments[0]->paymentMethod->paymentMethodName)?$cart_data->orderPayments[0]->paymentMethod->paymentMethodName:'';

?>
<div class="col-xl-7 col-md-8 revieworder" style="display: none;">
                    <!-- Review Order -->
                    
                    <h3 class="mb-3 pt-3 pb-3 border-bottom">Review Order</h3>
                    
                    <div class="row order_review_area">
                        <?php if($shipping_address){ ?>
						<!-- Review Order: Shipping Address -->
                        <div class="col-md-6 mb-4">
                            <!-- Shipping Info -->
                            <div class="bg-light p-4 h-100">
                                <a href="#" data-section="shippinginfo" class="edit_review small float-right">Edit</a>
                                <h6 class="card-title text-muted">Shipping Address</h6>
                                <address class="small mb-0">
                                    <?php echo $shipping_address->name.'<br>'.$shipping_address->streetAddress.'<br>'.$shipping_address->city.', '.$shipping_address->stateCode.' '.$shipping_address->postalCode.'<br>'.$shipping_address->countrycode; ?>
                                </address>
                            </div>
                        </div>
				<?php } ?>
                                                <!-- Review Order: Shipping Fulfillment -->
                        
                        <?php if($billing_address){ ?>
						<!-- Review Order: Billing Address -->
                        <div class="col-md-6 mb-4">
                            <!-- Billing Address -->
                            <div class="bg-light p-4 h-100">
                                <a href="#" data-section="billinginfo" class="edit_review small float-right">Edit</a>
                                <h6 class="card-title text-muted">Billing Address</h6>
                                <address class="small mb-0">
                                  <?php echo $billing_address->name.'<br>'.$billing_address->streetAddress.'<br>'.$billing_address->city.', '.$billing_address->stateCode.' '.$billing_address->postalCode.'<br>'.$billing_address->countrycode; ?>
                                </address>
                            </div>
                        </div>
                        <?php }?>
						<!-- Review Order: Payment Method -->
                        <div class="col-md-6 mb-4">
                            <div class="bg-light p-4 h-100">
                                <a href="#" data-section="billinginfo" class="edit_review  float-right">Edit</a>
                                <?php if($credit_card_last_four){  ?>
                                <h6 class="card-title text-muted">Payment Information</h6>
                                <p class="small"><?php echo $payment_mathod_name; ?> ending in <?php echo $credit_card_last_four; ?></p>
                                <?php } else { ?>
                                <h6 class="card-title text-muted">Payment Information</h6>
                                    <p class="small"><?php echo $payment_mathod_name; ?></p>                                
                               <?php } ?>
                            </div>
                        </div>
                    </div>

                    <!-- Place Order: Toggle disabled attribute after form submit validation to continue -->
                    <button type="button" class="btn btn-block btn-primary mt-5" id="place-order">Place Order <i class="fas fa-circle-notch fa-spin"></i></button>
                    <!-- /End Review Order -->
				</div>
                <!-- /End Body -->
