<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function setDateTime()
{
	return date('Y-m-d H:i:s');
}
function setDateOnly()
{
	return date('Y-m-d');
}
function convertDatedmy($dt)
{
	return date("d-m-Y", strtotime($dt));
}
function convertDatedmyhis($dt)
{
	return date("d-m-Y H:i s", strtotime($dt));
}
function dateDiffInDays($date1, $date2)
{
	$diff = strtotime($date2) - strtotime($date1);
	// 1 day = 24 hours
	// 24 * 60 * 60 = 86400 seconds
	return abs(round($diff / 86400));
}
function sessionId($id)
{
	$ci = &get_instance();
	return $ci->session->userdata($id);
}
function insertRow($table, $data)
{
	$ci = &get_instance();
	$clean = $ci->security->xss_clean($data);
	return $ci->db->insert($table, $clean);
}
function returnId($table, $data)
{
	$ci = &get_instance();
	$ci->db->insert($table, $data);
	return $ci->db->insert_id();
}
function randomCode($length_of_string)
{
	$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	return substr(str_shuffle($str_result), 0, $length_of_string);
}
//  function getRowbyid($table, $id)
// 	{
// 		$get = $this->db->select()
// 			->from($table)
// 			->where($id = 0)
// 			->get();
// 		if ($get->num_rows() > 0) {
// 			return $get->result_array();
// 		} else {
// 			return false;
// 		}
// 	}
function getRowById($table, $column, $id)
{
	$ci = &get_instance();
	$get = $ci->db->get_where($table, array($column => $id));
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}
function getSingleRowById($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	if ($get->num_rows() > 0) {
		return $get->row_array();
	} else {
		return false;
	}
}
function getAllRow($table)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}
function updateRowById($table, $column, $id, $data)
{
	$ci = &get_instance();
	$clean = $ci->security->xss_clean($data);
	$query = $ci->db->where($column, $id)
		->update($table, $clean);
	return $ci->db->affected_rows();
}
function deleteRowById($table, $column, $id)
{
	$ci = &get_instance();
	$ci->db->where($column, $id);
	$ci->db->delete($table);
	if ($ci->db->affected_rows() > 0) {
		return true;
	} else {
		return $ci->db->error();
	}
}
function deleteRowMoreId($table, $where)
{
	$ci = &get_instance();
	$ci->db->where($where);
	$ci->db->delete($table);
	if ($ci->db->affected_rows() > 0) {
		return true;
	} else {
		return $ci->db->error();
	}
}
function getAllRowInOrder($table, $column, $type)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($column, $type)->get($table);
	if ($select->num_rows() > 0) {
		return $select->result_array();
	} else {
		return false;
	}
}
function getAllRowsWithLimit($table, $limit, $orderCol)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->limit($limit)
		->order_by($orderCol, "desc")
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}
function getRowsByMoreIdWithOrder($table, $where, $column, $type)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($column, $type)->get_where($table, $where);
	if ($select->num_rows() > 0) {
		return $select->result_array();
	} else {
		return false;
	}
}
function getDataByIdInOrder($table, $column, $id, $orderColumn, $type)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($orderColumn, $type)->get_where($table, array($column => $id));
	return $select->result_array();
}
function getAllDataWithLimitInOrder($table, $orderColumn, $type, $start, $end)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($orderColumn, $type)->limit($start, $end)->get($table);
	return $select->result_array();
}
function getDataByIdInOrderLimit($table, $column, $id, $orderColumn, $type, $start, $end)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($orderColumn, $type)->limit($start, $end)->get_where($table, array($column => $id));
	return $select->result_array();
}
function getRowByMoreId($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}
function getNumRows($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	return $get->num_rows();
}
function getRowByLikeInOrder($table, $where, $like, $name, $orderBy, $orderType)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->like($like, $name, 'both')
		->order_by($orderBy, $orderType)
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}
function encryptId($id)
{
	// $ci = &get_instance();
	// $key = $ci->encrypt->encode($id);
	// return $key;
	return $id;
}
function decryptId($key)
{
	// $ci = &get_instance();
	// $id = $ci->encrypt->decode($key);
	// return $id;
	return $key;
}
function lastReplace($search, $replace, $subject)
{
	$pos = strrpos($subject, $search);
	if ($pos !== false) {
		$subject = substr_replace($subject, $replace, $pos, strlen($search));
	}
	return $subject;
}
function flashData($var, $message)
{
	$ci = &get_instance();
	return $ci->session->set_flashdata($var, $message);
}
function sendOTP($contact_no, $message_content)
{
	$url = "http://mysmsshop.in/V2/http-api.php?apikey=aYR5fktJhboWNydD&senderid=UDHYME&number=$contact_no&message=" . urlencode($message_content) . "&format=json";
	$res = curl_init();
	curl_setopt($res, CURLOPT_URL, $url);
	curl_setopt($res, CURLOPT_RETURNTRANSFER, true);
	$result1 = curl_exec($res);
}
function getUserId($token)
{
	$ci = &get_instance();
	$ip = $ci->input->ip_address();
	$get = $ci->db->select()
		->from('user_registration')
		->where("user_registration.user_id = '" . $token['data']->id . "' AND user_status = '1' AND unique_hash = '" . $token['data']->unique_hash . "'")
		->get();
	if ($get->num_rows() > 0) {
		return $token['data']->id;
	} else {
		return false;
	}
}
function orderIdGenerateUser()
{
	$number = 'ORD' . date('ydmhis');
	if (checkOrderIdExistUser($number)) {
		orderIdGenerateUser();
	}
	return $number;
}
function checkOrderIdExistUser($number)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from('book_product')
		->where("order_id = '$number'")
		->get();
	if ($get->num_rows() > 0) {
		return true;
	} else {
		return false;
	}
}
function imageUpload($imageName, $path)
{
	$ci = &get_instance();
	$config['file_name'] = date('dm') . round(microtime(true) * 1000);
	$config['allowed_types'] = 'jpg|png|jpeg|webp';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		$configi['image_library'] = 'gd2';
		$config['quality'] = '100%';
		$config['create_thumb'] = FALSE;
		$configi['source_image'] = $path;
		$configi['new_image'] = $target_path;
		$configi['maintain_ratio'] = TRUE;
		$configi['width'] = 380;
		$configi['height'] = 260;
		$ci->load->library('image_lib');
		$ci->image_lib->initialize($configi);
		$ci->image_lib->resize();
		return $picture;
	} else {
		return false;
	}
}
function first_sentence($content)
{
	$contents = strip_tags($content);
	$pos = strpos($contents, '.');
	return substr($contents, 0, $pos + 1);
}
function setImage($image_nm, $location)
{
	if ($image_nm != '') {
		if (file_exists(FCPATH . $location . $image_nm)) {
			return base_url() . $location . $image_nm;
		} else {
			return base_url() . 'uploads/default.jpg';
		}
	} else {
		return base_url() . 'uploads/default.jpg';
	}
}


// function sendWhatsapp($contact_no, $message_content)
// {
// 	$curl = curl_init();
// 	curl_setopt_array($curl, [
// 		CURLOPT_URL => "https://www.wpsenders.in/api/sendMessage",
// 		CURLOPT_RETURNTRANSFER => true,
// 		CURLOPT_FOLLOWLOCATION => true,
// 		CURLOPT_ENCODING => "",
// 		CURLOPT_MAXREDIRS => 10,
// 		CURLOPT_TIMEOUT => 30,
// 		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 		CURLOPT_CUSTOMREQUEST => "POST",
// 		CURLOPT_POSTFIELDS => "api_key=NY76I15O4QVWDE8FU0HJPZGCA&message=" . $message_content . "&number=" . $contact_no . "&route=2&saccade=10",
// 		CURLOPT_HTTPHEADER => [
// 			"content-type: application/x-www-form-urlencoded"
// 		],
// 	]);
// 	$response = curl_exec($curl);
// 	$err = curl_error($curl);
// 	curl_close($curl);
// 	if ($err) {
// 		return "cURL Error #:" . $err;
// 	} else {
// 		return $response;
// 	}
// }
function sendWhatsapp($contact_no, $message, $route = 1)
{
	$api_key = "7VO1RTGUCZ93E5XA2IBHKP8SL";

	$dataArray['api_key'] = $api_key;
	$dataArray['route'] = $route;
	$dataArray['number'] = $contact_no;
	$dataArray['message'] = $message;

	$ch = curl_init();
	$url =  "https://www.wpsenders.com/api/sendOTPMessage";
	$getUrl = $url;
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_POST, 10);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $dataArray);
	curl_setopt($ch, CURLOPT_URL, $getUrl);
	curl_setopt($ch, CURLOPT_TIMEOUT, 80);
	$response = curl_exec($ch);
	// return json_decode($response, true);
}
