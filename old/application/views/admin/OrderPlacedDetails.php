<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/template/header_link'); ?>
<body class="sidebar-fixed">
    <div id="app">
        <?php $this->load->view('admin/template/header'); ?>
        <?php $this->load->view('admin/template/sidebar'); ?>
        <!--START PAGE HEADER -->
        <header class="page-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h1><?= $title ?></h1>
                </div>
            </div>
        </header>
        <section class="page-content container-fluid">
            <div class="row">
                <div class="col-md-12   mb-3 ">
                    <?php if ($msg = $this->session->flashdata('msg')) :
                        $msg_class = $this->session->flashdata('msg_class') ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert  <?= $msg_class; ?>"><?= $msg; ?></div>
                            </div>
                        </div>
                    <?php
                        $this->session->unset_userdata('msg');
                    endif; ?>
                    <div class="col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="actions top-right">
                                    <li>
                                        <a href="javascript:void(0)" data-q-action="card-expand"><i class="icon dripicons-expand-2"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="bs4-table" class="table table-striped table-bordered" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>S No</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Price </th>
                                                <th>Quantity</th>
                                                <th>Total Amount</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $i = 1;
                                        if (!empty($checkoutProduct)) {
                                            foreach ($checkoutProduct as $row) {
                                        ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><img src="<?php base_url('uploads/product/'); ?><?php echo $row['product_img']; ?>" /></td>
                                                        <td><?php echo $row['product_name']; ?></td>
                                                        <td>Rs. <?php echo $row['product_price']; ?> /-</td>
                                                        <td><?php echo $row['product_quantity']; ?></td>
                                                        <td>Rs. <?php echo $row['total_pro_amt']; ?> /-</td>
                                                    </tr>
                                                </tbody>
                                        <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-header mt-3">
                        <h3 class="page-title">Any notes</h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <table  class="table">
                                        <thead>
                                            <tr>
                                                <th>Any notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            if (!empty($checkout)) {
                                                foreach ($checkout as $row) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $row['notes']; ?></td>
                                                    </tr>
                                            <?php
                                                    $i++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-header mt-3">
                        <h3 class="page-title"> <?= $title ?> </h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <table  class="table">
                                        <thead>
                                            <tr>
                                                <th>S No</th>
                                                <th>Name</th>
                                                <th>Contact </th>
                                                <th>Email </th>
                                                <th>Address</th>
                                                <th>Payment Details</th>
                                                <th>total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            if (!empty($checkout)) {
                                                foreach ($checkout as $row) {
                                                    $state = getRowById('tbl_state','state_id',$row['state']);
                                            ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $row['name']; ?></td>
                                                        <td><?php echo $row['number']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                        <td><?php echo $row['address']; ?>, <?php echo $row['city']; ?> , <?php echo $state['state_name']; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($row['payment_type'] == '1') {
                                                                echo 'Online Payment<br>';
                                                                echo 'Payment ID - ' . $row['razorpay_payment_id'] . '<br>';
                                                            } else {
                                                                echo 'COD';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>Rs. <?php echo $row['totalamount']; ?> /-</td>
                                                    </tr>
                                            <?php
                                                    $i++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-header mt-3">
                        <h3 class="page-title">Promocode details</h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <table  class="table">
                                        <thead>
                                            <tr>
                                                <th>Promocode </th>
                                                <th>Promocode amt </th>
                                                <th>Grand Total </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $row['promocode']; ?></td>
                                                <td><?php echo $row['promocode_amt']; ?></td>
                                                <td>Rs. <?php echo $row['grand_total']; ?> /-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php $this->load->view('admin/template/footer'); ?>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php $this->load->view('admin/template/footer_link'); ?>
</body>
</html>
