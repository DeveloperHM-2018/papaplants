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
	<section class="cart-area pt-100 pb-100">
		<div class="container container-small">
			<div class="row wow fadeInUp" data-wow-delay=".3s">
				<div class="col-12">
					<div class="table-content table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="product-thumbnail">Images</th>
									<th class="cart-product-name">Product</th>
									<th class="product-price">Unit Price</th>
									<th class="product-quantity">Quantity</th>
									<th class="product-subtotal">Total</th>
									<th class="product-remove">Remove</th>
								</tr>
							</thead>
							<tbody id="cart_list">


							</tbody>
						</table>
					</div>

					<div class="row">
						<div class="col-md-5 ml-auto">
							<div class="cart-page-total">
								<h2>Cart totals</h2>
								<ul class="mb-20">
									<!-- <li>Subtotal <span>$78.00</span></li> -->
									<li>Total <span class="total_cart_amount"></span></li>
								</ul>
								<a class="border-btn" href="<?= base_url('checkout') ?>">Proceed to checkout</a>
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
