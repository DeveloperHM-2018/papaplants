<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Payangel extends CI_Controller
{
	public function index()
	{
		$post['name'] = 'name';
		$post['email_id'] = 'email';
		$post['contact_no'] = '9999999999';
		$post['payment_title'] = 'Payment';
		$post['payment_description'] = 'Package Desc';
		$post['payment_amount'] = 10;
		$post['order_id'] = 'ORD1112233';
		$post['redirect_url'] = base_url() . 'payangel/msg';

		$post_json = json_encode($post);
		$encrypt_payload = base64_encode($post_json);

		$hash = hash('sha256', $encrypt_payload . "/pay" . 'KBSNJPR8Z73GIWHUOYE59TVMC') . '###';

		$headers = array(
			"X-VERIFY: $hash"
		);

		$post['api_key'] = 'KBSNJPR8Z73GIWHUOYE59TVMC';

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://payment.webangeltech.com/paymentInitiate');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post);

		$response = curl_exec($curl);
		curl_close($curl);

		$check_resp = json_decode($response, true);

		print_r($response);
	}
}
