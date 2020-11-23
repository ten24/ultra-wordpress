<?php //d($cart_data); ?>
<div class="container my-5 cart-area">
            <h1>Shopping Cart</h1>
<?php if(isset($cart_data->orderItems) && !empty($cart_data->orderItems)){ ?>
            <div class="row">
                <div class="col-lg-8 col-md-12 ">
                    <!-- Alert message for no items in cart -->
                    <div class="cart-update-alert">
                    <?php if(isset($_GET['itemRemove'])){ ?>
                    <!-- Alert message for item removed from cart -->
                    <div class="alert alert-success">Item removed from your cart</div>
                    <?php } ?>
                    <?php if(isset($_GET['itemUpdate'])){ ?>
                    <div class="alert alert-success"><small>Quantity updated</small></div>
                   <?php } ?>
</div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="mb-0">Order Items</h4>
                        </div>
                        <?php if(isset($cart_data->orderItems) && !empty($cart_data->orderItems)){ ?>
                        <div class="card-body cart-items">

                            <?php foreach($cart_data->orderItems as $item){  
                                $product_single_url = get_site_url().'/'.PRODUCT_SINGLE_SLUG.'/'.$item->sku->product->urlTitle;
                                ?>
                            <!-- Order Item 1 -->
                            <div class="row border-bottom mb-5 pb-5 cart-row" data-skuid="<?php echo $item->sku->skuID; ?>" data-orderItemID="<?php echo $item->orderItemID; ?>">
                                <div class="col-sm-2 col-3">
                                    <a href="<?php echo $product_single_url; ?>">
                                    <?php if($item->sku->imagePath){ ?>
                                     <img class="img-fluid rounded-sm" src="<?php echo DOMAIN.'/'.$item->sku->imagePath; ?>">
                                    <?php } else { ?>
                                    <img class="img-fluid rounded-sm" src="http://placehold.it/100x100">
                                    <?php } ?>
                                    </a>
                                </div>
                                <div class="col-sm-4 col-9">
                                    <a href="<?php echo $product_single_url; ?>">
                                        <h5 style="color:#000;"><?php echo $item->sku->product->productName; ?></h5>
                                    </a>
                                    <!--span class="d-block d-sm-none"><strong>$ 25.00</strong></span-->

                                    <small class="text-muted"><?php echo $item->sku->skuDefinition ;?></small>
                                </div>
                                <div class="col-sm-12 col-md-6 d-none d-sm-block">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h6><span class="text-muted">$</span><?php echo price_number_format($item->extendedUnitPrice); ?></h6>
                                        </div>
                                        <div class="col-sm-3 item-quantity">
                                            <input type="number" class="form-control form-control-sm text-center" min="1" value="<?php echo $item->quantity; ?>">
                                            <button class="btn btn-secondary btn-sm cart-update"><small>Update</small></button>
                                        </div>
                                        <div class="col-sm-4">
                                            <h6><span class="text-muted">$</span><strong><?php echo price_number_format($item->extendedPrice); ?> </strong></h6>
                                        </div>
                                        <div class="col-sm-1 p-0">
                                            <span class="btn badge badge-danger item-remove">&times;</span>
                                        </div>
                                    </div>
                                    <!-- Quantity Updated Success Message -->

                                </div>
                            </div>
                            <?php } ?>


                        </div>
                        <?php } ?>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="javascript:void(0);" class="btn btn-link clear-cart">Clear Cart</a>
                            <a href="<?php echo get_site_url().'/'.CHECKOUT; ?>" class="btn btn-primary">Continue to Checkout</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <!-- Order Summary -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="mb-0">Order Summary</h4>
                                </div>
                                <ul class="list-group list-group-flush m-0 order-summary">
                                    <li class="list-group-item m-0">Item Total <span class="float-right"><strong>$<?php echo price_number_format($cart_data->subtotal); ?></strong></span></li>
                                    <li class="list-group-item m-0">Shipping & Delivery <span class="float-right"><strong>$<?php echo price_number_format($cart_data->fulfillmentTotal); ?></strong></span></li>
                                    <li class="list-group-item m-0">Tax <span class="float-right"><strong>$<?php echo price_number_format($cart_data->cart->taxTotal); ?></strong></span></li>
                                    <?php if($cart_data->orderAndItemDiscountAmountTotal > 0){ ?>
                                    <li class="list-group-item m-0">Discount <span class="float-right"><span class="badge badge-success">- $<?php echo price_number_format($cart_data->orderAndItemDiscountAmountTotal); ?></span></li>
                                    <?php } ?>
                                    <li class="list-group-item m-0">Total <span class="float-right"><strong>$<?php echo price_number_format($cart_data->cart->total); ?></strong></span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <!-- Promotion -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="mb-0">Promotion Code</h4>
                                </div>
                                <div class="card-body">
                                    <?php if(isset($_GET['addPromo'])){ ?>
                                    <div class="alert alert-success small">Promotion Code Applied</div>
                                    <?php } ?>
                                   <?php if(isset($_GET['removePromo'])){ ?>
                                    <div class="alert alert-success small">Promotion Code Removed</div>
                                    <?php } ?>
                                    <div class="alert alert-danger small invalid-promo" style="display:none;">The promotion code that you have entered is invalid</div>


                                    <form action="" method="POST" id="add_promo">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm" name="promotionCode" placeholder="Enter promotion code" required>
                                            <input type="hidden" name="returnJSONObjects" value="cart">
                                            <span class="input-group-append">
                                                <button class="btn btn-secondary btn-sm" type="submit" name="promocode" value="apply">Apply</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                               
                              <?php if($cart_data->cart->promotionCodeList){?>
                                <div class="card-footer-area">
                                <div class="card-footer">

                                    <span class="badge badge-success" id="<?php echo $cart_data->cart->promotionCodeList; ?>"><?php echo $cart_data->cart->promotionCodeList; ?><a href="javascript:void(0);" class="remove-promo">&times;</a> </span>

                                </div>
                                </div>
                              <?php } ?>
                                    
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo get_site_url().'/'.CHECKOUT; ?>" class="btn btn-primary btn-block">Continue to Checkout</a>
                </div>
            </div>
<?php } else {
    echo '  <div class="alert alert-info">There are no items in your cart</div>';
}
?>
        </div>


<div  id="qloader" style="display: none;"><div class="loader" style="display: flex;"><i class="fa-circle-o-notch fa-spin fa-3x"></i></div></div>
<script>

    jQuery(document).ajaxStart(function() {
  jQuery("#qloader").show();
}).ajaxStop(function() {
  jQuery("#qloader").hide('slow');
});
    function remove_item(id){
         var data = {
        'action' : 'remove_cart_item',
        'id': id
    };
var ajax_url = '<?php echo get_site_url()."/wp-admin/admin-ajax.php"; ?>';
    jQuery.post(ajax_url, data, function( result ) {
        var response = jQuery.parseJSON(result);
            if(result){
              if(response.successfulActions && response.successfulActions.includes("public:cart.removeOrderItem")){
           var url = window.location.href.split('?')[0];
                    url += '?itemRemove=1';
                // window.location.href = url;
                update_cart_items(response.cart.orderItems);
               update_cart_payment(response);
               update_mini_cart(response.cart);
               if(typeof response.cart.orderItems !== 'undefined' && response.cart.orderItems.length > 0){
               jQuery('.cart-update-alert').html('<div class="alert alert-success"><small>Item Removed</small></div>');
           } else { 
           jQuery('.cart-area').html('<h1>Shopping Cart</h1> <div class="alert alert-info">There are no items in your cart</div>');
           }
                }
            }


    } );

    }

    function clear_cart(){
         var data = {
        'action' : 'clear_cart'
    };
var ajax_url = '<?php echo get_site_url()."/wp-admin/admin-ajax.php"; ?>';
    jQuery.post(ajax_url, data, function( result ) {
        var response = jQuery.parseJSON(result);
            if(result){
                console.log(result);
              if(response.successfulActions && response.successfulActions.includes("public:cart.clear")){
                   update_cart_items(response.cart.orderItems);
               update_cart_payment(response);
               update_mini_cart(response.cart);
               jQuery('.cart-update-alert').html('<div class="alert alert-success"><small>Item Removed</small></div>');
            
                }
            }


    } );

    }


    jQuery(document).on('click','.item-remove',function(){
     var item_id =  jQuery(this).parents('.cart-row').attr('data-orderitemid');
     remove_item(item_id);
    });


    function update_item(sku_id,qty){
         var data = {
        'action' : 'update_cart_item',
        'id': sku_id,
        'qty' : qty
    };
    var ajax_url = '<?php echo get_site_url()."/wp-admin/admin-ajax.php"; ?>';
    jQuery.post(ajax_url, data, function( result ) {


            if(result){
        var response = jQuery.parseJSON(result);

              if(response.successfulActions && response.successfulActions.includes("public:cart.updateOrderItem")){
                  console.log(response.cart.orderItems);
            var url = window.location.href.split('?')[0];
               url += '?itemUpdate=1';
               update_cart_items(response.cart.orderItems);
               update_cart_payment(response);
               update_mini_cart(response.cart);
               jQuery('.cart-update-alert').html('<div class="alert alert-success"><small>Quantity updated</small></div>');
           // window.location.href = url;
                            }

            }


    } );

    }
    

    jQuery(document).on('click','.cart-update',function(){
      var qty =  jQuery(this).parent().find('input').val();
       var sku_id =  jQuery(this).parents('.cart-row').attr('data-skuid');
      update_item(sku_id,qty);
    });



    function remove_promo(promo){
         var data = {
        'action' : 'remove_promo',
        'id': promo
    };
var ajax_url = '<?php echo get_site_url()."/wp-admin/admin-ajax.php"; ?>';
    jQuery.post(ajax_url, data, function( result ) {
        var response = jQuery.parseJSON(result);
            if(result){
              if(response.successfulActions && response.successfulActions.includes("public:cart.removePromotionCode")){
            var url = window.location.href.split('?')[0];
               url += '?removePromo=1';
            window.location.href = url;
                }
            }


    } );

    }

    function add_promo(form_data){
         var data = {
        'action' : 'add_promo',
        'form_data': form_data
    };
var ajax_url = '<?php echo get_site_url()."/wp-admin/admin-ajax.php"; ?>';
    jQuery.post(ajax_url, data, function( result ) {
        var response = jQuery.parseJSON(result);
        console.log(response);
            if(result){
              if(response.successfulActions && response.successfulActions.includes("public:cart.addPromotionCode")){
                  var url = window.location.href.split('?')[0];
               url += '?addPromo=1';
            window.location.href = url;
            //location.reload(true);
                } else {
                    var promo_error = response.errors.promotionCode[0];
                    console.log(promo_error)
                   jQuery('.invalid-promo').text(promo_error).show();
            }
            }


    } );

    }

    jQuery(document).on('submit','#add_promo',function(e){
        e.preventDefault();
       var form_data = jQuery(this).serializeArray();
       add_promo(form_data);
       return false;
    });

    jQuery(document).on('click','.remove-promo',function(){
       var promo_code = jQuery(this).parent().attr('id');
       remove_promo(promo_code);
    });

    jQuery(document).on('click','.clear-cart',function(){
       clear_cart();
    });

    </script>
