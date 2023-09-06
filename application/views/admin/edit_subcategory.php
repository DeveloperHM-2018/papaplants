<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/template/header_link'); ?>
<body class="sidebar-fixed">
    <div id="app">
        <?php $this->load->view('admin/template/header'); ?>
        <?php $this->load->view('admin/template/sidebar'); ?>
        <!--START PAGE HEADER -->
        <header class="page-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h1><?= $title ?></h1>
                </div>
                <ul class="actions top-right">
                    <li>
                        <button onclick="history.back()" class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                    </li>
                </ul>
            </div>
        </header>
        <section class="page-content container-fluid">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            // print_r($categoryInfo);
                            foreach ($categoryInfo as $row) {
                            ?>
                                <form action="<?php echo base_url() . 'admin_Dashboard/editsubcategory' ?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                            <div class="">
                                                <input class="form-control" type="hidden" name="id" value="<?= $row['sub_category_id']; ?>">
                                                <div class="form-group">
                                                    <label class="">Main Category </label>
                                                    <select class="form-control" name="cat_id">
                                                        <?php
                                                        foreach ($category as $cat) {
                                                        ?>
                                                            <option value="<?= $cat['category_id'] ?>" <?= (($row['cat_id'] == $cat['category_id']) ? 'selected' : '') ?>><?= $cat['cat_name'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="">Sub Category Name</label>
                                                    <input class="form-control" type="text" name="subcat_name" value="<?= $row['subcat_name'] ?>">
                                                </div>
                                                <img src="<?php echo base_url();
                                                            ?>uploads/subcategory/<?php echo $row['image'] ?>" width="130px" />
                                                <div class="form-group">
                                                    <label class=""> Image</label>
                                                    <div class="pos-relative">
                                                        <input class="form-control pd-r-80" type="file" name="image">
                                                    </div>
                                                </div>
                                                <button name="submit" class="btn btn-primary">Update</button>
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
        </section>
    </div>
    <?php $this->load->view('admin/template/footer_link'); ?>
</body>
</html>
</div>
