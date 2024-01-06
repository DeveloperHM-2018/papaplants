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
                    <div class="col-sm-2  align-self-center text-right"><button type="button" class="btn btn-<?= (($order_details['status'] == 0) ? 'info' : (($order_details['status'] == 1) ? 'warning' : (($order_details['status'] == 2) ? 'danger' : (($order_details['status'] == 3) ? 'success' :  'secondary')))) ?>"> <?= (($order_details['status'] == 0) ? 'New order' : (($order_details['status'] == 1) ? 'On the way' : (($order_details['status'] == 2) ? 'Cancelled' : (($order_details['status'] == 3) ? 'Order completed' : '')))) ?>
                        </button>
                    </div>
                </div>
            </section>
            <section class="page-content container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <h6>Product list</h6>
                                    <table class="table table-striped table-bordered" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Image</th>
                                                <th>Product name</th>
                                                <th>Variant</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($order_product as $fetchrow) {
                                            ?>
                                                <tr>
                                                    <td> <?php echo $fetchrow['cpid']; ?></td>
                                                    <td> <img src="<?= setImage($fetchrow['product_img'], 'uploads/product/') ?>" style="height:50px;" /></td>
                                                    <td> <?php echo $fetchrow['product_name']; ?></td>
                                                    <td> <?php echo $fetchrow['product_variant_name']; ?></td>
                                                    <td> <?php echo $fetchrow['product_quantity']; ?></td>
                                                    <td>$ <?php echo $fetchrow['product_price']; ?></td>
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
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <h6>Payment Info</h6>
                                    <hr>
                                    <h6>Total: <br><span style="font-size: 14px;color:grey"><?= $order_details['totalamount'] ?></span></h6>
                                    <h6>Payment ID: <br><span style="font-size: 14px;color:grey"><?= $order_details['payment_id'] ?></span></h6>
                                    <h6>Payment Status: <br><span style="font-size: 14px;color:grey"><?= (($order_details['payment_status'] == 0) ? 'Initated' : (($order_details['payment_status'] == 1) ? 'Paid' : 'Failed')) ?></span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <h6>Customer Info</h6>
                                    <hr>
                                    <h6>Name: <br><span style="font-size: 14px;color:grey"><?= $order_details['name'] ?></span></h6>
                                    <h6>Contact: <br><span style="font-size: 14px;color:grey"><?= $order_details['number'] ?></span></h6>
                                    <h6>Email: <br><span style="font-size: 14px;color:grey"><?= $order_details['email'] ?></span></h6>
                                    <hr>
                                    <h6>Address: <br><span style="font-size: 14px;color:grey"><?= $order_details['address'] ?></span></h6>
                                    <h6>City: <br><span style="font-size: 14px;color:grey"><?= $order_details['city'] ?></span></h6>
                                    <h6>Postcode: <br><span style="font-size: 14px;color:grey"><?= $order_details['pincode'] ?></span></h6>
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
