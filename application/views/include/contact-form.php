<section class="contact-area pt-120">
	<div class="container">
		<div class="row wow fadeInUp" data-wow-delay=".3s">
			<div class="col-lg-12">
				<div class="contact-wrapper">
					<div class="contact-wrapper-content">
						<div class="section-title">
							<?php
							if ($this->session->has_userdata('msg')) {
								echo $this->session->userdata('msg');
								$this->session->unset_userdata('msg');
							}
							?>
							<h2 class="section-main-title sz-35 mb-35">Connect with nature and connect with us -<br> <span style="font-size:20px;"> drop us a message today! </span></h2>
						</div>
						<div class="contact-form">
							<form method="POST" action="<?php echo base_url('home/contact') ?>">
								<div class="row">
									<div class="col-sm-6">
										<div class="single-input-field field-name">
											<input type="text" name="name" placeholder="Enter Full name">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="single-input-field field-call">
											<input type="number" name="phone" placeholder="Phone No.">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="single-input-field field-email">
											<input type="email" name="email" placeholder="Email ">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="single-input-field field-email">
											<input type="text" name="plant" placeholder="Plant Name">
										</div>
									</div>
									<div class="col-sm-12">
										<div class="single-input-field field-message">
											<textarea name="message" id="message" placeholder="message"></textarea>
										</div>
									</div>
								</div>
								<div class="contact-btn">
									<button type="submit" class="fill-btn"><i class="fal fa-long-arrow-right"></i><span>
											Send</span></button>
								</div>
							</form>
						</div>
					</div>
					<div class="contact-wrapper-img">
						<img src="<?= base_url() ?>assets/images/contactimg.png" alt="img not found">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
