<?php>
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>

<?php //d($cart_data->orderItems); ?>

                <!-- Sidebar -->
                <div class="offset-xl-1 col-xl-4 col-sm-4 col-print-5">
                    <?php if($cart_data->orderID){ ?>
                	<!-- Order Items -->
                        <div class="order_items_checkout">

                	<h3 class="mb-3 pt-3 pb-3 border-bottom">Order Items</h3>

                    <ul class="list-unstyled ml-0 mb-5 orderitems">
                        <?php foreach($cart_data->orderItems as $item){
                            $product_single_url = get_site_url().'/'.PRODUCT_SINGLE_SLUG.'/'.$item->sku->product->urlTitle;
                            ?>
                        <li class="media mb-4 pb-4 ml-0 border-bottom">
                            <div class="mr-3 sidebar-prodimg col-print-4">
                                <a href="<?php echo $product_single_url; ?>">
                              <?php if($item->sku->imagePath){ ?>
                              <img src="<?php echo DOMAIN.'/'.$item->sku->imagePath; ?>" alt="<?php echo $item->sku->product->productName; ?>" class="img-fluid">
                               <?php } else { ?>
                                <img src="https://via.placeholder.com/90x90" alt="<?php echo $item->sku->product->productName; ?>" class="img-fluid">
                              <?php } ?>
                                </a>
                            </div>
                            <div class="w-100 media-body col-print-8">
                                <a class="text-body font-weight-bold" href="<?php echo $product_single_url; ?>"><?php echo $item->sku->product->productName; ?></a> <br>
                                <span class="text-muted">$<?php echo $item->extendedPrice; ?></span><br>
                                <small>Qty: <?php echo $item->quantity; ?></small><br>
                                <small><?php echo $item->sku->skuDefinition ;?></small>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    <!-- /End Order Items -->

                        </div>
                	<!-- Order Totals -->
                    <div class="bg-light p-4 mb-5">
            			<ul class="list-unstyled ml-0 checkout_summary_area">
            				<li class="d-flex mb-3 pb-3 ml-0 border-bottom">
            					<span>Subtotal</span> <span class="ml-auto font-size-sm subtotal">$<?php echo price_number_format($cart_data->subtotal); ?></span>
            				</li>
            				<li class="d-flex mb-3 pb-3 ml-0 border-bottom">
            					<span>Tax</span> <span class="ml-auto font-size-sm taxTotal">$<?php echo price_number_format($cart_data->cart->taxTotal); ?></span>
            				</li>
                                        <?php if($cart_data->orderAndItemDiscountAmountTotal){ ?>
                            <li class="d-flex mb-3 ml-0 pb-3 border-bottom">
            					<span>Discount</span> <span class="ml-auto font-size-sm discount_value">- $<?php echo price_number_format($cart_data->orderAndItemDiscountAmountTotal); ?></span>
            				</li>
                                        <?php } ?>
            				<li class="d-flex mb-3 pb-3 ml-0 border-bottom">
            					<span>Shipping</span> <span class="ml-auto font-size-sm shipping_value">$<?php echo price_number_format($cart_data->fulfillmentTotal); ?></span>
            				</li>
            				<li class="d-flex font-size-lg ml-0 font-weight-bold">
            					<span>Total</span> <span class="ml-auto grand_total">$<?php echo price_number_format($cart_data->cart->total); ?></span>
            				</li>
            			</ul>
                    </div>
                    <!--/End Order Totals -->

                    <!-- Place Order: Toggle disabled attribute after form submit validation to continue -->
                	<button type="button" id="place-order" class="btn btn-block btn-primary sidebar-place-order" disabled="disabled">Place Order <i class="fas fa-circle-notch fa-spin"></i></button>
                 <?php } else { ?>
                        <p>No Items In Your Shopping Cart</p>
                 <?php } ?>
                </div>
