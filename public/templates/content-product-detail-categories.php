<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>
<div class="mt-2 mb-4">
    <ul>
        <?php if($product->productCode){ ?>
        <li>Code: <?php echo $product->productCode; ?></li>
        <?php } ?>
        <?php if(isset($product->brand_urlTitle)){ ?>
        <li>Brand: <a href="<?php echo get_site_url().'/'.BRAND_SLUG.'/'.$product->brand_urlTitle; ?>"><?php echo $product->brand_brandName; ?></a></li>
        <?php } if(isset($product->productType_urlTitle)){ ?>
        <li>Type: <a href="<?php echo get_site_url().'/'.TYPE_SLUG.'/'.$product->productType_urlTitle; ?>"><?php echo $product->productType_productTypeName; ?></a></li>
        <?php } ?>
    </ul>
    <?php if($product->categories){ $categories = array(); ?>
    <div class="mt-1">
        Categories:<br>
        <?php foreach($product->categories as $category){
       $categories[] = '<a href="'.get_site_url().'/'.CATEGORY_SLUG.'/'.$category->urlTitle.'">'.$category->categoryName.'</a>';
        }
        echo implode( ', ', $categories );
        ?>
    </div>
    <?php } ?>
</div>
