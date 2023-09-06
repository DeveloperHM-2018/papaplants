<?php $this->load->view('admin/template/header_link'); ?>
<div class="container">
    <div class="row vh-100 justify-content-between align-items-center">
        <div class="col-12">
            <?php
            if ($this->session->has_userdata('msg')) {
                echo $this->session->userdata('msg');
                $this->session->unset_userdata('msg');
            }
            ?>
            <form action="<?= base_url('Admin/adminlogin') ?>" method="post" class="row row-eq-height lockscreen  mt-5 mb-5">
                <div class="lock-image col-12 col-sm-5"></div>
                <div class="login-form col-12 col-sm-7">
                <div class="form-group mb-3"><img src="<?= base_url() ?>assets/admin/images/papaplants_logo_2.jpg" style="width: 150px;" ></div>
                    <div class="form-group mb-3">
                        <label for="emailaddress">Username</label>
                        <input class="form-control" type="email" name="username" id="emailaddress" required="" placeholder="Enter your email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" required="" id="password" placeholder="Enter your password">
                    </div>
                    <div class="form-group mb-0">
                        <button class="btn btn-primary" type="submit"> Log In </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('template/footer_link.php'); ?>
</body>
</html>
