<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stripe extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function Index()
	{
		if ($_POST['currency'] == 'USD') {
			$_POST['amount'] = $_POST['usd'];
		} else {
			$_POST['amount'] = $_POST['inr'];
		}
		$data['post'] = $_POST;
		$this->load->view('stripe/home', $data);
	}
	public function stripe_charge()
	{




		require 'vendor/autoload.php';
		// This is a public sample test API key.
		// Don’t submit any personally identifiable information in requests made with this key.
		// Sign in to see your own test API key embedded in code samples.
		\Stripe\Stripe::setApiKey('sk_test_tR3PYbcVNZZ796tH88S4VQ2u');

		header('Content-Type: application/json');

		$YOUR_DOMAIN = 'http://localhost/public';

		$checkout_session = \Stripe\Checkout\Session::create([
			'customer_email' => 'customer@example.com',
			'submit_type' => 'donate',
			'billing_address_collection' => 'required',
			'shipping_address_collection' => [
				'allowed_countries' => ['US', 'CA'],
			],
			'line_items' => [[
				# Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
				'price' => '{{PRICE_ID}}',
				'quantity' => 1,
			]],
			'mode' => 'payment',
			'success_url' => $YOUR_DOMAIN . '/success.html',
			'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
		]);

		header("HTTP/1.1 303 See Other");
		header("Location: " . $checkout_session->url);
	}
	public function success()
	{
		$this->load->view('stripe/success');
	}
	public function failed()
	{
		$this->load->view('stripe/failed');
	}
}
