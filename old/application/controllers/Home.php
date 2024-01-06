<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->contact = $this->CommonModal->getSingleRowById('contact_details', ['cid' => 1]);
	}
	public function index()
	{
		$data['category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '1', 'parent_id' => '0']);
		$data['other_category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '0', 'parent_id' => '0']);
		$data['subcategory'] = $this->CommonModal->getRowById('category', 'is_visible', '1');
		$data['policylinks'] = $this->CommonModal->getAllRows('policy');
		$data['title'] = 'Papa Plants - connecting nature';
		$data['description'] = 'Discover a world of natural beauty at PapaPlants - your ultimate destination for a diverse selection of premium plants. Explore a wide range of indoor and outdoor plants, expertly curated for plant enthusiasts of all levels. Transform your space with vibrant greenery while contributing to a cleaner, greener environment. Shop now and bring the serenity of nature into your life with PapaPlants.';
		$data['keywords'] = 'Plants for sale, Indoor plants, Outdoor plants, Plant care, Garden essentials, Sustainable gardening, Green living, Eco-friendly plants, Plant enthusiasts, Premium plants, Botanical decor, Natural beauty, Gardening supplies, Plant variety, Horticulture, Organic gardening, Plant lovers, Urban gardening, Biodiversity, Plant aesthetics';
		$data['author'] = 'PapaPlants - connecting nature';

		$this->load->view('home', $data);
	}
	public function products($category = null, $sub_category = null, $page = 1)
	{
		$data['category_id'] = $category;
		$data['sub_category_id'] = $sub_category;
		$data['policylinks'] = $this->CommonModal->getAllRows('policy');
		$this->load->library('pagination');
		$config['base_url'] = base_url('home/products');
		$config['per_page'] = 12;
		$config['total_rows'] = $this->CommonModal->getTotalRows('product');
		$this->pagination->initialize($config);
		$data['product'] = $this->CommonModal->getAllProductsByPagination($config['per_page'], $page, 'product');
		$data['category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '1', 'parent_id' => '0']);
		$data['other_category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '0', 'parent_id' => '0']);
		$data['sub_category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '0']);
		$data['cat'] = $this->CommonModal->getSingleRowById('category', ['meta_url' => $category]);

		$data['title'] = @$data['cat']['name'] . ' plants | PapaPlants';
		$data['description'] = 'Discover a world of natural beauty at PapaPlants - your ultimate destination for a diverse selection of premium plants. Explore a wide range of indoor and outdoor plants, expertly curated for plant enthusiasts of all levels. Transform your space with vibrant greenery while contributing to a cleaner, greener environment. Shop now and bring the serenity of nature into your life with PapaPlants.';
		$data['keywords'] = 'Plants for sale, Indoor plants, Outdoor plants, Plant care, Garden essentials, Sustainable gardening, Green living, Eco-friendly plants, Plant enthusiasts, Premium plants, Botanical decor, Natural beauty, Gardening supplies, Plant variety, Horticulture, Organic gardening, Plant lovers, Urban gardening, Biodiversity, Plant aesthetics';
		$data['author'] = 'PapaPlants - connecting nature';
		$this->load->view('products', $data);
	}
	public function about()
	{
		$data['category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '1', 'parent_id' => '0']);
		$data['other_category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '0', 'parent_id' => '0']);
		$data['subcategory'] = $this->CommonModal->getRowById('category', 'is_visible', '1');
		$data['policylinks'] = $this->CommonModal->getAllRows('policy');

		$data['title'] = 'About Us | Papa Plants';
		$data['description'] = 'Discover a world of natural beauty at PapaPlants - your ultimate destination for a diverse selection of premium plants. Explore a wide range of indoor and outdoor plants, expertly curated for plant enthusiasts of all levels. Transform your space with vibrant greenery while contributing to a cleaner, greener environment. Shop now and bring the serenity of nature into your life with PapaPlants.';
		$data['keywords'] = 'Plants for sale, Indoor plants, Outdoor plants, Plant care, Garden essentials, Sustainable gardening, Green living, Eco-friendly plants, Plant enthusiasts, Premium plants, Botanical decor, Natural beauty, Gardening supplies, Plant variety, Horticulture, Organic gardening, Plant lovers, Urban gardening, Biodiversity, Plant aesthetics';
		$data['author'] = 'PapaPlants - connecting nature';
		$this->load->view('about', $data);
	}
	public function contact()
	{
		$data['policylinks'] = $this->CommonModal->getAllRows('policy');
		$data['title'] = 'Contact Us | Papaplants';
		$data['description'] = 'Discover a world of natural beauty at PapaPlants - your ultimate destination for a diverse selection of premium plants. Explore a wide range of indoor and outdoor plants, expertly curated for plant enthusiasts of all levels. Transform your space with vibrant greenery while contributing to a cleaner, greener environment. Shop now and bring the serenity of nature into your life with PapaPlants.';
		$data['keywords'] = 'Plants for sale, Indoor plants, Outdoor plants, Plant care, Garden essentials, Sustainable gardening, Green living, Eco-friendly plants, Plant enthusiasts, Premium plants, Botanical decor, Natural beauty, Gardening supplies, Plant variety, Horticulture, Organic gardening, Plant lovers, Urban gardening, Biodiversity, Plant aesthetics';
		$data['author'] = 'PapaPlants - connecting nature';
		$data['category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '1', 'parent_id' => '0']);
		$data['other_category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '0', 'parent_id' => '0']);
		$data['subcategory'] = $this->CommonModal->getRowById('category', 'is_visible', '1');

		if (count($_POST) > 0) {
			$post = $this->input->post();
			$ins = $this->CommonModal->insertRow('contact_query', $post);
			if ($ins) {
				$this->session->set_userdata('msg', '<h6 class="alert alert-success">Your query is successfully submit. We will contact you as soon as possible.</h6>');
			} else {
				$this->session->set_userdata('msg', '<h6 class="alert alert-danger">We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.');
			}
		} else {
		}
		$this->load->view('contact', $data);
	}
	public function product_category($id)
	{
		$data['policylinks'] = $this->CommonModal->getAllRows('policy');
		$data['category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '1', 'parent_id' => '0']);
		$data['other_category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '0', 'parent_id' => '0']);
		$data['product'] = $this->CommonModal->getRowById('product', 'cat_id', $id);
		$data['cat'] = $this->CommonModal->getSingleRowById('category', ['id' => $id]);
		$data['product'] = $this->CommonModal->getSingleRowById('category', ['id' => $id]);

		$data['title'] = $data['cat']['name'] . ' plants | PapaPlants';
		$data['description'] = 'Discover a world of natural beauty at PapaPlants - your ultimate destination for a diverse selection of premium plants. Explore a wide range of indoor and outdoor plants, expertly curated for plant enthusiasts of all levels. Transform your space with vibrant greenery while contributing to a cleaner, greener environment. Shop now and bring the serenity of nature into your life with PapaPlants.';
		$data['keywords'] = 'Plants for sale, Indoor plants, Outdoor plants, Plant care, Garden essentials, Sustainable gardening, Green living, Eco-friendly plants, Plant enthusiasts, Premium plants, Botanical decor, Natural beauty, Gardening supplies, Plant variety, Horticulture, Organic gardening, Plant lovers, Urban gardening, Biodiversity, Plant aesthetics';
		$data['author'] = 'PapaPlants - connecting nature';

		$this->load->view('products-category', $data);
	}
	// aditional sections
	public function product_description($product_id)
	{
		$data['category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '1', 'parent_id' => '0']);
		$data['other_category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '0', 'parent_id' => '0']);
		$data['product_desc'] = $this->CommonModal->getSingleRowById('product', ['meta_url' => $product_id]);

		$data['pro_category'] = $this->CommonModal->runQuery("SELECT * FROM `pp_category` JOIN `pp_product_category` ON `pp_category`.`id`=`pp_product_category`.`category_id` WHERE  `pp_product_category`.`product_id`= '" . $data['product_desc']['id'] . "'");
		$data['pro_image'] = $this->CommonModal->getRowByMoreId('product_images', array('product_id' => $data['product_desc']['id']));
		$data['policylinks'] = $this->CommonModal->getAllRows('policy');
		$data['title'] = $data['product_desc']['name'] . ' | Papaplants';
		$data['description'] = 'Discover a world of natural beauty at PapaPlants - your ultimate destination for a diverse selection of premium plants. Explore a wide range of indoor and outdoor plants, expertly curated for plant enthusiasts of all levels. Transform your space with vibrant greenery while contributing to a cleaner, greener environment. Shop now and bring the serenity of nature into your life with PapaPlants.';
		$data['keywords'] = 'Plants for sale, Indoor plants, Outdoor plants, Plant care, Garden essentials, Sustainable gardening, Green living, Eco-friendly plants, Plant enthusiasts, Premium plants, Botanical decor, Natural beauty, Gardening supplies, Plant variety, Horticulture, Organic gardening, Plant lovers, Urban gardening, Biodiversity, Plant aesthetics';
		$data['author'] = 'PapaPlants - connecting nature';
		$this->load->view('product-description', $data);
	}
	public function cart()
	{
		$data['category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '1', 'parent_id' => '0']);
		$data['other_category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '0', 'parent_id' => '0']);
		$data['subcategory'] = $this->CommonModal->getRowById('category', 'is_visible', '1');
		$data['policylinks'] = $this->CommonModal->getAllRows('policy');
		$data['title'] = 'Papa Plants';
		$data['description'] = 'Discover a world of natural beauty at PapaPlants - your ultimate destination for a diverse selection of premium plants. Explore a wide range of indoor and outdoor plants, expertly curated for plant enthusiasts of all levels. Transform your space with vibrant greenery while contributing to a cleaner, greener environment. Shop now and bring the serenity of nature into your life with PapaPlants.';
		$data['keywords'] = 'Plants for sale, Indoor plants, Outdoor plants, Plant care, Garden essentials, Sustainable gardening, Green living, Eco-friendly plants, Plant enthusiasts, Premium plants, Botanical decor, Natural beauty, Gardening supplies, Plant variety, Horticulture, Organic gardening, Plant lovers, Urban gardening, Biodiversity, Plant aesthetics';
		$data['author'] = 'PapaPlants - connecting nature';
		$this->load->view('cart', $data);
	}

	public function search($category = null, $sub_category = null, $page = 1)
	{
		$data['category_id'] = $category;
		$data['sub_category_id'] = $sub_category;
		$data['policylinks'] = $this->CommonModal->getAllRows('policy');
		$this->load->library('pagination');
		$config['base_url'] = base_url('home/products');
		$config['per_page'] = 12;
		$config['total_rows'] = $this->CommonModal->getTotalRows('product');
		$this->pagination->initialize($config);
		$data['product'] = $this->CommonModal->getAllProductsByPagination($config['per_page'], $page, 'product');
		$data['category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '1', 'parent_id' => '0']);
		$data['other_category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '0', 'parent_id' => '0']);
		$data['sub_category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '0']);
		$data['cat'] = $this->CommonModal->getSingleRowById('category', ['meta_url' => $category]);
		$data['title'] = "Search | Papa Plants";
		$data['description'] = 'Discover a world of natural beauty at PapaPlants - your ultimate destination for a diverse selection of premium plants. Explore a wide range of indoor and outdoor plants, expertly curated for plant enthusiasts of all levels. Transform your space with vibrant greenery while contributing to a cleaner, greener environment. Shop now and bring the serenity of nature into your life with PapaPlants.';
		$data['keywords'] = 'Plants for sale, Indoor plants, Outdoor plants, Plant care, Garden essentials, Sustainable gardening, Green living, Eco-friendly plants, Plant enthusiasts, Premium plants, Botanical decor, Natural beauty, Gardening supplies, Plant variety, Horticulture, Organic gardening, Plant lovers, Urban gardening, Biodiversity, Plant aesthetics';
		$data['author'] = 'PapaPlants - connecting nature';

		$this->load->view('search', $data);
	}

	public function getSearchProducts()
	{
		$limit = $this->input->post('limit');
		$offset = $this->input->post('offset');
		$category = ((isset($_POST['category'])) ? $_POST['category'] : '');
		$subcategory = ((isset($_POST['subcategory'])) ? $_POST['subcategory'] : '');
		$query = "SELECT *,`pp_product`.`id` as id,`pp_product_category`.`id` as 'catid' FROM `pp_product` ";
		if (($category != '') || ($subcategory != '')) {
			$query .= " INNER JOIN  `pp_product_category` ON `pp_product`.`id`=`pp_product_category`.`product_id` WHERE ";
		}
		if (($category != '') && ($subcategory != '')) {
			$merged_array = array_merge($category, $subcategory);
			$query .= "`pp_product_category`.`category_id` IN('" . implode("','", $merged_array) . "')";
		} elseif ($category != '') {
			$merged_array = $category;
			$query .= " `pp_product_category`.`category_id` IN('" . implode("','", $merged_array) . "')";
		} elseif ($subcategory != '') {
			$merged_array = $subcategory;
			$query .= " `pp_product_category`.`category_id` IN('" . implode("','", $merged_array) . "')";
		} else {
		}
		$query .= ' LIMIT ' . $limit . ' OFFSET ' . $offset;

		$data['all_data'] = $this->CommonModal->runQuery($query);

		$data_result['result'] = $this->load->view('single_product', $data, true);
		$data_result['offset'] = $offset  + $limit;
		$data_result['query'] = $query;
		echo json_encode($data_result);
	}

	public function checkout()
	{
		$data['category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '1', 'parent_id' => '0']);
		$data['other_category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '0', 'parent_id' => '0']);
		$data['subcategory'] = $this->CommonModal->getRowById('category', 'is_visible', '1');
		$data['policylinks'] = $this->CommonModal->getAllRows('policy');
		$data['title'] = 'Checkout | Papa Plants';
		$data['description'] = 'Discover a world of natural beauty at PapaPlants - your ultimate destination for a diverse selection of premium plants. Explore a wide range of indoor and outdoor plants, expertly curated for plant enthusiasts of all levels. Transform your space with vibrant greenery while contributing to a cleaner, greener environment. Shop now and bring the serenity of nature into your life with PapaPlants.';
		$data['keywords'] = 'Plants for sale, Indoor plants, Outdoor plants, Plant care, Garden essentials, Sustainable gardening, Green living, Eco-friendly plants, Plant enthusiasts, Premium plants, Botanical decor, Natural beauty, Gardening supplies, Plant variety, Horticulture, Organic gardening, Plant lovers, Urban gardening, Biodiversity, Plant aesthetics';
		$data['author'] = 'PapaPlants - connecting nature';
		$this->load->view('checkout', $data);
	}
	public function checkout_payment()
	{
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$post['user_id'] = sessionId('login_user_id');
			$ins = $this->CommonModal->insertRowReturnId('checkout', $post);
			$amount = 0;
			foreach ($this->cart->contents() as $items) {
				$product_data = ['checkoutid' => $ins, 'product_id' => $items['id'], 'product_img' => $items['image'], 'product_name' => $items['name'], 'product_price' => $items['price'], 'product_quantity' => $items['qty'], 'total_pro_amt' => ($items['qty'] * $items['price'])];
				$amount += ($items['qty'] * $items['price']);
				$ins_pro = $this->CommonModal->insertRowReturnId('checkout_product', $product_data);
			}
			if ($ins) {
				$this->session->set_userdata('checkout_id', $ins);
				$this->session->set_userdata('msg', '<h6 class="alert alert-success">Your order is initiated, Complete your payment to confirm your order</h6>');
				// redirect(base_url('razorpay'));
				$data['checkout'] = $ins;
				$data['amount'] = $amount;
				$data['name'] = $post['first_name'] . ' ' . $post['last_name'];
				$data['email'] = $post['email'];
				$data['contact'] = $post['number'];
				$data['address'] = $post['address'] . ' ' . $post['state'] . ' ' . $post['city'];
				$this->load->view('razorpay/checkout_redirect', $data);
			} else {
				$this->session->set_userdata('msg', '<h6 class="alert alert-danger">We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.');
			}
		} else {
		}
	}
	public function login()
	{
		$data['category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '1', 'parent_id' => '0']);
		$data['other_category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '0', 'parent_id' => '0']);
		$data['subcategory'] = $this->CommonModal->getRowById('category', 'is_visible', '1');
		$data['policylinks'] = $this->CommonModal->getAllRows('policy');
		$data['title'] = 'User Login | Papa Plants';
		$data['description'] = 'Discover a world of natural beauty at PapaPlants - your ultimate destination for a diverse selection of premium plants. Explore a wide range of indoor and outdoor plants, expertly curated for plant enthusiasts of all levels. Transform your space with vibrant greenery while contributing to a cleaner, greener environment. Shop now and bring the serenity of nature into your life with PapaPlants.';
		$data['keywords'] = 'Plants for sale, Indoor plants, Outdoor plants, Plant care, Garden essentials, Sustainable gardening, Green living, Eco-friendly plants, Plant enthusiasts, Premium plants, Botanical decor, Natural beauty, Gardening supplies, Plant variety, Horticulture, Organic gardening, Plant lovers, Urban gardening, Biodiversity, Plant aesthetics';
		$data['author'] = 'PapaPlants - connecting nature';
		$this->load->view('login', $data);
	}
	public function filterData()
	{
		$limit = $this->input->post('limit');
		$offset = $this->input->post('offset');
		$searchkeywords = $this->input->post('searchkeywords');
		$category = ((isset($_POST['category'])) ? $_POST['category'] : '');
		$subcategory = ((isset($_POST['subcategory'])) ? $_POST['subcategory'] : '');
		if ($category != '') {
			$query = "SELECT *,`pp_product`.`id` as id,`pp_product_category`.`id` as 'catid' FROM `pp_product` ";
		} else {
			$query = "SELECT * FROM `pp_product` ";
		}

		if (($category != '') || ($subcategory != '')) {
			$query .= " INNER JOIN  `pp_product_category` ON `pp_product`.`id`=`pp_product_category`.`product_id`  ";
		}
		if (($category != '') && ($subcategory != '')) {
			$merged_array = array_merge($category, $subcategory);
			$query_row[] = "`pp_product_category`.`category_id` IN('" . implode("','", $merged_array) . "')";
		} elseif ($category != '') {
			$merged_array = $category;
			$query_row[] = " `pp_product_category`.`category_id` IN('" . implode("','", $merged_array) . "')";
		} elseif ($subcategory != '') {
			$merged_array = $subcategory;
			$query_row[] = " `pp_product_category`.`category_id` IN('" . implode("','", $merged_array) . "')";
		} else {
		}
		if ($searchkeywords != '') {
			$query_row[] = " `pp_product`.`name` LIKE '%" . $searchkeywords . "%' ";
		}
		$query .= ((count($query_row) > 0) ? ' WHERE ' . implode(' AND ', $query_row) : '') . ' ORDER BY  `pp_product`.`id` DESC';
		if ($searchkeywords != '') {
		} else {
			$query .= ' LIMIT ' . $limit . ' OFFSET ' . $offset;
		}

		$data['all_data'] = $this->CommonModal->runQuery($query);

		$data_result['result'] = $this->load->view('single_product', $data, true);
		$data_result['offset'] = $offset  + $limit;
		$data_result['query'] = $query;
		$data_result['count'] = count($data['all_data']);
		echo json_encode($data_result);
	}
	public function dashboard()
	{
		$data['category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '1', 'parent_id' => '0']);
		$data['other_category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '0', 'parent_id' => '0']);
		$data['subcategory'] = $this->CommonModal->getRowById('category', 'is_visible', '1');
		$data['checkout'] = $this->CommonModal->getRowByIdInOrder('checkout', ['user_id' => sessionId('login_user_id')], 'id', 'DESC');
		$data['policylinks'] = $this->CommonModal->getAllRows('policy');
		$data['title'] = 'Dashboard |Papa Plants';
		$data['description'] = 'Discover a world of natural beauty at PapaPlants - your ultimate destination for a diverse selection of premium plants. Explore a wide range of indoor and outdoor plants, expertly curated for plant enthusiasts of all levels. Transform your space with vibrant greenery while contributing to a cleaner, greener environment. Shop now and bring the serenity of nature into your life with PapaPlants.';
		$data['keywords'] = 'Plants for sale, Indoor plants, Outdoor plants, Plant care, Garden essentials, Sustainable gardening, Green living, Eco-friendly plants, Plant enthusiasts, Premium plants, Botanical decor, Natural beauty, Gardening supplies, Plant variety, Horticulture, Organic gardening, Plant lovers, Urban gardening, Biodiversity, Plant aesthetics';
		$data['author'] = 'PapaPlants - connecting nature';
		$this->load->view('dashboard', $data);
	}
	public function policy($id)
	{
		$data['category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '1', 'parent_id' => '0']);
		$data['other_category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '0', 'parent_id' => '0']);
		$data['subcategory'] = $this->CommonModal->getRowById('category', 'is_visible', '1');
		$data['policy'] = $this->CommonModal->getSingleRowById('policy', ['id' => $id]);
		$data['policylinks'] = $this->CommonModal->getAllRows('policy');
		$data['title'] = $data['policy']['tag'] . ' | Papa Plants';
		$data['description'] = 'Discover a world of natural beauty at PapaPlants - your ultimate destination for a diverse selection of premium plants. Explore a wide range of indoor and outdoor plants, expertly curated for plant enthusiasts of all levels. Transform your space with vibrant greenery while contributing to a cleaner, greener environment. Shop now and bring the serenity of nature into your life with PapaPlants.';
		$data['keywords'] = 'Plants for sale, Indoor plants, Outdoor plants, Plant care, Garden essentials, Sustainable gardening, Green living, Eco-friendly plants, Plant enthusiasts, Premium plants, Botanical decor, Natural beauty, Gardening supplies, Plant variety, Horticulture, Organic gardening, Plant lovers, Urban gardening, Biodiversity, Plant aesthetics';
		$data['author'] = 'PapaPlants - connecting nature';
		$this->load->view('policy', $data);
	}
	public function all_products()
	{
		$data['category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '1', 'parent_id' => '0']);
		$data['other_category'] = $this->CommonModal->getRowByMoreId('category', ['is_visible' => '0', 'parent_id' => '0']);
		$data['subcategory'] = $this->CommonModal->getRowById('category', 'is_visible', '1');

		$data['title'] = 'Our product list | Papa Plants';
		$data['description'] = 'Discover a world of natural beauty at PapaPlants - your ultimate destination for a diverse selection of premium plants. Explore a wide range of indoor and outdoor plants, expertly curated for plant enthusiasts of all levels. Transform your space with vibrant greenery while contributing to a cleaner, greener environment. Shop now and bring the serenity of nature into your life with PapaPlants.';
		$data['keywords'] = 'Plants for sale, Indoor plants, Outdoor plants, Plant care, Garden essentials, Sustainable gardening, Green living, Eco-friendly plants, Plant enthusiasts, Premium plants, Botanical decor, Natural beauty, Gardening supplies, Plant variety, Horticulture, Organic gardening, Plant lovers, Urban gardening, Biodiversity, Plant aesthetics';
		$data['author'] = 'PapaPlants - connecting nature';
		$data['product'] = $this->CommonModal->getAllRows('product');
		$this->load->view('product_list', $data);
	}
	// public function putimage()
	// {
	// 	$products = $this->CommonModal->getAllRows('product');
	// 	if ($products != '') {
	// 		foreach ($products as $product) {
	// 			// if ($product['images'] != '') {
	// 			// 	$pimg = explode(',', $product['images']);
	// 			// 	$post = [];
	// 			// 	foreach ($pimg as $img) {
	// 			// 		$ext = pathinfo($img, PATHINFO_EXTENSION);
	// 			// 		$nm = time() . '.' . $ext;
	// 			// 		$url =  './uploads/product/' . $nm;
	// 			// 		file_put_contents($url, file_get_contents($img));
	// 			// 		$post['image_file'] = $nm;
	// 			// 		$post['product_id'] = $product['id'];
	// 			// 		echo $img . ' --- ' . $url . '<br>';
	// 			// 		$this->CommonModal->insertRowReturnId('product_images', $post);
	// 			// 	}
	// 			// }
	// 			if($product['price'] == ''){
	// 				$product_ins = $this->CommonModal->updateRowById('product', 'id', $product['id'], ['price'=>199]);
	// 			}


	// 		}
	// 	}
	// }

	public function logout()
	{
		$this->session->unset_userdata('login_user_id');
		redirect(base_url());
	}
}
