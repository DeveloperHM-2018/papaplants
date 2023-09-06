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
                </div>
            </section>
            <section class="page-content container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>S No</th>
                                                <th>Title</th>
                                                <th>Rating</th>
                                                <th>Name</th>
                                                <th>Product</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($product_review as $fetchrow) {
                                                $product = getSingleRowById('product', array('id' => $fetchrow['product_id']));
                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $fetchrow['text']; ?></td>
                                                    <td><?php echo $fetchrow['rating']; ?></td>
                                                    <td><?php echo $fetchrow['name']; ?></td>
                                                    <td><?php if($product != ''){ echo $product['name']; }else{ } ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url() . 'admin_Dashboard/deletereview/' . $fetchrow['id']; ?>" class="btn btn-danger" onclick="return confirm('Continue to delete ?')"><i class="fas fa-trash-alt"></i></a>
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
                </div>
        </div>
        </section>
</div>
<?php include('template/footer.php') ?>
<?php include('template/footer_link.php'); ?>
</body>
</html>
