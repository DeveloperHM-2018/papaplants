<?php include('template/header_link.php'); ?>
<div class="holder">
	<?php include('template/header.php'); ?>
	<?php $this->load->view('admin/template/sidebar'); ?>

	<main>
		<div class="container-fluid site-width">
			<section class="page-content container-fluid">
				<div class="row">
					<div class="col-sm-10  align-self-center">
						<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
							<div class="w-sm-100 mr-auto">
								<h4 class="mb-0"><?= $title ?></h4>
							</div>
						</div>
					</div>
					<div class="col-sm-2  align-self-center">
						<a href="<?= base_url('admin_Dashboard/products') ?>" class="btn btn-primary align-left">Products List</a>
					</div>
				</div>
			</section>
			<section class="page-content container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<form action="" method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-12 col-lg-12 col-xl-12">
											<div class="row">
												<div class="form-group col-md-4">
													<label class="">Product Name</label>
													<input class="form-control" required="" type="text" name="name" value="<?= (($tag == 'edit') ? $product['name'] : '') ?>">
												</div>
												<div class="form-group col-md-4">
													<label class="">Price (in $)</label>
													<input class="form-control" placeholder="Ex. 2300" type="text" name="price" pattern="[0-9]+" value="<?= (($tag == 'edit') ? $product['price'] : '') ?>">
												</div>
												<div class="form-group col-md-4">
													<label class="">Discounted Price (in $)</label>
													<input class="form-control" placeholder="Ex. 2300" type="text" name="discounted_price" pattern="[0-9]+" value="<?= (($tag == 'edit') ? $product['discounted_price'] : '') ?>">
												</div>
												<div class="form-group col-md-4">
													<label class="">Discount % </label>
													<input class="form-control" placeholder="Ex. 10" type="text" name="discount_per" pattern="[0-9]+" value="<?= (($tag == 'edit') ? $product['discount_per'] : '') ?>">
												</div>
												<div class="form-group col-md-12">
													<label class="">Product Category</label>
													<br>
													<?php
													if($tag == 'edit'){

													}
													$i = 0;
													if ($category != '') {
														foreach ($category as $row) {
															$i = $i + 1;
															$subcategory = getRowById('pp_category', 'parent_id', $row['id']);
													?>
															<input type="checkbox" class="common_selector category" id="cate<?= $row['id'] ?>" name="cate[]" value="<?= $row['id'] ?>" <?= (($tag == 'edit') ? ((in_array($row['id'], $catlist)) ? 'checked' : '') : '') ?>>
															<label for="cate<?= $i ?>"> <?= $row['name'] ?> </label><br>
															<?php
															if ($subcategory != '') {
																foreach ($subcategory as $subrow) {
															?>
																	<div class="ml-4">
																		<input type="checkbox" class="common_selector category" id="cate<?= $subrow['id'] ?>" name="cate[]" value="<?= $subrow['id'] ?>" <?= (($tag == 'edit') ? ((in_array($subrow['id'], $catlist)) ? 'checked' : '') : '') ?>>
																		<label for="cate<?= $i ?>"> <?= $subrow['name'] ?> </label><br>
																	</div>
															<?php
																}
															}
															?>
													<?php
														}
													}
													?>
												</div>
												<div class="form-group col-md-12">
													<label class="">Product Short Description</label>
													<textarea cols="30" class="form-control" name="sdesc" rows="2"><?= (($tag == 'edit') ? $product['sdesc'] : '') ?></textarea>
												</div>
												<div class="form-group col-md-12">
													<label class="">Product Description</label>
													<textarea cols="60" class="form-control" id="editor" name="description" rows="5"><?= (($tag == 'edit') ? $product['description'] : '') ?></textarea>
												</div>
												<div class="form-group col-md-12">
													<div class="fieldGroup row">
														<div class="col-md-4">
															<div class="form-group">
																<label>Title</label>
																<input type="text" class="form-control" name="specs_title[]" placeholder="Title">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Description</label>
																<textarea class="form-control editor" name="specs_desc[]" placeholder="Description "></textarea>
															</div>
														</div>
														<div class="col-md-1">
															<label> ADD</label>
															<a href="javascript:void(0)" class="form-control btn btn-success addMore">Add </span> </a>
														</div>
													</div>
													<div class="fieldGroupCopy row" style="display: none;">
														<div class="col-md-4">
															<div class="form-group">
																<label>Title</label>
																<input type="text" class="form-control" name="specs_title[]" placeholder="Title">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Description</label>
																<textarea class="form-control editor" name="specs_desc[]" placeholder="Description "></textarea>
															</div>
														</div>
														<div class="col-md-1">
															</br>
															<a href="javascript:void(0)" class="form-control btn btn-danger remove">Remove</a>
														</div>
													</div>
												</div>
												<div class="form-group col-md-12">
													<label class="">Section 1</label>
												</div>
												<div class="form-group col-md-4">
													<label class="">Title</label>
													<input class="form-control" value="<?= (($tag == 'edit') ? $product['title_one'] : '') ?>" type="text" name="title_one">
												</div>
												<div class="form-group col-md-4">
													<label class="">Description</label>
													<input class="form-control" value="<?= (($tag == 'edit') ? $product['description_one'] : '') ?>" type="text" name="description_one">
												</div>
												<div class="form-group col-md-4">
													<label class="">Image</label>
													<div class="pos-relative">
														<input class="form-control pd-r-80" type="file" name="img_one" accept="image/png, image/gif, image/jpeg">
														<?php if ($tag == 'edit') { ?>
															<input type="hidden" name="image_url_one" value="<?= $product['image_url_one'] ?>">
															<img src="<?= base_url() ?>uploads/product/<?= $product['image_url_one'] ?>" height="50px">
														<?php    }  ?>
													</div>
												</div>
												<div class="form-group col-md-12">
													<label class="">Section 2</label>
												</div>
												<div class="form-group col-md-4">
													<label class="">Title</label>
													<input class="form-control" value="<?= (($tag == 'edit') ? $product['title_two'] : '') ?>" type="text" name="title_two">
												</div>
												<div class="form-group col-md-4">
													<label class="">Description</label>
													<input class="form-control" value="<?= (($tag == 'edit') ? $product['description_two'] : '') ?>" type="text" name="description_two">
												</div>
												<div class="form-group col-md-4">
													<label class="">Image</label>
													<div class="pos-relative">
														<input class="form-control pd-r-80" type="file" name="img_two" accept="image/png, image/gif, image/jpeg">
														<?php if ($tag == 'edit') { ?>
															<input type="hidden" name="image_url_two" value="<?= $product['image_url_two'] ?>">
															<img src="<?= base_url() ?>uploads/product/<?= $product['image_url_two'] ?>" height="50px">
														<?php    }  ?>
													</div>
												</div>
												<div class="form-group col-md-12">
													<button type="submit" class="btn  btn-primary ">Submit</button>
												</div>
											</div>
										</div>
									</div>
								</form>
								<?php
								$i = 1;
								if ($tag == 'edit') {
								?>
									<h4>Description Specification</h4>
									<div class="table-responsive">
										<table id="datatable" class="table table-striped table-bordered" style="width: 100%">
											<thead>
												<tr>
													<th>S No</th>
													<th>Title</th>
													<th>Description</th>
													<th>Actions</th>
												</tr>
											</thead>
											<?php
											$i = 1;
											if (!empty($specs)) {
												foreach ($specs as $row) {
											?>
													<tbody>
														<tr>
															<td><?php echo $i; ?></td>
															<td><?php echo $row['specs_title']; ?></td>
															<td><?php echo $row['specs_desc']; ?></td>
															<td>
																<a href="<?php echo base_url() . 'admin_Dashboard/edit_products?BdID=' . encryptId($row['specs_id']) . '&pro_i=' . $row['product_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')"><i class="fas fa-trash-alt"></i></a>
																<a href="<?php echo base_url() . 'admin_Dashboard/edit_products_specs/' . $row['specs_id'] ?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
															</td>
														</tr>
													</tbody>
											<?php
													$i++;
												}
											} else {
												// echo  'No contact query exists';
											}
											?>
										</table>
									</div>
								<?php
									$i++;
								}
								?>
							</div>
						</div>
					</div>
			</section>
		</div>
		</section>
		<?php include('template/footer.php') ?>
		<?php include('template/footer_link.php'); ?>
		</body>

		</html>
		<script>
			filter_data();

			function filter_data() {
				$('#Subcate').html('<div id="loading" style="" ></div>');
				var pid = $(this).val();
				var action = 'fetch_data';
				var category = $('#cate' + pid).val();
				console.log(pid);
				$.ajax({
					url: "<?= base_url('admin_Dashboard/filterData') ?>",
					method: "POST",
					data: {
						category: category
					},
					success: function(data) {
						console.log(data);
						$('#Subcate' + pid).html(data);
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
				filter_data();
			});
		</script>
		<script type="application/javascript">
			$(document).ready(function() {
				//group add limit
				var maxGroup = 200;
				//add more fields group
				$(".addMore").click(function() {
					if ($('body').find('.fieldGroup').length < maxGroup) {
						var fieldHTML = '<div class="fieldGroup row">' + $(".fieldGroupCopy").html() + '</div>';
						$('body').find('.fieldGroup:last').after(fieldHTML);
					} else {
						alert('Maximum ' + maxGroup + ' groups are allowed.');
					}
				});
				$("body").on("click",
					".remove",
					function() {
						$(this).parents(".fieldGroup").remove();
					});
			});
		</script>
