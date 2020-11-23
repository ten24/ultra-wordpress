<?php

/**
 * Provide a admin area view for the slatwall
 *
 * This file is used to markup the admin-facing aspects of the slatwall.
 *
 * @link       https://www.slatwallcommerce.com/
 * @since      1.0.0
 *
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<!--form method="POST" action="" id="slatwall_integration"-->
    <!--table>
        <tr><td>Domain</td><td><input type="text" name="domain" value="<?php echo isset($result->domain)?$result->domain:''; ?>" placeholder="https://demo.ten24dev.com"></td></tr>
        <tr><td>Access Key</td><td><input type="text" name="access_key" value="<?php echo isset($result->access_key)?$result->access_key:''; ?>"></td></tr>
        <tr><td>Access Key</td><td><input type="text" name="access_key_secret" value="<?php echo isset($result->access_key_secret)?$result->access_key_secret:''; ?>"></td></tr>
        <tr><td><input class="integration-form-btn" id="test-key" value="Test Setting" type="button"></td></tr>
        <tr><td><input class="integration-form-btn" id="submit-key" type="button" value="Save"></td></tr>
    </table-->
<form method="POST" action="slatwall_integration" id="slatwall_integration">
    <!-- <table>
        tr><td>account url</td><td><input type="text" name="account_url"></td></tr
        <tr><td>Domain</td><td><input type="text" name="domain" value="<?php //echo isset($result->domain)?$result->domain:''; ?>" placeholder="https://demo.ten24dev.com"></td></tr>
        <tr><td>Access Key</td><td><input type="text" name="access_key" value="<?php //echo isset($result->access_key)?$result->access_key:''; ?>"></td></tr>
        <tr><td>Access Key</td><td><input type="text" name="access_key_secret" value="<?php //echo isset($result->access_key_secret)?$result->access_key_secret:''; ?>"></td></tr>
        <tr><td><input class="submit-key" type="submit"></td></tr>
    </table> -->

      <div class="col-12 py-4 pr-4 wrap-inner">
        <!-- Header Section (Logo) -->
        <div class="row py-2 align-items-center header-section">
          <div class="col-sm-6 left-container logo">
            <img src="<?php echo content_url(); ?>/plugins/slatwall/admin/images/logo.png" alt="SlatWall Logo" class="img-fluid" />
          </div>
          <div class="col-sm-6 text-right right-container email-text">
            <a href="mailto: www.slatwallcommerce.com" class="text-body">www.slatwallcommerce.com</a>
          </div>
        </div>
        <!-- End -->

        <!-- Intro Section -->
        <div class="row py-2 into-section">
          <div class="col-12 intro-inner">
            <div class="py-4 mt-3 jumbotron">
              <h3>API Settings</h3>
              <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
              <div class="row">
                <div class="col-lg-2 col-md-3">
                    <a href="https://www.slatwallcommerce.com/resources/" title="" class="text-body" target="_blank">Documentation</a>
                </div>
                <div class="col-lg-2 col-md-3">
                  <a href="https://www.slatwallcommerce.com/contact-us" title="" class="text-body" target="_blank">Slatwall Support</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End -->

        <!-- Setting Form Section -->
        <div class="row form-section">
          <div class="col-12 form-inner">
            <h2>API Settings</h2>
            <div class="row">
              <div class="col-sm-10 form-box">
                <div class="col-md-12 border rounded-lg p-4 settingForm">
                  <div class="border border-right-0 border-top-0 border-left-0 mb-4 form-title">
                    <h4>Basic Settings</h4>
                    <p>Update basic store information</p>
                  </div>
                  <div class="col-md-10 pl-0 formfields">
                    <div class="form-group">
                      <label class="text-secondary" for="url">Domain URL:</label>
                      <input name="domain" type="url" class="border form-control" id="url" placeholder="Enter URL" value="<?php echo isset($result->domain)?$result->domain:''; ?>" required>
                    </div>
                    <div class="form-group">
                      <label class="text-secondary" for="uname">Access Key:</label>
                      <input type="text" class="border form-control" id="uname" placeholder="Access Key"  name="access_key" value="<?php echo isset($result->access_key)?$result->access_key:''; ?>" required>
                    </div>
                    <div class="form-group">
                      <label class="text-secondary" for="api">Access Key Secret:</label>
                      <div class="d-flex">
                        <input type="text" class="border form-control" id="api" placeholder="Access Key Secret"  name="access_key_secret" value="<?php echo isset($result->access_key_secret)?$result->access_key_secret:''; ?>" required>
                        <button type="button" id="test-key"  class="integration-form-btn btn btn-info w-25 ml-4">Test Settings</button>
                      </div>
                    </div>
                    <button type="buttom" id="submit-key" class="integration-form-btn btn btn-success">Submit</button>
                    <div class="response_msg"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End -->
      </div>

</form>

<div id="qloader" style="display: none; margin-left: 20px;"><img src="<?php echo SLATWALL_PLUGIN_DIR_ULR; ?>/public/images/spinner.gif"></div>
<script>
       jQuery(document).ajaxStart(function() {
  jQuery("#qloader").show();
}).ajaxStop(function() {
  jQuery("#qloader").hide('slow');
});
     var ajax_url = '<?php echo get_site_url()."/wp-admin/admin-ajax.php"; ?>';
    jQuery(document).ready(function(){
        jQuery('#slatwall_integration .integration-form-btn').on( 'click', function(event) {
        event.preventDefault();
    
    var id = jQuery(this).attr('id');
    console.log(id);
    var form_data = jQuery("#slatwall_integration").serializeArray();
    form_data.push({send_option: id});
    // set ajax data
    var data = {
        'action' : 'send_key_data',
        'form_data': form_data
    };

    jQuery.post(ajax_url, data, function( result ) {
        var response = jQuery.parseJSON(result);
            if(response.token){
                if(id == 'submit-key'){
                   console.log('Success'); 
                   jQuery('.response_msg').html('Success');
                } else {
                    console.log('Test Success');
                      jQuery('.response_msg').html('Test Success');
                }
                
            } else{
                if(id == 'submit-key'){
                     jQuery('.response_msg').html('Failed');
                   console.log('Failed'); 
                } else {
                     jQuery('.response_msg').html('Test Failed');
                    console.log('Test Failed');
                }
            }


    } );
return false;
} );
    });

    </script>
