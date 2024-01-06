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
								<a href="<?= base_url() ?>"><span>home</span></a>
							</li>
							<li class="trail-item trail-end"><span>Search</span></li>
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
						<!--<div class="sidebar-widget sidebar-search mb-50">-->
						<!--	<h4 class="sidebar-widget-title">Search Product</h4>-->
						<!--	<div class="sidebar-search-form">-->
						<!--		<input type="text" placeholder="Search your keyword..." />-->
						<!--		<button><i class="fal fa-search"></i></button>-->
						<!--	</div>-->
						<!--</div>-->
						<div class="sidebar-widget sidebar-category mb-50">
							<h4 class="sidebar-widget-title">Categories</h4>
							<div class="sidebar-category-list">
								<?php
								if (!empty($category)) {
									foreach ($category as $cat_name) {
								?>
										<div class="form-check product" style="margin-bottom: 0rem !important;">
											<input class="form-check-input common_selector category" type="checkbox" value="<?= $cat_name['id']; ?>" id="flexCheckDefault" <?= ($category_id == $cat_name['meta_url']) ? 'Checked' : '' ?>>
											<label class="form-check-label text-capitalize" for="flexCheckDefault">
												<?= $cat_name['name']; ?>
											</label>
										</div>
								<?php
									}
								}
								?>
							</div>
						</div>
						<div class="sidebar-widget sidebar-tags mb-50">
							<h4 class="sidebar-widget-title">Plants By Type</h4>
							<div class="sidebar-category-list" >
								<?php
								if (!empty($sub_category)) {
									foreach ($sub_category as $sub_info) {
								?>
										<div class="form-check" style="margin-bottom: 0rem !important;">
											<input class="form-check-input common_selector sub_category" type="checkbox" value="<?= $sub_info['id']; ?>" id="flexCheckDefault" <?= ($sub_category_id == $sub_info['meta_url']) ? 'Checked' : '' ?>>
											<label class="form-check-label text-capitalize" for="flexCheckDefault">
												<?= $sub_info['name']; ?>
											</label>
										</div>
								<?php
									}
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<!-- products  -->
				<div class="col-xl-9 col-lg-8 col-md-12">
					<div class="foundation-area style-2 pt-0 pb-60">
						<div class="filter-tab-content wow fadeInUp" data-wow-delay=".3s">
							<!-- <div class="tab-content" id="nav-tabContent">
								<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0"> -->
							<div class="swipper-wrapper product row" id="filter_data">
							</div>
							<div class="row text-center  justify-content-center">
								<div class="col-3">
									<button id="loadMoreBtn" class="btn btn-success">View more plants</button>
								</div>
							</div>
							<!-- </div>
							</div> -->
						</div>
					</div>
				</div>
				<input type="hidden" name="limit" id="limit" value="70" />
				<input type="hidden" name="offset" id="offset" value="0" />
	</section>
	<!-- footer  -->
	<?php $this->load->view('include/footer') ?>
	<?php $this->load->view('include/footerlink') ?>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		filter_data();

		function filter_data() {
			// $('#filter_data').html('<div id="loading" style="" ></div>');
			var action = 'fetch_data';
			var category = get_filter('category');
			var subcategory = get_filter('sub_category');
			$.ajax({
				url: "<?= base_url('Home/getSearchProducts') ?>",
				method: "POST",
				data: {
					category: category,
					subcategory: subcategory,
					offset: $('#offset').val(),
					limit: $('#limit').val()
				},
				dataType: 'json',
				beforeSend: function() {
					// var skeliton = `<div class="ph-item">
					//     <div class="ph-col-12">
					//         <div class="ph-picture"></div>
					//         <div class="ph-row">
					//             <div class="ph-col-4"></div>
					//             <div class="ph-col-8 empty"></div>
					//             <div class="ph-col-12"></div>
					//         </div>
					//     </div>
					//     <div>
					//         <div class="ph-row">
					//             <div class="ph-col-12"></div>
					//             <div class="ph-col-2"></div>
					//             <div class="ph-col-10 empty"></div>
					//             <div class="ph-col-8 big"></div>
					//             <div class="ph-col-4 big empty"></div>
					//         </div>
					//     </div>
					// </div>`;
					// var skelitons = skeliton.repeat(6);
					// $("#filter_data").html(skelitons);
				},
				success: function(data) {
					$('#filter_data').append(data.result)
					$('#offset').val(data.offset)
					if (data.result == '') {
						$('#loadMoreBtn').hide();
					}
				}
			});
		}

		function get_filter(class_name) {
			var filter = [];
			$('.' + class_name + ':checked').each(function() {
				filter.push($(this).val());
			});
			return filter;
		}
		$('.common_selector').click(function() {
			console.log('23');
			filter_data();
		});
		$('#loadMoreBtn').click(function() {
			filter_data();
		});
	});
</script>
