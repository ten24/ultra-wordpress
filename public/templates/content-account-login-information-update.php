
 <?php //d($accounts->accountEmailAddresses['0']->emailAddress); ?>
 <div class="container my-5">
        <h1 class="mb-4">Account Login Information</h1>
<div class="row">
            <!-- Account Sidebar Navigation -->
            <?php  $templates->get_template_part( 'content', 'account-sidebar',true ); ?>
<div class="col-md-9">
                <div class="alert alert-success" style="display:none">Email address updated</div>
                <div class="alert alert-danger" style="display:none">Invalid Email address</div>
                <h4>Change Primary Email Login</h4>
                <p>Primary Email login: <strong><?php echo $accounts->primaryEmailAddress->emailAddress; ?></strong></p>
                <!-- <div class="row">
                    <form  action="" method="post" class="col-md-5">
                        <div class="form-group">
                            <label for="emailAddress">Email Address</label>
                            <input class="form-control is-invalid" id="emailAddress" required>
                            <div class="invalid-feedback">Valid email address required</div>
                        </div>
                        <div class="form-group">
                            <label for="emailAddressConfirm">Confirm Email Address</label>
                            <input class="form-control is-invalid" id="emailAddressConfirm" required>
                            <div class="invalid-feedback">Valid confirm email address required</div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary"  value="chage_email" type="submit">Update Email Login</button>
                        </div>
                    </form>
                </div> -->

                <div class="alert alert-success show-password-msg" style="display:none">Password updated</div>
                <div class="alert alert-danger show-error-msg" style="display:none">Invalid updated</div>

                <h4>Change Password</h4>
                <div class="row">
                    <div class="col-md-5">
                        <form action="change_password_account" method="post" id="change_password">
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" name="password" class="form-control required" id="reg-password" >
                                <div class="invalid-feedback">Valid password required</div>
                            </div>
                            <div class="form-group">
                                <label for="passwordConfirm">Confirm New Password</label>
                                <input type="password" name="passwordConfirm" class="form-control required" id="confirm-password">
                                <div class="invalid-feedback">Valid confirm password required</div>
                                <div id="msg"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" value="change_password" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</div>
</div>
<div  id="qloader" style="display: none;"><div class="loader" style="display: flex;"><i class="fa-circle-o-notch fa-spin fa-3x"></i></div></div>

