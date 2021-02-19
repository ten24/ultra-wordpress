<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.slatwallcommerce.com/
 * @since      1.0.0
 *
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/public
 */
?>
<?php
$para_typeID = isset($_GET['typeID'])?$_GET['typeID']:'';
$para_brand_brandID = isset($_GET['brand_brandID'])?$_GET['brand_brandID']:'';
$para_categoryID = isset($_GET['categoryID'])?$_GET['categoryID']:'';
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="col-lg-3">
                    <div class="accordion mb-4" id="accordionExample">
                        <form action="index.php" id="sidebar_form" >
                    	<div class="card">
                    		<div class="card-header" id="heading1">
                            <h5 class="mb-0">
                    				<button type="button"class="btn btn-link p-0" data-toggle="collapse" data-target="#collapse1" aria-expanded="true">
                    				Search
                    				</button>
                    			</h5>
                    		</div>
                    		<div id="collapse1" class="collapse show">
                    			<div class="card-body">
                            <div class="inner">
                                <input type="text" id="search_value" name="search" class="form-control form-control-sm" value="<?php echo isset($search_val)?$search_val:''; ?>">
                              <div class="invalid-feedback">Please enter search value</div>
                              <input type="button" id="search" class="btn btn-sm btn-block btn-secondary mt-3" value="Search">
                         	  </div>
                         	</div>
                    		</div>
                    	</div>
                    	<div class="card">
                    		<div class="card-header" id="heading2">
                            <h5 class="mb-0">
                    				<button type="button"class="btn btn-link p-0" data-toggle="collapse" data-target="#collapse2" aria-expanded="true">
                    				Price
                    				</button>
                    			</h5>
                    		</div>
                    		<div id="collapse2" class="collapse show">
                    			<div class="card-body">
                            <div class="inner">
                              <div class="form-check ml-1">
                                <input class="form-check-input" type="radio" name="fix_range" id="Price0^30" value="0^30">
                                <label class="form-check-label" for="Price0^30">Under $30</label>
                              </div>
                              <div class="form-check ml-1">
                                <input class="form-check-input" type="radio" name="fix_range" id="Price30^75" value="30^75">
                                <label class="form-check-label" for="Price30^75">$30-$75</label>
                              </div>
                              <div class="form-check ml-1">
                                <input class="form-check-input" type="radio" name="fix_range" id="Price75^300" value="75^300">
                                <label class="form-check-label" for="Price75^300">$75-$300</label>
                              </div>
                              <div class="form-check ml-1">
                                <input class="form-check-input" type="radio" name="fix_range" id="Price300" value="300^">
                                <label class="form-check-label" for="Price300">$300+</label>
                              </div>

                              <div class="form-row mt-4">
                                <div class="col">
                                  <input type="text" id="min" name="min" class="form-control form-control-sm" placeholder="Min" value="">
                                </div>
                                <div class="col">
                                  <input type="text" id="max" name="max" class="form-control form-control-sm" placeholder="Max" value="">
                               
                                </div>
                                  <div class="invalid-feedback price-range-error ml-1">Please enter range value</div>
                              </div>
                              <input type="button" id="range" class="btn btn-sm btn-block btn-secondary mt-3" value="Apply" required>
                              <a href="javascript:void(0);" class="btn btn-block btn-link btn-sm" id="clear_price">Clear Price</a>
	                          </div>
			                    </div>
                    		</div>
                    	</div>
                        <?php 
                        if(isset($urlTitle_slug) && isset($template_name) && $template_name == 'brand'){  ?>
                           <div class="form-check">
                            <input style="visibility: hidden;" class="form-check-input hide_applied_filter" name="brands" type="checkbox" id="<?php echo $brands->pageRecords[$value_key]->urlTitle; ?>" value="<?php echo $brands->pageRecords[$value_key]->brandID; ?>"  checked>
                            <label class="form-check-label" for="<?php echo $brands[$value_key]->urlTitle; ?>"></label>
                           </div>
                                <?php } else  if($brands){ ?>
                    	<div class="card">
                    		<div class="card-header" id="heading3">
                            <h5 class="mb-0">
                      				<button type="button" class="btn btn-link p-0" data-toggle="collapse" data-target="#collapse3" aria-expanded="true">
                      				Brands
                      				</button>
                    			   </h5>
                    		</div>
                    		<div id="collapse3" class="collapse show">
                    			<div class="card-body">
                            <div class="inner">
                              <?php foreach($brands as $brand){
                                if($brand->activeFlag == 1){
                                ?>
                                  <div class="form-check">
                                    <input class="form-check-input" name="brands" type="checkbox" id="<?php echo $brand->urlTitle; ?>" value="<?php echo $brand->brandID; ?>"  <?php echo $para_brand_brandID==$brand->brandID?'checked':''; ?>>
                                    <label class="form-check-label" for="<?php echo $brand->urlTitle; ?>"><?php echo $brand->brandName; ?></label>
                                  </div>
                                <?php }} ?>
                            </div>
                             <?php if(count($brands) > 10){ ?>
                            <div class="text-center m-0 mt-2 show-more">
                              <span class="morebtn">Show More</span>
                              <span class="lessbtn">Show Less</span>
                            </div>
                              <?php }?>
                    			</div>
                    		</div>
                    	</div>
                      <?php }
                      if(isset($urlTitle_slug) && isset($template_name) && $template_name == 'category'){
                        $value_key = array_search($urlTitle_slug, array_column($categories, 'urlTitle')); ?>
                           <div class="form-check">
                            <input style="visibility: hidden;" class="form-check-input hide_applied_filter" name="categories" type="checkbox" id="<?php echo $categories->pageRecords[$value_key]->urlTitle; ?>" value="<?php echo $categories->pageRecords[$value_key]->categoryID; ?>"  checked>
                            <label class="form-check-label" for="<?php echo $categories[$value_key]->urlTitle; ?>"></label>
                           </div>
                                <?php } else if($categories){ ?>
                        <div class="card">
                    		<div class="card-header" id="heading4">
                            <h5 class="mb-0">
                    				<button type="button" class="btn btn-link p-0" data-toggle="collapse" data-target="#collapse4" aria-expanded="true">
                    				Category
                    				</button>
                    			</h5>
                    		</div>
                    		<div id="collapse4" class="collapse show">
                          <div class="card-body">
                            <div class="inner">
                              <?php foreach($categories as $category){ ?>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" name="categories" id="<?php echo $category->urlTitle; ?>" value="<?php echo $category->categoryID; ?>" <?php echo $para_categoryID==$category->categoryID?'checked':''; ?>>
                                  <label class="form-check-label" for="<?php echo $category->urlTitle; ?>"><?php echo $category->categoryName; ?></label>
                                </div>
                              <?php  } ?>
                            </div>
                            <?php if(count($categories) > 10){ ?>
                            <div class="text-center m-0 mt-2 show-more">
                              <span class="morebtn">Show More</span>
                              <span class="lessbtn">Show Less</span>
                            </div>
                              <?php }?>
                          </div>
                    		</div>
                    	</div>
                        <?php }  if(isset($urlTitle_slug) && isset($template_name) && $template_name == 'type'){ ?>
                           <div class="form-check">
                            <input style="visibility: hidden;" class="form-check-input hide_applied_filter" name="types" type="checkbox" id="<?php echo $types->pageRecords[$value_key]->urlTitle; ?>" value="<?php echo $types->pageRecords[$value_key]->productTypeID; ?>"  checked>
                            <label class="form-check-label" for="<?php echo $types[$value_key]->urlTitle; ?>"></label>
                           </div>
                                <?php } else if($types){ ?>
                        <div class="card">
                    		<div class="card-header" id="heading5">
                            <h5 class="mb-0">
                    				<button type="button" class="btn btn-link p-0" data-toggle="collapse" data-target="#collapse5" aria-expanded="true">
                    				Product Type
                    				</button>
                    			</h5>
                    		</div>
                    		<div id="collapse5" class="collapse show">
                    			<div class="card-body">
                            <div class="inner">
                              <?php foreach($types as $type){ ?>
                                <div class="form-check">
                                  <input class="form-check-input" name="types" type="checkbox" id="<?php echo $type->urlTitle; ?>" value="<?php echo $type->productTypeID; ?>" <?php echo $para_typeID==$type->productTypeID?'checked':''; ?>>
                                  <label class="form-check-label" for="<?php echo $type->urlTitle; ?>"><?php echo $type->productTypeName; ?></label>
                                </div>
                              <?php } ?>
                            </div>
                            <?php if(count($types) > 10){ ?>
                            <div class="text-center m-0 mt-2 show-more">
                              <span class="morebtn">Show More</span>
                              <span class="lessbtn">Show Less</span>
                            </div>
                              <?php }?>
                    			</div>
                    		</div>
                    	</div>
                         <?php } 
                         if(isset($urlTitle_slug) && isset($template_name) && $template_name == 'option'){ ?>
                           <div class="form-check">
                            <input style="visibility: hidden;" class="form-check-input hide_applied_filter" name="options" type="checkbox" id="<?php echo $options->pageRecords[$value_key]->optionID; ?>" value="<?php echo $options->pageRecords[$value_key]->optionID; ?>"  checked>
                            <label class="form-check-label" for="<?php echo $options[$value_key]->optionName; ?>"></label>
                           </div>
                                <?php } else if($options){ ?>
                        <div class="card">
                    		<div class="card-header" id="heading6">
                            <h5 class="mb-0">
                    				<button type="button" class="btn btn-link p-0" data-toggle="collapse" data-target="#collapse6" aria-expanded="true">
                    				Product Options
                    				</button>
                    			</h5>
                    		</div>
                    		<div id="collapse6" class="collapse show">
                    			<div class="card-body">
                            <div class="inner">
                              <?php foreach($options as $option){ ?>
                                <div class="form-check">
                                  <input class="form-check-input" name="options" type="checkbox" id="<?php echo $option->optionCode; ?>" value="<?php echo $option->optionID; ?>">
                                  <label class="form-check-label" for="<?php echo $option->optionCode; ?>"><?php echo $option->optionName; ?></label>
                                </div>
                              <?php } ?>
                            </div>
                            <?php if(count($options) > 10){ ?>
                            <div class="text-center m-0 mt-2 show-more">
                              <span class="morebtn">Show More</span>
                              <span class="lessbtn">Show Less</span>
                            </div>
                              <?php }?>
                    			</div>
                    		</div>
                    	</div>
                         <?php } ?>
                            
                    </form>
                    </div>
				</div>
