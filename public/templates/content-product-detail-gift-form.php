<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
 ?>
<form action="" method="POST">
    <?php $rand=rand(); $_SESSION['rand']=$rand; ?>
    <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
     <input type="hidden" name="skuID" id="option" value="<?php echo $product->defaultSku_skuID; ?>">
     <input type="hidden" name="userDefinedPriceFlag" value="1">
     <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="option">First Name</label>
                <input type="text" class="form-control" name="firstName" value="">
            </div>
        </div>
         <div class="col-md-6">
            <div class="form-group">
                <label for="option">Last Name</label>
                <input type="text" class="form-control" name="lastName" value="">
            </div>
        </div>
     </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="option">Select Gift Card Amount</label>
                <select class="form-control check-amount-fill" name="list_amount" id="option_amount">
                    <option value="">- Select Amount</option>
                    <option value="25">$25</option>
                    <option value="50">$50</option>
                    <option value="75">$75</option>
                    <option value="100">$100</option>
                    <option value="250">$250</option>
                </select>
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="option">or, Create Your Own</label>
                <input type="number" min="0" step="1" name="price" class="form-control check-amount-fill number-field" id="customGiftCard" aria-describedby="quantity"  pattern="^[0-9]" value="" placeholder="Enter Amount">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="quantity">How Many Cards?</label>
                <input type="number" min="0" step="1" name="quantity" class="form-control quantity-gift-cart number-field" id="quantity" aria-describedby="quantity" value="1" required>
            </div>
        </div>

    </div>
    <div class="row recipient_row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="recipient_id">Recipient E-Mail Address <small class="text-black-50">Optional</small></label>
                <input type="email" class="form-control" name="emailAddress" id="recipient_id" aria-describedby="quantity" value="" placeholder="Enter email address for recipient">
            </div>
        </div>
    </div>
    <div class="row giftMessage_row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="giftMessage">Gift Message <small class="text-black-50">Optional</small></label>
                <textarea name="giftMessage" id="giftMessage" placeholder="Enter a gift message to your recipent" class="form-control"></textarea>
            </div>
        </div>
    </div>
     <div class="cart_btn"><button type="submit" name="add_to_cart" value="submit" class="add-to-cart btn btn-primary btn-lg btn-block" disabled>Add to cart</button></div>
</form>
