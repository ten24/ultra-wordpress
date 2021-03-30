<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>
<?php if(isset($bundle_data->data)){ ?>
<form action="" method="POST" class="bundle-product-form">
    <?php $group_count = 0; foreach($bundle_data->data as $bundle_group){
            if(isset($bundle_group->skuList) && count($bundle_group->skuList) > 0){?>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="hidden" name="quantity[<?php echo $group_count; ?>]" value="1">
                                            <input type="hidden" name="productBundleGroupID[<?php echo $group_count; ?>]" value="<?php echo $bundle_group->productBundleGroupID; ?>">
                                            <input type="hidden" name="defaultSkuID[<?php echo $group_count; ?>]" value="<?php echo $bundle_group->defaultSkuID; ?>">
                                            <label for="option"><?php echo $bundle_group->bundleType; ?>:</label>
                                            <?php if($bundle_group->maximumQuantity == 1){ ?>
                                            <div class="selection_limit_area selection"><small>Select at least<span class="badge badge-primary">1</span></small></div>
                                            <select class="form-control select-option" id="option" name="skuID[<?php echo $group_count; ?>]" required>
                                                <?php foreach($bundle_group->skuList as $sku){ ?>
                                                <option value="<?php echo $sku->skuID; ?>"><?php echo $sku->calculatedSkuDefinition?$sku->calculatedSkuDefinition.' - $'.$sku->price:'NA'.' - $'.$sku->price; ?></option>
                                                <?php } ?>

                                            </select>
                                            <?php } else { ?>
                                                <div class="selection_limit_area input_selection"><small>Select at least <span class="badge badge-primary min-max-sku-selection" data-min-value="<?php echo $bundle_group->minimumQuantity; ?>" data-max-value="<?php echo $bundle_group->maximumQuantity; ?>"><?php echo $bundle_group->minimumQuantity; ?></span>. Max <span class="badge badge-primary"><?php echo $bundle_group->maximumQuantity; ?></span></small></div>
                                             <?php $sku_list_count = 0; foreach($bundle_group->skuList as $sku){
                                                 if($sku->activeFlag == 1 && $sku->publishedFlag == 1){ 
                                                 ?>
                                            <div class="row mt-3">
                                                <div class="col-md-8"><?php echo $sku->calculatedSkuDefinition?$sku->calculatedSkuDefinition.' - $'.$sku->price:'NA'.' - $'.$sku->price; ?></div>
                                                <input type="hidden" name="skuID[<?php echo $group_count; ?>][<?php echo $sku_list_count; ?>]" value="<?php echo $sku->skuID; ?>">
                                                <div class="col-md-4"><input type="number" name="quantity[<?php echo $group_count; ?>][<?php echo $sku_list_count; ?>]" class="sku_input_value form-control form-control-sm number-field" value="" max="<?php echo $sku->calculatedQATS; ?>"></div>
                                            </div>
                                                 <?php $sku_list_count++; } } ?>
                                           <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    <?php $group_count++; } }  ?>



                        <div class="row mt-2">
                            <div class="col-md-8">
                                <button type="submit" name="add_to_cart" class="btn btn-primary btn-lg btn-block bundle-add-to-cart" value="bundle">Add to cart</button>
                            </div>
                        </div>

                    </form>
<?php } else {
    echo '<p>No sku found</p>';
} ?>
