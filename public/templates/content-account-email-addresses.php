<?php>
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>

<div class="container my-5">
<h1 class="mb-4">Account Email Addresses</h1>
        <div class="row">
			<?php  $templates->get_template_part( 'content', 'account-sidebar',true ); ?>
	<!-- Email Address Listing -->
	<div class="col-md-9">
                <!-- Message notifications -->
                <div class="alert alert-success account-email-address" style="display:none">Email address deleted</div>
                <div class="alert alert-success primary-email" style="display:none">Primary Email address updated</div>
                <div class="alert alert-success add-email" style="display:none">Email address added</div>
                <div class="add-email-errors" style="display:none"></div>
                <button type="button" class="btn btn-primary float-right mb-4" data-toggle="modal" data-target="#exampleModal">Add Email Address</button>

                <table class="table table-condensed table-bordered table-striped table-responsive-sm">
                	<tbody>
					<?php foreach($accounts->accountEmailAddresses as $accountEmail) {

                   if($accounts->primaryEmailAddress->accountEmailAddressID==$accountEmail->accountEmailAddressID){
                   ?>
                		<tr>
                			<td><?php echo $accountEmail->emailAddress; ?></td>
                			<td>
                				<span class="badge badge-primary">Primary</span>
                			</td>
                			<td>
                				<!-- <a href="#" title="Delete Email Address - <?php //echo $accountEmail->emailAddress; ?>" class="delete-primary-emailAddress delete-emailAddress" data-id="<?php //echo $accountEmail->accountEmailAddressID; ?>">Delete</a> -->
                			</td>
						</tr>
				   <?php }else{ ?>
                		<tr>
                			<td><?php echo $accountEmail->emailAddress; ?></td>
                			<td>
                				<a href="#" title="Set <?php echo $accountEmail->emailAddress; ?> as your primary email address" class="set-primary-emailAddress" data-id="<?php echo $accountEmail->accountEmailAddressID; ?>">Set Primary</a>
                			</td>
                			<td>
                				<a href="#" title="Delete Email Address - <?php echo $accountEmail->emailAddress; ?>" class="delete-emailAddress" data-id="<?php echo $accountEmail->accountEmailAddressID; ?>">Delete</a>
                			</td>
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
                <form action="add_email_address" method="post" id="add_modal_email_address">
    			<div class="modal-body">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Street Address">Email Address</label>
									<input type="text" name="emailAddress" class="form-control required">
									<div class="invalid-feedback">Email Address </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Street Address2">Confirm Email Address</label>
                                    <input type="text" name="emailAddressConfirm" class="form-control required" >
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
