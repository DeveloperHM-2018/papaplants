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
						<a href="<?= base_url('admin_Dashboard/add_product') ?>" class="btn btn-primary align-left">Add Product</a>
					</div>
				</div>
			</section>
			<section class="page-content container-fluid">
				<div class="row">
					<div class="col-lg-12 col-xl-12">
						<div class="card">
							<div class="card-body">
								<?php if ($msg = sessionId('msg')) :
									$msg_class = sessionId('msg_class') ?>
									<div class="row">
										<div class="col-lg-12">
											<div class="alert  <?= $msg_class; ?>"><?= $msg; ?></div>
										</div>
									</div>
								<?php
									$this->session->unset_userdata('msg');
								endif; ?>
								<div class="table-responsive">
									<table id="datatable" class="table table-striped table-bordered" style="width: 100%">
										<thead>
											<tr>
												<th>S No</th>
												<th>Product Name</th>
												<th>price</th>
												<!-- <th>Description</th> -->
												<th>Product Image</th>
												<th>Best Seller</th>
												<th>Featured</th>
												<th>Disable</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$i = 1;
											if ($products) {
											foreach ($products as $fetchrow) {
												$imgcount = getNumRows('product_images', array('product_id' => $fetchrow['id']));
												$varcount = getNumRows('product_variants', array('product_id' => $fetchrow['id']));
											?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo wordwrap($fetchrow['name'], 30, '<br>'); ?></td>
													<?php
													if (!empty($fetchrow['discount_per'])) {
													?>
														<td>₹ <?php echo $fetchrow['discount_per']; ?><br> <strike>₹ <?php echo $fetchrow['price']; ?></strike> </td>
													<?php
													} else {
													?>
														<td>₹ <?php echo $fetchrow['price']; ?> </td>
													<?php
													}
													?>
													<!-- <td><?php echo wordwrap($fetchrow['description'], 30, '<br>'); ?></td> -->
													<td>
														<a href="<?php echo base_url() . 'admin_Dashboard/edit_productsimg/' . $fetchrow['id']; ?>" class="btn btn-info edit"><i class="fa fa-file-image"></i> (<?= $imgcount ?> images)</a>
													</td>
													<td>
														<a href="<?php echo base_url() . 'admin_Dashboard/bestseller/' . $fetchrow['id'] . '/product/' . (($fetchrow['is_bestseller'] == '1') ? '0' : '1'); ?>" class="btn btn-light"><?php if ($fetchrow['is_bestseller'] == '1') { ?><span class="badge badge-success">Yes</span><?php } else { ?> <span class="badge badge-warning">No</span><?php } ?></a>
													</td>
													<td>
														<a href="<?php echo base_url() . 'admin_Dashboard/featured/' . $fetchrow['id'] . '/product/' . (($fetchrow['is_featured'] == '1') ? '0' : '1'); ?>" class="btn btn-light"><?php if ($fetchrow['is_featured'] == '1') { ?><span class="badge badge-success">Yes</span><?php } else { ?> <span class="badge badge-warning">No</span><?php } ?></a>
													</td>
													<td>
														<a href="<?php echo base_url() . 'admin_Dashboard/disable/' . $fetchrow['id'] . '/product/' . (($fetchrow['is_visible'] == '1') ? '0' : '1'); ?>" class="btn btn-light"><?php if ($fetchrow['is_visible'] == '1') { ?><i class="fas fa-eye"></i><?php } else { ?> <i class="fas fa-eye-slash"></i><?php } ?></a>
													</td>
													<td>
														<a href="<?php echo base_url() . 'admin_Dashboard/edit_products/' . $fetchrow['id']; ?>" class="btn btn-success edit"><i class="fas fa-pencil-alt"></i></a>
														<a href="<?php echo base_url() . 'admin_Dashboard/deleteproducts/' . $fetchrow['id']; ?>" class="btn btn-danger" onclick="return confirm('Continue to delete ?')"><i class="fas fa-trash-alt"></i></a>
													</td>
												</tr>
											<?php
												$i++;
											}
										}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
		</section>
</div>
<?php include('template/footer.php') ?>
<?php include('template/footer_link.php'); ?>
</body>

</html>
