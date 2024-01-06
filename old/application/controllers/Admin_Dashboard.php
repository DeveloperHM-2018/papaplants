<?php
defined('BASEPATH') or exit('no direct access allowed');
class Admin_Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (sessionId('admin_id') == "") {
			redirect(base_url('admin'));
		}
		date_default_timezone_set("Asia/Kolkata");
	}
	public function index()
	{
		$data['title'] = "Home";
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['category'] = $this->CommonModal->getNumRow('category');
		$data['products'] = $this->CommonModal->getNumRow('product');
		// $data['user_registration'] = $this->CommonModal->getNumRow('user_registration');
		$data['contact_query'] = $this->CommonModal->getNumRow('contact_query');
		$data['new'] = $this->CommonModal->getNumRows('checkout', array('status' => '0'));
		$data['working'] = $this->CommonModal->getNumRows('checkout', array('status' => '1'));
		$data['cancelled'] = $this->CommonModal->getNumRows('checkout', array('status' => '2'));
		$data['completed'] = $this->CommonModal->getNumRows('checkout', array('status' => '3'));
		$data['extra_data'] = $this->CommonModal->getSingleRowById('miscellaneous', array('id' => '1'));
		$data['checkout'] = $this->CommonModal->getRowById('checkout', 'create_date_only', setDateOnly());
		$this->load->view('admin/dashboard', $data);
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$insert = $this->CommonModal->updateRowById('miscellaneous', 'id', 1, $post);
			if ($insert) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Your query is successfully submit. We will contact you as soon as possible.</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-danger">We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.</div>');
			}
			redirect(base_url('Admin_Dashboard'));
		} else {
		}
	}
	public function bestseller()
	{
		$id = $this->uri->segment(3);
		$table = $this->uri->segment(4);
		$status = $this->uri->segment(5);
		$this->CommonModal->updateRowById($table, 'id', $id, array('is_bestseller' => $status));
		redirect(base_url('admin_Dashboard/products'));
	}
	public function featured()
	{
		$id = $this->uri->segment(3);
		$table = $this->uri->segment(4);
		$status = $this->uri->segment(5);
		$this->CommonModal->updateRowById($table, 'id', $id, array('is_featured' => $status));
		redirect(base_url('admin_Dashboard/products'));
	}
	public function disable()
	{
		$id = $this->uri->segment(3);
		$table = $this->uri->segment(4);
		$status = $this->uri->segment(5);
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		if ($table == 'category') {
			$this->CommonModal->updateRowById('category', 'id', $id, array('is_visible' => $status));
			redirect(base_url('admin_Dashboard/product_category'));
		}
		if ($table == 'sub_category') {
			$this->CommonModal->updateRowById('category', 'id', $id, array('is_visible' => $status));
			redirect(base_url('admin_Dashboard/product_subcategory'));
		}
		if ($table == 'promocode') {
			$this->CommonModal->updateRowById($table, 'pid', $id, array('status' => $status));
			redirect(base_url('admin_Dashboard/promocode'));
		}
		if ($table == 'product') {
			$this->CommonModal->updateRowById($table, 'id', $id, array('is_visible' => $status));
			redirect(base_url('admin_Dashboard/products'));
		}
		if ($table == 'blog') {
			$this->CommonModal->updateRowById($table, 'blog_id', $id, array('is_visible' => $status));
			redirect(base_url('admin_Dashboard/blogs'));
		}
		if ($table == 'vendor') {
			$this->CommonModal->updateRowById('vendor', 'vid', $id, array('is_visible' => $status));
			redirect(base_url('admin_Dashboard/vendor_list'));
		}
	}
	public function product_category()
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Product Category";
		$BdID = $this->input->get('BdID');
		$img = $this->input->get('img');
		if (decryptId($BdID) != '') {
			$delete = $this->CommonModal->deleteRowById('category', array('id' => decryptId($BdID)));
			unlink('./uploads/category/' . $img);
			redirect('admin_Dashboard/product_category');
			exit;
		}
		$data['category'] = $this->CommonModal->getRowByIdInOrder('category', array('parent_id' => '0'), 'id', 'DESC');
		$this->load->view('admin/view_category', $data);
	}
	public function add_category()
	{
		$data['title'] = "Add Product Category";
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['tag'] = "add";
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$post['image_url'] = imageUpload('img', 'uploads/category/');
			$post['image_url_one'] = imageUpload('img_one', 'uploads/category/');
			$post['image_url_two'] = imageUpload('img_two', 'uploads/category/');
			$savedata = $this->CommonModal->insertRowReturnId('category', $post);
			if ($savedata) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Category Add Successfully</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Category Add Successfully</div>');
			}
			redirect(base_url('admin_Dashboard/product_category'));
		} else {
			$this->load->view('admin/add_category', $data);
		}
	}
	public function edit_category($id)
	{
		$data['title'] = 'Update Category';
		$data['tag'] = 'edit';
		$tid = decryptId($id);
		$data['category'] = $this->CommonModal->getRowById('category', 'id', $tid);
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$image_url = $post['image_url'];
			$image_url_one = $post['image_url_one'];
			$image_url_two = $post['image_url_two'];
			if ($_FILES['img']['name'] != '') {
				$img = imageUpload('img', 'uploads/category/');
				$post['image_url'] = $img;
				if ($image_url != "") {
					unlink('uploads/category/' . $image_url);
				}
			}
			if ($_FILES['img_one']['name'] != '') {
				$img = imageUpload('img_one', 'uploads/category/');
				$post['image_url_one'] = $img;
				if ($image_url_one != "") {
					unlink('uploads/category/' . $image_url_one);
				}
			}
			if ($_FILES['img_two']['name'] != '') {
				$img = imageUpload('img_two', 'uploads/category/');
				$post['image_url_two'] = $img;
				if ($image_url_two != "") {
					unlink('uploads/category/' . $image_url_two);
				}
			}
			$category_id = $this->CommonModal->updateRowById('category', 'id', $tid, $post);
			if ($category_id) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">category Updated successfully</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-success">category Updated successfully</div>');
			}
			redirect(base_url('admin_Dashboard/product_category'));
		} else {
			$this->load->view('admin/add_category', $data);
		}
	}
	public function product_subcategory()
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Product Sub-Category";
		$BdID = $this->input->get('BdID');
		$img = $this->input->get('img');
		if (decryptId($BdID) != '') {
			$delete = $this->CommonModal->deleteRowById('category', array('id' => decryptId($BdID)));
			unlink('upload/category/' . $img);
			redirect('admin_Dashboard/product_subcategory');
			exit;
		}
		// $data['category'] = $this->CommonModal->runQuery("SELECT * FROM 'category' WHERE 'parent_id' != '0'");
		$data['category'] = $this->CommonModal->getRowByIdInOrder('category', "`parent_id` != 0", 'id', 'DESC');
		$this->load->view('admin/view_subcategory', $data);
	}
	public function add_subcategory()
	{
		$data['title'] = "Add Product Subcategory";
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['tag'] = "add";
		$data['categ'] = $this->CommonModal->getRowByIdInOrder('category', array('parent_id' => '0'), 'id', 'DESC');
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$post['image_url'] = imageUpload('img', 'uploads/category/');
			$post['image_url_one'] = imageUpload('img_one', 'uploads/category/');
			$post['image_url_two'] = imageUpload('img_two', 'uploads/category/');
			$savedata = $this->CommonModal->insertRowReturnId('category', $post);
			if ($savedata) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Category Add Successfully</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Category Add Successfully</div>');
			}
			redirect(base_url('admin_Dashboard/product_subcategory'));
		} else {
			$this->load->view('admin/add_subcategory', $data);
		}
	}
	public function edit_subcategory($id)
	{
		$data['title'] = 'Update Subcategory';
		$data['tag'] = 'edit';
		$tid = decryptId($id);
		$data['category'] = $this->CommonModal->getRowById('category', 'id', $tid);
		$data['categ'] = $this->CommonModal->getRowById('category', 'parent_id', 0);
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$image_url = $post['image_url'];
			if ($_FILES['img']['name'] != '') {
				$img = imageUpload('img', 'uploads/category/');
				// print_r($img);
				$post['image_url'] = $img;
				if ($image_url != "") {
					unlink('uploads/category/' . $image_url);
				}
			}
			$image_url_one = $post['image_url_one'];
			$image_url_two = $post['image_url_two'];
			if ($_FILES['img']['name'] != '') {
				$img = imageUpload('img', 'uploads/category/');
				$post['image_url'] = $img;
				if ($image_url != "") {
					unlink('uploads/category/' . $image_url);
				}
			}
			if ($_FILES['img_one']['name'] != '') {
				$img = imageUpload('img_one', 'uploads/category/');
				$post['image_url_one'] = $img;
				if ($image_url_one != "") {
					unlink('uploads/category/' . $image_url_one);
				}
			}
			if ($_FILES['img_two']['name'] != '') {
				$img = imageUpload('img_two', 'uploads/category/');
				$post['image_url_two'] = $img;
				if ($image_url_two != "") {
					unlink('uploads/category/' . $image_url_two);
				}
			}
			$category_id = $this->CommonModal->updateRowById('category', 'id', $tid, $post);
			if ($category_id) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">category Updated successfully</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-success">category not Updated successfully</div>');
			}
			redirect(base_url('admin_Dashboard/product_subcategory'));
		} else {
			$this->load->view('admin/add_subcategory', $data);
		}
	}
	public function vendor_list()
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Vendors List";
		$BdID = $this->input->get('BdID');
		$img = $this->input->get('img');
		if (decryptId($BdID) != '') {
			$delete = $this->CommonModal->deleteRowById('category', array('id' => decryptId($BdID)));
			unlink('./uploads/category/' . $img);
			redirect('admin_Dashboard/product_category');
			exit;
		}
		$data['vendor'] = $this->CommonModal->getAllRowsInOrder('vendor', 'vid', 'DESC');
		$this->load->view('admin/view_vendor', $data);
	}
	public function add_vendor()
	{
		$data['title'] = "Add Vendor ";
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['tag'] = "add";
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$post['logo'] = imageUpload('img', 'uploads/vendor/');
			$savedata = $this->CommonModal->insertRowReturnId('vendor', $post);
			if ($savedata) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Vendor Add Successfully</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Something went wrong, please try again later</div>');
			}
			redirect(base_url('admin_Dashboard/vendor_list'));
		} else {
			$this->load->view('admin/add_vendor', $data);
		}
	}
	public function edit_vendor($vid)
	{
		$data['title'] = 'Update Vendor';
		$data['tag'] = 'edit';
		$tid = decryptId($vid);
		$data['category'] = $this->CommonModal->getRowById('vendor', 'vid', $tid);
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$image_url = $post['logo'];
			if ($_FILES['img']['name'] != '') {
				$img = imageUpload('img', 'uploads/vendor/');
				$post['logo'] = $img;
				if ($image_url != "") {
					unlink('uploads/vendor/' . $image_url);
				}
			}
			$category_id = $this->CommonModal->updateRowById('vendor', 'vid', $tid, $post);
			if ($category_id) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Vendor Updated successfully</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Something went wrong, please try again later</div>');
			}
			redirect(base_url('admin_Dashboard/vendor_list'));
		} else {
			$this->load->view('admin/add_vendor', $data);
		}
	}
	public function showroom()
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Showroom Gallery";
		$BdID = $this->input->get('BdID');
		$img = $this->input->get('img');
		if (decryptId($BdID) != '') {
			$delete = $this->CommonModal->deleteRowById('pp_blog', array('blog_id' => decryptId($BdID)));
			unlink('./uploads/blogs/' . $img);
			redirect('admin_Dashboard/blogs');
			exit;
		}
		$data['showroom'] = $this->CommonModal->getAllRowsInOrder('pp_showroom_gallery', 'sid', 'desc');
		$this->load->view('admin/showroom', $data);
	}
	public function add_showroom()
	{
		$data['title'] = "Add Showroom Gallery";
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['tag'] = "add";
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$post['image'] = imageUpload('img', 'uploads/showroom/');
			$savedata = $this->CommonModal->insertRowReturnId('pp_showroom_gallery', $post);
			if ($savedata) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Image Added Successfully</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Something  went wrong</div>');
			}
			redirect(base_url('admin_Dashboard/showroom'));
		} else {
			$this->load->view('admin/add_showroom', $data);
		}
	}
	public function edit_showroom($id)
	{
		$data['title'] = 'Update showroom gallery';
		$data['tag'] = 'edit';
		$tid = decryptId($id);
		$data['blog'] = $this->CommonModal->getRowById('pp_blog', 'blog_id', $tid);
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$image_url = $post['image'];
			if ($_FILES['img']['name'] != '') {
				$img = imageUpload('img', 'uploads/blogs/');
				$post['image'] = $img;
				if ($image_url != "") {
					unlink('uploads/blogs/' . $image_url);
				}
			}
			$category_id = $this->CommonModal->updateRowById('blog', 'blog_id', $tid, $post);
			if ($category_id) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Blog Updated successfully</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Blog Updated successfully</div>');
			}
			redirect(base_url('admin_Dashboard/blogs'));
		} else {
			$this->load->view('admin/add_blog', $data);
		}
	}
	public function banner()
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Home Banner";
		$BdID = $this->input->get('BdID');
		$img = $this->input->get('img');
		if (decryptId($BdID) != '') {
			$delete = $this->CommonModal->deleteRowById('pp_blog', array('blog_id' => decryptId($BdID)));
			unlink('./uploads/blogs/' . $img);
			redirect('admin_Dashboard/blogs');
			exit;
		}
		$data['banner'] = $this->CommonModal->getAllRows('pp_home_banner');
		$this->load->view('admin/banner', $data);
	}
	public function edit_banner($id)
	{
		$data['title'] = 'Update Banner';
		$data['tag'] = 'edit';
		$tid = decryptId($id);
		$data['blog'] = $this->CommonModal->getRowById('pp_home_banner', 'bid', $tid);
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$image_url = $post['image'];
			if ($_FILES['img']['name'] != '') {
				$img = imageUpload('img', 'uploads/banner/');
				$post['image'] = $img;
				if ($image_url != "") {
					unlink('uploads/banner/' . $image_url);
				}
			}
			$category_id = $this->CommonModal->updateRowById('pp_home_banner', 'bid', $tid, $post);
			if ($category_id) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Banner Updated successfully</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Something went worng</div>');
			}
			redirect(base_url('admin_Dashboard/banner'));
		} else {
			$this->load->view('admin/add_banner', $data);
		}
	}
	public function blogs()
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Blogs";
		$BdID = $this->input->get('BdID');
		$img = $this->input->get('img');
		if (decryptId($BdID) != '') {
			$delete = $this->CommonModal->deleteRowById('pp_blog', array('blog_id' => decryptId($BdID)));
			unlink('./uploads/blogs/' . $img);
			redirect('admin_Dashboard/blogs');
			exit;
		}
		$data['blogs'] = $this->CommonModal->getAllRows('pp_blog');
		$this->load->view('admin/blogs', $data);
	}
	public function add_blog()
	{
		$data['title'] = "Add Blog";
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['tag'] = "add";
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$post['image'] = imageUpload('img', 'uploads/blogs/');
			$savedata = $this->CommonModal->insertRowReturnId('blog', $post);
			if ($savedata) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Blog Add Successfully</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Blog Add Successfully</div>');
			}
			redirect(base_url('admin_Dashboard/blogs'));
		} else {
			$this->load->view('admin/add_blog', $data);
		}
	}
	public function edit_blog($id)
	{
		$data['title'] = 'Update Blog';
		$data['tag'] = 'edit';
		$tid = decryptId($id);
		$data['blog'] = $this->CommonModal->getRowById('pp_blog', 'blog_id', $tid);
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$image_url = $post['image'];
			if ($_FILES['img']['name'] != '') {
				$img = imageUpload('img', 'uploads/blogs/');
				$post['image'] = $img;
				if ($image_url != "") {
					unlink('uploads/blogs/' . $image_url);
				}
			}
			$category_id = $this->CommonModal->updateRowById('blog', 'blog_id', $tid, $post);
			if ($category_id) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Blog Updated successfully</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Blog Updated successfully</div>');
			}
			redirect(base_url('admin_Dashboard/blogs'));
		} else {
			$this->load->view('admin/add_blog', $data);
		}
	}
	public function contact_query()
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Contact Query";
		$table = "contact_query";
		$BdID = $this->input->get('BdID');
		if (decryptId($BdID) != '') {
			$delete = $this->CommonModal->deleteRowById('contact_query', array('cid' => decryptId($BdID)));
			redirect('Admin_Dashboard/contact_query');
			exit;
		}
		$data['contact'] = $this->CommonModal->getAllRows($table);
		$this->load->view('admin/contact', $data);
	}
	public function contactdetails()
	{
		$data['title'] = "Contact Details";
		$table = "contact_details";
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['contactdetails'] = $this->CommonModal->getRowById($table, 'cid', '1');
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$update = $this->CommonModal->updateRowByMoreId($table, array('cid' => '1'), $post);
			if ($update) {
				$this->session->set_flashdata('msg', 'Category Add successfully');
				$this->session->set_flashdata('msg_class', 'alert-success');
			} else {
				$this->session->set_flashdata('msg', 'Soemthing went wrong Please try again!!');
				$this->session->set_flashdata('msg_class', 'alert-danger');
			}
			redirect(base_url() . 'admin_Dashboard/contactdetails');
		} else {
			$this->load->view('admin/contactdetails', $data);
		}
	}
	public function faq()
	{
		$table = "faq";
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "FAQ";
		$data['faq'] = $this->CommonModal->getAllRows($table);
		$BdID = $this->input->get('BdID');
		if (decryptId($BdID) != '') {
			$delete = $this->CommonModal->deleteRowById('faq', array('fid' => decryptId($BdID)));
			redirect('Admin_Dashboard/faq');
			exit;
		}
		$this->load->view('admin/faq', $data);
	}
	public function add_faq()
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Add FAQ";
		if (count($_POST) > 0) {
			$data = $this->input->post();
			$done = $this->CommonModal->insertRow('faq', $data);
			if ($done) {
				$this->session->set_flashdata('msg', 'FAQ Add successfully');
				$this->session->set_flashdata('msg_class', 'alert-success');
			} else {
				$this->session->set_flashdata('msg', 'Soemthing went wrong Please try again!!');
				$this->session->set_flashdata('msg_class', 'alert-danger');
			}
			redirect(base_url('admin_Dashboard/faq'));
		} else {
			$this->load->view('admin/add_faq', $data);
		}
	}
	public function policy()
	{
		$data['title'] = "Policy";
		$data['policy'] = $this->CommonModal->getAllRowsInOrder('policy', 'id', 'desc');
		$this->load->view('admin/policy', $data);
	}
	public function policy_edit()
	{
		$key = $this->uri->segment(3);
		$data['title'] = "Policy Edit";
		$id = decryptId($key);
		$data['policy'] = $this->CommonModal->getRowById('policy', 'id', $id);
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$savedata = $this->CommonModal->updateRowById('policy', 'id', $id, $post);
			if ($savedata) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Policy Update Successfully</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Policy Update Successfully</div>');
			}
			redirect(base_url('admin_Dashboard/policy'));
		} else {
			$this->load->view('admin/policy-edit', $data);
		}
	}
	public function products()
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Products";
		$data['products'] = $this->CommonModal->getRowById('product', 'is_visible', '1');
		$this->load->view('admin/products', $data);
	}
	public function products_disabled()
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Disbaled Products";
		$data['products'] = $this->CommonModal->getRowById('product', 'is_visible', '0');
		$this->load->view('admin/products', $data);
	}
	public function add_product()
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Add Product";
		$data['category'] = $this->CommonModal->getRowByIdInOrder('category', array('parent_id' => '0'), 'id', 'DESC');
		$data['tag'] = "add";
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$cat_id = $post['cate'];
			$get['specs_title'] = $post['specs_title'];
			$get['specs_desc'] = $post['specs_desc'];
			unset($post['cate']);
			unset($post['specs_title']);
			unset($post['specs_desc']);
			$post['sec_image'] = imageUpload('secimage', 'uploads/product/');
			$post['image_url_one'] = imageUpload('img_one', 'uploads/product/');
			$post['image_url_two'] = imageUpload('img_two', 'uploads/product/');
			$productId = $this->CommonModal->insertRowReturnIdWithClean("product", $post);
			foreach ($cat_id  as $cat) {
				if ($cat != '') {
					$this->CommonModal->insertRowReturnId('product_category', array('product_id' => $productId, 'category_id' => $cat));
				}
			}
			for ($i = 0; $i <= count($get['specs_title']); $i++) {
				if ($get['specs_title'][$i] != '') {
					$this->CommonModal->insertRowReturnId('product_specs', array('product_id' => $productId, 'specs_title' => $get['specs_title'][$i], 'specs_desc' => $get['specs_desc'][$i]));
				}
			}
			if ($productId) {
				$this->session->set_flashdata('msg', 'Product  Add successfully');
				$this->session->set_flashdata('msg_class', 'alert-success');
			} else {
				$this->session->set_flashdata('msg', 'Something went wrong Please try again!!');
				$this->session->set_flashdata('msg_class', 'alert-danger');
			}
			redirect(base_url() . 'admin_Dashboard/products');
		} else {
			$this->load->view('admin/add_products', $data);
		}
	}
	public function filterData()
	{
		$category = $this->input->post('category');
		$data['city'] = $this->CommonModal->getRowByIdInOrder('category', array('parent_id' => $category), 'name', 'asc');
		$this->load->view('get_subcate', $data);
	}
	public function edit_productsimg($product_id = null)
	{
		if ($product_id != '') {
			$data['favicon'] = base_url() . 'assets/images/favicon.png';
			$data['title'] = " Product Images";
			if (count($_POST) > 0) {
				for ($i = 0; $i <= count($_FILES['img']['name']); $i++) {
					if ($_FILES['img']['name'][$i] != '') {
						$_FILES['images'] = array('name' => $_FILES['img']['name'][$i], 'full_path' => $_FILES['img']['full_path'][$i], 'type' => $_FILES['img']['type'][$i], 'tmp_name' => $_FILES['img']['tmp_name'][$i], 'error' => $_FILES['img']['error'][$i], 'size' => $_FILES['img']['size'][$i]);
						$post['image_file'] = "uploads/product/".imageUpload('images', "uploads/product/");
						$post['product_id'] = $product_id;
						$this->CommonModal->insertRowReturnId('product_images', $post);
					}
				}
				redirect(base_url() . 'admin_Dashboard/edit_productsimg/' . $product_id);
				exit();
			} else {
				$data['product'] = $this->CommonModal->getRowById('product', 'id', $product_id);
				$data['productimg'] = $this->CommonModal->getRowById('product_images', 'product_id', $product_id);
				$this->load->view('admin/edit_productsimg', $data);
			}
		} else {
			redirect('/');
		}
	}
	public function deleteproductimg($id)
	{
		$product_ins = $this->CommonModal->deleteRowById('product_images', array('id' => $id));
		if ($product_ins) {
			$this->session->set_userdata('msg', '<div class="alert alert-success">Product Image deleted successfully</div>');
		} else {
			$this->session->set_userdata('msg', '<div class="alert alert-success">Server error. Plase try again later.</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function edit_variants($product_id = null)
	{
		if ($product_id != '') {
			$data['favicon'] = base_url() . 'assets/images/favicon.png';
			$data['title'] = " Product Variants";
			if (count($_POST) > 0) {
				$post = $this->input->post();
				$post['product_id'] = $product_id;
				$option = $this->CommonModal->getRowById('pp_product_option_label', 'id', $post['option_values']);
				$post['option_values'] = json_encode($option);
				$this->CommonModal->insertRowReturnId('product_variants', $post);
				redirect(base_url() . 'admin_Dashboard/edit_variants/' . $product_id);
				exit();
			} else {
				$data['size'] = $this->CommonModal->getAllRows('pp_product_option_label');
				$data['productvar'] = $this->CommonModal->getRowById('product_variants', 'product_id', $product_id);
				$this->load->view('admin/edit_variants', $data);
			}
		} else {
			redirect('/');
		}
	}
	public function deletevariants($id)
	{
		$product_ins = $this->CommonModal->deleteRowById('product_variants', array('id' => $id));
		if ($product_ins) {
			$this->session->set_userdata('msg', '<div class="alert alert-success">Product Variant deleted successfully</div>');
		} else {
			$this->session->set_userdata('msg', '<div class="alert alert-success">Server error. Plase try again later.</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function deleteproducts($id)
	{
		$product_ins = $this->CommonModal->deleteRowById('product', array('id' => $id));
		if ($product_ins) {
			$this->session->set_userdata('msg', '<div class="alert alert-success">Product deleted successfully</div>');
		} else {
			$this->session->set_userdata('msg', '<div class="alert alert-success">Server error. Plase try again later.</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function deletecustomer($id)
	{
		$product_ins = $this->CommonModal->deleteRowById('customer', array('user_id' => $id));
		if ($product_ins) {
			$this->session->set_userdata('msg', '<div class="alert alert-success">User deleted successfully</div>');
		} else {
			$this->session->set_userdata('msg', '<div class="alert alert-success">Server error. Plase try again later.</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function deletereview($id)
	{
		$product_ins = $this->CommonModal->deleteRowById('product_review', array('id' => $id));
		if ($product_ins) {
			$this->session->set_userdata('msg', '<div class="alert alert-success">Product review deleted successfully</div>');
		} else {
			$this->session->set_userdata('msg', '<div class="alert alert-success">Server error. Plase try again later.</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function edit_products($product_id = null)
	{
		$data['title'] = 'Update Product';
		$data['tag'] = 'edit';
		$data['product'] = $this->CommonModal->getSingleRowById('product', array('id' => $product_id));
		$data['category'] = $this->CommonModal->getRowById('category', 'parent_id', 0);
		$data['specs'] = $this->CommonModal->getRowById('product_specs', 'product_id', $product_id);
		$data['catelist'] = $this->CommonModal->getRowById('product_category', 'product_id', $product_id);
		$c = [];
		foreach ($data['catelist'] as $cated) {
			$c[] = $cated['category_id'];
		}
		$data['catlist'] = $c;

		$BdID = $this->input->get('BdID');
		$pro_i = $this->input->get('pro_i');
		if (decryptId($BdID) != '') {
			$delete = $this->CommonModal->deleteRowById('product_specs', array('specs_id' => decryptId($BdID)));
			redirect('admin_Dashboard/edit_products/' . $pro_i);
			exit;
		}
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$post['categories'] = json_encode($post['cate']);
			$get['specs_title'] = $post['specs_title'];
			$get['specs_desc'] = $post['specs_desc'];
			unset($post['cate']);
			unset($post['specs_title']);
			unset($post['specs_desc']);
			$sec_image = $post['sec_image'];
			if ($_FILES['secimage']['name'] != '') {
				$img = imageUpload('secimage', 'uploads/product/');
				$post['sec_image'] = $img;
				if ($sec_image != "") {
					unlink('uploads/product/' . $sec_image);
				}
			}
			$image_url_one = $post['image_url_one'];
			$image_url_two = $post['image_url_two'];
			if ($_FILES['img_one']['name'] != '') {
				$img = imageUpload('img_one', 'uploads/product/');
				$post['image_url_one'] = $img;
				if ($image_url_one != "") {
					unlink('uploads/product/' . $image_url_one);
				}
			}
			if ($_FILES['img_two']['name'] != '') {
				$img = imageUpload('img_two', 'uploads/product/');
				$post['image_url_two'] = $img;
				if ($image_url_two != "") {
					unlink('uploads/product/' . $image_url_two);
				}
			}
			$product_ins = $this->CommonModal->updateRowById('product', 'id', $product_id, $post);
			for ($i = 0; $i <= count($get['specs_title']); $i++) {
				if ($get['specs_title'][$i] != '') {
					$this->CommonModal->insertRowReturnId('product_specs', array('product_id' => $product_id, 'specs_title' => $get['specs_title'][$i], 'specs_desc' => $get['specs_desc'][$i]));
				}
			}
			if ($product_ins) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Product Updated successfully</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Server error. Plase try again later.</div>');
			}
			redirect(base_url('admin_Dashboard/products'));
		} else {
			$this->load->view('admin/add_products', $data);
		}
	}
	public function edit_products_specs($specs_id)
	{
		$data['title'] = 'Update Product specs';
		$data['specs'] = $this->CommonModal->getSingleRowById('product_specs', array('specs_id' => $specs_id));
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$product_ins = $this->CommonModal->updateRowById('product_specs', 'specs_id', $specs_id, $post);
			if ($product_ins) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Product Specs Updated successfully</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Server error. Plase try again later.</div>');
			}
			redirect(base_url('admin_Dashboard/edit_products/' . $data['specs']['product_id']));
		} else {
			$this->load->view('admin/products_specs_update', $data);
		}
	}
	public function order_management()
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Orders History";
		$data['checkout'] = $this->CommonModal->getAllRows('checkout');
		$this->load->view('admin/order_management', $data);
	}
	public function customer()
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Customer's List";
		$data['customer'] = $this->CommonModal->getAllRows('customer');
		$this->load->view('admin/customer', $data);
	}
	public function order_view($id)
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Order details";
		$data['order_details'] = $this->CommonModal->getSingleRowById('checkout', array('id' => $id));
		$data['order_product'] = $this->CommonModal->getRowById('checkout_product', 'checkoutid', $id);
		$this->load->view('admin/order_view', $data);
	}
	public function product_review()
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Product Review";
		$data['product_review'] = $this->CommonModal->getAllRows('product_review');
		$this->load->view('admin/product_review', $data);
	}
	public function logout()
	{
		$this->session->unset_userdata('admin_id');
		redirect('Admin');
	}
	public function promocode()
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "  Promocode";
		$data['promocode'] = $this->CommonModal->getAllRows('promocode');
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$savedata = $this->CommonModal->insertRowReturnId('promocode', $post);
			if ($savedata) {
				$this->session->set_flashdata('msg', 'promocode added Sucessfully');
				$this->session->set_flashdata('msg_class', 'alert-success');;
			} else {
				$this->session->set_userdata('msg', 'Something went Wrong. please try again later  ');
			}
			redirect(base_url('admin_Dashboard/promocode'));
		} else {
			$this->load->view('admin/promocode', $data);
		}
	}
	public function deletepromocode($pid)
	{
		if ($this->CommonModal->deleteRowById('promocode', array('pid' => $pid))) {
			$this->session->set_flashdata('msg', 'promocode Delete successfully');
			$this->session->set_flashdata('msg_class', 'alert-success');
		} else {
			$this->session->set_flashdata('msg', 'promocode not Delete Please try again!!');
			$this->session->set_flashdata('msg_class', 'alert-danger');
		}
		redirect('admin_Dashboard/promocode');
	}
}
