<?php if(isset($_SESSION['token'])){
    $orderDeliveries = $orders->ordersOnAccount->orderDeliveries;
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
              <?php $order_count = 1; foreach($orders->ordersOnAccount->ordersOnAccount as $order) {  
                  if($order_count < 6){
                  $order_id = $order->orderID;
$orderDelivery = array_filter($orderDeliveries, function($ar,$ak)  use ($order_id)  {
    if($order_id == $ar->order_orderID && str_replace(' ', '', $ar->trackingNumber) != ''){
                return $ar->trackingNumber;
    }
            },ARRAY_FILTER_USE_BOTH);
            $tracking_ids = array();
            if(!empty($orderDelivery)){
                $tracking_ids = array_column($orderDelivery,'trackingNumber');
            }
           
                  ?>
          			<tr>
                 
                	<td><?php echo $order->orderNumber?></td>
                  <td><?php echo  DateTime::createFromFormat("F, j Y H:i:s O",$order->createdDateTime)->format('F j, Y');//$order->createdDateTime; //get_date_from_gmt(strtotime($order->createdDateTime),'M d, Y'); ?></td>
                  <td style="text-align: right; vertical-align: middle;"><?php echo $order->calculatedTotalItemQuantity?></td>
                  <td style="text-align: center; vertical-align: middle;"><?php echo $order->orderStatusType_typeName?> <?php echo !empty($tracking_ids)?'<a href="javascript:void(0);"><small> Tracking #'.$tracking_ids[0].'</small></a>':''; ?></td>
                  <td style="text-align: right; vertical-align: middle;">$<?php echo price_number_format($order->calculatedTotal);?></td>
                  <td style="text-align: center; vertical-align: middle;"><a href="<?php echo get_site_url().'/'.MY_ACCOUNT_SLUG.'/order-details'.'/'.$order->orderID; ?>" id="<?php echo $order->orderID; ?>">View</a></td>
          			</tr>
                  <?php } else {
                      break;
                  } $order_count++; } ?>
          	</tbody>
          </table>
        </div>
    </div>
  </div>
</div>
