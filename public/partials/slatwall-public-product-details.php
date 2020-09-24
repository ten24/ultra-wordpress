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
        <div class="col-md-7 product-gallery">
            <!-- Default Product Image -->
            <!-- <img class="img-fluid rounded d-block mb-4" src="<?php //echo $image_url; ?>" alt="Product Name"> -->
            <div class="col">
              <?php if($product->altImages){ //d($product->altImages); ?>
              <div class="pdp-image-gallery-block">
                  <!-- gallery Viewer -->
                  <div class="gallery-viewer">
                    <img id="zoom_10" src="<?php echo DOMAIN.'/'.$product->altImages[0]->RESIZEDIMAGEPATHS[3]; ?>" data-zoom-image="<?php echo DOMAIN.'/'.$product->altImages[0]->ORIGINALPATH; ?>" href="<?php echo DOMAIN.'/'.$product->altImages[0]->ORIGINALPATH; ?>" class="img-fluid mb-4" />
                  </div>
              		<!-- Gallery -->
                        <?php if(isset($product->altImages) && count($product->altImages) > 1 && count($product->altImages) != count($missing_image)){ ?>
              		<div class="position-relative gallery_pdp_container">
              			<div id="gallery_pdp">
                                    <?php foreach ($product->altImages as $alt_image_key => $alt_image){
                                        if(empty($missing_image_keys)){
                                        ?>
              				<a href="#" data-image="<?php echo DOMAIN.'/'.$alt_image->RESIZEDIMAGEPATHS[3]; ?>" data-zoom-image="<?php echo DOMAIN.'/'.$alt_image->ORIGINALPATH; ?>">
              					<img id="" src="<?php echo DOMAIN.'/'.$alt_image->RESIZEDIMAGEPATHS[1]; ?>" class="img-fluid mx-1 thumb-img" />
              				</a>
                                        <?php } else {
                                            if(!in_array($alt_image_key, $missing_image_keys)){
                                        ?>
              				<a href="#" data-image="<?php echo DOMAIN.'/'.$alt_image->RESIZEDIMAGEPATHS[3]; ?>" data-zoom-image="<?php echo DOMAIN.'/'.$alt_image->ORIGINALPATH; ?>">
              					<img id="" src="<?php echo DOMAIN.'/'.$alt_image->RESIZEDIMAGEPATHS[1]; ?>" class="img-fluid mx-1 thumb-img" />
              				</a>
                                        <?php }
                                        } } ?>
              			</div>
              			<!-- Up and down button for vertical carousel -->
              			<div class="nav-arrow">
                      <a href="#" id="ui-carousel-next" style="display: inline;"><i class="fa fa-angle-left"></i></a>
                			<a href="#" id="ui-carousel-prev" style="display: inline;"><i class="fa fa-angle-right"></i></a>
                    </div>
              		</div>
                        <?php } ?>
              		<!-- Gallery -->

              	</div>
                <?php } ?>
            </div>
        </div>

        <!-- Product Description -->
        <div class="col-md-5 prod-content">
            <h1><?php echo $product->productName; ?></h1>
            <?php echo $product->productDescription; ?>
            <p id="defaultSku_price">Price : $<?php echo price_number_format($product->defaultSku_price); ?></p>
            <?php  if($product_sku->pageRecords){ ?>
                <div class="card mt-5">
                    <div class="card-body">
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
                        <div class="cart_msg"></div>
            <?php } ?>
                    </div>
                </div>

            <div class="mt-2 mb-4">
                <ul>
                    <?php if($product->productCode){ ?>
                    <li>Code: <?php echo $product->productCode; ?></li>
                    <?php } ?>
                    <li>Brand: <a href="<?php echo get_site_url().'?brand_brandID='.$product->brand_brandID; ?>"><?php echo $product->brand_brandName; ?></a></li>
                    <?php if($product->productType_productTypeName){ ?>
                    <li>Type: <a href="<?php echo get_site_url().'?typeID='.$product->productType_productTypeID; ?>"><?php echo $product->productType_productTypeName; ?></a></li>
                    <?php } ?>
                </ul>
                <?php if($product->categories){ $categories = array(); ?>
                <div class="mt-1">
                    Categories:<br>
                    <?php foreach($product->categories as $category){
                   $categories[] = '<a href="'.get_site_url().'?categoryID='.$category->categoryID.'">'.$category->categoryName.'</a>';
                    }
                    echo implode( ', ', $categories );
                    ?>
                </div>
                <?php } ?>
            </div>

        </div>

      </div>
<?php if($reviews->productReviews){ ?>
    <!-- Product Reviews -->
    <h2 class="mt-5 mb-4">Reviews</h3>
<?php foreach($reviews->productReviews as $review){
            $pieces = explode(" ", $review->createdDateTime, 4);
            $review_date = implode(" ", array_splice($pieces, 0, 3));
?>
    <div class="card mb-4">
		<div class="card-body">
			<h5><?php echo $review->reviewTitle; ?></h5>
			<p><?php echo $review->review; ?></p>
            <small class="text-muted">Posted by <?php echo $review->reviewerName; ?> on <?php echo $review_date; ?></small>
        </div>
    </div>
<?php } ?>

<?php } ?>

    <?php if($related_product_data->relatedProducts){ ?>
    <!-- Related Projects Row -->
    <h2 class="mt-5 mb-4">Related Products</h3>

    <div class="row">
        <?php foreach($related_product_data->relatedProducts as $related_product){
            $related_product_image_url = DOMAIN.$related_product->images[2];
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
    </div>
<div  id="qloader" style="display: none;"><div class="loader" style="display: flex;"><i class="fa-circle-o-notch fa-spin fa-3x"></i></div></div>
