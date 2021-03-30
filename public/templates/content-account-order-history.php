<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>
<div class="container my-5">
	<h1 class="mb-4">Order History</h1>
	<div class="row">
			<?php  $templates->get_template_part( 'content', 'account-sidebar',true ); ?>

            <!-- Account Recent Orders -->
            <div class="col-md-9">
                <?php  if(isset($order_history->orderDeliveryOnAccount->recordsCount) && $order_history->orderDeliveryOnAccount->recordsCount > 0){ ?>
							<div class="table-responsive">
								<table class="table table-condensed table-bordered table-striped">
            		<thead>
            	    	<tr>
                            <th><strong>Order #</strong></th>
                			<th><strong>Invoice Number</strong></th>
                			<th><strong>Quantity</strong></th>
                			<th><strong>Delivery ID</strong></th>
                			<th><strong>Tracking Number</strong></th>
                			<th><strong>View</strong></th>
            		    </tr>
                    </thead>
            		<tbody>
						<?php  foreach($order_history->orderDeliveryOnAccount->ordersOnAccount as $order) { ?>
        				<tr>
                        	<td><?php echo $order->order_orderNumber?></td>
                            <td><?php echo $order->invoiceNumber?></td>
        	                <td><?php echo $order->order_calculatedTotalItemQuantity?></td>
        	                <td><?php echo $order->orderDeliveryID?></td>
        	                <td><?php echo $order->trackingNumber?></td>
        	                <td><a href="<?php echo get_site_url().'/'.MY_ACCOUNT_SLUG.'/order-details'.'/'.$order->order_orderID; ?>" id="<?php echo $order->order_orderID; ?>">View</a></td>
						</tr>
						<?php } ?>
            		</tbody>
            	</table>
							</div>
                <?php } else {
                    echo '<p>No record found </p>';
                }
?>
            </div>
        </div>
</div>
