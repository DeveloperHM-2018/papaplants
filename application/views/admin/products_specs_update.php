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
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div class="">
                                            <div class="form-group">
                                                <label class="">Title </label>
                                                <input class="form-control" type="text" name="specs_title"
                                                    value="<?= $specs['specs_title'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="">Description</label>
                                                <textarea class="form-control" type="text" name="specs_desc" id="editor"
                                                    ><?= $specs['specs_desc'] ?></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <?php $this->load->view('admin/template/footer_link'); ?>
</body>
</html>
</div>
