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
							<li class="trail-item trail-end"><span><?= $title ?></span></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- page title area end  -->

	<div class="faq-area pt-120 pb-120">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?= $policy['policy'] ?>
				</div>
			</div>
		</div>
	</div>
	<!-- faq area end  -->
	<!-- cart area end  -->
	<?php $this->load->view('include/footer') ?>
	<?php $this->load->view('include/footerlink') ?>
</body>

</html>
