<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */

/**
 * Provide a admin area view for the slatwall
 *
 * This file is used to markup the admin-facing aspects of Slatwall.
 *
 * @link       https://www.slatwallcommerce.com/
 * @since      1.0.0
 *
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/admin/partials
 */
?>
<div>
<form method="POST" action="slatwall_integration" id="slatwall_integration">

      <div class="col-12 py-4 pr-4 wrap-inner">
        <!-- Header Section (Logo) -->
        <div class="row py-2 align-items-center header-section">
          <div class="col-sm-6 left-container logo">
            <img src="<?php echo SLATWALL_PLUGIN_DIR_ULR; ?>/admin/images/logo.png" alt="Slatwall Commerce" class="img-fluid w-25" />
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
                <h3>Slatwall Commerce for WordPress</h3>
                <p class="mb-1">Power your WordPress storefronts with the complete enterprise eCommerce functionality of Slatwall Commerce. </p>
                <p>Designed to be a headless commerce solution that easily integrates into WordPress using the Slatwall Commerce API.</p>
                <p>
                  <a href="https://publicapi.slatwallcommerce.com/" title="" class="btn btn-outline-secondary mr-3" target="_blank">Slatwall API Documentation</a>
                  <a href="https://www.slatwallcommerce.com/user-guide/" title="" class="btn btn-outline-secondary" target="_blank">Slatwall User Guide</a>
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- End -->

        <!-- Setting Form Section -->
        <div class="row form-section">
          <div class="col-12 form-inner">
            <h3>API Settings</h3>
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
                   jQuery('.response_msg').html('Success');
                } else {
                    console.log('Test Success');
                      jQuery('.response_msg').html('Test Success');
                }

            } else{
                if(id == 'submit-key'){
                     jQuery('.response_msg').html('Failed');
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
