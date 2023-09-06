<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function category($cat, $col)
{
	// print_r($cat);
	if ($cat['is_visible'] == 1) {
?>
		<div class="col-md-<?= $col ?>  ">
			<div class="single-category single-category--type-one text-center">
				<div class="single-category--type-one__image">
					<a href="<?= base_url('collection/' . $cat['id'] . '/' . url_title($cat['name'], "dash", TRUE)) ?>"><img src="<?= setImage($cat['image_url'], 'uploads/category/') ?>" class="img-fluid" alt="" style="height:350px;"></a>
					<!-- <span class="floter">UP TO $600 OFF</span> -->
				</div>
				<div class="single-category--type-one__content d-flex align-items-center justify-content-between">
					<h2 class="title mb-0 dark_color">Shop <?= $cat['name'] ?></h2>
					<!-- <a href="" class="warranty_label"> <img src="<?= base_url() ?>assets/images/dark-shield.png" alt=""> 10-Year Warranty </a> -->
				</div>
			</div>
		</div>
		<?php
	}
}
function product($product_info, $col = 3, $slider = false)
{
	// print_r($product_info);
	if ($product_info != '') {
		if ($product_info['is_visible'] == 1) {
			$img = getRowByMoreId('pp_product_images', array('product_id' => $product_info['id']));
		?>
			<div class="col-md-<?= $col ?> ">
				<div class="product-single shadow <?= ($slider == true) ? 'm-4' : '' ?>">
					<div class="product-thumb home">
						<a href="<?= base_url() ?><?= $product_info['meta_url'] ?>">
							<img src="<?= base_url() ?><?= ($img != '') ? $img[0]['image_file'] : '' ?>" onerror="this.onerror=null; this.src='<?= base_url() ?>assets/images/aelo-vera.jpg'" alt="img not found"></a>
						<div class="product-item-action">
							<!-- <a href="cart.html"><i class="fal fa-shopping-cart"></i></a> -->
							<!-- <a href="<?= base_url() ?><?= $product_info['meta_url'] ?>"><i class="fal fa-eye"></i></a> -->
						</div>
					</div>
					<div class="product-description bg-white p-3">
						<h4 class="product-name">
							<a href="<?= base_url() ?><?= $product_info['meta_url'] ?>"><?= $product_info['name'] ?></a>
						</h4>
						<div class="product-price">

							<span class="price-now">₹<?= $product_info['price'] ?></span>
							<!-- <span class="price-old  mt-1">₹<?= $product_info['discounted_price'] ?></span> -->
						</div>
						<!-- <div class="rating">
							<a href="#"><i class="fas fa-star"></i></a>
							<a href="#"><i class="fas fa-star"></i></a>
							<a href="#"><i class="fas fa-star"></i></a>
							<a href="#"><i class="fas fa-star"></i></a>
							<a href="#"><i class="far fa-star"></i></a>
						</div> -->
					</div>
				</div>
			</div>
		<?php
		}
	}
}
function product_slide($product_info, $col = 3, $slider = false)
{
	// print_r($product_info);
	if ($product_info != '') {
		if ($product_info['is_visible'] == 1) {
			$img = getRowByMoreId('pp_product_images', array('product_id' => $product_info['id']));
		?>
			<div class="swiper-slide">
				<div class="product-single">
					<div class="product-thumb">
						<a href="<?= base_url() ?><?= $product_info['meta_url'] ?>"><img src="<?= base_url() ?><?= $img[0]['image_file'] ?>" onerror="this.onerror=null; this.src='<?= base_url() ?>assets/images/aelo-vera.jpg'" alt="img not found"></a>
						<div class="product-item-action">
							<!-- <a href="cart.html"><i class="fal fa-shopping-cart"></i></a>
							<a href="assets/img/product/product-shop-1.html" data-bs-toggle="modal" data-bs-target="#productModalId"><i class="fal fa-eye"></i></a>
							<a href="wishlist.html"><i class="fal fa-heart"></i></a> -->
						</div>
					</div>
					<div class="product-description">
						<div class="rating">
							<!-- <a href="#"><i class="fas fa-star"></i></a>
							<a href="#"><i class="fas fa-star"></i></a>
							<a href="#"><i class="fas fa-star"></i></a>
							<a href="#"><i class="fas fa-star"></i></a>
							<a href="#"><i class="far fa-star"></i></a> -->
						</div>
						<h4 class="product-name">
							<a href="<?= base_url() ?><?= $product_info['meta_url'] ?>"><?= $product_info['name'] ?></a>
						</h4>
						<div class="product-price">
							<!-- <span class="price-old">₹<?= $product_info['discounted_price'] ?></span> -->
							<span class="price-now">₹<?= $product_info['price'] ?></span>
						</div>
					</div>
				</div>
			</div>

		<?php
		}
	}
}
function product_list($pro, $col)
{
	// print_r($pro);
	if ($pro['is_visible'] == 1) {
		$img = getRowByMoreId('pp_product_images', array('product_id' => $pro['id']));
		?>
		<div class="col-md-<?= $col ?> mb-4">
			<div class="single-grid-product">
				<div class="single-grid-product__image">
					<div class="product-badge-wrapper">
						<?php
						if ($pro['is_bestseller'] == '1') {
						?>
							<span class="onsale dark_color semi-bold">BEST SELLER</span>
						<?php
						} else {
						?>
						<?php
						}
						?>
						<?php
						if ($pro['is_featured'] == '1') {
						?>
							<span class=" onsale dark_color semi-bold bg-warning">FEATURED</span>
						<?php
						} else {
						?>
						<?php
						}
						?>
					</div>
					<?php
					if (!empty($pro['discount_per'])) {
					?>
						<div class="product-badge-wrapper">
							<span class="discount_badge onsale semi-bold bg-danger text-white"><?= $pro['discount_per'] ?>% off</span>
						</div>
					<?php
					} else {
					?>
					<?php
					}
					?>
					<a href="<?= base_url('product_details/' . $pro['id'] . '/' . url_title($pro['name'], "dash", TRUE)) ?>" class="image-wrap">
						<img src="<?= setImage($img[0]['image_file'], '/') ?>" class="img-fluid" alt="">
					</a>
				</div>
				<div class="single-grid-product__content row p-3">
					<h3 class="title dark_color col-md-7"><a href="<?= base_url('product_details/' . $pro['id'] . '/' . url_title($pro['name'], "dash", TRUE)) ?>" class="dark_color semi-bold"><?= $pro['name'] ?></a></h3>
					<a href="<?= base_url('product_details/' . $pro['id'] . '/' . url_title($pro['name'], "dash", TRUE)) ?>" class="favorite-icon dark_color semi-bold col-md-5 text-right">
						$ <?= (!empty($pro['discounted_price'])) ? $pro['discounted_price'] : $pro['price'] ?> <strike>
							<?php
							if (!empty($pro['discounted_price'])) {
							?>
								<span style="color: #4f5e8d;font-size: 12px;">$ <?= $pro['price'] ?></span>
							<?php
							}
							?>
						</strike>
						<!--<span class="text-success"><?= $pro['discount_per'] ?> %</span>-->
					</a>
					<p class="  pl-3 pr-3"><?= $pro['sdesc'] ?></p>
				</div>
			</div>
		</div>
	<?php
	}
}
function cartlist()
{
	$ci = &get_instance();
	foreach ($ci->cart->contents() as $items) {
		// if ($items['is_visible'] == 1) {
	?>
		<div class="sidebar-list-item">
			<div class="product-image pos-rel">
				<a href="#" class=""><img src="<?= setImage($items['image'], '/'); ?>" alt="img"></a>
			</div>
			<div class="product-desc">
				<div class="product-name">
					<a href="#"><?= $items['name']; ?></a>
				</div>
				<div class="product-pricing">
					<span class="item-number"> <?= $items['qty'] ?> ×</span>
					<span class="price-now"> &#8377; <?= $items['price'] ?></span>
				</div>
				<button class="remove-item remove_cartitem" data-id="<?= $items['rowid'] ?>">
					<i class="fal fa-times"></i>
				</button>
			</div>
		</div>
	<?php
		// }
	}
}
function cart_page()
{
	$ci = &get_instance();
	foreach ($ci->cart->contents() as $items) {
		// if ($items['is_visible'] == 1) {
	?>
		<tr>
			<td class="product-thumbnail">
				<a href="#"><img src="<?= setImage($items['image'], '/'); ?>" alt="img"></a>
			</td>
			<td class="product-name">
				<a href="#"><?= $items['name']; ?></a>
			</td>
			<td class="product-price">
				<span class="amount"> &#8377; <?= $items['price'] ?></span>
			</td>
			<td class="product-quantity text-center">
				<div class="product-quantity mt-10 mb-10">
					<div class="product-quantity-form">
						<form action="#">
							<button class="cart-minus addCart" data-id="<?= $items['id'] ?>">
								<i class="far fa-minus"></i>
							</button>
							<input class="cart-input" type="text" value="<?= $items['qty'] ?>">
							<button class="cart-plus addCart" data-id="<?= $items['id'] ?>">
								<i class="far fa-plus"></i>
							</button>
						</form>
					</div>
				</div>
			</td>
			<td class="product-subtotal">
				<span class="amount">&#8377; <?= $items['qty'] * $items['price'] ?></span>
			</td>
			<td class="product-remove">
				<a href="#" class="remove_cartitem" data-id="<?= $items['rowid'] ?>"><i class="fa fa-times"></i></a>
			</td>
		</tr>
	<?php
		// }
	}
}
function cart_checkout_list()
{

	$ci = &get_instance();
	foreach ($ci->cart->contents() as $items) {
		// if ($items['is_visible'] == 1) {
	?>
		<tr class="cart_item">
			<td class="product-name">
				<?= $items['name']; ?>
				<strong class="product-quantity"> × <?= $items['qty'] ?></strong>
			</td>
			<td class="product-total">
				<span class="amount"> &#8377; <?= $items['price'] ?></span>
			</td>
		</tr>
<?php
		// }
	}
}
