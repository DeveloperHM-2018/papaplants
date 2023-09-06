<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ajax extends CI_Controller
{
	// ecommerce functions
	public function addToCart()
	{
		$pid = $this->input->post('pid');
		$qty = $this->input->post('qty');
		$product = getSingleRowById('product', array('id' => $pid));
		$images = getSingleRowById('product_images', array('product_id' => $pid));
		$data = array(
			'id'      => $product['id'],
			'qty'     => (int)$qty,
			'price'   => $product['price'],
			'name'    => $product['name'],
			'image'    => (($images == '') ? DEFAULT_IMG : $images['image_file']),
			'is_visible' => $product['is_visible'],
		);
		$this->cart->insert($data);
	}
	public function delete_item()
	{
		$product_id = $this->input->post('pid');
		$data = array(
			'rowid' => $product_id,
			'qty'   => 0
		);
		$this->cart->update($data);
	}
	public function fetch_cart_list()
	{
		cartlist();
	}
	public function fetch_cart_page()
	{
		cart_page();
	}
	public function fetch_checkout_list()
	{
		cart_checkout_list();
	}
	public function fetch_cart_count()
	{
		echo $this->cart->total_items();
	}
	public function fetch_total_amount()
	{
		if (count($this->cart->contents()) > 0) {
			echo $this->cart->total();
		} else {
			echo 0;
		}
	}
	public function update_qty()
	{
		extract($this->input->post());
		$data = array(
			'rowid' => $rowid,
			'qty'   => $qty
		);
		$this->cart->update($data);
	}
	public function get_contact_otp()
	{
		$responce = [];
		$contactno = $this->input->post('contactno');
		$otp =  rand(1000, 10000);
		$data = $this->CommonModal->getNumRows('customer', array('phone' => $contactno));
		if ($data == 0) {
			$register = $this->CommonModal->insertRowReturnId('customer', array('first_name' => 'user', 'phone' => $contactno));
			$this->session->set_userdata('otp', $otp);
			$responce['login_msg'] = 'You have successfully registered with us.Enter OTP send to your given whatsapp no. to log in to your account';
			$msg = "" . $otp . " is the verification code to log in to your Papaplants account.";
			sendWhatsapp($contactno, $msg);
			$responce['status'] = '2';
		} elseif ($data == 1) {
			$this->session->set_userdata('otp', $otp);
			$responce['login_msg'] = 'Enter OTP send to your given whatsapp no. to log in to your account';
			$msg = "" . $otp . " is the verification code to log in to your Papaplants account.";
			sendWhatsapp($contactno, $msg);
			$responce['status'] = '1';
		} else {
			$responce['login_msg'] = 'We suspect a account fraud through your registered no. Kindly contact us through mail to inform us.';
			$responce['status'] = '0';
		}
		echo json_encode($responce);
	}
	public function verify_contact_otp()
	{
		$responce = [];
		$contactno = $this->input->post('contactno');
		$otp = $this->input->post('otp');
		$data = $this->CommonModal->getNumRows('customer', array('phone' => $contactno));
		if ($data == 0) {
			$responce['status'] = 'Breach identified';
		} elseif ($data == 1) {
			if ($this->session->userdata('otp') == $otp) {
				$login_data = $this->CommonModal->getSingleRowById('customer', array('phone' => $contactno));
				$this->session->set_userdata(array('login_user_id' => $login_data['user_id']));
				$this->session->unset_userdata('otp');
				$responce['login_msg'] = 'OTP verified';
				$responce['status'] = '1';
			} else {
				$responce['login_msg'] = 'Wrong OTP';
				// $responce['login_msg'] = 'Wrong OTP' . $this->session->userdata('otp');
				$responce['status'] = '2';
			}
		} else {
			$responce['login_msg'] = 'We suspect a account fraud through your registered no. Kindly contact us through mail to inform us.';
			$responce['status'] = '0';
		}
		echo json_encode($responce);
	}
	public function importdata()
	{
		if (count($_FILES) > 0) {
			echo '<pre>';
			$file = $_FILES['pname']['tmp_name'];
			$handle = fopen($file, "r");
			$c = 0;
			$msg = 'Saved List - <br>';
			while (($filesop = fgetcsv($handle,	1000)) !== false) {
				$post = array();

				$post['type'] = $filesop[1];
				$post['sku'] = $filesop[2];
				$post['name'] = $filesop[3];
				$post['is_featured'] = $filesop[5];
				$post['sdesc'] = $filesop[7];
				$post['description'] = $filesop[8];
				$post['sale_price'] = $filesop[24];
				$post['regular_price'] = $filesop[25];
				if ($filesop[26] != '')
					$cat = explode(',', $filesop[26]);
				$post['tags'] = $filesop[27];
				if ($filesop[29] != '')
					$images = explode(',', str_replace('https://nurserynisarga.in/wp-content/', '', $filesop[29]));
				if ($c <> 0) {


					if ($post['name'] != '') {
						$prod_id = $this->CommonModal->insertRowReturnId('product', $post);

						foreach ($cat as $ct) {
							$cts = strtolower(str_replace(' ', '', $ct));
							$check_cat = $this->CommonModal->getNumRows('category', [
								'name' => $cts
							]);
							if ($check_cat > 0) {
								$idss = $this->CommonModal->getSingleRowById('category', [
									'name' => $cts
								]);
								$ids = $idss['id'];
							} else {
								$ids = $this->CommonModal->insertRowReturnId('category', [
									'name' => $cts
								]);
							}
							$id = $this->CommonModal->insertRowReturnId('product_category', [
								'product_id' => $prod_id,
								'category_id' => $ids
							]);
						}
						foreach ($images as $img) {
							$idss = $this->CommonModal->insertRowReturnId('product_images', [
								'product_id' => $prod_id,
								'image_file' => $img,
							]);
						}
						echo $prod_id . '-----------------<br/>';
					}
				}
				$c++;
			}
		} else {
			$this->load->view('import');
		}
	}
	public function updatedata()
	{
		$product = getAllRow('pp_product');
		foreach ($product as $pro) {
			  $this->CommonModal->updateRowById('pp_product', 'id', $pro['id'], ['price' => $pro['regular_price']]);
		}
	}
}
