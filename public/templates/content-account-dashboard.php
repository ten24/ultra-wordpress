<?php if(isset($_SESSION['token'])){
   //  wp_redirect(get_site_url().'/'.MY_ACCOUNT_SLUG.'/order-details');
    // $order_single_url = get_site_url().'/'.MY_ACCOUNT_SLUG.'/order-details'.'/'.;
} ?>
<div class="container my-5">
  <div class="row">
      <?php  $templates->get_template_part( 'content', 'account-sidebar',true ); ?>

      <!-- Account Recent Orders -->
    <div class="col-md-9 myaccount-page">
        <p class="myaccount_user">
          <?php
          //d();
          printf(
          __( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'slatwall' ) . ' ',
          $accounts->firstName. ' '.$accounts->lastName,home_url('my-account/logout'));

          // printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
          // 	wc_customer_edit_account_url()
          // );
          ?>
        </p>
        <h2>Recent Orders</h2>
        <div class="table-responsive">
          <table class="table table-condensed table-bordered table-striped">
          	<thead>
              	<tr>
                  <th><strong>Order #</strong></th>
            			<th><strong>Date</strong></th>
            			<th style="text-align: right; vertical-align: middle;"><strong>Quantity</strong></th>
            			<th style="text-align: center; vertical-align: middle;"><strong>Status</strong></th>
            			<th style="text-align: right; vertical-align: middle;"><strong>Total</strong></th>
            			<th style="text-align: center; vertical-align: middle;"><strong></strong></th>
          	    </tr>
            </thead>
          	<tbody>
              <?php foreach($orders->ordersOnAccount->ordersOnAccount as $order) {   ?>
          			<tr>
                  <?php ?>
                	<td><?php echo $order->orderNumber?></td>
                  <td><?php echo  DateTime::createFromFormat("F, j Y H:i:s O",$order->createdDateTime)->format('F j, Y');//$order->createdDateTime; //get_date_from_gmt(strtotime($order->createdDateTime),'M d, Y'); ?></td>
                  <td style="text-align: right; vertical-align: middle;"><?php echo $order->calculatedTotalItemQuantity?></td>
                  <td style="text-align: center; vertical-align: middle;"><?php echo $order->orderStatusType_typeName?></td>
                  <td style="text-align: right; vertical-align: middle;">$<?php echo price_number_format($order->calculatedTotal);?></td>
                  <td style="text-align: center; vertical-align: middle;"><a href="<?php echo get_site_url().'/'.MY_ACCOUNT_SLUG.'/order-details'.'/'.$order->orderID; ?>" id="<?php echo $order->orderID; ?>">View</a></td>
          			</tr>
          		<?php } ?>
          	</tbody>
          </table>
        </div>
    </div>
  </div>
</div>
