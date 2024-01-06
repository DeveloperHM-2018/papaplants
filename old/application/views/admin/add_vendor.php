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
                    <div class="col-sm-2  align-self-center text-right">
                        <a href="<?= base_url('admin_Dashboard/vendor_list') ?>" class="btn btn-primary align-left">Vendor List</a>
                    </div>
                </div>
            </section>
            <section class="page-content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label class="">Vendor Name</label>
                                                    <input class="form-control" value="<?= (($tag == 'edit') ? $category['0']['name'] : '') ?>" type="text" name="name">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="">Vendor Logo</label>
                                                    <div class="pos-relative">
                                                        <input class="form-control pd-r-80" type="file" name="img" accept="image/png, image/gif, image/jpeg">
                                                        <?php if ($tag == 'edit') { ?>
                                                            <input type="hidden" name="logo" value="<?= $category['0']['logo'] ?>">
                                                            <img src="<?= base_url() ?>uploads/vendor/<?= $category['0']['logo'] ?>" height="50px">
                                                        <?php    }  ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="">Number</label>
                                                    <input class="form-control" value="<?= (($tag == 'edit') ? $category['0']['number'] : '') ?>" type="text" name="number">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="">Email id</label>
                                                    <input class="form-control" value="<?= (($tag == 'edit') ? $category['0']['email'] : '') ?>" type="text" name="email">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="">Password</label>
                                                    <input class="form-control" value="<?= (($tag == 'edit') ? $category['0']['password'] : '') ?>" type="text" name="password">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>
<?php $this->load->view('admin/template/footer_link'); ?>
</body>
</html>
