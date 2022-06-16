<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
 ?>

<?php if($reviews->productReviews){ ?>
    <!-- Product Reviews -->
    <h2 class="mt-5 mb-4">Reviews</h3>
<?php foreach($reviews->productReviews as $review){
            $pieces = explode(" ", $review->createdDateTime, 4);
            $review_date = ''; 
            if(isset($pieces[0])){
            $pieces[0] = str_replace(',','',$pieces[0]);
            $pieces[1] = $pieces[1].',';
            $review_date = implode(" ", array_splice($pieces, 0, 3));
            }
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
