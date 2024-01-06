<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('include/headerlink') ?>
</head>

<body>
	<?php $this->load->view('include/header') ?>

	<section class="shop-details-area pt-60 pb-90">
		<div class="container">
			<div class="row wow fadeInUp" data-wow-delay=".3s">
				<div class="col-lg-6">
					<div class="product-d-img-tab-wrapper mb-60">
						<div class="product-d-img-tab mb-3">
							<div class="tab-content" id="productDetailsTab">
								<?php
								$i = 0;
								if (!empty($pro_image)) {
									foreach ($pro_image as $row) {
								?>
										<div class="tab-pane fade <?= ($i == 0) ? 'active show' : '' ?>  " id="pro-<?= $i ?>" role="tabpanel" aria-labelledby="pro-1-tab">
											<img class="active" src="<?= base_url(trim($row['image_file'])) ?>" onerror="this.onerror=null; this.src='<?= base_url() ?>assets/images/aelo-vera.jpg'" alt="img not found">
										</div>
									<?php
										$i++;
									}
								} else {
									?>
									<div class="tab-pane fade <?= ($i == 0) ? 'active show' : '' ?>" id="pro-<?= $i ?>" role="tabpanel" aria-labelledby="pro-1-tab">
										<img class="active" src="<?= base_url() ?>assets/images/aelo-vera.jpg" onerror="this.onerror=null; this.src='<?= base_url() ?>assets/images/aelo-vera.jpg'" alt="img not found">
									</div>
								<?php
								}
								?>
							</div>
						</div>
						<div class="product-d-img-nav">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<?php
								$i = 0;
								if (!empty($pro_image)) {
									foreach ($pro_image as $row) {
								?>
										<li class="nav-item" role="presentation">
											<button class="nav-link <?= ($i == 0) ? 'active' : '' ?>" id="pro-<?= $i ?>-tab" data-bs-toggle="tab" data-bs-target="#pro-<?= $i ?>" type="button" role="tab" aria-controls="pro-<?= $i ?>" aria-selected="false">
												<img src="<?= base_url(trim($row['image_file'])) ?>" onerror="this.onerror=null; this.src='<?= base_url() ?>assets/images/aelo-vera.jpg'" alt="img not found <?= $row['image_file'] ?>">
											</button>
										</li>
									<?php
										$i++;
									}
								} else {
									?>
									<li class="nav-item" role="presentation">
										<button class="nav-link <?= ($i == 0) ? 'active' : '' ?>" id="pro-<?= $i ?>-tab" data-bs-toggle="tab" data-bs-target="#pro-<?= $i ?>" type="button" role="tab" aria-controls="pro-<?= $i ?>" aria-selected="false">
											<img src="<?= base_url() ?>assets/images/aelo-vera.jpg" onerror="this.onerror=null; this.src='<?= base_url() ?>assets/images/aelo-vera.jpg'" alt="img not found">
										</button>
									</li>
								<?php
								}
								?>

							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="product-side-info mb-60">
						<div class="product-category-review">

							<?php
							$r = [];
							$similar_cat_id = [];

							if (!empty($pro_category)) {
								echo '<div class="product-d-category">';
								foreach ($pro_category as $category_row) {
									$r[] = $category_row['name'];
									$similar_cat_id[] = $category_row['category_id'];
								}
								echo implode('</div>  <div class="product-d-category"> ', $r);
								echo '</div>';
							}
							?>

							<div class="product-d-review">
								<!--<div class="rating">-->
								<!--  <a href="#"><i class="fas fa-star"></i></a>-->
								<!--  <a href="#"><i class="fas fa-star"></i></a>-->
								<!--  <a href="#"><i class="fas fa-star"></i></a>-->
								<!--  <a href="#"><i class="fas fa-star"></i></a>-->
								<!--  <a href="#"><i class="far fa-star"></i></a>-->
								<!--</div>-->
								<!--<span>10 Reviews</span>-->
							</div>
						</div>
						<br>
						<h4 class="product-name"><?= $product_desc['name'] ?></h4>
						<div class="product-price">
							<span class="price-now">₹ <?= $product_desc['price'] ?></span>
							<!-- <span class="price-old">₹ <?= $product_desc['discounted_price'] ?></span> -->
						</div>
						<span>
							<?= str_replace('\n', '', $product_desc['sdesc']) ?>
						</span>
						<div class="product-quantity-cart mb-30 mt-3">
							<div class="product-quantity-form">
								<form action="#">
									<button class="cart-minus">
										<i class="far fa-minus"></i>
									</button>
									<input class="cart-input qty" type="text" value="1">
									<button class="cart-plus">
										<i class="far fa-plus"></i>
									</button>
								</form>
							</div>
							<span class="fill-btn addCart" target="_blank" data-id="<?= $product_desc['id'] ?>"><i class="fa fa-fa fa-shopping-cart" aria-hidden="true"></i>Add to cart</span>
						</div>
						<div class="product-d-meta share mb-10">
							<span>Share:</span>
							<div class="social-links">
								<ul>
									<li>
										<a href="https://www.facebook.com/sharer/sharer.php?u=<?= current_url() ?>&t=<?= $title ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><i class="fab fa-facebook fs-3 text-success"></i></a>
									</li>
									<li>
										<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= current_url() ?>&t=<?= $title ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Linkedin"><i class="fab fa-linkedin fs-3 text-success"></i></a>

									</li>
									<li>
										<a href="whatsapp://send?text=<?= current_url() ?>" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on whatsapp"><i class="fab fa-whatsapp fs-3 text-success"></i></a>

									</li>

								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="product_info-faq-area pb-0 pt-20 wow fadeInUp" data-wow-delay=".3s">
				<div class="product-details-tab-wrapper">
					<nav class="product-details-nav mb-30">
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active" id="pro-info-1-tab" data-bs-toggle="tab" href="#pro-info-1" role="tab" aria-selected="true">Description</a>
							<!-- <a class="nav-item nav-link" id="pro-info-2-tab" data-bs-toggle="tab" href="#pro-info-2" role="tab" aria-selected="false">Additional Information</a>
							<a class="nav-item nav-link" id="pro-info-3-tab" data-bs-toggle="tab" href="#pro-info-3" role="tab" aria-selected="false">Reviews (3)</a> -->
						</div>
					</nav>
					<div class="product-details-content mb-30">
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade active show" id="pro-info-1" role="tabpanel">
								<div class="tabs-wrapper mt-0">
									<div class="product__details-des">
										<?= str_replace('\n', '<br/>', $product_desc['description']) ?>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="pro-info-2" role="tabpanel">
								<div class="tabs-wrapper mt-0">
									<div class="product__details-info">
										<ul>
											<li>
												<h6>Weight</h6>
												<span>2 lbs</span>
											</li>
											<li>
												<h6>Dimensions</h6>
												<span>12 × 16 × 19 in</span>
											</li>
											<li>
												<h6>Product</h6>
												<span>Purchase this product on rag-bone.com</span>
											</li>
											<li>
												<h6>Color</h6>
												<span>Gray, Black</span>
											</li>
											<li>
												<h6>Size</h6>
												<span>S, M, L, XL</span>
											</li>
											<li>
												<h6>Model</h6>
												<span>Model </span>
											</li>
											<li>
												<h6>Shipping</h6>
												<span>Standard shipping: $5,95</span>
											</li>
											<li>
												<h6>Care Info</h6>
												<span>Machine Wash up to 40ºC/86ºF Gentle Cycle</span>
											</li>
											<li>
												<h6>Brand</h6>
												<span>Kazen</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="pro-info-3" role="tabpanel">
								<div class="tabs-wrapper mt-0">
									<div class="course-review-item mb-30">
										<div class="course-reviews-img">
											<a href="#"><img src="assets/img/testimonial/course-reviews-1.png" alt="image not found"></a>
										</div>
										<div class="course-review-list">
											<h5><a href="#">Sotapdi Kunda</a></h5>
											<div class="course-start-icon">
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<span>55 min ago</span>
											</div>
											<p>
												Very clean and organized with easy to follow
												tutorials, Exercises, and solutions. This course
												does start from the beginning with very little
												knowledge and gives a great overview of common tools
												used for data science and progresses into more
												complex concepts and ideas.
											</p>
										</div>
									</div>
									<div class="course-review-item mb-30">
										<div class="course-reviews-img">
											<a href="#"><img src="assets/img/testimonial/course-reviews-2.png" alt="image not found"></a>
										</div>
										<div class="course-review-list">
											<h5><a href="#">Samantha</a></h5>
											<div class="course-start-icon">
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<span>45 min ago</span>
											</div>
											<p>
												The course is good at explaining very basic
												intuition of the concepts. It will get you
												scratching the surface so to say. where this course
												is unique is the implementation methods are so well
												defined Thank you to the team !.
											</p>
										</div>
									</div>
									<div class="course-review-item mb-30">
										<div class="course-reviews-img">
											<a href="#"><img src="assets/img/testimonial/course-reviews-3.png" alt="image not found"></a>
										</div>
										<div class="course-review-list">
											<h5><a href="#">Michell Mariya</a></h5>
											<div class="course-start-icon">
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<span>30 min ago</span>
											</div>
											<p>
												This course is amazing..! I started this course as a
												beginner and learnt a lot. Instructors are great.
												Query handling can be improved.Overall very happy
												with the course.
											</p>
										</div>
									</div>
									<div class="product__details-comment">
										<div class="comment-title mb-20">
											<h3>Add a review</h3>
											<p>
												Your email address will not be published. Required
												fields are marked *
											</p>
										</div>
										<div class="comment-rating mb-20">
											<span>Overall ratings</span>
											<ul>
												<li>
													<a href="#"><i class="fas fa-star"></i></a>
												</li>
												<li>
													<a href="#"><i class="fas fa-star"></i></a>
												</li>
												<li>
													<a href="#"><i class="fas fa-star"></i></a>
												</li>
												<li>
													<a href="#"><i class="fas fa-star"></i></a>
												</li>
												<li>
													<a href="#"><i class="fal fa-star"></i></a>
												</li>
											</ul>
										</div>
										<div class="comment-input-box mb-0">
											<form action="#">
												<div class="row">
													<div class="col-xxl-12">
														<textarea placeholder="Your review" class="comment-input comment-textarea mb-20"></textarea>
													</div>
													<div class="col-xxl-6">
														<div class="comment-input mb-20">
															<input type="text" placeholder="Your Name">
														</div>
													</div>
													<div class="col-xxl-6">
														<div class="comment-input mb-20">
															<input type="email" placeholder="Your Email">
														</div>
													</div>
													<div class="col-xxl-12">
														<div class="comment-submit">
															<button type="submit" class="fill-btn">
																Submit
															</button>
														</div>
													</div>
												</div>
											</form>
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
	<!-- section end  -->
	<section class="product-area ptn-25" style="background: var(--clr-theme-3);">
		<div class="container">
			<div class="row align-items-center wow fadeInUp" data-wow-delay=".3s">
				<div class="col-lg-5 col-md-5">
					<div class="section-title style-3">
						<h2 class="section-main-title mb-45">Relative Products</h2>
					</div>
				</div>
				<div class="col-lg-7 col-md-7">
				</div>
			</div>
			<div class="procuct-wrapper product-slide-wrapper mb-0 slider-drag wow fadeInUp" data-wow-delay=".3s">
				<div class="swiper-container product-active">
					<?php

					if (!empty($similar_cat_id)) {
					?>
						<div class="swiper-wrapper">
							<?php
							foreach ($similar_cat_id as $cat_id) {
								$related_product = getRowById('product', 'id', $cat_id);

								if (!empty($related_product)) {
									foreach ($related_product as $product) {
										product($product, 3, true);
									}
								}
							}
							?>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</section>
	<!-- footer  -->
	<?php $this->load->view('include/footer') ?>
	<?php $this->load->view('include/footerlink') ?>
</body>

</html>
