<?php $image_url = DOMAIN.$product->images[2];  
$search_image = '/assets/images/cache/missingimage_90w_90h.jpg';
$missing_image = array_filter($product->altImages, function($ar)  use ($search_image)  {
                return (in_array($search_image, $ar->RESIZEDIMAGEPATHS));
            });
$missing_image_keys = array_keys($missing_image);
$sku_definitions = array_column(array_column($cart_data->orderItems,'sku'),'skuDefinition');
$item_count = count($cart_data->orderItems);
$sku_exist  = count(array_filter($sku_definitions)) != 0;
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
        <div class="col-md-5 product-gallery">
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
        <div class="col-md-7 prod-content">
            <h1><?php echo $product->productName; ?></h1>
            <?php echo $product->productDescription; ?>
            <p>Price : $<span id="defaultSku_price"><?php echo price_number_format($product->defaultSku_price); ?></span></p>
            <?php  if($product_sku->pageRecords){ ?>
                
                    <form action="">
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="option">Bundle Group Name:</label>
                                            <div><small>Select <span class="badge badge-primary">1</span></small></div>
                                            <select class="form-control" id="option" required>
                                                <option>Option 1 - $9.99</option>
                                                <option>Option 2 - $10.99</option>
                                                <option>Option 3</option>
                                                <option disabled>Option 4 (Out of Stock)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="option">Bundle Group Name:</label>
                                            <div><small>Select at least <span class="badge badge-primary">1</span>. Max <span class="badge badge-primary">2</span></small></div>

                                            <div class="row mt-3">
                                                <div class="col-md-8">Cras justo odio - $9.99</div>
                                                <div class="col-md-4"><input type="text" class="form-control form-control-sm" value="0"></div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-8">Cras justo odio - $12.99</div>
                                                <div class="col-md-4"><input type="text" class="form-control form-control-sm" value="0"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="option">Bundle Group Name:</label>
                                            <div><small>Optional. Max <span class="badge badge-primary">2</span></small></div>

                                            <div class="row mt-3">
                                                <div class="col-md-8">Cras justo odio - $9.99</div>
                                                <div class="col-md-4"><input type="text" class="form-control form-control-sm" value="0"></div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-8">Cras justo odio - $12.99</div>
                                                <div class="col-md-4"><input type="text" class="form-control form-control-sm" value="0"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Add to cart</button>
                            </div>
                        </div>

                    </form>
            <?php } ?>
                    

            <div class="mt-2 mb-4">
                <ul>
                    <?php if($product->productCode){ ?>
                    <li>Code: <?php echo $product->productCode; ?></li>
                    <?php } ?>
                    <li>Brand: <a href="<?php echo get_site_url().'/'.BRAND_SLUG.'?brand_brandID='.$product->brand_brandID; ?>"><?php echo $product->brand_brandName; ?></a></li>
                    <?php if($product->productType_productTypeName){ ?>
                    <li>Type: <a href="<?php echo get_site_url().PRODUCT_LISTING_SLUG.'?typeID='.$product->productType_productTypeID; ?>"><?php echo $product->productType_productTypeName; ?></a></li>
                    <?php } ?>
                </ul>
                <?php if($product->categories){ $categories = array(); ?>
                <div class="mt-1">
                    Categories:<br>
                    <?php foreach($product->categories as $category){ 
                   $categories[] = '<a href="'.get_site_url().PRODUCT_LISTING_SLUG.'?categoryID='.$category->categoryID.'">'.$category->categoryName.'</a>';
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
<script>
jQuery(document).on('click','.add-to-cart',function(){
    jQuery('#qloader').show();
});
</script>