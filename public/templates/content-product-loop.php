<?php>
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>

<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */

$image_url = DOMAIN.$product->images[2];
$product_single_url = get_site_url().'/'.PRODUCT_SINGLE_SLUG.'/'.$product->urlTitle; ?>
<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
            <a href="<?php echo $product_single_url; ?>">
                <img src="<?php echo $image_url; ?>" class="img-fluid" alt="<?php echo $product->productName; ?>">
            </a>
            <div class="card-body">
                <?php if($product->productType_productTypeID){ ?>
                <small><a href="javascript:void(0);" id="<?php echo $product->productType_productTypeID; ?>" class="product_type_on_list text-secondary"><?php echo $product->productType_productTypeName; ?></a></small>
                <?php } ?>
                    <h5><a href="<?php echo $product_single_url; ?>"><?php echo $product->productName; ?></a></h5>
                    <?php  if($product->calculatedSalePrice < $product->defaultSku_listPrice){ ?>
                    <s class="float-right small">$<?php echo price_number_format($product->defaultSku_listPrice); ?></s>
                    <?php } ?>
                    <?php if($product->calculatedSalePrice){ ?>
                    <p>$<?php echo price_number_format($product->calculatedSalePrice); ?></p>
                    <?php } ?>
            </div>
          <div class="card-footer">
              <?php
              if(isset($product->baseProductTypeSystemCode) &&  $product->baseProductTypeSystemCode == 'productBundle'){
               ?>
              <a class="btn btn-primary btn-block" href="<?php echo $product_single_url; ?>">Go to Product</a>
              <?php
              } else {
              if($product->calculatedQATS){ ?>
              <form action="" method="post" class="listing-add-to-cart">
                  <input type="hidden" name="sku_id" value="<?php echo  $product->defaultSku_skuID; ?>">
                            <button type="submit" class="btn btn-primary btn-block" <?php echo $product->calculatedQATS>=1?'':'disabled'; ?>>Add to Cart</button>

              </form>
              <?php } else {?>
              <p class="out_of_stock">Out of Stock</p>
              <?php }
              }
              ?>
            </div>

    </div>
</div>
