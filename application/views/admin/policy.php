<?php include('template/header_link.php'); ?>
<div class="holder">
    <?php include('template/header.php'); ?>
    <?php $this->load->view('admin/template/sidebar'); ?>
    <main>
        <div class="container-fluid site-width">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0"></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                    if ($this->session->has_userdata('msg')) {
                        echo $this->session->userdata('msg');
                        $this->session->unset_userdata('msg');
                    }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <h5>
                                    Website Policies
                                </h5>
                                <table id="example" class="display table dataTable table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S. No</th>
                                            <th>Name</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($policy)) {
                                            $i = $j = 0;
                                            foreach ($policy as $row) {
                                                $i = $i + 1;
                                                $dash = '';  ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $row['tag'] ?></td>
                                                    <td> <a href="<?= base_url('Admin_Dashboard/') ?>policy_edit/<?= encryptId($row['id']) ?>" class="btn btn-success delete"><i class="fas fa-pencil-alt"></a></td>
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
        </div>
    </main>
    <?php include('template/footer.php') ?>
    <?php include('template/footer_link.php'); ?>
    </body>
    </html>
