<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>

<?php $item_count = $item_count->scalar;  $sku_exist = $sku_exist->scalar; if($item_count > 0 && $sku_exist == false){ ?>
    <div class="alert alert-primary mt-3" role="alert">
        You have <span class="badge badge-pill badge-secondary go-to-cart-btn"><?php echo $item_count; ?></span> in your cart. <a href="<?php echo get_site_url().'/'.SLATWALL_CART; ?>">Go to Cart</a>
    </div>
<?php } elseif($item_count > 0 && $sku_exist != false){ ?>
        <div class="alert alert-primary mt-3" role="alert">
            You have <span class="badge badge-pill badge-secondary"><?php echo $item_count; ?></span> in your cart.<br>
            <?php $definition_count = 1; foreach($cart_skus as $definition){

                if($definition->skuDefinition != '' && in_array($definition->skuID, (array)$same_sku_ids)){
                ?>
            <i class="fa fa-disc"></i> <?php echo $definition_count.' - '.$definition->skuDefinition; ?><br>
                <?php $definition_count++; } } ?>
            <div class="text-center">
                <a href="<?php echo get_site_url().'/'.SLATWALL_CART; ?>" class="btn btn-light text-center go-to-cart-btn">Go to Cart</a>
            </div>
        </div>
<?php } ?>
