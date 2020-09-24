<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>

<div class="container">
			<h1 class="mb-4">Product Listing</h4>
      <div class="alert alert-success added-cart" style="display: none;">Item Added to Cart</div>
			<div class="alert alert-danger failed-add-cart" style="display: none;">There was an error adding item to cart</div>
			<div class="row">
				<div class="col-sm-3">
					<!--h6><strong>3</strong> Available Products</h6-->
					<!-- Show Applied Filters -->
					<h6 class="available_product"><strong><?php echo $products->recordsCount; ?></strong> Available <?php echo $products->recordsCount>1?'Products':'Product'; ?></h6>
					<div class="applied_filters"> </div>
				</div>
				<div class="col-sm-6">
				</div>
				<div class="col-sm-2 offset-md-1">
					<div class="dropdown">
						<button class="btn btn-secondary btn-sm dropdown-toggle float-md-right" type="button" id="sort_active_text" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort by</button>
						<div class="dropdown-menu dropdown-menu-right sorting" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item active" data-value="productName|ASC" href="javascript:vaid(0);">Name - A to Z</a>
							<a class="dropdown-item " data-value="productName|DESC" href="javascript:vaid(0);">Name - Z to A</a>
							<a class="dropdown-item " data-value="calculatedSalePrice|ASC" href="javascript:vaid(0);">Price - Low to High</a>
							<a class="dropdown-item " data-value="calculatedSalePrice|DESC" href="javascript:vaid(0);">Price - High to Low</a>
							<a class="dropdown-item " data-value="createdDateTime|DESC" href="javascript:vaid(0);">Date Created - Newest to Oldest</a>
							<a class="dropdown-item " data-value="createdDateTime|ASC" href="javascript:vaid(0);">Date Created - Oldest to Newest</a>
							<a class="dropdown-item " data-value="brand.brandName|ASC" href="javascript:vaid(0);">Brand - A to Z</a>
							<a class="dropdown-item " data-value="brand.brandName|DESC" href="javascript:vaid(0);">Brand - Z to A</a>
						</div>
					</div>
				</div>
			</div>

			<div class="row mt-3">
				<?php require 'slatwall-public-sidebar.php'; ?>
                            <?php if($products->pageRecords){ ?>
				<div class="col-lg-9">
					<div class="row product-listing-area">
                                            <?php foreach($products->pageRecords as $product){   ?>
                                            <?php  $templates->set_template_data( $product, 'product' )->get_template_part( 'content', 'product-loop',true ); ?>
					 <?php } ?>
                         <?php echo $pagination;?>
					</div>
				</div>
                            <?php } ?>
			</div>


		</div>
<div  id="qloader" style="display: none;"><div class="loader" style="display: flex;"><i class="fa-circle-o-notch fa-spin fa-3x"></i></div></div>
