<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
 ?>
<form class="form-inline my-2 my-lg-0 slatwall-search" action="<?php echo get_site_url().'/'.SLATWALL_PRODUCT_SEARCH_SLUG; ?>" method="GET">
    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search" value="<?php echo isset($_GET['search'])?$_GET['search']:''; ?>" required="">
                        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
                    </form>
