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
                        <div class="card">
                            <div class="card-body">
                                <?php foreach ($contactdetails as $row) {
                                ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-md-4 ">
                                                <label class="">Phone</label>
                                                <input class="form-control" type="text" name="f_contact" value="<?= $row['f_contact'] ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="">Whatsapp</label>
                                                <input class="form-control" type="text" name="s_contact" value="<?= $row['s_contact'] ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="">First Email</label>
                                                <input class="form-control" type="text" name="f_email" value="<?= $row['f_email'] ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="">Second Email</label>
                                                <input class="form-control" type="text" name="s_email" value="<?= $row['s_email'] ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="">Address</label>
                                                <input class="form-control" type="text" name="address" value="<?= $row['address'] ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="">Facebook link</label>
                                                <input class="form-control" type="text" name="facebook" value="<?= $row['facebook'] ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="">Instagram link</label>
                                                <input class="form-control" type="text" name="instagram" value="<?= $row['instagram'] ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="">Youtube link</label>
                                                <input class="form-control" type="text" name="youtube" value="<?= $row['youtube'] ?>">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                    </form>
                <?php
                                }
                ?>
                </div>
        </div>
</div>
<?php include('template/footer.php') ?>
<?php include('template/footer_link.php'); ?>
</body>
</html>
