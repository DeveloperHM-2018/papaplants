<?php include('template/header_link.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
	ul {
		padding: 0px;
		margin: 0px;
	}
	#response {
		padding: 10px;
		background-color: #9F9;
		border: 2px solid #396;
		margin-bottom: 20px;
	}
	#list li {
		margin: 0 0 3px;
		padding: 8px;
		/* background-color: #00CCCC; */
		color: #fff;
		list-style: none;
		border: #CCCCCC solid 1px;
	}
</style>
<script type="text/javascript">
	$(document).ready(function() {
		function slideout() {
			setTimeout(function() {
				$("#response").slideUp("slow", function() {});
			}, 2000);
		}
		$("#response").hide();
		$(function() {
			$("#list ul").sortable({
				opacity: 0.8,
				cursor: 'move',
				update: function() {
					var order = $(this).sortable("serialize") + '&update=update';
					$.post("<?= base_url('Ajax/update_image') ?>", order, function(theResponse) {
						$("#response").html(theResponse);
						$("#response").slideDown('slow');
						slideout();
					});
				}
			});
		});
	});
</script>
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
								<h4 class="mb-0">
									<?= $title ?>
								</h4>
							</div>
						</div>
					</div>
					<div class="col-sm-2  align-self-center">
					</div>
				</div>
			</section>
			<section class="page-content container-fluid">
				<div class="row">
					<div class="col-md-12  ">
						<div class="card">
							<div class="card-body">
								<form action="" method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-6 col-lg-6 col-xl-6">
											<div class="">
												<div class="form-group">
													<label class=""> Upload Image </label>
													<div class="pos-relative">
														<input class="form-control pd-r-80" required="" type="file" name="img[]" accept="image/png, image/gif, image/jpeg" multiple>
													</div>
												</div>
												<button name="submit" class="btn  btn-light">Submit</button>
											</div>
										</div>
										<div class="col-md-6 col-lg-6 col-xl-6">
											<h5>Images reference -</h5>
											<ol>
												<?php
												if ($product != '') {
													$pimg = explode(',', $product[0]['images']);
													if ($pimg != '') {
														foreach ($pimg as $img) {
												?>
															<li><a href="<?php echo $img ?>" target="_blank"> <?php echo $img ?></a></li>
												<?php
														}
													}
												}
												?>
												<ol>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12   mb-3 ">
						<?php if ($msg = sessionId('msg')) :
							$msg_class = sessionId('msg_class') ?>
							<div class="row">
								<div class="col-lg-12">
									<div class="alert  <?= $msg_class; ?>">
										<?= $msg; ?>
									</div>
								</div>
							</div>
						<?php
							$this->session->unset_userdata('msg');
						endif; ?>
					</div>
					<div class="col-md-12   mb-3 ">
						<h4>Arrange images here by dragging </h4>
					</div>
					<div class="col-md-12   mb-3 ">
						<form action="<= base_url('Admin_Dashboard/primary_img') ?>" method="POST">
							<div class="col-lg-12 col-xl-12">
								<div class="card">
									<div class="card-body row col-md-12">
										<div id="list">
											<div id="response"></div>
											<ul>
												<?php
												if ($productimg != '') {
													foreach ($productimg as $img) {
												?>
														<li id="arrayorder_<?php echo $img['id'] ?>">
															<img src="<?= base_url() ?>uploads/product/<?php echo $img['image_file'] ?>" style="width: 200px;" class="shadow" />
															<div class="clear"></div>
															<a href="<?php echo base_url() . 'admin_Dashboard/deleteproductimg/' . $img['id']; ?>" class="btn btn-danger" onclick="return confirm('Continue to delete?')"><i class="fas fa-trash-alt"></i></a>
														</li>
												<?php
													}
												}
												?>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
		</div>
		</section>
</div>
<?php include('template/footer.php') ?>
<?php include('template/footer_link.php'); ?>
<script>
	$(document).ready(function() {
		$('input[type="radio"]').click(function() {
			if ($(this).attr('checked', false)) {
				$(this).attr("value", "0");
			}
			if ($(this).attr('checked', true)) {
				$(this).attr("value", "1");
			}
			var rid = $(this).attr('id');
			console.log(rid);
			var gender = $(this).val();
			$.ajax({
				url: "<?= base_url('Admin_Dashboard') ?>",
				method: "POST",
				data: {
					gender: gender
				},
				success: function(data) {
					$('#result').html(data);
				}
			});
		});
	});
</script>
</body>
</html>
