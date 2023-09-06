<?php include('template/header_link.php'); ?>
<div class="holder">
    <?php include('template/header.php'); ?>
    <?php $this->load->view('admin/template/sidebar'); ?>
    <main>
        <div class="container-fluid site-width">
            <div class="row">
                <div class="col-sm-10  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0"><?= $title ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2  align-self-center">
                    <a href="<?= base_url('admin_Dashboard/add_faq') ?>" class="btn btn-primary align-left">Add FAQ</a>
                </div>
            </div>
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
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="bs4-table" class="table table-striped table-bordered" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>S No</th>
                                                    <th>Particulars</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $i = 1;
                                            if (!empty($faq)) {
                                                foreach ($faq as $row) {
                                            ?>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo wordwrap($row['f_title'], 120, '<br>'); ?><br>
                                                                <hr>
                                                                <?php echo wordwrap($row['f_description'], 120, '<br>'); ?>
                                                            </td>
                                                            <!-- <td> <a href="<?php echo base_url() . 'admin_Dashboard/editfaq/' . encryptId($row['fid']); ?>" class="btn btn-success delete"><i class="fas fa-pencil-alt"></i></a></td> -->
                                                            <td>
                                                                <a href="<?php echo base_url() . 'admin_Dashboard/faq?BdID=' . encryptId($row['fid']); ?>" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></a>
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
            <?php include('template/footer.php') ?>
            <?php include('template/footer_link.php'); ?>
            </body>
            </html>
