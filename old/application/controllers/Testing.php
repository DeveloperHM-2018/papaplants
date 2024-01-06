<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testing extends CI_Controller
{
	public function index()
	{
		// $variant = getAllData('catalog/products/120/variants');
		// $product_variant = json_decode($variant, true);
		// echo '<pre>';
		// // print_R($product_variant);
		// if (is_array($product_variant['data'])) {
		// 	foreach ($product_variant['data'] as $variant_row) {
		// 		print_R($variant_row);
		// 		if ($variant_row['option_values'][0]['id'] != '') {
		// 			// echo $variant_row['option_values'][0]['id'];
		// 		}
		// 	}
		// } else {
		// }



		// $variant = getAllData('checkouts/'.sessionId('cart_id'));
		// echo '<pre>';
		
		// $product_variant = json_decode($variant, true);
		// print_R($product_variant);




		$payment_initiate = payment('139');
        $payment_info = json_decode($payment_initiate,true);
        print_r($payment_info);
	}
}
