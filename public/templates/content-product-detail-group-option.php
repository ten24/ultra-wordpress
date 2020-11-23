<form action="" method="POST">
                            <div class="row">
                                <?php $group_count = 1; foreach($group_options as $group_option_key => $group_option_value){ ?>
                                   
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="<?php echo $group_option_key; ?>"><?php echo $group_option_key; ?>:</label>
                                        <select class="form-control select-variation" name="option_<?php echo $group_option_key; ?>" id="option_<?php echo $group_option_key; ?>" required <?php echo $group_count>1?'disabled':''; ?>>
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
                                        <?php if($product_sku->pageRecords[0]->calculatedQATS > 0){ ?>
                                            <input type="number" class="form-control" name="quantity" id="quantity" aria-describedby="quantity" value="1" min="<?php echo $product_sku->pageRecords[0]->skuOrderMinimumQuantity; ?>" max="<?php echo $product_sku->pageRecords[0]->skuOrderMaximumQuantity; ?>" required>
                                        <?php } else {
                                            echo '<small>Out of Stock</small>';
                                        } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cart_btn"></div>
                            
                            
                        </form>