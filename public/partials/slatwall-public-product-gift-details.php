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

foreach($product_sku->pageRecords as $sku_data){  
    $sku_options[$sku_data->skuID] = $sku_data->options;
    $sku_options[$sku_data->skuID]['calculatedQATS'] = $sku_data->calculatedQATS;
    if($sku_data->calculatedQATS > 0){
    $options_match[$sku_data->skuID] = array_column($sku_data->options,'optionID');
    }
    $sku_id_string = (string)$sku_data->skuID;
     $min_max_quantity[$sku_id_string] = array('min' => $sku_data->skuOrderMinimumQuantity,'max' => $sku_data->skuOrderMaximumQuantity);
$sku_option_count++;}


?>
<div class="container my-5">
        <!-- Add to Cart Success/Error message -->
        <?php if($_SESSION['added_into_cart'] == 1 && $_POST['randcheck']==$_SESSION['rand']){ ?>
        <div class="alert alert-success added-cart" >Item Added to Cart</div>
        <?php } ?>
       <?php if($_SESSION['added_into_cart_error'] === 1 && $_POST['randcheck']==$_SESSION['rand']){ 
            if(isset($_SESSION['added_into_cart_error_value'])){
            foreach($_SESSION['added_into_cart_error_value'] as $error_value){
                if(isset($error_value[0])){
                    echo '<div class="alert alert-danger failed-add-cart" >'.$error_value[0].'</div>';
                }
            }
        }  } 
        $_SESSION['added_into_cart'] = 0; 
        $_SESSION['added_into_cart_error'] = 0;
        ?>
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
            
                <div class="card mt-5">
                    <div class="card-body">
                <!-- Add to cart form -->
                <?php if($product->calculatedQATS >= 1){ ?>
                <?php $templates->set_template_data( $product, 'product' )->get_template_part( 'content', 'product-detail-gift-form',true ); ?>      
                <?php } else {
                    echo '<p class="m-0">No Stock Available</p>';
                } ?>
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
        jQuery(document).on('submit','form',function(){
            jQuery('#qloader').show();
        });
        
        </script>