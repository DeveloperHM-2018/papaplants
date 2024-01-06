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
					<div class="col-sm-2  align-self-center text-right">
						<a href="<?= base_url('admin_Dashboard/product_category') ?>" class="btn btn-primary align-left">Category List</a>
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
												<div class="form-group col-md-6">
													<label class="">Category Name</label>
													<input class="form-control" value="<?= (($tag == 'edit') ? $category['0']['name'] : '') ?>" type="text" name="name">
												</div>
												<div class="form-group col-md-4">
													<label class="">Category Image</label>
													<div class="pos-relative">
														<input class="form-control pd-r-80" type="file" name="img" accept="image/png, image/gif, image/jpeg">
														<?php if ($tag == 'edit') { ?>
															<input type="hidden" name="image_url" value="<?= $category['0']['image_url'] ?>">
															<img src="<?= base_url() ?>uploads/category/<?= $category['0']['image_url'] ?>" height="50px">
														<?php    }  ?>
													</div>
												</div>
												<?php
												if(@$category['0']['parent_id'] == 0){}else{
													?>
												<div class="col-sm-4">
													<div class="pos-relative">
														<select class="form-control pd-r-80" aria-label="Default select example" name="parent_id">
															<option selected>Category</option>
															<?php
															$category = getRowById('category', 'parent_id', '0');
															if (!empty($category)) {
																foreach ($category as $cat_nme) {
															?>
																	<option value="<?= $cat_nme['id']; ?>"><?= $cat_nme['name']; ?></option>
															<?php }
															} ?>
														</select>
													</div>
												</div>
												<?php } ?>
												<div class="form-group col-md-12">
													<label class="">Description</label>
													<div class="pos-relative">
														<textarea class="form-control" id="editor" name="description"><?= (($tag == 'edit') ? $category['0']['description'] : '') ?> </textarea>
													</div>
												</div>
												<div class="form-group col-md-12">
												     <label class="">Section 1</label>
												 </div>
												 <div class="form-group col-md-4">
												     <label class="">Title</label>
												     <input class="form-control" value="<?= (($tag == 'edit') ? $category['0']['title_one'] : '') ?>" type="text" name="title_one">
												 </div>
												 <div class="form-group col-md-4">
												     <label class="">Description</label>
												     <input class="form-control" value="<?= (($tag == 'edit') ? $category['0']['description_one'] : '') ?>" type="text" name="description_one">
												 </div>
												 <div class="form-group col-md-4">
												     <label class="">Image</label>
												     <div class="pos-relative">
												         <input class="form-control pd-r-80" type="file" name="img_one" accept="image/png, image/gif, image/jpeg">
												         <?php if ($tag == 'edit') { ?>
												             <input type="hidden" name="image_url_one" value="<?= $category['0']['image_url_one'] ?>">
												             <img src="<?= base_url() ?>uploads/category/<?= $category['0']['image_url_one'] ?>" height="50px">
												         <?php    }  ?>
												     </div>
												 </div>
												 <div class="form-group col-md-12">
												     <label class="">Section 2</label>
												 </div>
												 <div class="form-group col-md-4">
												     <label class="">Title</label>
												     <input class="form-control" value="<?= (($tag == 'edit') ? $category['0']['title_two'] : '') ?>" type="text" name="title_two">
												 </div>
												 <div class="form-group col-md-4">
												     <label class="">Description</label>
												     <input class="form-control" value="<?= (($tag == 'edit') ? $category['0']['description_two'] : '') ?>" type="text" name="description_two">
												 </div>
												 <div class="form-group col-md-4">
												     <label class="">Image</label>
												     <div class="pos-relative">
												         <input class="form-control pd-r-80" type="file" name="img_two" accept="image/png, image/gif, image/jpeg">
												         <?php if ($tag == 'edit') { ?>
												             <input type="hidden" name="image_url_two" value="<?= $category['0']['image_url_two'] ?>">
												             <img src="<?= base_url() ?>uploads/category/<?= $category['0']['image_url_two'] ?>" height="50px">
												         <?php    }  ?>
												     </div>
												 </div>
												<button type="submit" class="btn btn-primary">Submit</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
</div>
<?php $this->load->view('admin/template/footer_link'); ?>
</body>

</html>
