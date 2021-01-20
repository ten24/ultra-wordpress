<?php>
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>
<?php // print_r($profile_update); die("gfghfgh");?>
<div class="container my-5">
  <h1 class="mb-4">Profile Update</h1>
        <div class="row">
            <?php  $templates->get_template_part( 'content', 'account-sidebar',true ); ?>
            <!-- Account Recent Orders -->
            <div class="col-md-9">
			<div class="alert alert-success profile_update_success" style="display:none">Profile updated</div>
			<div class="alert alert-error profile_update_error" style="display:none">Something Went Wrong</div>
                 <form action="profile_update_account" method="POST" id="update_profile_account">
                                    <div class="row">
                                    	<div class="col-md-6">
                                    		<div class="form-group">
                                    			<label for="firstName">First Name</label>
                                                        <input name="firstName" value="<?php echo $account_details->firstName?$account_details->firstName:''; ?>" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-swvalidationrequired" ng-model="Account_Create.firstName" swvalidationrequired="true" data-keeper-lock-id="k-zwyqm2hq14s" required>
                                    		</div>
                                    	</div>
                                    	<div class="col-md-6">
                                    		<div class="form-group">
                                    			<label for="lastName">Last Name</label>
                                    			<input name="lastName" value="<?php echo $account_details->lastName?$account_details->lastName:''; ?>" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-swvalidationrequired" ng-model="Account_Create.lastName" swvalidationrequired="true" data-keeper-lock-id="k-h2ef3p5i8l" required>
                                    		</div>
                                    	</div>
                                    	<div class="col-md-6">
                                    		<div class="form-group">
                                    			<label for="emailAddress">Email Address</label>
                                                        <input name="emailAddress" value="<?php echo $account_details->primaryEmailAddress->emailAddress?$account_details->primaryEmailAddress->emailAddress:''; ?>" disabled="disabled" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-swvalidationrequired ng-valid-swvalidationdatatype ng-valid-swvalidationemail" ng-model="Account_Create.emailAddress" swvalidationdatatype="email" swvalidationrequired="true" data-keeper-lock-id="k-l2s7ta0eydn" required>
                                    		</div>
                                    	</div>
                                    	<div class="col-md-6">
                                    		<div class="form-group">
                                    			<label for="emailConfirm">Email Address Confirm</label>
                                    			<input name="emailAddressConfirm" class="form-control ng-pristine ng-untouched ng-isolate-scope ng-empty ng-invalid ng-invalid-swvalidationrequired ng-valid-swvalidationdatatype ng-valid-swvalidationemail" ng-model="Account_Create.emailAddressConfirm" swvalidationeqproperty="Account_Create.emailAddress" swvalidationdatatype="email" swvalidationrequired="true" data-keeper-lock-id="k-odqjuiosuq" required>
                                    		</div>
                                    	</div>
                                    	<div class="col-md-6">
                                    		<div class="form-group">
                                    			<label for="company" class="control-labell">Organization</label>
                                    			<input id="company" type="text" name="company" class="form-control ng-pristine ng-untouched ng-valid ng-empty" value="<?php echo $account_details->company?$account_details->company:''; ?>" ng-model="Account_CreateAccount.company" data-keeper-lock-id="k-kmrlbx0yklk">
                                    		</div>
                                    	</div>
                                        <input type="hidden" value="account" name="returnJSONObjects">
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit" value="profile_update" name="account">Profile Update</button>
                                </form>
            </div>
        </div>
    </div>
	<div  id="qloader" style="display: none;"><div class="loader" style="display: flex;"><i class="fa-circle-o-notch fa-spin fa-3x"></i></div></div>
