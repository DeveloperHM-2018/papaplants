<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('include/headerlink') ?>
</head>

<body>
	<?php $this->load->view('include/header') ?>
	<div class="mobileSearch" style="display: block !important;">
	<form action="#">
		<div class="single-input-field field-search mobile-serach-field">
			<input type="search" placeholder="Search Plants..." class="text-capitalize">
			<button type="submit" class="mobileSearchIcon">
				<i class="fas fa-search"></i>
			</button>
		</div>
	</form>
	</div>
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="<?= base_url() ?>assets/images/slider/1.png" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="<?= base_url() ?>assets/images/slider/2.png" alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="<?= base_url() ?>assets/images/slider/3.png" alt="Third slide">
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<!-- category-area start  -->



	<?php
	$i = 0;
	$j = 0;
	$start = 0;
	$part = [];
	if (!empty($category)) {
		foreach ($category as $cat_nme) {

	?>
			<section class="product-area pt-40 pb-40 prodiv">
				<div class="container">
					<div class="row align-items-center wow fadeInUp" data-wow-delay=".3s">
						<div class="col-lg-8 col-md-8">
							<div class="section-title style-5">
								<span class="section-subtitle">Papaplants</span>
								<h2 class="section-main-title mb-45"><?= $cat_nme['name']; ?></h2>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="product-area-btn product-slider-area-btn style-5">
								<a href="<?= base_url() ?>products/<?= $cat_nme['meta_url']; ?>" class="border-btn"><span>view all</span><i class="fal fa-long-arrow-right"></i></a>

								<?php
								$subcategory = getRowByMoreId('category', ['parent_id' => $cat_nme['id'], 'is_visible' => '1']);
								if (!empty($subcategory)) {
								?>
									<?php
									foreach ($subcategory as $subcat) {
									?>
										<a href="<?= base_url() ?>products/<?= $cat_nme['meta_url'] ?>/<?= $subcat['meta_url'] ?>" class="border-btn">
											<span>
												| <?= $subcat['name'] ?>
											</span>
										</a>
								<?php
									}
								}
								?>
							</div>
						</div>
					</div>
					<div class="procuct-wrapper product-slide-wrapper mb-0 slider-drag wow fadeInUp" data-wow-delay=".3s">
						<div class="swiper-container product-active">
							<div class="swiper-wrapper">

								<?php
								$product_list = getRowById('product_category', 'category_id', $cat_nme['id']);
								$i = 0;
								if (!empty($product_list)) {
									foreach ($product_list as $pro) {
										$product = getRowById('product', 'id', $pro['product_id']);
										foreach ($product as $product_info) {
											if ($i == 4) {
												break;
											} else {
												product_slide($product_info);
											}
											$i++;
										}
									}
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</section>

			<?php
			if ($j % 2 == 0) {
				$part = array_slice($other_category, $start, 4, true);
				if (!empty($part)) {
			?>
					<div class="category-area category-area-basic pt-10">
						<div class="container">
							<div class="category-wrapper slider-drag wow fadeInUp" data-wow-delay=".3s">
								<div class="swiper-container category-basic-slider">
									<div class="swiper-wrapper">
										<?php
										foreach ($part as $part_pro) {
											$count = getNumRows('product_category', ['category_id' => $part_pro['id']]);
										?>
											<div class="swiper-slide">
												<div class="category-single category-basic">
													<div class="category-thumb">
														<a href="<?= base_url('products/' . $part_pro['meta_url']) ?>"><img src="assets/img/category/category-t-1.jpg" alt="img not found"></a>
													</div>
													<div class="category-content">
														<span class="in-stock"><span class="stock-amount"><?= $count ?></span> in stock</span>
														<h4 class="category-name">
															<a href="<?= base_url('products/' . $part_pro['meta_url']) ?>"><?= $part_pro['name'] ?></a>
														</h4>
													</div>
												</div>
											</div>
										<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>

	<?php
					$start += 4;
				}
			}
			$j++;
		}
	}
	?>

	<!-- instagram slider area start  -->

	<div class="instagram-slider-wrappper wow fadeInUp mt-3" data-wow-delay=".3s">
		<div class="swiper-container instagram-slider-active">
			<div class="swiper-wrapper">
				<?php


				if ($handle = opendir('./uploads/instagram/')) {

					while (false !== ($entry = readdir($handle))) {

						if ($entry != "." && $entry != "..") {
				?>
							<div class="swiper-slide">
								<div class="instagram-shot">
									<a href="#"><img src="<?= base_url('uploads/instagram/' . $entry) ?>" alt=""></a>
									<div class="instagram-hover-link">
										<a href="#"><i class="fab fa-instagram"></i></a>
									</div>
								</div>
							</div>
				<?php
						}
					}

					closedir($handle);
				}
				?>


			</div>
		</div>
	</div>

	<?php $this->load->view('include/footer') ?>
	<?php $this->load->view('include/footerlink') ?>

</body>

</html>
