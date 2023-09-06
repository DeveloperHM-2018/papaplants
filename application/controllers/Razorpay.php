<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Razorpay extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->contact = $this->CommonModal->getSingleRowById('contact_details', ['cid' => 1]);
	}
// 	public function index()
// 	{
// 		$this->checkout();
// 	}

// 	public function checkout()
// 	{
// 		$data['title']              = 'Checkout payment | Infovistar';
// 		$data['callback_url']       = base_url() . 'razorpay/callback';
// 		$data['surl']               = base_url() . 'razorpay/success';
// 		$data['furl']               = base_url() . 'razorpay/failed';
// 		$data['currency_code']      = 'INR';
// 		$this->load->view('razorpay/checkout', $data);
// 	}

// 	// initialized cURL Request
// 	private function curl_handler($payment_id, $amount)
// 	{
// 		$url            = 'https://api.razorpay.com/v1/payments/' . $payment_id . '/capture';
// 		$key_id         = "rzp_live_UJkOVV92wUxESs";
// 		$key_secret     = "A9sZ0jf5vVHslqZp4Ej3sJ7C";
// 		$fields_string  = "amount=$amount";
// 		//cURL Request
// 		$ch = curl_init();
// 		//set the url, number of POST vars, POST data
// 		curl_setopt($ch, CURLOPT_URL, $url);
// 		curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $key_secret);
// 		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
// 		curl_setopt($ch, CURLOPT_POST, 1);
// 		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
// 		return $ch;
// 	}

// 	// callback method
// 	public function callback()
// 	{
// 		print_r($this->input->post());
// 		if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
// 			$razorpay_payment_id = $this->input->post('razorpay_payment_id');
// 			$merchant_order_id = $this->input->post('merchant_order_id');

// 			$this->session->set_flashdata('razorpay_payment_id', $this->input->post('razorpay_payment_id'));
// 			$this->session->set_flashdata('merchant_order_id', $this->input->post('merchant_order_id'));
// 			$currency_code = 'INR';
// 			$amount = $this->input->post('merchant_total');
// 			$success = false;
// 			$error = '';
// 			try {
// 				$ch = $this->curl_handler($razorpay_payment_id, $amount);
// 				//execute post
// 				$result = curl_exec($ch);
// 				$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// 				if ($result === false) {
// 					$success = false;
// 					$error = 'Curl error: ' . curl_error($ch);
// 				} else {
// 					$response_array = json_decode($result, true);
// 					//Check success response
// 					if ($http_status === 200 and isset($response_array['error']) === false) {
// 						$success = true;
// 					} else {
// 						$success = false;
// 						if (!empty($response_array['error']['code'])) {
// 							$error = $response_array['error']['code'] . ':' . $response_array['error']['description'];
// 						} else {
// 							$error = 'RAZORPAY_ERROR:Invalid Response <br/>' . $result;
// 						}
// 					}
// 				}
// 				//close curl connection
// 				curl_close($ch);
// 			} catch (Exception $e) {
// 				$success = false;
// 				$error = 'Request to Razorpay Failed';
// 			}

// 			if ($success === true) {
// 				if (!empty($this->session->userdata('ci_subscription_keys'))) {
// 					$this->session->unset_userdata('ci_subscription_keys');
// 				}
// 				if (!$order_info['order_status_id']) {
// 					redirect($this->input->post('merchant_surl_id'));
// 				} else {
// 					redirect($this->input->post('merchant_surl_id'));
// 				}
// 			} else {
// 				redirect($this->input->post('merchant_furl_id'));
// 			}
// 		} else {
// 			echo 'An error occured. Contact site administrator, please!';
// 		}
// 	}
	public function success()
	{
		$data['category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '1', 'parent_id' => '0']);
		$data['subcategory'] = $this->CommonModal->getRowById('category', 'is_visible', '1');
		$rpi = $this->input->post('razorpay_payment_id');

		if($rpi != ''){
		$mid = $this->input->post('merchant_order_id');
		$checkout = explode('-', $mid);
		$data['title'] = 'Razorpay Success | Papaplants';
		$msg = "<h4>Your transaction is successful</h4>";
		$msg .= "<br/>";
		$msg .= "Transaction ID: " . $rpi;
		$msg .= "<br/>";
		$msg .= "Order ID: " . $mid;
		$data['msg'] = $msg;
		$update = $this->CommonModal->updateRowByMoreId('checkout', array('id' => $checkout[2]), ['payment_status' => 1, 'razorpay_payment_id' => $rpi]);
		$checkout_data = $this->CommonModal->getSingleRowById('checkout', array('id' => $checkout[2]));
		$login_data = $this->CommonModal->getSingleRowById('customer', array('user_id' => $checkout_data['user_id']));
		$this->session->set_userdata(array('login_user_id' => $login_data['user_id']));
		$this->load->view('view_msg', $data);
		}
		$this->load->view('view_msg', $data);
	}
	public function failed()
	{
		$data['category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '1', 'parent_id' => '0']);
		$data['subcategory'] = $this->CommonModal->getRowById('category', 'is_visible', '1');
		$rpi = $this->input->post('razorpay_payment_id');
		if($rpi != ''){
		$mid = $this->input->post('merchant_order_id');
		$checkout = explode('-', $mid);
		$data['title'] = 'Razorpay Failed | Papaplants';
		$msg = "<h4>Your transaction got Failed</h4>";
		$msg .= "<br/>";
		$msg .= "Transaction ID: " . $rpi;
		$msg .= "<br/>";
		$msg .= "Order ID: " . $mid;
		$data['msg'] = $msg;
		$update = $this->CommonModal->updateRowByMoreId('checkout', array('id' => $checkout[2]), ['payment_status' => 2, 'razorpay_payment_id' => $rpi]);
		$checkout_data = $this->CommonModal->getSingleRowById('checkout', array('id' => $checkout[2]));
		$login_data = $this->CommonModal->getSingleRowById('customer', array('user_id' => $checkout_data['user_id']));
		$this->session->set_userdata(array('login_user_id' => $login_data['user_id']));
		$this->load->view('view_msg', $data);
		}
	}
}
