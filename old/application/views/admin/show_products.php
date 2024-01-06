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
                        <a href="<?= base_url('admin_Dashboard/add_products'); ?>" class="btn btn-primary">
                            Add Product</a>
                    </li>
                </ul>
            </div>
        </header>
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
                            <div class="card-header">
                                <ul class="actions top-right">
                                    <li>
                                        <a href="javascript:void(0)" data-q-action="card-expand"><i class="icon dripicons-expand-2"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="bs4-table" class="table table-striped table-bordered" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>S No</th>
                                                <th>Category/Subcategory Name</th>
                                                <!-- <th>Sub Category Name</th> -->
                                                <th>Product Name</th>
                                                <th>On Sell</th>
                                                <th>Featured </th>
                                                <th>Product Image</th>
                                                <th>Disable</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($products as $fetchrow) {
                                                $cat = getRowById('category', 'category_id', $fetchrow['category_id']);
                                                $subcat = getRowById('sub_category', 'sub_category_id', $fetchrow['subcategory_id']);
                                                $imgcount = getNumRows('products_image', array('product_id' => $fetchrow['product_id']));
                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td>
                                                        <?= $cat[0]['cat_name']; ?>/<?= $subcat[0]['subcat_name'] ?>
                                                    </td>
                                                    <td><?php echo wordwrap($fetchrow['pro_name'], 10, '<br>'); ?></td>
                                                    <!-- <td> -->
                                                    <!-- <img src="<?php echo base_url();  ?>uploads/products/<?php echo $fetchrow['img1']; ?>" style="width: 50px;height: 50px;" /> -->
                                                    <!-- </td> -->
                                                    <td>
                                                        <select name="sale" class="form-control salehm" id="sale<?= $fetchrow['product_id'] ?>" data-id="<?= $fetchrow['product_id'] ?>">
                                                            <option value="1" <?= (($fetchrow['sale'] == '1') ? 'selected' : '') ?>>Yes</option>
                                                            <option value="0" <?= (($fetchrow['sale'] == '0') ? 'selected' : '') ?>>No</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="featured" class="form-control featuredhm" id="featured<?= $fetchrow['product_id'] ?>" data-id="<?= $fetchrow['product_id'] ?>">
                                                            <option value="1" <?= (($fetchrow['featured'] == '1') ? 'selected' : '') ?>>Yes</option>
                                                            <option value="0" <?= (($fetchrow['featured'] == '0') ? 'selected' : '') ?>>No</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url() . 'admin_Dashboard/edit_productsimg/' . $fetchrow['product_id']; ?>" class="btn btn-info edit"><i class="fa fa-file-image"></i> (<?= $imgcount ?>)</a>
                                                    </td>
                                                    <td> <a href="<?php echo base_url() . 'admin_Dashboard/disable/' . $fetchrow['product_id'] . '/products/' . (($fetchrow['status'] == '1') ? '0' : '1'); ?>" class="btn btn-light"><?php if ($fetchrow['status'] == '0') { ?><i class="fas fa-eye"></i><?php } else { ?> <i class="fas fa-eye-slash"></i><?php } ?></a></td>
                                                    <td>
                                                        <a href="<?php echo base_url() . 'admin_Dashboard/edit_products/' . $fetchrow['product_id']; ?>" class="btn btn-success edit"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="<?php echo base_url() . 'admin_Dashboard/deleteproducts/' . $fetchrow['product_id']; ?>" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>
    </div>
    <?php $this->load->view('admin/template/footer_link'); ?>
    <script>
        $('.salehm').change(function() {
            var pid = $(this).data('id');
            var sale = $('#sale' + pid).val();
            // console.log(df);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin_Dashboard/productOnSale') ?>",
                data: {
                    sale: sale,
                    pid: pid
                },
                success: function(response) {
                    $('#featuredmsg').html('');
                    $('#salemsg').html('Product is on Sale Now');
                }
            });
        });
        $('.featuredhm').change(function() {
            var pid = $(this).data('id');
            var featured = $('#featured' + pid).val();
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin_Dashboard/featuredProduct') ?>",
                data: {
                    featured: featured,
                    pid: pid
                },
                success: function(response) {
                    $('#salemsg').html('');
                    $('#featuredmsg').html('Product is featured Now');
                }
            });
        });
    </script>
</body>
</html>
