<?php>
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */
?>
<?php if(isset($_SESSION['token'])){
     wp_redirect(get_site_url().'/'.MY_ACCOUNT_SLUG.'/dashboard');
} ?>
<div class="container my-5">

        <div class="text-center my-3">
        <h4>Reset Password</h4>
        </div>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="tab-content" id="pills-tabContent">
                    <!-- Login -->
                	<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="card">
                            <div class="card-body">
                            <div class="alert alert-success show-password-msg" style="display:none">Your password has been reset successfully . <a href="my-account">Click here to return to the login page</a></div>
                           <div class="alert alert-danger show-error-msg" style="display:none">Invalid updated</div>
                        <form action="reset_password_account" method="post" id="reset_password">
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" name="password" class="form-control required" id="reset-new-password">
                                <div class="invalid-feedback">Valid password required</div>
                            </div>
                            <div class="form-group">
                                <label for="passwordConfirm">Confirm New Password</label>
                                <input type="password" name="passwordConfirm" class="form-control required" id="reset-confirm-password">
                                <div class="invalid-feedback">Valid confirm password required</div>
                                <div id="msg"></div>
                            </div>
                            <div class="form-group">
                            <input type="hidden" name="swprid" class="form-control" value="<?php echo $_GET['swprid'];?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" value="reset_password" class="btn btn-primary">Reset Password</button>
                            </div>
                        </form>


                             </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <div  id="qloader" style="display: none;"><div class="loader" style="display: flex;"><i class="fa-circle-o-notch fa-spin fa-3x"></i></div></div>
    <script>
jQuery(document).ajaxStart(function() {
  jQuery("#qloader").show();
}).ajaxStop(function() {
  jQuery("#qloader").hide('slow');
});

jQuery(document).ready(function(){
    //get it if Status key found
    if(localStorage.getItem("Status")=='succes')
    {
        jQuery('.show-password-msg').show();
        localStorage.clear();
    }
    if(localStorage.getItem("Status")=='error')
    {
        jQuery('.show-error-msg').show();
        localStorage.clear();
    }
});


    var ajax_url = '<?php echo get_site_url()."/wp-admin/admin-ajax.php"; ?>';
    jQuery("#reset-confirm-password").keyup(function(){
             if (jQuery("#reset-new-password").val() != jQuery("#reset-confirm-password").val()) {
				jQuery("#msg").html("Password do not match").css("color","red");
             }else{
				jQuery("#msg").html("Password matched").css("color","green");
            }
	  });
	function reset_password(form_data,action){
         var data = {
        'action' : action,
        'form_data': form_data
    };

    jQuery.post(ajax_url, data, function( result ) {
       console.log(result.status_code);
    var response = jQuery.parseJSON(result);
    if(response.successfulActions.length>0)
    {
         localStorage.setItem("Status",'succes')
    window.location.reload();
    } else if(response.failureActions.length>0)
    {localStorage.setItem("Status",'error')
    window.location.reload();
    }
    } );

    }
    jQuery(document).on('submit','#reset_password',function(e){
        e.preventDefault();
		var error_require = 0;
       var form_data = jQuery('#reset_password').serializeArray();
			 jQuery('#reset_password .required').each(function(){
				 var inputval = jQuery(this).val();
				 if(inputval == '') {
					 error_require = 1;
					 jQuery(this).addClass('is-invalid');
				 } else{
					 jQuery(this).removeClass('is-invalid');
				 }
			 });
       var form_data = jQuery('#reset_password').serializeArray();
       var action = jQuery('#reset_password').attr('action');
       console.log(form_data);
	   if(error_require == 0) {
        reset_password(form_data,action);
			 }
       return false;
    });
</script>
