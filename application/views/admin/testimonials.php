<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/template/header_link'); ?>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php $this->load->view('admin/template/header'); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <?php $this->load->view('admin/template/sidebar'); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"><?= $title ?> </h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12   mb-3 ">
                            <?php
                            if ($this->session->has_userdata('msg')) {
                             echo $this->session->userdata('msg');
                             $this->session->unset_userdata('msg');
                            }
                            ?>
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="">  Name</label>
                                                <input class="form-control" required="" type="text" name="name" />
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label class="">  Testimonial</label>
                                                <input class="form-control" required="" type="text" name="testimonial" />
                                            </div>
                                            <button type="submit" class="btn  btn-light">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <table id="order-listing" class="table">
                                        <thead>
                                            <tr>
                                                <th>S No</th>
                                                <th>Name</th>
                                                <th>Particulars</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $i = 1;
                                        if (!empty($testimonials)) {
                                            foreach ($testimonials as $row) {
                                        ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td>
                                                            <?php echo wordwrap($row['name'], 120, '<br>'); ?><br>
                                                        </td>
                                                        <td>
                                                            <?php echo wordwrap($row['testimonial'], 120, '<br>'); ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url() . 'admin_Dashboard/deletetestimonials/' . $row['tid']; ?>" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></a>
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
