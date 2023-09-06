<header class="header1" style="box-shadow: 0 0 60px 0 rgba(53, 57, 69, 0.15);">
	<div class="header-top-area d-none d-lg-block" style="background: var(--clr-theme-3);">
		<div class="container ">
			<div class="header-top-inner">
				<div class="header-top-left">
					<div class="meta-items">
						<div class="meta-item">
							<div class="meta-item-icon">
								<i class="fas fa-phone"></i>
							</div>
							<div class="meta-item-text">
								<p><a href="tel:<?= $this->contact['f_contact'] ?>"><?= $this->contact['f_contact'] ?></a></p>
							</div>
						</div>
						<div class="meta-item">
							<div class="meta-item-icon">
								<i class="fas fa-envelope-open"></i>
							</div>
							<div class="meta-item-text">
								<p>
									<a href="mailto:<?= $this->contact['f_email'] ?>"><?= $this->contact['f_email'] ?></a>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="header-top-right">
					<div class="meta-items">
						<div class="meta-item">
							<div class="meta-item-icon">
							</div>
							<div class="meta-item-text">
								<p>
									<span class="d-none d-xl-inline-block">
										<strong>PAPAPLANTS - </strong>CONNECTING NATURE</span>
								</p>
							</div>
						</div>
					</div>
					<div class="header-top-social">
						<div class="social-links">
							<ul>
								<li>
									<a href="<?= $this->contact['youtube'] ?>"><i class="fab fa-youtube"></i></a>
								</li>
								<li>
									<a href="<?= $this->contact['instagram'] ?>"><i class="fab fa-instagram"></i></a>
								</li>
								<li>
									<a href="<?= $this->contact['facebook'] ?>"><i class="fab fa-facebook-f"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="header-sticky" class="header-main header-main1">
		<div class="container ">
			<div class="row align-items-center">
				<div class="col-xl-12 col-lg-12">
					<div class="header-main-content-wrapper">
						<div class="header-main-left header-main-left-header1">
							<div class="header-logo header1-logo">
								<a href="<?= base_url() ?>" class="logo-w"><img src="<?= base_url() ?>/assets/images/logo.png" alt="logo-img"></a>
							</div>
							<div class="main-menu main-menu1 d-none d-xl-block">
								<nav id="mobile-menu">
									<ul>
										<?php
										if (!empty($category)) {
											foreach ($category as $cat_nme) {
										?>
												<li class="menu-item-has-childen"><a href="<?= base_url() ?>products/<?= $cat_nme['meta_url']; ?>"><?= $cat_nme['name']; ?></a></li>
										<?php
											}
										}
										?>
										<li style="visibility:hidden">View all products</li>
										<!-- <li class="header-search desktop-search">
											<form action="<?= base_url('Home/search') ?>">
												<div class="single-input-field field-search desk-inputsearch">
													<input type="search" name="plant" placeholder="Search Plants...">
													<button type="submit" class="position-static">
														<i class="fas fa-search"></i>
													</button>
												</div>
											</form>
										</li> -->
									</ul>

								</nav>
							</div>
						</div>
						<div class="header-main-right header-main-right-header1">
							<?php
							if (current_url() == base_url('checkout')) {
							} else {
							?>
								<a href="<?= ((sessionId('login_user_id') != '') ? base_url() . 'dashboard' : 'javascript:void(0)') ?>" class="action-btn" <?= ((sessionId('login_user_id') != '') ? '' : 'data-toggle="modal" data-target="#exampleModal"') ?> id="login"><i class="fas fa-user"></i></a>
							<?php
							}
							?>
							<a href="javascript:void(0)" class="action-btn cart-btn d-none d-lg-inline-flex action-item-cart"><i class="fas fa-shopping-basket"></i></a>
							<div class="menu-bar d-xl-none">
								<a class="side-toggle" href="javascript:void(0)">
									<div class="bar-icon">
										<span></span>
										<span></span>
										<span></span>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- header area end -->
<main>

	<!-- side toggle start -->
	<div class="fix">
		<div class="side-info">
			<div class="side-info-content">
				<div class="offset-widget offset-logo mb-40">
					<div class="row align-items-center">
						<div class="col-9">
						</div>
						<div class="col-3 text-end">
							<button class="side-info-close">
								<i class="fal fa-times"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="mobile-menu d-xl-none fix"></div>
				<div class="offset-widget offset_searchbar mb-30">
					<form action="#" class="filter-search-input">
						<input type="text" placeholder="Search keyword">
						<button type="submit"><i class="fal fa-search"></i></button>
					</form>
				</div>
				<div class="offset-widget offset-support mb-30">
					<div class="footer-support">
						<div class="irc-item support-meta">
							<div class="irc-item-icon">
								<i class="fas fa-phone-alt"></i>
							</div>
							<div class="irc-item-content">
								<p>Emergency Call</p>
								<div class="support-number">
									<a href="tel:<?= $this->contact['f_contact'] ?>"><?= $this->contact['f_contact'] ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="offset-widget offset-social mb-30">
					<div class="footer-social">
						<span>Connect:</span>
						<div class="social-links">
							<ul>
								<li>
									<a href="<?= $this->contact['youtube'] ?>"><i class="fab fa-youtube"></i></a>
								</li>
								<li>
									<a href="<?= $this->contact['instagram'] ?>"><i class="fab fa-instagram"></i></a>
								</li>
								<li>
									<a href="<?= $this->contact['facebook'] ?>"><i class="fab fa-facebook-f"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="offcanvas-overlay"></div>
	<div class="offcanvas-overlay-white"></div>
	<div class="fix">
		<div class="sidebar-action sidebar-cart">
			<button class="close-sidebar">
				Close<i class="fal fa-times"></i>
			</button>
			<h4 class="sidebar-action-title">Shopping Cart</h4>
			<div class="sidebar-action-list" id="cart">

			</div>
			<div class="product-price-total">
				<span>Subtotal :</span>
				<span class="subtotal-price total_cart_amount"></span>
			</div>
			<div class="sidebar-action-btn">
				<a href="<?= base_url('cart') ?>" class="fill-btn">View cart</a>
				<a href="<?= base_url('checkout') ?>" class="border-btn">Checkout</a>
			</div>
		</div>
	</div>
	<?php
	if (current_url() == base_url('checkout')) {
	} else {
	?>
		<!-- side toggle end -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Login here</h5>
						<button type="button" id="loginclose" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
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
		</div>
	<?php
	}
	?>
