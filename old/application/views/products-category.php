<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('include/headerlink.php') ?>
	<style>
		.pagination {
			display: inline-block;
		}

		.pagination a {
			color: black;
			float: left;
			padding: 8px 16px;
			text-decoration: none;
		}

		.pagination a.active {
			background-color: #4CAF50;
			color: white;
		}

		.pagination a:hover:not(.active) {
			background-color: #ddd;
		}
	</style>
</head>

<body>
	<!-- header  -->
	<?php $this->load->view('include/header') ?>
	<!-- banner area  -->
	<section class="page-title-area">
		<div class="breadcrumb-wrapper">
			<div class="container">
				<div class="breadcrumb-menu">
					<nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
						<ul class="trail-items">
							<li class="trail-item trail-begin">
								<a href="#"><span>home</span></a>
							</li>
							<li class="trail-item trail-end"><span>Products</span></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- banner area end  -->
	<!-- main area  -->
	<section class="blog-area pt-120 pb-60">
		<div class="container">
			<div class="row wow fadeInUp" data-wow-delay=".3s">
				<!-- sidebar  -->
				<div class="col-xl-3 col-lg-4 col-md-8">
					<div class="blog-sidebar_wrapper mb-60">
						<div class="sidebar-widget sidebar-search mb-50">
							<h4 class="sidebar-widget-title">Search Product</h4>
							<div class="sidebar-search-form">
								<input type="text" placeholder="Search your keyword..." />
								<button><i class="fal fa-search"></i></button>
							</div>
						</div>
						<div class="sidebar-widget sidebar-category mb-50">
							<h4 class="sidebar-widget-title">Categories</h4>
							<div class="sidebar-category-list">
								<ul>
									<?php
									if (!empty($category)) {
										foreach ($category as $cat_name) {
									?>
											<li>
												<a href="#">
													<span class="category-name"><?= $cat_name['name']; ?></span>
													<div class="category-item-number">26</div>
												</a>
											</li>
									<?php
										}
									}
									?>
								</ul>
							</div>
						</div>
						<div class="sidebar-widget sidebar-tags mb-50">
							<h4 class="sidebar-widget-title">Tags</h4>
							<div class="sidebar-tag-list">
								<a href="#" class="tag">Popular</a>
								<a href="#" class="tag">Design</a>
								<a href="#" class="tag">UX</a>
								<a href="#" class="tag">Usability</a>
								<a href="#" class="tag">Develop</a>
								<a href="#" class="tag">Icon</a>
								<a href="#" class="tag">Business</a>
								<a href="#" class="tag">Consult</a>
								<a href="#" class="tag">Kit</a>
								<a href="#" class="tag">Keyboard</a>
								<a href="#" class="tag">Mouse</a>
								<a href="#" class="tag">Tech</a>
							</div>
						</div>
					</div>
				</div>
				<!-- products  -->
				<div class="col-xl-9 col-lg-8 col-md-12">
					<div class="foundation-area style-2 pt-0 pb-60">
						<div class="filter-tab-content wow fadeInUp" data-wow-delay=".3s">
							<div class="tab-content" id="nav-tabContent">
								<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
									<div class="product-wrapper product">
										<?php
										if (!empty($product)) {
											foreach ($product as $product_info) {
												product($product, 3);
											}
										}
										?>
										</ul>
										<div class="pagination">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- footer  -->
	<?php $this->load->view('include/footer') ?>
	<?php $this->load->view('include/footerlink') ?>
</body>

</html>
