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
                        <a href="<?= base_url('admin_Dashboard/blogs') ?>" class="btn btn-primary align-left">Blog List</a>
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
                                            <div class="">
                                                <div class="form-group">
                                                    <label class="">Title</label>
                                                    <input class="form-control" value="<?= (($tag == 'edit') ? $blog['0']['title'] : '') ?>" type="text" name="title">
                                                </div>
                                                <div class="form-group">
                                                    <label class="">Blog Image</label>
                                                    <div class="pos-relative">
                                                        <input class="form-control pd-r-80" type="file" name="img" accept="image/png, image/gif, image/jpeg">
                                                        <?php if ($tag == 'edit') { ?>
                                                            <input type="hidden" name="image" value="<?= $blog['0']['image'] ?>">
                                                            <img src="<?= base_url() ?>uploads/blogs/<?= $blog['0']['image'] ?>" height="50px">
                                                        <?php    }  ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="">Description</label>
                                                    <div class="pos-relative">
                                                        <textarea class="form-control" id="editor" name="blog_body"  ><?= (($tag == 'edit') ? $blog['0']['blog_body'] : '') ?> </textarea>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
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
