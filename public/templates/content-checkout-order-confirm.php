<?php>
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>

!-- Start Body -->
<?php $cart_data;
$shipping_address = isset($cart_data->cart->orderFulfillments[0]->shippingAddress)?$cart_data->cart->orderFulfillments[0]->shippingAddress:'';
$billing_address = isset($cart_data->orderPayments[0]->billingAddress)?$cart_data->orderPayments[0]->billingAddress:'';
$credit_card_last_four = isset($cart_data->orderPayments[0]->creditCardLastFour)?$cart_data->orderPayments[0]->creditCardLastFour:'';

?>
<div class="alert alert-success my-4 order-placed" style="display:none;width: 100%;"></div>
				<div class="col-xl-7 col-sm-8 reviewconfirm col-print-7" style="display: none;">
                    <!-- Review Order -->
                    <h3 class="mb-3 pt-3 pb-3 border-bottom">Shipping & Billing</h3>

                    <div class="row order_review_area">
                        <?php if($shipping_address){ ?>
						<!-- Review Order: Shipping Address -->
                        <div class="col-sm-6 mb-4 col-print-6">
                            <!-- Shipping Info -->
                            <div class="bg-light p-4 h-100">
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
                        <div class="col-sm-6 mb-4 col-print-6">
                            <!-- Billing Address -->
                            <div class="bg-light p-4 h-100">
                                <h6 class="card-title text-muted">Billing Address</h6>
                                <address class="dsdsd small mb-0">
                                  <?php echo $billing_address->name.'<br>'.$billing_address->streetAddress.'<br>'.$billing_address->city.', '.$billing_address->stateCode.' '.$billing_address->postalCode.'<br>'.$billing_address->countrycode; ?>
                                </address>
                            </div>
                        </div>
                        <?php }?>
                        <?php if($credit_card_last_four){ ?>
						<!-- Review Order: Payment Method -->
                        <div class="col-sm-6 mb-4 col-print-6">
                            <div class="bg-light p-4 h-100">
                                <h6 class="card-title text-muted">Payment Information</h6>
                                <p class="small">Credit Card ending in <?php echo $credit_card_last_four; ?></p>
                            </div>
                        </div>
                        <?php }?>
                    </div>

                     <!-- /End Review Order -->
				</div>
                <!-- /End Body -->
