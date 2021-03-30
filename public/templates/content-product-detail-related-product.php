<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>

    <?php if($related_product_data->relatedProducts){ ?>
    <!-- Related Projects Row -->
    <h2 class="mt-5 mb-4">Related Products</h3>

    <div class="row">
        <?php foreach($related_product_data->relatedProducts as $related_product){
            if(isset($related_product->images[2])){
             $related_product_image_url = DOMAIN.$related_product->images[2];
            } else {
                 $related_product_image_url = 'http://placehold.it/510x350';
            }
//     if(isset($related_product->relatedProduct_defaultSku_imageFile)){
//            $related_product_image_url = DOMAIN.'/custom/assets/images/product/default/'.$related_product->relatedProduct_defaultSku_imageFile;
//     } else {
//         $related_product_image_url = 'http://placehold.it/510x350';
//     }
            $related_product_single_url = get_site_url().'/'.PRODUCT_SINGLE_SLUG.'/'.$related_product->relatedProduct_urlTitle;
            ?>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100">
                <a href="<?php echo $related_product_single_url; ?>">
                    <img src="<?php echo $related_product_image_url; ?>" class="img-fluid" alt="<?php echo $related_product->relatedProduct_productName; ?>">
                </a>
                <div class="card-body">
                    <small><a href="javascript:void(0);" class="text-secondary"><?php echo $related_product->relatedProduct_productType_productTypeName; ?></a></small>
                    <h5><a href="<?php echo $related_product_single_url; ?>"><?php echo $related_product->relatedProduct_productName; ?></a></h5>
                   <?php if($related_product->relatedProduct_calculatedSalePrice < $related_product->relatedProduct_defaultSku_listPrice){ ?>
                    <s class="float-right small">$<?php echo price_number_format($related_product->relatedProduct_defaultSku_listPrice); ?></s>
                   <?php } ?>
                    <p>$<?php echo price_number_format($related_product->relatedProduct_calculatedSalePrice); ?> </p>
                </div>
            </div>
        </div>
        <?php } ?>
      </div>
    <?php } ?>
