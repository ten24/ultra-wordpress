<?php>
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>
<div class="container my-5">
     <h1 class="mb-4">Account Phone numbers</h1>
        <div class="row">
			<?php  $templates->get_template_part( 'content', 'account-sidebar',true ); ?>
	<!-- Email Address Listing -->
	<div class="col-md-9">
                <!-- Message notifications -->
                <div class="alert alert-success account-phone-number" style="display:none">Phone number added/deleted</div>
                <div class="alert alert-success primary-phone" style="display:none">Primary Phone number updated</div>
                <div class="alert alert-success add-phone" style="display:none">Phone number added</div>
                <div class="phone-number-errors" style="display:none"></div>
                <button type="button" class="btn btn-primary float-right mb-4" data-toggle="modal" data-target="#exampleModal">Add Phone Number</button>

                <table class="table table-condensed table-bordered table-striped table-responsive-sm">
                	<tbody>
					<?php foreach($accounts->accountPhoneNumbers as $accountPhone) {

                   if($accounts->primaryPhoneNumber->accountPhoneNumberID==$accountPhone->accountPhoneNumberID){
                   ?>
                        <tr>
                			<td><?php echo $accountPhone->phoneNumber; ?></td>
                			<td><span class="badge badge-primary">Primary</span></td>
                			<td><!-- <a href="#" title="Delete Phone Number - <?php //echo $accountPhone->phoneNumber; ?>" class="delete-primary-emailAddress delete-phoneNumber" data-id="<?php //echo $accountPhone->accountPhoneNumberID; ?>">Delete</a> --> </td>
						</tr>
						<?php }else{ ?>
                		<tr>
                			<td><?php echo $accountPhone->phoneNumber; ?></td>
                			<td><a href="#" title="Set <?php echo $accountPhone->phoneNumber; ?> as your primary phone number" class="set-primary-emailAddress set-primary-phoneNumber" data-id="<?php echo $accountPhone->accountPhoneNumberID; ?>">Set Primary</a></td>
                			<td><a href="#" title="Delete Phone Number - <?php echo $accountPhone->phoneNumber; ?>" class="delete-primary-emailAddress delete-phoneNumber" data-id="<?php echo $accountPhone->accountPhoneNumberID; ?>">Delete</a></td>
						</tr>
						<?php }}?>
                	</tbody>
                </table>
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
                <form action="add_account_phone_number" method="post" id="add_account_phone_number">
    			<div class="modal-body">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Street Address">Phone Number</label>
									<input type="text" name="phoneNumber" class="form-control required">
									<div class="invalid-feedback">Phone Number </div>
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
