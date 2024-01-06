<?php

class Auth extends CI_Controller
{

    function __destruct()
    {
        $this->db->close();
    }

    public function register()
    {
        if ($this->session->has_userdata('login_user_id')) {
            redirect(base_url('profile'));
        }
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Register - ' . APP_NAME_TITLE;
        $data['state_list'] = $this->CommonModel->getAllRows('tbl_state');
        if (count($_POST) > 0) {
            $count = $this->CommonModel->getNumRows('user_registration', array('email_id' => $this->input->post('email_id'), 'contact_no' => $this->input->post('contact_no')));
            if ($count > 0) {
                $this->session->set_userdata('msg', '<h6 class="alert alert-warning">You have already registered with this email id or contact no.</h6>');
            } else {
                $post = $this->input->post();
                $otp =  rand(1000, 10000);
                if (OTP_ENABLE) {
                    $msg = "" . $otp . " is the verification code to log in to your account.";
                    sendOTP($post['contact_no'], $msg);
                }
                $this->session->set_userdata(array('user_name' => $post['name'], 'user_emailid' => $post['email_id'], 'user_contact' => $post['contact_no'], 'user_address' => $post['address'], 'user_area' => $post['area'], 'user_postal_code' => $post['postal_code'], 'user_state' => $post['state'], 'user_city' => $post['city'], 'user_otp' => $otp));

                redirect('verify-registration');
                exit();
            }
        } else {
        }
        $this->load->view('register', $data);
    }

    public function verify_registration()
    {
        if ($this->session->has_userdata('login_user_id')) {
            redirect(base_url('profile'));
        }
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Register - ' . APP_NAME_TITLE;

        $this->load->view('check-otp', $data);
    }

    public function check_verification()
    {
        $responce = [];
        $otp = $this->input->post('otp');

        if ($this->session->userdata('user_otp') == $otp) {

            $ins = $this->CommonModel->insertRow('user_registration', array('name' => sessionId('user_name'), 'email_id' => sessionId('user_emailid'), 'contact_no' => sessionId('user_contact'), 'address' => sessionId('user_address'), 'area' => sessionId('user_area'), 'postal_code' => sessionId('user_postal_code'), 'state' => sessionId('user_state'), 'city' => sessionId('user_city')));

            $login_data = $this->CommonModel->getSingleRowById('user_registration', array('contact_no' => sessionId('user_contact')));
            $session = $this->session->set_userdata(array('login_user_id' => $login_data['user_id'], 'login_user_name' => $login_data['name'], 'login_user_emailid' => $login_data['email_id'], 'login_user_contact' => $login_data['contact_no']));
            $responce['reg_msg'] = 'OTP verified';
            if (count($this->cart->contents()) > 0) {
                $responce['status'] = '3';
            } else {
                $responce['status'] = '1';
            }
        } else {
            $responce['reg_msg'] = 'Wrong OTP';
            $responce['status'] = '2';
        }

        echo json_encode($responce);
    }

    public function login()
    {
        if ($this->session->has_userdata('login_user_id')) {
            redirect(base_url('profile'));
        }
        $data['category'] = $this->CommonModel->getAllRowsInOrder('category', 'category_id', 'desc');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Login - ' . APP_NAME_TITLE;
        if (count($_POST) > 0) {
            extract($this->input->post());
            $table = "user_registration";
            $login_data = $this->CommonModel->getRowByOr($table, array('email_id' => $uname), array('contact_no' => $uname));
            if (!empty($login_data)) {
                if ($login_data[0]['password'] == $password) {
                    $session = $this->session->set_userdata(array('login_user_id' => $login_data[0]['user_id'], 'login_user_name' => $login_data[0]['name'], 'login_user_emailid' => $login_data[0]['email_id'], 'login_user_contact' => $login_data[0]['contact_no']));
                    if (count($this->cart->contents()) > 0) {
                        redirect(base_url('checkout'));
                    } else {
                        redirect(base_url('profile'));
                    }
                } else {
                    $this->session->set_userdata('loginError', '<h6 class="alert alert-warning">Wrong Password.</h6>');
                    redirect(base_url('login'));
                }
            } else {
                $this->session->set_flashdata('loginError', '<h6 class="alert alert-warning">Username or Password not match.</h6>');
                redirect(base_url('login'));
            }
        } else {
            if ($this->session->has_userdata('login_user_id')) {
                redirect(base_url('Web/profile'));
            }
        }
        $this->load->view('login', $data);
    }

    public function forgot_password()
    {
        $data['title'] = 'Forgot Password - ' . APP_NAME_TITLE;
        if (count($_POST) > 0) {
            extract($this->input->post());
            $email = $this->input->post('email');
            $table = "user_registration";
            $login_data = $this->CommonModel->getSingleRowById($table, array('email_id' => $email));
            if (!empty($login_data)) {
                $message = '<h6 style="margin: 0;
                font-size: 1.3em;
                color: rgb(80, 79, 79);
                font-family: Source Sans Pro;
                letter-spacing: 1px;">Hey there! </h6><br>
                <p style="margin: 0;
                font-size: 1.3em;
                color: rgb(80, 79, 79);
                font-family: Source Sans Pro;
                letter-spacing: 1px;">You Have Been Reset Your Password Sucessfully <br>
                 Your new Password is  - <span style=" color: #ffa800;
                  font-weight: 700;">' . $login_data['password'] . '</span> <br>
                  <p style="margin: 0;
                  padding: 4px;
                  color: #5892FF;
                  font-family: Source Sans Pro;
                  letter-spacing: 1px;">Click To login <a href="' . base_url() . 'login" style="text-decoration: none;
                color: #006573;
                font-weight: 600;"> ' . APP_NAME . '</a>
                  </p>
        ';
                mailmsg($email, 'Forgot Password  | From ' . APP_NAME, $message);
                $this->session->set_userdata('forget', '<span class="alert alert-success py-2 mt-2">Check your mail ID for Password</span>');
                redirect(base_url('login'));
            } else {
                $this->session->set_userdata('forget', '<span class="alert alert-danger py-2 mt-2">No username found</span>');
                redirect(base_url('forgot-password'));
            }
        } else {
            $this->load->view('forgot-password', $data);
        }
    }

    public function verify_otp()
    {
        $responce = [];
        $contactno = $this->input->post('contactno');
        $otp = $this->input->post('otp');
        $data = $this->CommonModel->getNumRows('user_registration', array('contact_no' => $contactno));
        if ($data == 0) {
            $responce['login_msg'] = 'Account Not found with this contact no.';
            $responce['status'] = '0';
        } elseif ($data == 1) {
            if ($this->session->userdata('otp') == $otp) {
                $login_data = $this->CommonModel->getSingleRowById('user_registration', array('contact_no' => $contactno));
                $session = $this->session->set_userdata(array('login_user_id' => $login_data['user_id'], 'login_user_name' => $login_data['name'], 'login_user_emailid' => $login_data['email_id'], 'login_user_contact' => $login_data['contact_no']));
                $this->session->unset_userdata('otp');
                $responce['login_msg'] = 'OTP verified';
                if (count($this->cart->contents()) > 0) {
                    $responce['status'] = '3';
                } else {
                    $responce['status'] = '1';
                }
            } else {
                $responce['login_msg'] = 'Please Enter Valid OTP';
                // $responce['login_msg'] = 'Wrong OTP' . $this->session->userdata('otp');
                $responce['status'] = '0';
            }
        } else {
            $responce['login_msg'] = 'Account Not found with this contact no.';
            $responce['status'] = '0';
        }
        echo json_encode($responce);
    }

    public function deleteUser()
    {
        echo json_encode(['status' => false, 'message' => 'Enter valid user id']);
    }

    public function get_otp()
    {
        $responce = [];
        $contactno = $this->input->post('contactno');
        $otp =  rand(1000, 10000);
        $data = $this->CommonModel->getNumRows('user_registration', array('contact_no' => $contactno));
        if ($data == 1) {
            $this->session->set_userdata('otp', $otp);
            $otp_msg = "";
            if (OTP_ENABLE) {
                $msg = "" . $otp . " is the verification code to log in to your " . APP_NAME . " account number.";
                sendOTP($contactno, $msg);
            } else {
                $otp_msg = $otp;
            }
            $responce['login_msg'] = 'Enter OTP send to your given whatsapp number to login to your account.' . $otp_msg;
            $responce['status'] = '1';
        } else {
            $responce['login_msg'] = 'Unable to find account. No registration with this contact. To inform us, please send us a mail.';
            $responce['status'] = '0';
        }
        echo json_encode($responce);
    }

    public function logout()
    {
        $this->session->unset_userdata('login_user_id');
        $this->session->unset_userdata('login_user_name');
        $this->session->unset_userdata('login_user_emailid');
        $this->session->unset_userdata('login_user_contact');
        $this->session->unset_userdata('login_user_type');
        redirect(base_url());
    }

    // public function refund_policy()
    // {
    //     $data['pp'] = $this->CommonModel->getRowById('tbl_policy', 'ppid', '3');
    //     $data['title'] = 'Shipping Policy - ' . APP_NAME_TITLE;
    //     $this->load->view('refund-policy', $data);
    // }
    // public function return_policy()
    // {
    //     $data['pp'] = $this->CommonModel->getRowById('tbl_policy', 'ppid', '4');
    //     $data['title'] = 'Return Policy - ' . APP_NAME_TITLE;
    //     $this->load->view('return-policy', $data);
    // }
}
