$(document).on('click', '.addCart', function () {
	var pid = $(this).data('id');
	var qty = $('.qty').val();
	var base_url = $('#base').val();
	$.ajax({
		method: "POST",
		url: base_url + "Ajax/addToCart",
		data: {
			pid: pid,
			qty: qty
		},
		success: function () {
			load_cart();
			load_amount();
			$('.action-item-cart').click();
			// alert('Item added to cart');
		}
	});
});
$(document).on('click', '.remove_cartitem', function () {
	var pid = $(this).data('id');
	var base_url = $('#base').val();
	$.ajax({
		method: "POST",
		url: base_url + "Ajax/delete_item",
		data: {
			pid: pid
		},
		success: function (response) {
			load_cart();
			load_amount();
			load_cart_page();
			alert('Item removed');
		}
	});
});
function load_cart() {
	var base_url = $('#base').val();
	$.ajax({
		url: base_url + "Ajax/fetch_cart_list",
		method: 'POST',
		success: function (response) {
			$('#cart').html(response);
			fetch_cart_count();
		}
	});
}
function fetch_cart_count() {
	var base_url = $('#base').val();
	$.ajax({
		url: base_url + "Ajax/fetch_cart_count",
		method: 'POST',
		success: function (response) { 
			$('.cart_count').html(response);
			if (response > 0) {
				$('#cart_btn').html('<a href="' + base_url + 'cart" class="fill-btn">View cart</a><a href="' + base_url + 'checkout" class="border-btn">Checkout</a>');
			} else {
				$('#cart_btn').html('<a href="' + base_url + '" class="fill-btn">Continue shopping</a>');
			}
		}
	});
}

function load_cart_page() {
	var base_url = $('#base').val();
	$.ajax({
		url: base_url + "Ajax/fetch_cart_page",
		method: 'POST',
		success: function (response) {
			$('#cart_list').html(response);
		}
	});
}

function load_amount() {
	var base_url = $('#base').val();
	$.ajax({
		url: base_url + "Ajax/fetch_total_amount",
		method: 'POST',
		success: function (response) {
			$('.total_cart_amount').html('&#8377; ' + response);
		}
	});
}
function load_checkout_list() {
	var base_url = $('#base').val();
	$.ajax({
		url: base_url + "Ajax/fetch_checkout_list",
		method: 'POST',
		success: function (response) {
			$('#checkout_cart').html(response);
		}
	});
}
load_cart();
load_amount();
load_cart_page();
load_checkout_list();
fetch_cart_count();

$('#otpbtn').click(function () {
	var base_url = $('#base').val();
	var contactno = $('#contactno').val();
	$.ajax({
		type: "json",
		method: "POST",
		url: base_url + "Ajax/get_contact_otp",
		data: { contactno: contactno },
		success: function (response) {
			var json = $.parseJSON(response);
			console.log(json.login_msg);
			$('#otpbtn').hide();
			$('#verifybtn').show();
			$('#otpbox').show();
			$('#otpverify').show();
			$('#otpmessage').html('<i class="text-warning">' + json.login_msg + '</i><br/>');
		}
	});
});
$('#otpverify').click(function () {
	var base_url = $('#base').val();
	var contactno = $('#contactno').val();
	var otp = $('#otp').val();
	$.ajax({
		type: "json",
		method: "POST",
		url: base_url + "Ajax/verify_contact_otp",
		data: {
			contactno: contactno,
			otp: otp
		},
		success: function (response) {
			var json = $.parseJSON(response);
			$('#otpmessage').html('<i class="text-warning">' + json.login_msg + '</i><br/>');
			if (json.status == 1) {
				if (window.location.href == base_url + 'checkout') {
					window.location.href = base_url + 'checkout';
				} else {
					window.location.href = base_url;
				}

			}
		}
	});
});
