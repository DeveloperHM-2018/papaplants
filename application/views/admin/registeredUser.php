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
                <ul class="actions top-right">
                    <li>
                        <a href="<?= base_url('admin_Dashboard/add_category'); ?>" class="btn btn-primary">
                            Add category</a>
                    </li>
                </ul>
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
                                <div class="">
                                    <table id="" class="table table-striped table-bordered" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>S No</th>
                                                <th>Date</th>
                                                <th>fullname</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>View orders</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $i = 1;
                                        if (!empty($registeredUser)) {
                                            foreach ($registeredUser as $row) {
                                                $orderCount = getNumRows('checkout', array('user_id' => $row['reg_id']));
                                        ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo convertDatedmy($row['create_date']); ?></td>
                                                        <td><?php echo $row['fullname']; ?></td>
                                                        <td><?php echo $row['emailid']; ?></td>
                                                        <td><?php echo $row['contact']; ?></td>
                                                        <!-- <td><?php echo $row['password']; ?></td> -->
                                                        <td>
                                                            <a href="<?php echo base_url() . 'admin_Dashboard/orderPlaced/' . $row['reg_id']; ?>" class="btn btn-info"><i class="fas fa-shopping-cart"></i> (<?= $orderCount ?>)</a>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url() . 'admin_Dashboard/blockuser/' . $row['reg_id']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                        </td>
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
                </div>
        </section>
    </div>
    <!-- container-scroller -->
    <?php $this->load->view('admin/template/footer_link'); ?>
</body>
</html>
