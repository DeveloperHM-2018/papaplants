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
                    <a href="<?= base_url('admin_Dashboard/faq') ?>" class="btn btn-primary align-left">FAQ List</a>
                </div>
            </div>
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
                                                    <label class="">FAQ Title</label>
                                                    <input class="form-control" required="" type="text" name="f_title" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="">FAQ category</label>
                                                    <select class="form-control" name="cat_id">
                                                        <?php
                                                        $i = 0;
                                                        $category = getRowById('pp_category', 'parent_id', 0);
                                                        if ($category != '') {
                                                            foreach ($category as $row) {
                                                                $i = $i + 1;
                                                                $subcategory = getRowById('pp_category', 'parent_id', $row['id']);
                                                        ?>
                                                                <option value="<?= $row['id'] ?>"> <?= $row['name'] ?> </option>
                                                                <?php
                                                                if ($subcategory != '') {
                                                                    foreach ($subcategory as $subrow) {
                                                                ?>
                                                                        <option value="<?= $subrow['id'] ?>"> <?= $subrow['name'] ?> </option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        <option value="99"> Order & Shipping </option>
                                                        <option value="98"> Return & Exchange </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="">FAQ Particulars</label>
                                                    <textarea class="form-control" required="" name="f_description" required></textarea>
                                                </div>
                                                <button type="submit" class="btn  btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php include('template/footer.php') ?>
            <?php include('template/footer_link.php'); ?>
            </body>
            </html>
