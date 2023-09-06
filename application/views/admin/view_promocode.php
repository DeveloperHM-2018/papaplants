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
                    <h1><?= $title ?> </h1>
                </div>
                <ul class="actions top-right">
                    <li>
                        <a href="<?= base_url('admin_Dashboard/add_promocode'); ?>" class="btn btn-primary">
                            Add Promocode</a>
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
                                                <th>Promocode</th>
                                                <th>Amount deduction</th>
                                                <th>Description</th>
                                                <th>Disable</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $i = 1;
                                        if (!empty($promocode)) {
                                            foreach ($promocode as $row) {
                                        ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $row['title']; ?></td>
                                                        <td><?php echo $row['deduction']; ?></td>
                                                        <td><?php echo $row['description']; ?></td>
                                                        <td> <a href="<?php echo base_url() . 'admin_Dashboard/disable/' . $row['pid'] . '/promocode/' . (($row['status'] == 1) ? '0' : '1'); ?>" class="btn btn-light delete"><?php if ($row['status'] == 0) { ?><i class="fas fa-eye"></i><?php } else { ?> <i class="fas fa-eye-slash"></i><?php } ?></a></td>
                                                        <td>
                                                            <a href="<?php echo base_url() . 'admin_Dashboard/deletepromocode/' . $row['pid']; ?>" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></a>
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
    <?php $this->load->view('admin/template/footer_link'); ?>
</body>
</html>
