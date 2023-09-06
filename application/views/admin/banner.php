<?php include('template/header_link.php'); ?>
<div class="holder">
    <?php include('template/header.php'); ?>
    <?php $this->load->view('admin/template/sidebar'); ?>
    <main>
        <div class="container-fluid site-width">
            <section class="page-content container-fluid">
                <div class="row">
                    <div class="col-sm-10  align-self-center">
                        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto">
                                <h4 class="mb-0"><?= $title ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
                                        <table id="" class="table table-striped table-bordered" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>S No</th>
                                                    <th>Label</th>
                                                    <th>Image</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                if ($banner) {
                                                    foreach ($banner as $row) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $row['title']; ?></td>
                                                            <td>
                                                                <img src="<?= setImage($row['image'], 'uploads/banner/') ?>" style="width: 50px;height: 50px;" />
                                                            </td>
                                                            <!-- <td><?php echo getNumRows('product', array('id' => $row['id'])); ?></td> -->
                                                            <td>
                                                                <a href="<?php echo base_url() . 'admin_Dashboard/edit_banner/' . encryptId($row['bid']); ?>" class="btn btn-success edit"><i class="fas fa-pencil-alt"></i></a>
                                                            </td>
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
                    </div>
            </section>
            <?php include('template/footer.php') ?>
            <?php include('template/footer_link.php'); ?>
            </body>
            </html>
