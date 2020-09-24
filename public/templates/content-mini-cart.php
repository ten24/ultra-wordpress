<?php>
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>

<!-- Header Mini Shopping Cart Dropdown -->
<?php  //d($cart_data); ?>
<div class="dropdown" id="mini-cart">
                        <a href="#" class="btn btn-link text-body font-weight-bold" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cart <i class="fa fa-angle-down"></i>
                        </a>
    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-pill badge-secondary"><?php  echo isset($cart_data->orderID)?count($cart_data->orderItems):0; ?></span>
    </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <?php  if(isset($cart_data->orderID) && $cart_data->orderID){ ?>
                            <!-- Show order items if exist -->
                            <ul class="list-unstyled p-3 col-print-12" style="width: 300px;">
                                <?php foreach($cart_data->orderItems as $item){   ?>
                                <li class="media mb-3">
                                    <?php if($item->sku->imagePath){ ?>
                                    <img class="align-self-start img-fluid mr-2" width="45" height="45" src="<?php echo DOMAIN.'/'.$item->sku->imagePath; ?>">
                                    <?php } else { ?>
                                    <img class="align-self-start img-fluid mr-2" src="https://via.placeholder.com/45x45">
                                    <?php } ?>
                                    <div class="media-body">
                                        <a class="text-body font-weight-bold small" href="<?php echo get_site_url().'/'.PRODUCT_SINGLE_SLUG.'/'.$item->sku->product->productName; ?>"><?php echo $item->sku->product->productName; ?></a>
                                        <a href="javascript:void(0);" data-orderItemID="<?php echo $item->orderItemID; ?>" class="float-right text-secondary mini-remove-item"><i class="fa fa-times-circle"></i></a>
                                        <br>
                                        <span class="text-muted small">$<?php echo $item->extendedUnitPrice; ?></span>
                                        <small>Qty: <?php echo $item->quantity; ?></small>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                            <?php } else {?>
                            <!-- Show empty cart message if no order items exist -->
                            <div class="alert alert-secondary m-2 small">There are no items in your cart.</div>
                            <?php } ?>
                            <!-- Show item removed from mini cart message -->
                            <div class="alert alert-info m-2 small" style="display:none;">Item removed from your cart.</div>

							<!-- View Shopping Cart Link -->
                            <a href="<?php echo get_site_url().'/'.CART; ?>" class="btn btn-link btn-block text-center mini-cart-view"><small>View Shopping Cart</small></a>
                        </div>
                    </div>
					<!-- /End Mini Cart Dropdown -->
