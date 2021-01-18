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
                <ul class="nav nav-pills nav-fill mb-1" id="pills-tab" role="tablist">
                	<li class="nav-item">
                		<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Login</a>
                	</li>
                	<li class="nav-item">
                		<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Signup</a>
                	</li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <!-- Login -->
                	<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="card">
                            <div class="card-body">
							<div class="alert alert-danger small accounterror" style="display: none;"></div>
							<form action="user_login" class="login_register" id="login_form">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
										<input type="email" name="emailAddress" class="form-control required" id="login_email">
										<div class="invalid-feedback">Please enter a valid email address</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
										<input type="password" name="password" class="form-control required">
										<div class="invalid-feedback">Password Required</div>
                                    </div>

                                    <button class="btn btn-primary btn-block" name="account" type="submit" value="login">Sign In<i class="fas fa-circle-notch fa-spin"></i></button>
                                </form>
                                <a href="forget-password" class="btn btn-link btn-block text-center">Forgot your password?</a>
                            </div>
                        </div>
                    </div>

                    <!-- Signup -->
                	<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="card">
                            <div class="card-body">
							<div class="alert alert-danger small accountregerror" style="display: none;"></div>
							<form action="user_register" id="create-account" class="account_register mt-3">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-fn">First Name</label>
							<input class="form-control required" name="firstName" type="text" id="checkout-fn" >
							<div class="invalid-feedback">First Name Required</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-ln">Last Name</label>
							<input class="form-control required" name="lastName" type="text" id="checkout-ln" >
							<div class="invalid-feedback">Last Name Required</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-email">E-mail Address</label>
							<input class="form-control required" name="emailAddress" type="email" id="register-email" >
							<div class="invalid-feedback">Email Required</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-email-confirm">Confirm E-mail Address</label>
							<input class="form-control required" name="emailAddressConfirm" type="email" id="register-email-confirm" >
							<div class="invalid-feedback">Confirm E-mail Address Required</div>
							<div id="email-msg"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-phone">Phone Number</label>

							<input class="form-control numfieldvalidate required" name="phoneNumber" type="text" id="checkout-phone">

							<div class="invalid-feedback">Phone Number Required</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-organization">Organization</label>
							<input class="form-control" name="company" type="text" id="checkout-organization" >
							<div class="invalid-feedback">Organization Required</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="password">Password</label>
							<input class="form-control required" name="password" type="password" id="reg-password" >
							<div class="invalid-feedback">Password Required</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="confirm-password">Confirm Password</label>
							<input class="form-control required" name="passwordConfirm" type="password" id="confirm-password" >
							<div class="invalid-feedback">Confirm Password Required</div>
							<div id="msg"></div>
						</div>
					</div>
					<input type="hidden" class="form-control" name="returnTokenFlag" value="1">
				</div>

				<div class="form-group w-50">
					<!-- Toggle disabled attribute & spinner icon after form submit validation & loading -->
					<!-- <button class="btn btn-secondary btn-block" type="submit">Continue <i class="fas fa-circle-notch fa-spin"></i></button> -->
					<button class="btn btn-primary btn-block" name="account" type="submit" value="register">Sign Up<i class="fas fa-circle-notch fa-spin"></i></button>
				</div>
			</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

	</div>

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

<div  id="qloader" style="display: none;"><div class="loader" style="display: flex;"><i class="fa-circle-o-notch fa-spin fa-3x"></i></div></div>
