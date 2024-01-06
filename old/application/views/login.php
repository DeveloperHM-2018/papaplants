<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('include/headerlink.php') ?>
	<style>
		input[type=text],
		input[type=password] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			box-sizing: border-box;
		}

		button {
			background-color: #04AA6D;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			cursor: pointer;
			width: 100%;
		}

		button:hover {
			opacity: 0.8;
		}

		.cancelbtn {
			width: auto;
			padding: 10px 18px;
			background-color: #f44336;
		}

		.imgcontainer {
			text-align: center;
			margin: 24px 0 12px 0;
		}

		img.avatar {
			width: 40%;
			border-radius: 50%;
		}

		.container {
			padding: 16px;
		}

		span.psw {
			float: right;
			padding-top: 16px;
		}

		/* Change styles for span and cancel button on extra small screens */
		@media screen and (max-width: 300px) {
			span.psw {
				display: block;
				float: none;
			}

			.cancelbtn {
				width: 100%;
			}
		}
	</style>
</head>

<body>
	<!-- header  -->
	<?php include "include/header2.php" ?>
	<!-- header area end  -->
	<section class="page-title-area" data-background="<?= base_url() ?>assets/images/about-banner.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="page-title-wrapper">
						<h1 class="page-title mb-10">Login In</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="breadcrumb-wrapper">
			<div class="container">
				<div class="breadcrumb-menu">
					<nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
						<ul class="trail-items">
							<li class="trail-item trail-begin">
								<a href="#"><span>home</span></a>
							</li>
							<li class="trail-item trail-end"><span>contact us</span></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- banner area end  -->
	<div class="row">
		<div class="col-6">
		</div>
		<div class="col-6">
			<section class="login">
				<form action="/action_page.php" method="post">
					<div class="container">
						<label for="uname"><b>Username</b></label>
						<input type="text" placeholder="Enter Username" name="uname" required>
						<label for="psw"><b>Password</b></label>
						<input type="password" placeholder="Enter Password" name="psw" required>
						<button type="submit">Login</button>
						<label>
							<input type="checkbox" checked="checked" name="remember"> Remember me
						</label>
					</div>
					<div class="container" style="background-color:#f1f1f1">
						<button type="button" class="cancelbtn">Cancel</button>
						<span class="psw">Forgot <a href="#">password?</a></span>
					</div>
				</form>
			</section>
		</div>
	</div>
	<?php $this->load->view('include/footer') ?>
	<?php $this->load->view('include/footerlink') ?>
</body>

</html>
