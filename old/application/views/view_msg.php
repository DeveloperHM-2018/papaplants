<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('include/headerlink.php') ?>
</head>

<body>
	<?php $this->load->view('include/header') ?>
	<!-- banner area  -->
	<section class="page-title-area">
		<div class="breadcrumb-wrapper">
			<div class="container">
				<div class="breadcrumb-menu">
					<nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
						<ul class="trail-items">
							<li class="trail-item trail-begin">
								<a href="<?= base_url() ?>"><span>home</span></a>
							</li>
							<li class="trail-item trail-end"><span>Message</span></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- banner area end  -->
	<section class="contact-area pt-120">
		<div class="container">
			<div class="row wow fadeInUp" data-wow-delay=".3s">
				<div class="col-lg-12">
					<div class="contact-wrapper">
						<div class="contact-wrapper-content">
							<div class="section-title">
								<h2 class="section-main-title sz-35 mb-35">Connect with nature , connect with us </h2>
							</div>
							<div class="contact-form">
								<?= $msg ?>
								<div class="row">
									<div class="col-md-12">
										<br>
										<h3 class="bold">Estimated Delivery: 6 to 9 Days 🚛</h3>
										<h3> For Bhopal - 24 to 48 Hours</h3>
										<br>
										<a href="<?= base_url('dashboard') ?>" class="btn btn-success">View order history</a>
									</div>
									<div class="col-md-6">
										<!-- <a href="<?= base_url('dashboard') ?>" class="btn btn-primary">Back</a> -->
									</div>
								</div>
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
	</main>
	<!-- back to top start -->
	<div class="progress-wrap">
		<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
			<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
		</svg>
	</div>
	<!-- footer -->
	<?php $this->load->view('include/footer') ?>
	<?php $this->load->view('include/footerlink') ?>
</body>

</html>
