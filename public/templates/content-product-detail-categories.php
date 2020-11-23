
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