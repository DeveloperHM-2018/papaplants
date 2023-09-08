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
							<li class="trail-item trail-end"><span>My cart</span></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- page title area end  -->
	<!-- cart area start  -->
	<section class="h-100 h-custom" style="background-color: #d2c9ff;">
		<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-12">
					<div class="card card-registration card-registration-2" style="border-radius: 15px;">
						<div class="card-body p-0">
							<div class="row g-0">
								<div class="col-lg-8">
									<div class="p-5">
										<div class="d-flex justify-content-between align-items-center mb-5">
											<h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
											<h6 class="mb-0 text-muted"><span class="cart_count"></span> items</h6>
										</div>
										<span id="cart_list"></span>



										<div class="pt-5">
											<h6 class="mb-0"><a href="#" onclick="history.back()" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
										</div>
									</div>
								</div>
								<div class="col-lg-4 bg-grey">
									<div class="p-5">
										<h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
										<hr class="my-4">
										<div class="d-flex justify-content-between mb-4">
											<h5 class="text-uppercase">items </h5>
											<h5><span class="cart_count"></span></h5>
										</div>
										<hr class="my-4">
										<div class="d-flex justify-content-between mb-5">
											<h5 class="text-uppercase">Total price</h5>
											<h5><span class="total_cart_amount"></span></h5>
										</div>
										<hr class="my-4">
										<a href="<?= base_url('checkout') ?>" class="btn btn-dark btn-block btn-lg w-100" data-mdb-ripple-color="dark">Checkout</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- cart area end  -->
	<?php $this->load->view('include/footer') ?>
	<?php $this->load->view('include/footerlink') ?>
</body>

</html>
