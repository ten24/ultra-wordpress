<div class="container my-5">
	<h1 class="mb-4">Account Carts &amp; Quotes</h1>
	<div class="row">
			<?php  $templates->get_template_part( 'content', 'account-sidebar',true ); ?>

            <!-- Account Recent Orders -->
            <div class="col-md-9">
							<div class="table-responsive">
								<table class="table table-condensed table-bordered table-striped">
								<thead>
										<tr>
								<th><strong>Date Last Updated</strong></th>
											<th><strong>Status</strong></th>
											<th style="text-align:right"><strong>Item Count</strong></th>
											<th style="text-align:right"><strong>Total</strong></th>
                                                                                        <th style="text-align: center; vertical-align: middle;"><strong></strong></th>
										</tr>
										</thead>
								<tbody>
						<?php foreach($cart_quotes->cartsAndQuotesOnAccount->ordersOnAccount as $order) { ?>
								<tr>
													<td><?php echo  DateTime::createFromFormat("F, j Y H:i:s O",$order->createdDateTime)->format('F j, Y'); ?></td>
														<td><?php echo $order->orderStatusType_typeName?></td>
                                                                                                                <td style="text-align:right"><?php echo $order->calculatedTotalItemQuantity?></td>
													<td style="text-align:right">$<?php echo price_number_format($order->calculatedTotal); ?></td>
                                                                                                        <td style="text-align: center; vertical-align: middle;"><a href="<?php echo get_site_url().'/'.MY_ACCOUNT_SLUG.'/cart-details'.'/'.$order->orderID; ?>" id="<?php echo $order->orderID; ?>">View</a></td>
						</tr>
						<?php } ?>
								</tbody>
							</table>
							</div>
            </div>
        </div>
</div>
