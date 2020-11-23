<form action="" method="POST">
                            <div class="row">
                                <?php
                               usort($product_sku->pageRecords, function($a, $b) {
                                        return $b->calculatedQATS <=> $a->calculatedQATS;
                                    });
                                   
                                if(count($product_sku->pageRecords) > 1){ ?>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="option">Select Option</label>

                                        <select class="form-control" id="option" name="skuID" required>
                                            <?php  foreach($product_sku->pageRecords as $sku){
                                                if($sku->calculatedQATS == 0){
                                                $sku_text = $sku->calculatedSkuDefinition . ' (Out of Stock)';
                                                $disabled = 'disabled';
                                                } else {
                                                    $disabled = '';
                                                     $sku_text = $sku->calculatedSkuDefinition;
                                                }
                                                ?>
                                                   <option value="<?php echo $sku->skuID; ?>" <?php echo $sku->skuID==$product->defaultSku_skuID?'selected':''; ?> <?php echo $disabled; ?>><?php echo $sku_text; ?> </option>
                                              <?php } ?>
                                        </select>
                                        </div>
                                </div>
                                <?php } else {
                                    if($product_sku->pageRecords[0]->calculatedSkuDefinition != ""){

                                        ?>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="option">&nbsp;</label>
                                        <input type="hidden" name="skuID" id="option" value="<?php echo $product_sku->pageRecords[0]->skuID; ?>">
                                       <p class="align-bottom mt-3"><?php echo $product_sku->pageRecords[0]->calculatedSkuDefinition; ?></p>
                                    </div>
                                </div>
                                           <?php } else { ?>
                                                <input type="hidden" name="skuID" id="option" value="<?php echo $product_sku->pageRecords[0]->skuID; ?>">
                                           <?php }  } ?>

                                <div class="col-md-4">
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
                            <div class="cart_btn"> <?php if($product_sku->pageRecords[0]->calculatedQATS > 0){ ?><button type="submit" name="add_to_cart" value="submit" class="add-to-cart btn btn-primary btn-lg btn-block">Add to cart</button><?php } ?></div>
                            
                            
                        </form>