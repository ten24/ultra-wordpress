<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>
<?php $order_fulfillments = $order_details->orderDetails->orderFulfillments;?>
<div class="container my-5">
<!-- <h1 class="mb-4">Order Details</h1> -->
        <div class="row">
			<?php $templates->get_template_part( 'content', 'account-sidebar',true ); ?>
	<!-- Email Address Listing -->
	<div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h2>Order #<?php echo $order_details->orderDetails->orderInfo['0']->orderNumber;?></h2>
                    <a href="#" class="btn btn-light text-secondary printbtn" onclick="window.print();"><i class="fas fa-print"></i> Print Order</a>
                </div>
                <!-- Info -->
                <div class="bg-light p-4 mb-5 rounded">
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <!-- Heading -->
                            <h6 class="heading-xxxs text-muted">Order #</h6>
                            <!-- Text -->
                            <p class="mb-lg-0 font-size-sm font-weight-bold">
                            <?php echo $order_details->orderDetails->orderInfo['0']->orderNumber;?>
                            </p>
                        </div>
                        <div class="col-6 col-lg-3">
                            <!-- Heading -->
                            <h6 class="heading-xxxs text-muted">Order date:</h6>
                            <!-- Text -->
                            <p class="mb-lg-0 font-size-sm font-weight-bold">
                                <time datetime="2019-10-01">
                                <?php echo  DateTime::createFromFormat("F, j Y H:i:s O",$order_details->orderDetails->orderInfo['0']->orderOpenDateTime)->format('F j, Y');?>
                                </time>
                            </p>
                        </div>
                        <div class="col-6 col-lg-3">
                            <!-- Heading -->
                            <h6 class="heading-xxxs text-muted">Status:</h6>
                            <!-- Text -->
                            <p class="mb-0 font-size-sm font-weight-bold">
                            <?php echo $order_details->orderDetails->orderPayments['0']->order_orderStatusType_typeName;?>
                            </p>
                        </div>
                        <div class="col-6 col-lg-3">
                            <!-- Heading -->
                            <h6 class="heading-xxxs text-muted">Order Amount:</h6>
                            <!-- Text -->
                            <p class="mb-0 font-size-sm font-weight-bold">
                            $<?php echo price_number_format($order_details->orderDetails->orderInfo['0']->calculatedTotal);?>
                            </p>
                        </div>
                    </div>
                </div>

            	<!-- Order Detail -->
            	<div class="card card-lg mb-5 border">
            		<div class="card-body">
                        <h4 class="mb-4 pb-3 border-bottom">Order Items</h4>

                        <!-- Order Item Labels -->
                        <div class="bg-light p-2 mb-3 font-weight-bold text-secondary d-none d-lg-block">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-4">
                                    Item
                                </div>
                                <div class="col-12 col-lg-2">
                                    Price
                                </div>
                                <div class="col-12 col-lg-2">
                                    Qty
                                </div>
                                <div class="col-12 col-lg-2">
                                    Total
                                </div>
                                <div class="col-12 col-lg-2"> <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-orderID="<?php echo $order_details->orderDetails->orderInfo['0']->orderID; ?>" id="reodrder">Reorder</a>

                                    </div>
                            </div>
                        </div>
                    <?php  foreach($order_details->orderDetails->orderItems as  $val){
                        $missing_image_url = 'https://slatwalldevelop.ten24dev.com/assets/images/cache/missingimage_90w_90h.jpg';
                        if(isset($val->images[0])){
                            $image_url = DOMAIN.'/'.$val->images[0];
                        } else {
                            $image_url = $missing_image_url;
                        }
                       $product_single_url = get_site_url().'/'.PRODUCT_SINGLE_SLUG.'/'.$val->sku_product_urlTitle;
                        ?>
                        <!-- Order Items -->
                        <div class="row align-items-center mb-5">
                            <div class="col-6 col-lg-4">
                                <a class="text-body font-weight-bold" href="<?php echo $product_single_url; ?>">
                                    <img src="<?php echo $image_url; ?>" alt="<?php echo $val->sku_product_productName;?>" class="img-fluid rounded float-left mr-3">
                                </a>
                                    <a class="text-body font-weight-bold" href="<?php echo $product_single_url; ?>"><?php echo $val->sku_product_productName;?></a> <br>
                                    <span class="text-muted"><?php echo $val->sku_calculatedSkuDefinition; ?></span>

                            </div>
                            <div class="col-2 col-lg-2">
                                <span class="text-muted">$<?php  echo price_number_format($val->price);?></span>
                            </div>
                            <div class="col-2 col-lg-2">
                                <span class="text-muted"><?php echo $val->quantity;?></span>
                            </div>
                            <div class="col-2 col-lg-2">
                                <span class="text-muted">$<?php echo price_number_format($val->calculatedExtendedPriceAfterDiscount);?></span>
                            </div>
                            <div class="col-12 col-lg-2"> <a href="#" class="btn btn-secondary btn-sm buy-again" id="<?php echo $val->sku_skuID; ?>" data-quantity="<?php echo $val->quantity;?>">Buy Again</a>

                                </div>
                        </div>
                    <?php } ?>
                    </div>
            	</div>

            	<!-- Total -->
                <div class="row">
                    <div class="col-sm-7">
                    	<div class="card mb-5">
                    		<div class="card-body">
                                <h4 class="mb-4 pb-3 border-bottom">Shipping & Billing</h4>
                    			<!-- Content -->
                    			<div class="row">
                                            <?php if(isset($order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_streetAddress) && $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_streetAddress != ''){ ?>
                                    <div class="col-6 col-md-6 mb-4">
                    					<h6 class="text-secondary font-weight-bold">Shipping Address</h6>
                                        <address class="small mb-0">
                                        <?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_name;?><br>
                                            <?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_streetAddress;?><br>
                                            <?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_city;?> <?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_city?', ':' '; ?> <?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_stateCode.' '. $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_postalCode;?><br>
                                            <?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingAddress_countryCode;?>
                                        </address>
                    				</div>
                                            <?php } ?>
                    				<div class="col-6 col-md-6 mb-4">
                    					<h6 class="text-secondary font-weight-bold">Shipping Method</h6>
                                        <small>
                						<?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_shippingMethod_shippingMethodName; ?>
                                            <?php echo $order_details->orderDetails->orderFulfillments['0']->orderFulfillment_fulfillmentMethod_fulfillmentMethodName; ?>
                                        </small>
                    				</div>
                    				<div class="col-6 col-md-6 mb-4">
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
                                    <div class="col-6 col-md-6 mb-4">
                    					<h6 class="text-secondary font-weight-bold">Payment Method</h6>
                                                        <?php if($order_details->orderDetails->orderPayments['0']->creditCardLastFour){ ?>
                    					<small><?php echo $order_details->orderDetails->orderPayments['0']->paymentMethod_paymentMethodName.' ending in '.$order_details->orderDetails->orderPayments['0']->creditCardLastFour; ?> </small>
                                                        <?php } else { ?>
                                                            <small><?php echo $order_details->orderDetails->orderPayments['0']->paymentMethod_paymentMethodName; ?> </small>
                                                        <?php } ?>
                    				</div>
                    			</div>
                    		</div>
                    	</div>
                    </div>

                    <div class="col-sm-5">
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
                                    <?php if($order_details->orderDetails->orderInfo['0']->calculatedDiscountTotal > 0){ ?>
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
                <?php if($order_fulfillments){ ?>
                <!-- Order Deliveries -->
                    <div class="card card-lg mb-5 border">
                        <div class="card-body">
                            <!-- Show Total Order Delivery Count -->
                            	<h4 class="mb-4 pb-3 border-bottom">Order Deliveries (<?php echo count($order_fulfillments); ?>)</h4>
                            <?php foreach($order_fulfillments as $order_fulfillment){
                                $sku_id = $order_fulfillment->sku_skuID;
                                $order_items = array_filter(
                                $order_details->orderDetails->orderItems,
                                function ($value) use ($sku_id) {
                                if($value->sku_skuID==$sku_id){
                                    return $value;
                                }
                                }
                            );
                            ?>
                            <!-- Order Delivery 1 -->
                            <div class="bg-light p-2 mb-3 font-weight-bold text-secondary d-none d-lg-block">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-lg-8">Shipped via <?php echo $order_fulfillment->orderFulfillment_shippingMethod_shippingMethodName!=''?$order_fulfillment->orderFulfillment_shippingMethod_shippingMethodName:'NA'; ?> on <?php echo $order_fulfillment->orderFulfillment_estimatedDeliveryDateTime!=''?$order_fulfillment->orderFulfillment_estimatedDeliveryDateTime:'NA'; ?></div>
                                    <div class="col-lg-4">Tracking # <a href="#"><?php echo $order_fulfillment->orderDeliveryItems_orderDelivery_trackingNumber!=''?$order_fulfillment->orderDeliveryItems_orderDelivery_trackingNumber:'NA'; ?></a>

                                    </div>
                                </div>
                            </div>
                            <!-- Order Items -->
                            <?php foreach($order_items as $order_item){
                                $missing_image_url = 'https://slatwalldevelop.ten24dev.com/assets/images/cache/missingimage_90w_90h.jpg';
                        if(isset($order_item->images[0])){
                            $image_url = DOMAIN.'/'.$order_item->images[0];
                        } else {
                            $image_url = $missing_image_url;
                        }
                                if(isset($order_item->calculatedQuantityDelivered) && $order_item->calculatedQuantityDelivered == ''){
                                    $deliveredQuntity = 0;
                                } else{
                                    $deliveredQuntity = $order_item->calculatedQuantityDelivered;
                                }
                                $product_single_url = get_site_url().'/'.PRODUCT_SINGLE_SLUG.'/'.$order_item->sku_product_urlTitle;?>
                            <div class="row align-items-center mb-5">
                                <div class="col-12 col-lg-6">
                                    <img  src="<?php echo $image_url; ?>" alt="<?php echo $val->sku_product_productName;?>" class="img-fluid rounded float-left mr-3"> <a class="text-body font-weight-bold" href="<?php echo $product_single_url; ?>"><?php echo $order_item->sku_product_productName; ?></a>

                                    <br> <?php echo $order_item->sku_calculatedSkuDefinition; ?>

                                </div>
                                <div class="col-12 col-lg-6"> <small>Qty Delivered: <?php echo $deliveredQuntity.' of '.$order_item->quantity; ?></small>

                                </div>
                            </div>
                            <?php } ?>

                            <!-- /End Order Items -->
                            <?php } ?>

                        </div>
                    </div>
                <?php } ?>

            </div>
</div>
</div>
<div  id="qloader" style="display: none;"><div class="loader" style="display: flex;"><i class="fa-circle-o-notch fa-spin fa-3x"></i></div></div>
