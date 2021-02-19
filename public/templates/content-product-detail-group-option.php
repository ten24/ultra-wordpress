<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>
<form action="" method="POST">
    <?php $rand=rand(); $_SESSION['rand']=$rand; ?>
    <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
    <input type="hidden" name="skuID" id="option" value="">
    <div class="row options-row" data-options='<?php echo json_encode((array)$options_match); ?>' data-min-max='<?php echo json_encode((array)$min_max_quantity); ?>' data-images='<?php echo json_encode((array)$sku_image); ?>'>
        <?php $group_count = 1; foreach($group_options as $group_option_key => $group_option_value){ ?>

        <div class="col-md-8 select-variation-area">

            <div class="form-group">
                <label for="<?php echo $group_option_key; ?>"><?php echo $group_option_key; ?>:</label>
                <select class="form-control select-variation option_<?php echo $group_count; ?>" name="option_<?php echo $group_option_key; ?>" id="option_<?php echo $group_option_key; ?>" required <?php echo $group_count>1?'disabled':''; ?>>
                    <option value="">Select <?php echo $group_option_key; ?></option>
                     <?php foreach($group_option_value as $option_value){ ?>
                    <option value="<?php echo $option_value['optionID']; ?>" <?php echo $option_value['calculatedQATS']<1?'disabled':''; ?>><?php echo $option_value['optionName']; ?></option>
                    <?php } ?>

                </select>
            </div>
        </div>
        <?php $group_count++; } ?>

        <div class="col-md-12">
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <div class="sku-quantity">

                    <input type="number" class="form-control" name="quantity" id="quantity" aria-describedby="quantity" value="1" min="<?php echo $product_sku->pageRecords[0]->skuOrderMinimumQuantity; ?>" max="<?php echo $product_sku->pageRecords[0]->skuOrderMaximumQuantity; ?>" disabled required>

                </div>
            </div>
        </div>
    </div>
     <div class="cart_btn"> </div>
</form>
