</main>
<footer data-background="" class="footer1-bg" style="margin-top: 19px;">
	<section class="footer-area footer-area1 footer-area1-bg pt-55    <?= (current_url() == base_url() . 'checkout') ? 'd-none' : '' ?>">
		<!-- <div class="footer-bg-shape">
			<img src="assets/img/shape/pattern.png" alt="img not found">
		</div> -->
		<div class="container">
			<div class="row">
				<!-- <div class="col-lg-3 col-md-6 col-sm-6">
					<div class="footer-widget footer1-widget footer1-widget1 mb-40">
						<div class="footer-widget-title">
							<h4>about us</h4>
						</div>
						<p class="mb-35">Is that lawn is an open space between woods
							or lawn can be uncountable a type of thin linen
							or cotton while garden is an outdoor area
							containing one or more types of plants</p>
						<div class="footer-support">
							<div class="irc-item support-meta">
								<div class="irc-item-icon">
									<i class="fas fa-phone-alt"></i>
								</div>
								<div class="irc-item-content">
									<div class="support-number"><a href="tel:<?= $this->contact['f_contact'] ?>"><?= $this->contact['f_contact'] ?></a></div>
								</div>
							</div>
						</div>
					</div>
				</div> -->
				<!-- <div class="col-lg-3 col-md-6 col-sm-6">
					<div class="footer-widget footer1-widget footer1-widget2 mb-40">
						<div class="footer-widget-title">
							<h4>Usefull Links</h4>
						</div>
						<ul>
							<li><a href="<?= base_url() ?>">Home</a></li>
							<li><a href="<?= base_url() ?>about">about</a></li>
							<li><a href="<?= base_url() ?>contact">Contact us</a></li>
							<li><a href="<?= base_url() ?>product">Gardening Service</a></li>
							<li><a href="<?= base_url() ?>product">Product on sale</a></li>
						</ul>
						<ul>
							<li><a href="<?= base_url() ?>policy">terms & Condition policy</a></li>
							<li><a href="<?= base_url() ?>contact"></a></li>
							<li><a href="<?= base_url() ?>policy">Refund policy</a></li>

				</ul>
			</div>
		</div> -->
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="footer-widget footer1-widget footer1-widget3 mb-40 ">
						<div class="footer-widget-title">
							<h4>Explore more</h4>
						</div>
						<p>
							<?php
							if (!empty($category)) {
								foreach ($category as $cat_nme) {
							?>
									<span class="text-center text-white text-uppercase"><a href="<?= base_url() ?>products/<?= $cat_nme['meta_url']; ?>"><?= $cat_nme['name']; ?> | </a></span>
							<?php
								}
							}
							?>
							<?php
							if (!empty($other_category)) {
								foreach ($other_category as $cat_nme) {
							?>
									<span class="text-center text-white text-uppercase"><a href="<?= base_url() ?>products/<?= $cat_nme['meta_url']; ?>"><?= $cat_nme['name']; ?> | </a></span>
							<?php
								}
							}
							?>
						</p>
					</div>
					<div class="footer-widget footer1-widget footer1-widget3 mb-40 ">
						<div class="footer-widget-title">
							<h4>Usefull Links</h4>
						</div>
						<ul class="row">
							<?php
							if (!empty($policylinks)) {
								foreach ($policylinks as $row) {
							?>
									<li class="col-md-3 "><a href="<?= base_url() ?><?= $row['url']; ?>"> <?= $row['tag']; ?></a></li>
							<?php
								}
							}
							?>
							<li class="col-md-3 "><a href="<?= base_url() ?>about-us"> About us</a></li>
							<li class="col-md-3 "><a href="<?= base_url() ?>contact"> Contact Us</a></li>

						</ul>
					</div>
				</div>
				<!-- <div class="col-lg-3 col-md-6 col-sm-6">
			<div class="footer-widget footer1-widget footer1-widget4 mb-40 ">
				<div class="footer-widget-title">
					<h4>get in touch</h4>
				</div>
				<div class="footer-contact">
					<ul>
						<li>
							<div class="single-contact">
								<div class="contact-icon">
									<i class="fas fa-phone"></i>
								</div>
								<p><a href="tel:<?= $this->contact['f_contact'] ?>"><?= $this->contact['f_contact'] ?></a></p>
							</div>
						</li>
						<li>
							<div class="single-contact">
								<div class="contact-icon">
									<i class="fas fa-envelope-open"></i>
								</div>
								<p><a href="<?= $this->contact['f_email'] ?>"><?= $this->contact['f_email'] ?></a></p>
							</div>
						</li>
						<li>
							<div class="single-contact">
								<div class="contact-icon">
									<i class="fas fa-map-marked-alt"></i>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div class="footer-social">
					<span>Connect:</span>
					<div class="social-links">
						<ul>
							<li><a href="#"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#"><i class="fab fa-behance"></i></a></li>
							<li><a href="#"><i class="fab fa-youtube"></i></a></li>
							<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div> -->
	</section>
	<div class="copyright-area copyright1-area">
		<div class="container">
			<div class="copyright1-inner">
				<div class="row align-items-center">
					<div class="col-lg-3 col-md-4">
						<div class="footer-logo">
							<a href="<?= base_url() ?>"><img src="<?= base_url() ?>/assets/images/logo.png" alt="img not found"></a>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="copyright-text copyright1-text">
							Copyright By <a href="<?= base_url() ?>">Papaplants - connecting nature</a> - <?= date('Y') ?> All rights reserved
						</div>
					</div>
					<div class="col-lg-3 col-md-2">
						<div class="go-top-btn">
							<a class="go-top" href="#"><i class="fal fa-long-arrow-up"></i></a>
							<input type="hidden" id="base" value="<?php echo base_url(); ?>">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
