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
            </div>
            <section class="page-content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label class=""> Title</label>
                                                    <input class="form-control" required="" type="text" name="title" />
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class=""> Amount deduction </label>
                                                    <input class="form-control" required="" type="text" name="deduction" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class=""> Description</label>
                                                    <textarea class="form-control" required="" name="description" required></textarea>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <button type="submit" class="btn  btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <h5>
                                        <?= $title ?> List
                                    </h5>
                                    <table id="example" class="display table dataTable table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S. No</th>
                                                <th>Promocode</th>
                                                <th>Amount</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($promocode)) {
                                                foreach ($promocode as $row) {
                                                    $i = $i + 1;
                                            ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $row['title'] ?></td>
                                                    <td><?= $row['deduction'] ?></td>
                                                    <td><?= $row['description'] ?></td>
                                                    <td> <a href="<?= base_url('Admin_Dashboard/') ?>deletepromocode/<?= encryptId($row['pid']) ?>" class="btn btn-success delete"><i class="fas fa-trash"></a></td>
                                                </tr>
                                            <?php
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
