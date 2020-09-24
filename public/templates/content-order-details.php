<?php>
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>

<?php// d($orders); ?>
<div class="container my-5">
        <div class="row">
			<?php  $templates->get_template_part( 'content', 'account-sidebar',true ); ?>
			<div class="col-12 col-md-9">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h2>Order #123456</h2>
        <a href="#" class="btn btn-light text-secondary"><i class="fas fa-print"></i> Print Order</a>
    </div>
    <!-- Info -->
    <div class="bg-light p-4 mb-5 rounded">
        <div class="row">
            <div class="col-6 col-lg-3 col-print-3">
                <!-- Heading -->
                <h6 class="heading-xxxs text-muted">Order #</h6>
                <!-- Text -->
                <p class="mb-lg-0 font-size-sm font-weight-bold">
                    123456
                </p>
            </div>
            <div class="col-6 col-lg-3 col-print-3">
                <!-- Heading -->
                <h6 class="heading-xxxs text-muted">Order date:</h6>
                <!-- Text -->
                <p class="mb-lg-0 font-size-sm font-weight-bold">
                    <time datetime="2019-10-01">
                    01 Oct, 2019
                    </time>
                </p>
            </div>
            <div class="col-6 col-lg-3 col-print-3">
                <!-- Heading -->
                <h6 class="heading-xxxs text-muted">Status:</h6>
                <!-- Text -->
                <p class="mb-0 font-size-sm font-weight-bold">
                    Closed
                </p>
            </div>
            <div class="col-6 col-lg-3 col-print-3">
                <!-- Heading -->
                <h6 class="heading-xxxs text-muted">Order Amount:</h6>
                <!-- Text -->
                <p class="mb-0 font-size-sm font-weight-bold">
                    $259.00
                </p>
            </div>
        </div>
    </div>

  <!-- Order Detail -->
  <div class="card card-lg mb-5 border">
    <div class="card-body">
            <h4 class="mb-4 pb-3 border-bottom">Order Items</h4>

            <!-- Order Item Labels -->
            <div class="bg-light p-2 mb-3 font-weight-bold text-secondary d-none d-lg-block">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6">
                        Item
                    </div>
                    <div class="col-12 col-lg-2">
                        Price
                    </div>
                    <div class="col-12 col-lg-2">
                        Qty
                    </div>
                    <div class="col-12 col-lg-2">
                        Total
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="row align-items-center mb-5">
                <div class="col-12 col-lg-6">
                        <img src="https://via.placeholder.com/90x90" alt="Product Name" class="img-fluid rounded float-left mr-3">
                        <a class="text-body font-weight-bold" href="#">Product Name</a> <br>
                        <span class="text-muted">Size: Large</span><br>
                        <span class="text-muted">Color: Brown</span>
                </div>
                <div class="col-12 col-lg-2">
                    <span class="text-muted">$49.00</span>
                </div>
                <div class="col-12 col-lg-2">
                    <span class="text-muted">2</span>
                </div>
                <div class="col-12 col-lg-2">
                    <span class="text-muted">$98.00</span>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                        <img src="https://via.placeholder.com/90x90" alt="Product Name" class="img-fluid rounded float-left mr-3">
                        <a class="text-body font-weight-bold" href="#">Product Name</a> <br>
                        <span class="text-muted">Size: Large</span><br>
                        <span class="text-muted">Color: Brown</span>
                </div>
                <div class="col-12 col-lg-2">
                    <span class="text-muted">$49.00</span>
                </div>
                <div class="col-12 col-lg-2">
                    <span class="text-muted">2</span>
                </div>
                <div class="col-12 col-lg-2">
                    <span class="text-muted">$98.00</span>
                </div>
            </div>
            <!-- /End Order Items -->
        </div>
  </div>

  <!-- Total -->
    <div class="row">
        <div class="col-lg-7">
          <div class="card mb-5">
            <div class="card-body">
                    <h4 class="mb-4 pb-3 border-bottom">Shipping & Billing</h4>
              <!-- Content -->
              <div class="row">
                        <div class="col-12 col-md-6 mb-4 col-print-6">
                  <h6 class="text-secondary font-weight-bold">Shipping Address</h6>
                            <address class="small mb-0">
                                John Doe<br>
                                1 Main Street<br>
                                Worcester, MA 01608<br>
                                USA
                            </address>
                </div>
                <div class="col-12 col-md-6 mb-4 col-print-6">
                  <h6 class="text-secondary font-weight-bold">Shipping Method</h6>
                            <small>
                Standard Shipping <br>
                (5 - 7 days)
                            </small>
                </div>
                <div class="col-12 col-md-6 mb-4 col-print-6">
                  <h6 class="text-secondary font-weight-bold">Billing Address</h6>
                            <address class="small mb-0">
                                John Doe<br>
                                1 Main Street<br>
                                Worcester, MA 01608<br>
                                USA
                            </address>
                </div>
                        <div class="col-12 col-md-6 mb-4 col-print-6">
                  <h6 class="text-secondary font-weight-bold">Payment Method</h6>
                  <small>Credit Card ending in 1234</small>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-5">
            <div class="card mb-5">
                <div class="card-body">
                    <h4 class="mb-4 pb-3 border-bottom">Order Total</h4>
                    <ul class="list-unstyled mb-0 col-print-12">
                        <li class="d-flex mb-3 pb-3 border-bottom">
                            <span>Subtotal</span> <span class="ml-auto font-size-sm">$89.00</span>
                        </li>
                        <li class="d-flex mb-3 pb-3 border-bottom">
                            <span>Tax</span> <span class="ml-auto font-size-sm">$00.00</span>
                        </li>
                        <li class="d-flex mb-3 pb-3 border-bottom">
                            <span>Discount</span> <span class="ml-auto font-size-sm">- $10.00</span>
                        </li>
                        <li class="d-flex mb-3 pb-3 border-bottom">
                            <span>Shipping</span> <span class="ml-auto font-size-sm">$8.00</span>
                        </li>
                        <li class="d-flex font-size-lg font-weight-bold">
                            <span>Total</span> <span class="ml-auto">$97.00</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /End Order Detail Body -->
        </div>
    </div>
