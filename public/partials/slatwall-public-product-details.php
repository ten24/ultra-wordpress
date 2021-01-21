<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */

$image_url = DOMAIN.$product->images[2]; 
$search_image = '/assets/images/cache/missingimage_90w_90h.jpg';
$missing_image = array_filter($product->altImages, function($ar)  use ($search_image)  {
                return (in_array($search_image, $ar->RESIZEDIMAGEPATHS));
            });
$missing_image_keys = array_keys($missing_image);
$cart_skus = array_column($cart_data->orderItems,'sku');
$sku_definitions = array_column($cart_skus,'skuDefinition');
$cart_skuIDs = array_column($cart_skus,'skuID');
$product_option_group = $product->optionGroups;
$sku_exist  = count(array_filter($sku_definitions)) != 0;
$sku_option_count = 0;
foreach($product_sku->pageRecords as $sku_data){
    $sku_options[$sku_data->skuID] = $sku_data->options;
    $sku_options[$sku_data->skuID]['calculatedQATS'] = $sku_data->calculatedQATS;
    if($sku_data->calculatedQATS > 0){
    $options_match[$sku_data->skuID] = array_column($sku_data->options,'optionID');
    $sku_image[$sku_data->skuID] = $sku_data->imagePath;
    }
    $sku_id_string = (string)$sku_data->skuID;
     $min_max_quantity[$sku_id_string] = array('min' => $sku_data->skuOrderMinimumQuantity,'max' => $sku_data->skuOrderMaximumQuantity);
$sku_option_count++;}
function multiple_in_array($product_option_group,$seach_value){
    foreach($product_option_group as $product_option){

        if($product_option->optionGroupdID == $seach_value){
            return true;
        }
    }
    return false;
}
$group_options = array();
foreach($sku_options as $options_key => $options){
    $calculatedQATS = $options['calculatedQATS'];
    $sku_id = $options_key;
    foreach($options as $option){
    //    d($option);
     if(isset($option->optionGroupID)){
       $option =  array_merge(array('calculatedQATS'=>$calculatedQATS),array('sku_id'=>$sku_id),(array)$option);
         $group_options[$option['optionGroupName']][$option['optionID']] = $option;
     }
    }
}
if(isset($group_options['Size'])){
$sizes = $group_options['Size'];
$size_order = array('Extra Small','Small','Medium','Large','Extra Large');
usort($sizes, function($a, $b) use ($size_order) {
    $posA = array_search($a['optionName'], $size_order);
    $posB = array_search($b['optionName'], $size_order);
    return $posA - $posB;
});

$group_options['Size'] = $sizes;
}

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
        <div class="col-md-7 product-gallery">
        <?php  $templates->set_template_data( $product, 'product' )->set_template_data( $missing_image_keys, 'missing_image_keys' )->set_template_data( $missing_image, 'missing_image' )->get_template_part( 'content', 'product-detail-gallery',true ); ?>
        </div>
            <!-- Product Description -->
        <div class="col-md-5 prod-content">
            <h1><?php echo $product->productName; ?></h1>
            <?php echo $product->productDescription; ?>
            <p>Price : $<span id="defaultSku_price"><?php echo price_number_format($product->calculatedSalePrice); ?></span></p>
            <?php  if($product_sku->pageRecords){ $product_sku_ids = array_column($product_sku->pageRecords,'skuID'); ?>
                <div class="card mt-5">
                    <div class="card-body">
                <!-- Add to cart form -->
                <?php if(count($product_option_group) > 1){
                    $templates->set_template_data( $sku_image, 'sku_image' )->set_template_data( $min_max_quantity, 'min_max_quantity' )->set_template_data( $options_match, 'options_match' )->set_template_data( $product, 'product' )->set_template_data( $group_options, 'group_options' )->set_template_data( $product_sku, 'product_sku' )->get_template_part( 'content', 'product-detail-group-option',true );
                } else {
                    $templates->set_template_data( $product, 'product' )->set_template_data( $product_sku, 'product_sku' )->get_template_part( 'content', 'product-detail-form',true );
                }
                        $same_sku_ids = array_intersect($product_sku_ids, $cart_skuIDs);?>
                <?php if($same_sku_ids){ $item_count = count($same_sku_ids); ?>
                <!-- Cart Indicator -->
                         <?php  $templates->set_template_data( $sku_options, 'sku_options' )->set_template_data( $same_sku_ids, 'same_sku_ids' )->set_template_data( $sku_exist, 'sku_exist' )->set_template_data( $cart_skus, 'cart_skus' )->set_template_data( $item_count, 'item_count' )->get_template_part( 'content', 'product-detail-cart-indicator',true ); ?>
                <?php } ?>
                <div class="cart_msg"></div>
                    </div>
                </div>
            <?php } ?>
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
