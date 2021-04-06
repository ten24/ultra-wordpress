<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>
<div class="col">
  <?php if($product->altImages){

    $missing_image = (array)$missing_image;
    $missing_image_keys = (array)$missing_image_keys;
      ?>
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
