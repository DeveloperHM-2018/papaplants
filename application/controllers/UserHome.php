<?php

class UserHome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->profile = $this->CommonModel->getRowById('user_registration', 'user_id', $this->session->userdata('login_user_id'));
    }

    function __destruct()
    {
        $this->db->close();
    }

    public function index()
    {
        $data['banner'] = $this->CommonModel->getAllRowsInOrder('banner', 'banner_id', 'desc');
        $data['product'] = $this->CommonModel->getRowByOrderWithLimit('product', array('status' => '1'), 'product_id', 'DESC', '10');
        $data['productdesc'] = $this->CommonModel->getRowByOrderWithLimit('product', array('status' => '1'), 'product_id', 'DESC', '20');
        $data['featurepro'] = $this->CommonModel->getRowByOrderWithLimit('product', array('status' => '1', 'product_type' => '2'), 'product_id', 'DESC', '20');
        $data['cate'] = $this->CommonModel->getAllRowsInOrderWithLimit('category', '25', 'category_id', 'ASC');
        $data['title'] = 'Papa Plants';
        $this->load->view('home', $data);
    }

    public function product()
    {
        $cateid = $this->input->get('category');
        $data['cateid'] = decryptId($cateid);
        $data['search'] = $this->input->get('searchbox');
        $subcate  = $this->input->get('subcate');
        $data['subcateid'] = decryptId($subcate);
        $data['sidecategory'] = $this->CommonModel->getAllRowsInOrder('category', 'category_id', 'ASC');
        $data['subcategory'] = $this->CommonModel->getAllRowsInOrder('sub_category', 'category_id', 'desc');
        $data['title'] = ' Our product';
        $this->load->view('product', $data);
    }

    public function filterData()
    {
        $price = ((isset($_POST['price'])) ? $_POST['price'] : '');
        $search = ((isset($_POST['search'])) ? $_POST['search'] : '');
        $category = ((isset($_POST['category'])) ? $_POST['category'] : '');
        $subcategory = ((isset($_POST['subcategory'])) ? $_POST['subcategory'] : '');
        $query = "SELECT * FROM `tbl_product` WHERE `status` = '1'";
        if (($search != '')  || ($category != '') || ($subcategory != '') || ($price != '')) {
            if ($search != '') {
                $query .= " AND `product_name` LIKE '%" . trim($search) . "%'  OR `sale_price` LIKE '%" . trim($search) . "%' OR `description` LIKE '%" . trim($search) . "%'  ";
            }
            if ($category != '') {
                $cate = implode("','", $category);
                $query .= " AND category_id IN('" . $cate . "')";
            }
            if ($subcategory != '') {
                if (!empty($subcategory)) {
                    $query_new = "";
                    foreach ($subcategory as $subcategory_list) {
                        $query_new .= " JSON_SEARCH(sub_category_id, 'one', '$subcategory_list') IS NOT NULL OR";
                    }
                    $query .= " AND " . lastReplace("OR", "", $query_new);
                }
            }

            if ($price != '') {
                if ($price == 0) {
                    $query .= " ORDER BY `sale_price` ASC";
                } else {
                    $query .= " ORDER BY `sale_price` DESC";
                }
            }
        }
        //  echo $query;
        $data['all_data'] = $this->CommonModel->runQuery($query);
        $this->load->view('get_product', $data);
    }

    public function product_details($id, $title)
    {
        $data['products_image'] = $this->CommonModel->getRowById('product_image', 'product_id', decryptId($id));
        $table = "tbl_product";
        $data['details'] = $this->CommonModel->getRowById($table,  'product_id', decryptId($id))[0];
        $data['title'] =  $data['details']['product_name'] . ' | ' . APP_NAME_TITLE;
        $this->load->view('product-details', $data);
    }

    public function orders()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect();
        }
        $data['login_user'] = $this->session->userdata();
        $data['orderDetails'] = $this->CommonModel->getRowByIdInOrder('book_product', array('user_id' => $this->session->userdata('login_user_id')), 'product_book_id', 'DESC');
        $data['cancelOrderDetails'] = $this->CommonModel->getRowByIdInOrder('book_product', 'user_id = ' . $this->session->userdata('login_user_id') . ' AND booking_status = "2" ', 'product_book_id', 'DESC');
        $data['checkoutnum'] = $this->CommonModel->getNumRows('book_product', array('user_id' => $this->session->userdata('login_user_id')));
        $data['title'] = ' Profile - ' . APP_NAME_TITLE;
        $data['logo'] = 'assets/logo.png';
        $this->load->view('order-history', $data);
    }

    public function profile()
    {
        // echo '<pre>';
        // print_r($this->profile);
        if (!$this->session->has_userdata('login_user_id')) {
            redirect(base_url());
        }
        $data['login_user'] = $this->session->userdata();
        $data['profiledata'] = $this->CommonModel->getRowById('user_registration', 'user_id', $this->session->userdata('login_user_id'))[0];
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $savedata = $this->CommonModel->updateRowById('user_registration', 'user_id', $this->session->userdata('login_user_id'), $post);
            if ($savedata) {
                $this->session->set_flashdata('msg', 'Profile Updated Sucessfully');
                $this->session->set_flashdata('msg_class', 'alert-success');
            } else {
                $this->session->set_userdata('msg', 'Profile Updated Sucessfully ');
                $this->session->set_flashdata('msg_class', 'alert-danger');
            }
            redirect(base_url('profile'));
        } else {
            $data['title'] = 'Profile - ' . APP_NAME_TITLE;
            $data['logo'] = 'assets/logo.png';
            $this->load->view('profile', $data);
        }
    }

    public function cancelorder()
    {
        $id = $this->input->post('id');
        $upd = $this->CommonModel->updateRowById('checkout', 'id', $id, array('status' => '2'));
        if ($upd) {
            echo '0';
        } else {
            echo '1';
        }
    }

    public function returnorder()
    {
        $id = $this->input->post('id');
        $upd = $this->CommonModel->updateRowById('checkout', 'id', $id, array('status' => '5'));
        if ($upd) {
            return '0';
        } else {
            return '1';
        }
    }

    public function orderDetails($checkoutID  = true)
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect(base_url());
        }
        $data['login_user'] = $this->session->userdata();
        $data['orderDetails'] = $this->CommonModel->getRowByIdInOrder('checkout', array('user_id' => $this->session->userdata('login_user_id')), 'id', 'DESC');
        $data['orderProductDetails'] = $this->CommonModel->getRowById('checkout_product', 'product_book_id', $checkoutID);
        $data['title'] = 'Order Details - ' . APP_NAME_TITLE;
        $data['logo'] = 'assets/logo.png';
        $this->load->view('orderDetails', $data);
    }

    public function checkPromo()
    {
        $promocode = $this->input->post('promocode');
        echo json_encode($this->CommonModel->getRowById('tbl_promocode', 'promocode', $promocode));
    }

    public function orderInvoice($checkoutID  = true)
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect(base_url());
        }
        $data['orderDetails'] = $this->CommonModel->getRowById('checkout', 'id', $checkoutID);
        $data['orderProductDetails'] = $this->CommonModel->getRowById('checkout_product', 'product_book_id', $checkoutID);
        $data['title'] = ' Your Order Invoice - ' . APP_NAME_TITLE;
        $data['logo'] = 'assets/logo.png';
        $this->load->view('orderInvoice', $data);
    }

    public function checkout()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect('login');
        }

        if ($this->cart->total_items() < 1) {
            redirect();
        }

        $data['login'] = $this->CommonModel->getRowById('user_registration', 'user_id', $this->session->userdata('login_user_id'));
        $data['state_list'] = $this->CommonModel->getAllRows('tbl_state');
        $data['promocode'] = $this->CommonModel->getAllRows('promocode');
        $data['delivery'] = $this->CommonModel->getAllRows('tbl_delivery_charge')[0];
        $data['title'] = 'Checkout - ' . APP_NAME_TITLE;
        if (count($_POST) > 0) {
            if ($this->input->post('final_amount') > 0) {
                $postdata = $this->input->post();
                $user_id = $this->input->post('user_id');
                $state = $this->input->post('state');
                $city = $this->input->post('city');
                $postal_code = $this->input->post('postal_code');
                $address = $this->input->post('address');
                $data = array('state' => $state, 'city' => $city, 'postal_code' => $postal_code, 'address' => $address);
                $this->CommonModel->updateRowById('user_registration', 'user_id', $user_id, $data);
                $orderId   = orderIdGenerateUser();
                $postdata['order_id']  = $orderId;
                $postdata['booking_date'] = setDateOnly();
                $post = $this->CommonModel->insertRowReturnId('tbl_book_product', $postdata);
                foreach ($this->cart->contents() as $items) :
                    $mydata[]  = array(
                        'create_date' => setDateTime(),
                        'order_id' => $orderId,
                        'no_of_items' => $items['qty'],
                        'base_price' => $items['price'],
                        'user_price' => $items['price'],
                        'booking_price' => ($items['price'] * $items['qty']),
                        'product_id' => $items['id'],
                    );
                endforeach;
                $insert2 = $this->CommonModel->insertRowInBatch('tbl_book_item', $mydata);
                if ($post != '') {
                    if ($this->input->post('payment_mode') == '1') {
                        redirect(base_url('booking-status'));
                        exit();
                    }
                } else {
                    echo 'Check Form Data';
                }
            }
        } else {
            $this->load->view('checkout', $data);
        }
    }

    public function booking_status()
    {
        if (count($this->cart->contents()) > 0) {
            $data['logo'] = 'assets/logo.png';
            $data['title'] = 'Payment Status - ' . APP_NAME_TITLE;
            $msg = '';
            $msg .= '<img src="assets/img/order.png" alt="Booking" style="max-width: 250px;"/>';
            $msg .= "<p>We're prepping your order.You will be notified regarding the order shipment shortly .<br/>
            Till then happy shopping</p>";
            $msg .= "<br/>";
            $data['message'] = $msg;
            $this->load->view('payment_msg', $data);
            $this->cart->destroy();
        } else {
            redirect(base_url());
        }
    }

    public function getcity()
    {
        $state = $this->input->post('state');
        $getState = $this->CommonModel->getSingleRowById('tbl_state', "state_name = '$state'");
        $data['city'] = $this->CommonModel->getRowByIdInOrder('tbl_city', array('state_id' => $getState['state_id']), 'city_name', 'asc');
        $this->load->view('dropdown', $data);
    }

    public function contact()
    {
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $insert = $this->CommonModel->insertRowReturnId('contact_query', $post);
            if ($insert) {
                $this->session->set_userdata('msg', '<div class="alert alert-success">Your query is successfully submit. We will contact you as soon as possible.</div>');
            } else {
                $this->session->set_userdata('msg', '<div class="alert alert-danger">We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.</div>');
            }
        } else {
        }
        $data['title'] = 'Contact Us';
        $this->load->view('contact', $data);
    }

    public function privacy_policy()
    {
        $data['pp'] = $this->CommonModel->getRowById('tbl_policy', 'ppid', '1');
        $data['title'] = 'Privacy Policy - ' . APP_NAME_TITLE;
        $this->load->view('privacy-policy', $data);
    }

    public function shipping_policy()
    {
        $data['pp'] = $this->CommonModel->getRowById('tbl_policy', 'ppid', '3');
        $data['title'] = 'Shipping Policy - ' . APP_NAME_TITLE;
        $this->load->view('shipping-policy', $data);
    }

    public function term_condition()
    {
        $data['pp'] = $this->CommonModel->getRowById('tbl_policy', 'ppid', '5');
        $data['title'] = 'Terms & Condition - ' . APP_NAME_TITLE;
        $this->load->view('term-condition', $data);
    }

    public function about()
    {
        $data['title'] = 'About Us - ' . APP_NAME_TITLE;
        $this->load->view('about', $data);
    }
}
