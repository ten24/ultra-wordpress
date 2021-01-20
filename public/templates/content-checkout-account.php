<!-- Start Body -->
<div class="col-xl-7 col-md-8 checkoutforms">
	<!-- Account Login / Create Account -->
	<h3 class="mb-3 pt-3 pb-3 border-bottom">Account Information</h3>

	<div class="tab-content" id="pills-tabContent">
		<!-- Account Login -->
		<div class="tab-pane fade show active" id="pills-login">
                    <p>Login with your account to continue, or <a id="pills-create-account-tab" href="#pills-create-account" 
                                onclick="jQuery('#pills-login').hide(); jQuery('#pills-password').hide(); jQuery('#pills-create-account').show()">create a new account</a>.</p>
			<div class="alert alert-danger small accounterror" style="display: none;">The username or password that you entered is invalid.</div>
			<form action="user_login" class="checkout_login_register" id="login_form">
				<div class="form-group">
					<label for="email">Email Address</label>
					<input type="email" name="emailAddress" id="emailAddress" class="form-control required">
					<div class="invalid-feedback">Please enter a valid email address</div>
				</div>

				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control required">
					<div class="invalid-feedback">Password Required</div>
				</div>
                            <div class="row">
				<div class="col-md-6">
					<!-- Toggle disabled attribute & spinner icon after form submit validation & loading -->
					<button class="btn btn-secondary btn-block" type="submit" id="submit">Continue <i class="fas fa-circle-notch fa-spin"></i></button>
				</div>
                            <div class="col-md-6 text-right">	<a id="pills-password-tab" class="btn btn-link" href="#pills-password" onclick="jQuery('#pills-login').hide(); jQuery('#pills-password').show(); jQuery('#pills-create-account').hide()">
											Forgot Password
										</a>

                                    </div>
                            </div>
			</form>
		</div>
		<!-- /End Account Login -->
                <!-- Forget Password -->
                <div class="tab-pane" id="pills-password">
                    
                             <h4>Forgot Password</h4>

                            <!-- Forgot Password error display message -->
                            <div class="account_create_errors"></div>
                            <div class="alert alert-success small account_forget" style="display: none;">Please check your email with instructions to reset your password.</div>
                            <form action="forget_password_account" class="checkout_login_register">
                                <div class="form-group" class="form-control required">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="emailAddress" class="form-control" required>
                                    <div class="invalid-feedback">Email Address Required</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-block">Recover Password</button>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <!-- Back to Login --> <a id="pills-login-tab" class="btn btn-link" href="#pills-login" onclick="jQuery('#pills-login').show(); jQuery('#pills-password').hide(); jQuery('#pills-create-account').hide()">
			                                Back to Login
			                            </a>

                                    </div>
                                </div>
                                </form>
                        </div>
                <!-- /End Forget Password -->
		<!-- Create Account Tab -->
		<div class="tab-pane" id="pills-create-account" >
                    <p>Create an account below to continue, or <a id="pills-login-tab" href="#pills-login" onclick="jQuery('#pills-login').show(); jQuery('#pills-password').hide(); jQuery('#pills-create-account').hide()">login to your account</a>.</p>
			<!-- Create Account Form -->
                        <div class="account_create_errors"></div>
                        <div class="alert alert-success small account_create" style="display: none;">Account Created</div>
			<form action="user_register" id="create-account" class="checkout_login_register mt-3">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-fn">First Name</label>
							<input class="form-control required" name="firstName" type="text" id="checkout-fn">
							<div class="invalid-feedback">First Name Required</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-ln">Last Name</label>
							<input class="form-control required" name="lastName" type="text" id="checkout-ln">
							<div class="invalid-feedback">Last Name Required</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-email">E-mail Address</label>
							<input class="form-control required" name="emailAddress" type="email" id="checkout-email">
							<div class="invalid-feedback">Email Required</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-email-confirm">Confirm E-mail Address</label>
							<input class="form-control required" name="emailAddressConfirm" type="email" id="checkout-email-confirm">
							<div class="invalid-feedback">Confirm E-mail Address Required</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-phone">Phone Number</label>
							<input class="form-control required number" name="phoneNumber" type="text" id="checkout-phone">
							<div class="invalid-feedback">Phone Number Required</div>
                                                        <div class="invalid-feedback-phone invalid-feedback" style="display: none;">Please enter numbers only</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-organization">Organization</label>
							<input class="form-control" name="company" type="text" id="checkout-organization">
							<div class="invalid-feedback">Organization Required</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="password">Password</label>
							<input class="form-control required" name="password" type="password" id="password">
							<div class="invalid-feedback">Password Required</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="confirm-password">Confirm Password</label>
							<input class="form-control required" name="passwordConfirm" type="password" id="confirm-password">
							<div class="invalid-feedback">Confirm Password Required</div>
						</div>
					</div>
					<input type="hidden" class="form-control" name="returnTokenFlag" value="1">
				</div>

				<div class="form-group">
					<div class="form-check">
						<input class="form-check-input required" type="checkbox" value="1" id="terms-conditions">
						<label class="form-check-label" for="terms-conditions">
							Accept <a href="#" data-toggle="modal" data-target="#termsModal">Terms & Conditions</a>
						</label>
						<div class="invalid-feedback">Terms & Conditions Required</div>
					</div>
				</div>
				<div class="form-group w-50">
					<!-- Toggle disabled attribute & spinner icon after form submit validation & loading -->
					<button class="btn btn-secondary btn-block" type="submit">Continue <i class="fas fa-circle-notch fa-spin"></i></button>
				</div>
			</form>
			<!-- /End Create Account Form  -->
		</div>
		<!-- /End Create Account -->
	</div>
</div>
<!-- /End Body -->
<!-- /End Row -->


<!-- Terms & Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModal" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="termsModal">Terms & Conditions</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Terms & Conditions Content Body</p>
			</div>
		</div>
	</div>
</div>
<!-- /End Terms & Conditions Modal -->
