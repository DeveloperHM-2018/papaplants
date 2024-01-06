<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminProduct extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (sessionId('admin_id') == "") {
			redirect("admin");
		}
	}

	//   category

	public function categoryAll()
	{
		$get['category_all'] = $this->CommonModel->getRowByIdInOrder('category', "is_delete = '1'", 'category_name', 'ASC');
		$get['title'] = 'All Category';
		$this->load->view('admin/product/category_all', $get);
	}

	public function categoryAdd()
	{
		extract($this->input->post());
		$id = $this->input->get('id');
		$dID = $this->input->get('dID');
		$decrypt_id = decryptId($this->input->get('id'));
		$get = $this->CommonModel->getSingleRowById('category', "category_id = '$decrypt_id'");
		$data['category_name'] = set_value('category_name') == false ? @$get['category_name'] : set_value('category_name');
		$data['image'] = set_value('image') == false ? @$get['image'] : set_value('image');
		if (isset($id)) {
			$data['title'] = 'Edit Category';
		} else {
			$data['title'] = 'Add Category';
		}

		if (isset($dID)) {
			$update = $this->CommonModel->updateRowById('category', 'category_id', decryptId($dID), array('is_delete' => '0'));
			redirect('categoryAll');
			exit;
		}

		if (count($_POST) > 0) {
			$this->form_validation->set_rules('category_name', 'category name', 'required');
			if ($this->form_validation->run()) {
				$post['category_name'] = trim($category_name);
				$post['featured'] = 1;

				if (!empty($_FILES['image']['name'])) {
					$picture = imageUploadWithRatio('image', CATEGORY_IMAGE, 600, 400, $data['image']);
					$post['image'] = $picture;
				}
				if (isset($id)) {
					$update = $this->CommonModel->updateRowById('category', 'category_id', $decrypt_id, $post);
					flashData('errors', 'Category Update Successfully');
				} else {
					$insert = $this->CommonModel->insertRow('category', $post);
					flashData('errors', 'Category Add Successfully');
				}
				redirect('categoryAll');
			}
		}
		$this->load->view('admin/product/category_add', $data);
	}

	//   sub category

	public function subCategoryAll()
	{
		$data['sub_category'] = $this->CommonModel->getRowByIdInOrder('sub_category', "is_delete = '1'", 'sub_category_name', 'ASC');
		$data['title'] = "All Sub Category";
		$this->load->view('admin/product/sub_category_all', $data);
	}

	public function subCategoryAdd()
	{
		$dID = $this->input->get('dID');
		$id = $this->input->get('id');
		extract($this->input->post());
		$decrypt_id = decryptId($this->input->get('id'));

		$get = $this->CommonModel->getSingleRowById('tbl_sub_category', "sub_category_id = '$decrypt_id'");
		$data['sub_category_name'] = set_value('sub_category_name') == false ? @$get['sub_category_name'] : set_value('sub_category_name');
		$data['category_id'] = set_value('category_id') == false ? @$get['category_id'] : set_value('category_id');
		$data['sub_category_image'] = set_value('category_image2') == false ? @$get['sub_category_image'] : set_value('category_image2');
		if (isset($id)) {
			$data['title'] = 'Edit Sub Category';
		} else {
			$data['title'] = 'Add Sub Category';
		}

		if (isset($dID)) {
			$update = $this->CommonModel->updateRowById('sub_category', 'sub_category_id', decryptId($dID), array('is_delete' => '0'));
			redirect('subCategoryAll');
			exit;
		}

		if (count($_POST) > 0) {
			$this->form_validation->set_rules('sub_category_name', 'sub category name', 'trim|required');
			$this->form_validation->set_rules('category_id', 'category', 'required');
			if ($this->form_validation->run()) {

				$post['sub_category_name'] = $sub_category_name;
				$post['category_id'] = $category_id;

				if (!empty($_FILES['sub_category_image']['name'])) {
					$picture = imageUploadWithRatio('sub_category_image', CATEGORY_IMAGE, 600, 400, $data['sub_category_image']);
					$post['sub_category_image'] = $picture;
				}

				if (isset($id)) {
					$update = $this->CommonModel->updateRowById('tbl_sub_category', 'sub_category_id', $decrypt_id, $post);
					flashData('errors', 'Sub Category Update Successfully');
				} else {
					$insert = $this->CommonModel->insertRow('tbl_sub_category', $post);
					flashData('errors', 'Sub Category Add Successfully');
				}
				redirect('subCategoryAll');
			}
		}
		$this->load->view('admin/product/sub_category_add', $data);
	}

	//  Product

	public function productAll()
	{
		if (count($_POST) > 0) {
			extract($this->input->post());
			$postData = $this->input->post();
			$searchValue = $postData['search']['value'];

			$searchQuery = " AND product.is_delete = '1'";
			if ($searchValue != '') {
				$searchQuery .= " AND (tbl_product.product_name LIKE '%" . $searchValue . "%' || tbl_category.category_name LIKE '%" . $searchValue . "%' || tbl_sub_category.sub_category_name LIKE '%" . $searchValue . "%')";
			}

			$searchQuery .= (isset($searchBySubCategory) && $searchBySubCategory != "") ? " AND (tbl_sub_category.sub_category_id = '" . decryptId($searchBySubCategory) . "')" : "";

			$this->session->set_userdata(array('sCateId' => decryptId($searchBySubCategory)));

			$select = "product.*, category.category_name, GROUP_CONCAT(tbl_sub_category.sub_category_name) as sub_category_name";
			$join = [
				['category', 'category.category_id = product.category_id', 'LEFT'],
				['sub_category', "JSON_SEARCH(tbl_product.sub_category_id, 'all', tbl_sub_category.sub_category_id) IS NOT NULL", 'LEFT'],
			];
			$allData = $this->CommonModel->getAjaxDataWithJoin($select, 'product', $searchQuery, $postData, $join, 'tbl_product.product_id');

			$draw = $postData['draw'];
			$data = array();
			$i = $postData['start'];
			foreach ($allData['records'] as $record) {
				++$i;
				$id = encryptId($record['product_id']);
				$viewItemBtn = "";

				$viewItemBtn .= '<a href="' . base_url('productDetails?id=') . $id  . '" class="btn btn-primary"><i class="fa fa-eye"></i> View</a>';
				$viewItemBtn .= '<a href="' . base_url('productAdd?id=') . $id  . '" class="btn btn-success m-1"><i class="fa fa-edit"></i> Edit</a>';
				$viewItemBtn .= '<a href="' . base_url("productDelete?dID=$id") . '" class="btn btn-danger confirm_data" title="Product Delete" title-text="Are you sure ?" icon="warning"><i class="fa fa-trash"></i> Delete</a>';


				$data[] = array(
					"product_id" => $i,
					"product_name" => '<p class="wrap_text">' . ucwords($record['product_name']) . '</p>',
					"category_name" => $record['category_name'],
					"sub_category_name" => str_replace(",", ", ", $record['sub_category_name']),
					"product_type" => $record['product_type'] == '1' ? 'Normal' : 'Featured',
					"market_price" => $record['market_price'],
					"sale_price" => $record['sale_price'],
					"action" => $viewItemBtn,
				);
			}

			## Response
			$response = array(
				"draw" => intval($draw),
				"iTotalRecords" => $allData['totalRecords'],
				"iTotalDisplayRecords" => $allData['totalRecordwithFilter'],
				"aaData" => $data
			);

			echo json_encode($response);
		} else {
			$data['title'] = 'All Product';

			$table_header = [
				['data' => 'product_id'],
				['data' => 'product_name'],
				['data' => 'category_name'],
				['data' => 'sub_category_name'],
				['data' => 'product_type'],
				['data' => 'market_price'],
				['data' => 'sale_price'],
				['data' => 'action'],
			];

			$data['all_sub_category'] = $this->CommonModel->getRowByIdInOrder('tbl_sub_category', "is_delete = '1'", 'sub_category_name', 'ASC');
			$data['ajax_table'] = "productAll";
			$data['table_column'] = json_encode($table_header);
			$data['col_stop'] = "7";
			$this->load->view('admin/product/product_all', $data);
		}
	}

	public function productDelete()
	{
		$dID = $this->input->get('dID');
		if (isset($dID)) {
			$update = $this->CommonModel->updateRowById('product', 'product_id', decryptId($dID), array('is_delete' => '0'));
			redirect('productAll');
			exit;
		}
	}

	function getSubCategory()
	{
		$category_id = $this->input->post('category_id');
		$data['type'] = 1;
		$data['all_data'] = $this->CommonModel->getRowByIdInOrder('tbl_sub_category', "category_id = '$category_id' AND is_delete = '1'", 'sub_category_name', 'ASC');
		$this->load->view('admin/product/sub_category_list', $data);
	}

	function getProductSubCategory()
	{
		$category_id = $this->input->post('category_id');
		$data['all_data'] = $this->CommonModel->getRowByIdInOrder('tbl_sub_category', "category_id = '$category_id' AND is_delete = '1'", 'sub_category_name', 'ASC');
		$data['type'] = 2;
		$this->load->view('admin/product/sub_category_list', $data);
	}

	public function productAdd()
	{
		$id = $this->input->get('id');
		$decrypt_id = decryptId($id);

		if (isset($id)) {
			$data['title'] = 'Edit Product';
			$getProduct = $this->CommonModel->getSingleRowById('product', "product_id = '$decrypt_id'");
		} else {
			$data['title'] = 'Add Product';
			$getProduct = false;
		}

		$data['product_name'] = set_value('product_name') == false ? @$getProduct['product_name'] : set_value('product_name');
		$data['category_id'] = set_value('category_id') == false ? @$getProduct['category_id'] : set_value('category_id');
		$data['sub_category_id'] = set_value('sub_category_id') == false ? @json_decode($getProduct['sub_category_id'], true) : set_value('sub_category_id');
		$data['product_type'] = set_value('product_type') == false ? @$getProduct['product_type'] : set_value('product_type');
		$data['description'] = set_value('description') == false ? @$getProduct['description'] : set_value('description');
		$data['market_price'] = set_value('market_price') == false ? @$getProduct['market_price'] : set_value('market_price');
		$data['sale_price'] = set_value('sale_price') == false ? @$getProduct['sale_price'] : set_value('sale_price');
		$data['quantity'] = set_value('quantity') == false ? @$getProduct['quantity'] : set_value('quantity');
		$data['image_all'] = $this->CommonModel->getRowById('product_image', "product_id", $decrypt_id);


		if (count($_POST) > 0) {
			extract($this->input->post());
			$post['product_name'] = $product_name;
			$post['category_id'] = $category_id;

			$post['description'] = $description;
			$post['product_type'] = $product_type;
			$post['market_price'] = $market_price;
			$post['sale_price'] = $sale_price;
			$post['quantity'] = $quantity;

			$sc_list = [];
			if (!empty($sub_category_id)) {
				foreach ($sub_category_id as $s_list) {
					$sc_list[] = $s_list;
				}
			}
			$post['sub_category_id'] = json_encode($sc_list);


			if (isset($id)) {
				$filesCount = count($_FILES['image']['name']);
				if ($filesCount > 0) {
					for ($i = 0; $i < $filesCount; $i++) {
						$extension = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
						$newFilename = round(microtime(true) * 1000);
						$_FILES['files']['name'] = $newFilename . '.' . $extension;
						$_FILES['files']['type'] = $_FILES['image']['type'][$i];
						$_FILES['files']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
						$_FILES['files']['error'] = $_FILES['image']['error'][$i];
						$_FILES['files']['size'] = $_FILES['image']['size'][$i];

						$picture = imageUploadWithRatio('files', PRODUCT_IMAGE, 600, 400, "");
						if ($picture) {
							$post2['image_path'] = $picture;
							$post2['product_id'] = $decrypt_id;
							$insert = $this->CommonModel->insertRow('product_image', $post2);
						}
					}
				}
				$update = $this->CommonModel->updateRowById('product', 'product_id', $decrypt_id, $post);
				flashData('errors', 'Produce update successfully');
			} else {
				$p_id = $this->CommonModel->insertRowReturnIdWithClean('product', $post);
				if ($p_id > 0) {
					$filesCount = count($_FILES['image']['name']);
					if ($filesCount > 0) {
						for ($i = 0; $i < $filesCount; $i++) {
							$extension = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
							$newFilename = round(microtime(true) * 1000);
							$_FILES['files']['name'] = $newFilename . '.' . $extension;
							$_FILES['files']['type'] = $_FILES['image']['type'][$i];
							$_FILES['files']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
							$_FILES['files']['error'] = $_FILES['image']['error'][$i];
							$_FILES['files']['size'] = $_FILES['image']['size'][$i];

							$picture = imageUploadWithRatio('files', PRODUCT_IMAGE, 600, 400, "");
							if ($picture) {
								$post2['image_path'] = $picture;
								$post2['product_id'] = $p_id;
								$insert = $this->CommonModel->insertRow('product_image', $post2);
							}
						}
					}

					flashData('errors', 'Produce add successfully');
				} else {
					flashData('errors', 'Product not add');
				}
			}
			redirect('productAll');
		}
		$this->load->view('admin/product/product_add', $data);
	}

	public function productImageD($id, $img)
	{
		$delete = $this->CommonModel->deleteRowById('product_image', "product_image_id = '" . decryptId($id) . "'");
		unlink(PRODUCT_IMAGE . $img);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function productDetails()
	{
		$id = $this->input->get('id');
		$decrypt_id = decryptId($id);
		$getProduct = $this->CommonModel->getSingleRowById('product', "product_id = '$decrypt_id'");
		$data['product_name'] = set_value('product_name') == false ? @$getProduct['product_name'] : set_value('product_name');
		$data['company_id'] = set_value('company_id') == false ? @$getProduct['company_id'] : set_value('company_id');
		$data['category_id'] = set_value('category_id') == false ? @$getProduct['category_id'] : set_value('category_id');
		$data['sub_category_id'] = set_value('sub_category_id') == false ? @json_decode($getProduct['sub_category_id'], true) : set_value('sub_category_id');
		$data['product_type'] = set_value('product_type') == false ? @$getProduct['product_type'] : set_value('product_type');
		$data['description'] = set_value('description') == false ? @$getProduct['description'] : set_value('description');
		$data['product_type'] = set_value('product_type') == false ? @$getProduct['product_type'] : set_value('product_type');
		$data['market_price'] = set_value('market_price') == false ? @$getProduct['market_price'] : set_value('market_price');
		$data['sale_price'] = set_value('sale_price') == false ? @$getProduct['sale_price'] : set_value('sale_price');
		$data['quantity'] = set_value('quantity') == false ? @$getProduct['quantity'] : set_value('quantity');
		$data['quantity_type'] = set_value('quantity_type') == false ? @$getProduct['quantity_type'] : set_value('quantity_type');
		$data['image_all'] = $this->CommonModel->getRowById('product_image', "product_id", $decrypt_id);
		$data['title'] = 'Product Details';
		$this->load->view('admin/product/view_product_details', $data);
	}
}
