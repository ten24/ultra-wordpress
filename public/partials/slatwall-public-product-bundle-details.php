<?php $image_url = DOMAIN.$product->images[2];  
$search_image = '/assets/images/cache/missingimage_90w_90h.jpg';
$missing_image = array_filter($product->altImages, function($ar)  use ($search_image)  {
                return (in_array($search_image, $ar->RESIZEDIMAGEPATHS));
            });
$missing_image_keys = array_keys($missing_image);
$cart_skus = array_column($cart_data->orderItems,'sku');

$sku_definitions = array_column($cart_skus,'skuDefinition');
$cart_skuIDs = array_column($cart_skus,'skuID');
$sku_exist  = count(array_filter($sku_definitions)) != 0;
$sku_option_count = 0;


?>
<div class="container my-5">
        <!-- Add to Cart Success/Error message -->
        <?php if($_SESSION['added_into_cart'] == 1){ ?>
        <div class="alert alert-success added-cart" >Item Added to Cart</div>
        <?php } ?>
        <?php if($_SESSION['added_into_cart_error'] === 1){ ?>
        <div class="alert alert-danger failed-add-cart" >There was an error adding item to cart</div>
        <?php } ?>
      <!-- Portfolio Item Row -->
      <div class="row">

        <!-- Product Image Gallery -->
        <div class="col-md-4 product-gallery">
        <?php  $templates->set_template_data( $product, 'product' )->set_template_data( $missing_image_keys, 'missing_image_keys' )->set_template_data( $missing_image, 'missing_image' )->get_template_part( 'content', 'product-detail-gallery',true ); ?>           
        </div>
            <!-- Product Description -->
        <div class="col-md-8 prod-content">
            <h1><?php echo $product->productName; ?></h1>
            <?php echo $product->productDescription; ?>
            <p>Price : $<span id="defaultSku_price"><?php echo price_number_format($product->calculatedSalePrice); ?></span></p>
            
                <div class="card mt-5">
                    <div class="card-body">
                <!-- Add to cart form -->
                <?php $templates->set_template_data( $product, 'product' )->set_template_data( $bundle_data, 'bundle_data' )->get_template_part( 'content', 'product-detail-bundle-form',true ); ?>      
                <div class="cart_msg"></div>
                    </div>
                </div>
                  <!-- category / brand / type details  -->  
            <?php $templates->set_template_data( $product, 'product' )->get_template_part( 'content', 'product-detail-categories',true ); ?>

        </div>

      </div>
       <!-- Product Review -->
        <?php $templates->set_template_data( $reviews, 'reviews' )->get_template_part( 'content', 'product-detail-product-review',true ); ?>

            <!-- Related Product -->
        <?php $templates->set_template_data( $related_product_data, 'related_product_data' )->get_template_part( 'content', 'product-detail-related-product',true ); ?>

            </div>
        <div  id="qloader" style="display: none;"><div class="loader" style="display: flex;"><i class="fa-circle-o-notch fa-spin fa-3x"></i></div></div>
        <script>
        jQuery(document).on('click','.add-to-cart',function(){
            jQuery('#qloader').show();
        });
        </script>