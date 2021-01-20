<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>
 <div class="container">
        <h1 class="mb-4">Account Address Book</h1>
        <div class="row">
            <!-- Account Sidebar Navigation -->
            <?php  $templates->get_template_part( 'content', 'account-sidebar',true ); ?>

            <!-- Email Address Listing -->
            <div class="col-md-9">
                <!-- Message notifications -->
                <div class="alert alert-success added_deleted_address" style="display:none">Address added/deleted</div>
                <div class="alert alert-success edit_address" style="display:none">Address updated</div>
                <div class="alert alert-info primary_address" style="display:none">Primary Address updated</div>

                <div class="text-right">
                    <button type="button" class="btn btn-primary d-inline-block mb-4 add-address" data-toggle="modal" data-target="#exampleModal" data-title="Add Address">Add Address</button>
                </div>

                <div class="row">


               <?php foreach($accounts->accountAddresses as $address) {

                   if($accounts->primaryAddress->accountAddressID==$address->accountAddressID){
                   ?>
                    <div class="col-md-6 mb-3 addres-box">
                        <div class="card h-100">
                            <div class="card-header text-center">
                            <small class="font-weight-bold">Primary Address</small>
                            </div>
                            <div class="card-body">
                                <address>
								<?php echo $address->accountAddressName==''?$address->address->name:$address->accountAddressName; ?><br>
								<?php echo $address->address->company; ?><br>
								<?php echo $address->address->streetAddress; ?><br>
								<?php if($address->address->street2Address !='') {?>
								<?php echo $address->address->street2Address; ?><br>
								<?php } ?>
								<?php echo $address->address->city; ?>, <?php echo $address->address->stateCode; ?>  <?php echo $address->address->postalCode; ?><br>
								<?php echo $address->address->countryCode; ?>
                                </address>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
							<button type="button" class="btn bg-transparent text-primary p-0 d-inline-block"></button>
							<button type="button" class="btn bg-transparent text-primary p-0 d-inline-block edit-address" data-toggle="modal" data-target="#exampleModal" data-title="Edit Address"  data-value='<?php echo json_encode((array)$address); ?>'  data-id="<?php echo $address->address->addressID; ?>">Edit</button>
                            </div>
                        </div>
					</div>
                  <?php } else{ ?>
                    <div class="col-md-6 mb-3 addres-box">
                        <div class="card h-100">
                            <div class="card-header text-center">
                                <small class="font-weight-bold"><a href="#" class="btn bg-transparent text-primary p-0 d-inline-block set-primary-address" data-id="<?php echo $address->accountAddressID; ?>">Set Primary Address</a></small>
                            </div>
                            <div class="card-body">
                                <address>
								<?php echo $address->accountAddressName; ?><br>
                                                                <?php echo $address->address->name; ?><br>
								<?php echo $address->address->company; ?><br>
								<?php echo $address->address->streetAddress; ?><br>
								<?php if($address->address->street2Address !='') {?>
								<?php echo $address->address->street2Address; ?><br>
								<?php } ?>
								<?php echo $address->address->city; ?>, <?php echo $address->address->stateCode; ?>  <?php echo $address->address->postalCode; ?><br>
								<?php echo $address->address->countryCode; ?>
                                </address>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
							<button type="button" class="btn bg-transparent text-primary p-0 d-inline-block delete-address" data-id="<?php echo $address->accountAddressID; ?>">Delete</button>
							<button type="button" class="btn bg-transparent text-primary p-0 d-inline-block edit-address" data-toggle="modal" data-target="#exampleModal" data-title="Edit Address"  data-value='<?php echo json_encode((array)$address); ?>'  data-id="<?php echo $address->accountAddressID; ?>">Edit</button>
                            </div>
                        </div>
					</div>
			   <?php }} ?>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel"></h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    				<span aria-hidden="true">&times;</span>
    				</button>
                </div>
                <form action="add_account_address" method="post" id="add_modal_address">
    			<div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nickname">Address Nickname</label>
									<input type="text" name="accountAddressName" class="form-control required">
									<div class="invalid-feedback">Address Nickname Required</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
									<input type="text" name="name" class="form-control required">
									<div class="invalid-feedback">Name Required</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" name="company" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Street Address">Street Address</label>
									<input type="text" name="streetAddress" class="form-control required">
									<div class="invalid-feedback">Street Address Required</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Street Address2">Street Address 2</label>
                                    <input type="text" name="street2Address" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">City</label>
									<input type="text" name="city" class="form-control required">
									<div class="invalid-feedback">City Required</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="countryCode">Country</label>
                                                                        <select class="form-control required" name="countryCode" id="countryCode">
                                                                    <option value="">Choose Country</option>
                                                                    <?php foreach($countries as $country){ ?>
                                                                    <option value="<?php echo $country->value; ?>" <?php echo $country->value=='US'?'selected':''; ?>><?php echo $country->name; ?></option>
                                                                    <?php } ?>
    								</select>
									<div class="invalid-feedback">Country Required</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
    							<div class="form-group">
    								<label for="checkout-state">State</label>
                                        <select class="form-control custom-select state_code_address required" name="stateCode" id="checkout-state">
                                                <option value="">Choose State</option>
                                                <?php foreach($default_states as $state){
                                                    echo '<option value="'.$state->value.'">'.$state->name.'</option>';
                                                } ?>
                                        </select>
                                    <div class="invalid-feedback">State Required</div>
    							</div>
    						</div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postalCode">Postal Code</label>
									<input type="text" name="postalCode" class="form-control required">
									<div class="invalid-feedback">Postal Code Required</div>
                                </div>
							</div>
                        </div>

    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    				<button type="submit" class="btn btn-primary " id="save_data">Save changes</button>
                </div>
                </form>
    		</div>
    	</div>
    </div>
    <div  id="qloader" style="display: none;"><div class="loader" style="display: flex;"><i class="fa-circle-o-notch fa-spin fa-3x"></i></div></div>
