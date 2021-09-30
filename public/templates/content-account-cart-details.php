<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>
<div class="container my-5">
             <h1 class="mb-4">My Account</h1>

            <div class="row">
                <!-- Account Sidebar Navigation -->
               <?php  $templates->get_template_part( 'content', 'account-sidebar',true ); ?>
                <div class="col-12 col-md-9">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                         <h2 class="printarea">Shopping Cart</h2>
                         <a href="javascript:void(0);" class="btn btn-light text-secondary print" ><i class="fas fa-print"></i> Print Cart / Quote</a>
                    </div>

                    <!-- Info -->
                    <div class="bg-light p-4 mb-2 rounded printarea">
                        <div class="row">
                            <div class="col-lg-3 col-print-3">
                                <!-- Heading -->
                                 <h6 class="heading-xxxs text-muted">Quote #</h6>

                                <!-- Text -->
                                <p class="mb-lg-0 font-size-sm font-weight-bold"><?php //echo $order_details->orderDetails->orderInfo[0]->orderID; ?></p>
                            </div>
                            <div class="col-lg-3 col-print-3">
                                <!-- Heading -->
                                 <h6 class="heading-xxxs text-muted">Last Updated:</h6>

                                <!-- Text -->
                                <p class="mb-lg-0 font-size-sm font-weight-bold">
                                    <time datetime="<?php echo  DateTime::createFromFormat("F, j Y H:i:s O",$order_details->orderDetails->orderInfo['0']->modifiedDateTime)->format('F, j Y');?>"><?php echo  DateTime::createFromFormat("F, j Y H:i:s O",$order_details->orderDetails->orderInfo['0']->modifiedDateTime)->format('F, j Y');?></time>
                                </p>
                            </div>
                            <div class="col-lg-3 col-print-3">
                                <!-- Heading -->
                                 <h6 class="heading-xxxs text-muted">Status:</h6>

                                <!-- Text -->
                                <p class="mb-0 font-size-sm font-weight">
                                    <?php echo  $order_details->orderDetails->orderInfo['0']->orderStatusType_typeName; ?>

                                </p>
                            </div>
                            <div class="col-lg-3 col-print-3">
                                <!-- Heading -->
                                 <h6 class="heading-xxxs text-muted">Order Amount:</h6>

                                <!-- Text -->
                                <p class="mb-0 font-size-sm font-weight-bold">$<?php echo price_number_format($order_details->orderDetails->orderInfo['0']->calculatedTotal);?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row hideprint">
                        <div class="col-12 col-lg-12 p-1 mb-1 text-center">
                            Complete Your Order: <a href="javascript:void(0);" id="<?php echo $order_details->orderDetails->orderInfo[0]->orderID; ?>" class="cart_reopen btn btn-small btn-primary">Re-Open Cart</a>
                        </div>
                    </div>


                    <!-- Order Detail -->
                    <div class="card card-lg mb-5 border printarea">
                        <div class="card-body">
                             <h4 class="mb-4 pb-3 border-bottom">Order Items</h4>

                            <!-- Order Item Labels -->
                            <div class="bg-light p-2 mb-3 font-weight-bold text-secondary d-none d-lg-block">
                                <div class="row align-items-center">
                                    <div class="col-12 col-lg-6 col-print-6">Item</div>
                                    <div class="col-12 col-lg-2 col-print-2">Price</div>
                                    <div class="col-12 col-lg-2 col-print-2">Qty</div>
                                    <div class="col-12 col-lg-2 col-print-2">Total</div>
                                </div>
                            </div>
                            <!-- Order Items -->
                            <?php foreach($order_details->orderDetails->orderItems as  $val){
                                $product_single_url = get_site_url().'/'.SLATWALL_PRODUCT_SINGLE_SLUG.'/'.$val->sku_product_urlTitle;
                            ?>
                        <!-- Order Items -->
                        <div class="row align-items-center mb-5">
                            <div class="col-6 col-lg-6">
                                    <img src="<?php echo DOMAIN.'/'.$val->images[0]; ?>" alt="Product Name" class="img-fluid rounded float-left mr-3">
                                    <a class="text-body font-weight-bold" href="<?php echo $product_single_url; ?>"><?php echo $val->sku_product_productName;?></a> <br>
                                    <span class="text-muted"><?php echo $val->sku_calculatedSkuDefinition; ?></span>
                            </div>
                            <div class="col-2 col-lg-2">
                                <span class="text-muted">$<?php echo price_number_format($val->price);?></span>
                            </div>
                            <div class="col-2 col-lg-2">
                                <span class="text-muted"><?php echo $val->quantity;?></span>
                            </div>
                            <div class="col-2 col-lg-2">
                                <span class="text-muted">$<?php echo price_number_format($val->calculatedExtendedPriceAfterDiscount);?></span>
                            </div>
                        </div>
                    <?php } ?>
                            <!-- /End Order Items -->
                        </div>
                    </div>
                    <!-- Total -->
                    <div class="row printarea">
                        <div class="col-lg-7 col-print-7">
                            <div class="card mb-5">
                                <div class="card-body">
                                     <h4 class="mb-4 pb-3 border-bottom">Shipping & Billing</h4>
                                     <?php  ?>
                                    <!-- Content -->
                                    <div class="row">
                                        <?php if(isset($order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_streetAddress) && $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_streetAddress != ''){ ?>
                                        <div class="col-md-6 mb-4 col-print-6">
                                            	<h6 class="text-secondary font-weight-bold">Shipping Address</h6>
 <address class="small mb-0">
                                             <?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_name;?><br>
                                            <?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_streetAddress;?><br>
                                            <?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_city;?> <?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_city?', ':' '; ?> <?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_stateCode.' '. $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_postalCode;?><br>
                                            <?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_countryCode;?>
                                        </address>

                                        </div>
                                        <?php } ?>
                                        <div class="col-md-6 mb-4 col-print-6">
                                            	<h6 class="text-secondary font-weight-bold">Shipping Method</h6>
                                        <small>
                			<?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingMethod_shippingMethodName; ?>
                                        <?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_fulfillmentMethod_fulfillmentMethodName; ?>
                                        </small>

                                        </div>
                                        <?php if($order_details->orderDetails->orderPayments){ ?>
                                        <div class="col-md-6 mb-4 col-print-6">
                                            	<h6 class="text-secondary font-weight-bold">Billing Address</h6>
                                        <?php if($order_details->orderDetails->orderInfo['0']->billingAddress_streetAddress){ ?>
                                        <address class="small mb-0">
                                        <?php echo $order_details->orderDetails->orderInfo['0']->billingAddress_name;?><br>
                                            <?php echo $order_details->orderDetails->orderInfo['0']->billingAddress_streetAddress;?><br>
                                            <?php echo $order_details->orderDetails->orderInfo['0']->billingAddress_city;?> <?php echo $order_details->orderDetails->orderInfo['0']->billingAddress_city?', ':' '; ?>
                                            <?php echo $order_details->orderDetails->orderInfo['0']->billingAddress_stateCode.' '. $order_details->orderDetails->orderInfo['0']->billingAddress_postalCode;?><br>
                                            <?php echo $order_details->orderDetails->orderInfo['0']->billingAddress_countryCode;?>
                                        </address>
                                                        <?php } else { ?>
                                                          <address class="small mb-0">
                                        <?php echo $order_details->orderDetails->orderPayments['0']->billingAddress_name;?><br>
                                            <?php echo $order_details->orderDetails->orderPayments['0']->billingAddress_streetAddress;?><br>
                                            <?php echo $order_details->orderDetails->orderPayments['0']->billingAddress_city;?> <?php echo $order_details->orderDetails->orderPayments['0']->billingAddress_city?', ':' '; ?>
                                            <?php echo $order_details->orderDetails->orderPayments['0']->billingAddress_stateCode.' '. $order_details->orderDetails->orderPayments['0']->billingAddress_postalCode;?><br>
                                            <?php echo $order_details->orderDetails->orderPayments['0']->billingAddress_countryCode;?>
                                        </address>
                                                        <?php } ?>

                                        </div>
                                        <?php } ?>
                                        <?php if($order_details->orderDetails->orderPayments){ ?>
                                        <div class="col-6 col-md-6 mb-4">
                    					<h6 class="text-secondary font-weight-bold">Payment Method</h6>
                                                        <?php if($order_details->orderDetails->orderPayments['0']->creditCardLastFour){ ?>
                    					<small><?php echo $order_details->orderDetails->orderPayments['0']->paymentMethod_paymentMethodName.' ending in '.$order_details->orderDetails->orderPayments['0']->creditCardLastFour; ?> </small>
                                                        <?php } else { ?>
                                                            <small><?php echo $order_details->orderDetails->orderPayments['0']->paymentMethod_paymentMethodName; ?> </small>
                                                        <?php } ?>
                    				</div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-print-5">
                            <div class="card mb-5">
                                <div class="card-body">
                                     <h4 class="mb-4 pb-3 border-bottom">Order Total</h4>

                                    <ul class="list-unstyled m-0">
                                    <li class="d-flex ml-0 mb-3 pb-3 border-bottom">
                                        <span>Subtotal</span> <span class="ml-auto font-size-sm">$<?php echo price_number_format($order_details->orderDetails->orderInfo['0']->calculatedSubTotal);?></span>
                                    </li>
                                    <li class="d-flex ml-0 mb-3 pb-3 border-bottom">
                                        <span>Tax</span> <span class="ml-auto font-size-sm">$<?php echo price_number_format($order_details->orderDetails->orderInfo['0']->calculatedTaxTotal);?></span>
                                    </li>
                                    <?php if($order_details->orderDetails->orderInfo['0']->calculatedDiscountTotal){ ?>
                                    <li class="d-flex ml-0 mb-3 pb-3 border-bottom">
                                        <span>Discount</span> <span class="ml-auto font-size-sm">- $<?php echo price_number_format($order_details->orderDetails->orderInfo['0']->calculatedDiscountTotal);?></span>
                                    </li>
                                    <?php } ?>
                                    <li class="d-flex ml-0 mb-3 pb-3 border-bottom">
                                        <span>Shipping</span> <span class="ml-auto font-size-sm">$<?php echo price_number_format($order_details->orderDetails->orderInfo['0']->calculatedFulfillmentTotal);?> </span>
                                    </li>
                                    <li class="d-flex ml-0 font-size-lg font-weight-bold">
                                        <span>Total</span> <span class="ml-auto">$<?php echo price_number_format($order_details->orderDetails->orderInfo['0']->calculatedTotal);?></span>
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-12 p-1 mb-1 text-center">
                            Complete Your Order: <a href="javascript:void(0);" id="<?php echo $order_details->orderDetails->orderInfo[0]->orderID; ?>" class="cart_reopen btn btn-small btn-primary">Re-Open Cart</a>
                        </div>
                    </div>
                </div>

                <!-- /End Order Detail Body -->
            </div>
        </div>
<div  id="qloader" style="display: none;"><div class="loader" style="display: flex;"><i class="fas fa-circle-notch fa-spin fa-3x"></i></div></div>
