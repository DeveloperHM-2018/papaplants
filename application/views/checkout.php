<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('include/headerlink.php') ?>
</head>

<body>
	<!-- header  -->
	<?php $this->load->view('include/header') ?>
	<!-- header area end  -->
	<!-- page title area start  -->
	<section class="page-title-area" data-background="<?= base_url() ?>assets/img/bg/page-title-bg.jpg">
		<div class="breadcrumb-wrapper">
			<div class="container">
				<div class="breadcrumb-menu">
					<nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
						<ul class="trail-items">
							<li class="trail-item trail-begin">
								<a href="<?= base_url() ?>"><span>home</span></a>
							</li>
							<li class="trail-item trail-end"><span>My Checkout</span></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<section class="cart-area pt-100 pb-100" style="background-color: #f8f5f0;">
		<div class="container container-small">
			<?php
			if (sessionId('login_user_id') != '') {
			?>
				<div class="container container-small">
					<form action="<?= base_url('checkout_payment') ?>" method="post">

						<div class="row wow fadeInUp" data-wow-delay=".3s">
							<div class="col-lg-8">
								<div class="card your-order shadow" style="border-radius: 15px;">
									<div class="card-body">
										<div class="checkbox-form ">

											<h3>Billing Details</h3>

											<div class="row">
												<div class="col-md-6">
													<div class="checkout-form-list">
														<label>First Name <span class="required">*</span></label>
														<input type="text" name="first_name" placeholder="" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="checkout-form-list">
														<label>Last Name <span class="required">*</span></label>
														<input type="text" name="last_name" placeholder="" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="checkout-form-list">
														<label>Email Address <span class="required">*</span></label>
														<input type="email" name="email" placeholder="" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="checkout-form-list">
														<label>Phone <span class="required">*</span></label>
														<input type="text" name="number" placeholder="Phone no." required>
													</div>
												</div>
												<div class="col-md-12">
													<div class="checkout-form-list">
														<label>Address <span class="required">*</span></label>
														<input type="text" name="address" placeholder="Street address" required>
													</div>
												</div>
												<div class="col-md-12">
													<div class="checkout-form-list">
														<input type="text" name="address1" placeholder="Apartment, suite, unit etc. (optional)">
													</div>
												</div>
												<div class="col-md-4">
													<div class="checkout-form-list">
														<label>Town / City <span class="required">*</span></label>
														<!-- <input type="text" name="address2" placeholder="" required> -->
														<select class="form-control" name="address2" id="state">
															<option>Select Town / City</option>
															<?php foreach ($category as $row) {
															?>
																<option value="<?= $row['state']; ?>"><?= $row['cat_name']; ?></option>
															<?php
															}
															?>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="checkout-form-list">
														<label>State / Country <span class="required">*</span></label>
														<input type="text" name="state" placeholder="" value="India" required readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="checkout-form-list">
														<label>Postcode / Zip <span class="required">*</span></label>
														<input type="text" name="pincode" placeholder="Postcode / Zip" required>
													</div>
												</div>
											</div>
											<div class="different-address">
												<div class="ship-different-title">
													<label>Ship to a different address?</label>
													<input id="ship-box" type="checkbox">
												</div>
												<div id="ship-box-info">
													<div class="row">
														<div class="col-md-6">
															<div class="checkout-form-list">
																<label>First Name <span class="required">*</span></label>
																<input type="text" class="ship-box" name="billing_first_name" placeholder="">
															</div>
														</div>
														<div class="col-md-6">
															<div class="checkout-form-list">
																<label>Last Name <span class="required">*</span></label>
																<input type="text" class="ship-box" name="billing_last_name" placeholder="">
															</div>
														</div>
														<div class="col-md-12">
															<div class="checkout-form-list">
																<label>Address <span class="required">*</span></label>
																<input type="text" class="ship-box" name="billing_address" placeholder="Street address">
															</div>
														</div>
														<div class="col-md-12">
															<div class="checkout-form-list">
																<input type="text" class="ship-box" name="billing_address1" placeholder="Apartment, suite, unit etc. (optional)">
															</div>
														</div>
														<div class="col-md-4">
															<div class="checkout-form-list">
																<label>Town / City
																	<span class="required">*</span></label>
																<input type="text" class="ship-box" name="billing_address2" placeholder="Town / City">
															</div>
														</div>
														<div class="col-md-4">
															<div class="checkout-form-list">
																<label>State / Country
																	<span class="required">*</span></label>
																<input type="text" class="ship-box" name="billing_state" placeholder="">
															</div>
														</div>
														<div class="col-md-4">
															<div class="checkout-form-list">
																<label>Postcode / Zip
																	<span class="required">*</span></label>
																<input type="text" class="ship-box" name="billing_pincode" placeholder="Postcode / Zip">
															</div>
														</div>
													</div>
												</div>
												<div class="order-notes">
													<div class="checkout-form-list">
														<label>Order Notes</label>
														<textarea id="checkout-mess" name="notes" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="your-order mb-30 shadow bg-white" style="border-radius: 15px;">
									<h3>Your order</h3>
									<div class="your-order-table">
										<div id="checkout_cart"></div>


										<div class="order-button-payment mt-20">
											<button type="submit" class="fill-btn">
												Place order
											</button>
										</div>
									</div>

								</div>
							</div>
						</div>

				</div>
				</form>
		</div>
	<?php
			} else {
	?>
		<div class="row wow fadeInUp" data-wow-delay=".3s">
			<div class="col-lg-8">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Login or Signup</h5>

					</div>
					<div class="modal-body">
						<div class="coupon-info">
							<p class="coupon-text">
								You may view your orders, wish list, and recommendations.
							</p>
							<form action="" method="post">
								<p class="form-row-first">
									<label>Enter Contact no. <span class="required">*</span></label>
									<input type="text" maxlength="10" id="contactno">
								</p>
								<p class="form-row-last" style="display:none" id="otpbox">
									<label>OTP <span class="required">*</span></label>
									<input type="text" maxlength="6" id="otp">
									<span id="otpmessage"></span>
								</p>
								<p class="form-row">
									<button class="fill-btn" type="button" id="otpbtn">Request OTP</button>
									<button class="fill-btn" type="button" id="otpverify" style="display:none;">Verify</button>
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<img class="d-block w-100" src="<?= base_url() ?>assets/images/slider/1.png" alt="First slide">
			</div>
		</div>

	<?php
			}
	?>
	</div>
	</section>
	<!-- cart area end  -->
	<?php $this->load->view('include/footer') ?>
	<?php $this->load->view('include/footerlink') ?>

</body>

</html>
