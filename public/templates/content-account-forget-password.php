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
            <h1>My Account</h1>
            <p>Please login or signup to continue.</p>
        </div>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="tab-content" id="pills-tabContent">
                    <!-- Login -->
                	<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-success show-password-msg" style="display:none">Please check your email for password reset link</div>
                           <div class="alert alert-danger show-error-msg" style="display:none">Invalid updated</div>
                                <form action="forget_password_account" method="POST" id="forget_password">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" name="emailAddress" class="form-control required" >
                                        <div class="invalid-feedback">Email Required</div>
                                    </div>
                                     <input type="hidden" value="account" name="returnJSONObjects">
                                    <button class="btn btn-primary btn-block" name="account" type="submit" value="forget-password">Reset Password</button>
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
	function forget_password(form_data,action){
         var data = {
        'action' : action,
        'form_data': form_data
    };

    jQuery.post(ajax_url, data, function( result ) {

    var response = jQuery.parseJSON(result);
    console.log(response);
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
    jQuery(document).on('submit','#forget_password',function(e){
        e.preventDefault();
		var error_require = 0;
       var form_data = jQuery('#forget_password').serializeArray();
			 jQuery('#forget_password .required').each(function(){
				 var inputval = jQuery(this).val();
				 if(inputval == '') {
					 error_require = 1;
					 jQuery(this).addClass('is-invalid');
				 } else{
					 jQuery(this).removeClass('is-invalid');
				 }
			 });
       var form_data = jQuery('#forget_password').serializeArray();
       var action = jQuery('#forget_password').attr('action');
	   if(error_require == 0) {
        forget_password(form_data,action);
			 }
       return false;
    });
</script>
