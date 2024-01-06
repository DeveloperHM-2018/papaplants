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
                                                <th>OrderId</th>
                                                <th>Date</th>
                                                <th>Customer</th>
                                                <th>Total</th>
                                                <th>Payment status</th>
                                                <th>Fulfillment status</th>
                                                <th>Items</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            if ($checkout  ) {
												foreach ($checkout as $fetchrow) {
                                                $varcount = getNumRows('checkout_product', array('checkoutid' => $fetchrow['id']));
                                            ?>
                                                <tr>
                                                    <td> <a href="<?php echo base_url() . 'admin_Dashboard/order_view/' . $fetchrow['id']; ?>"><?php echo $fetchrow['id']; ?></a></td>
                                                    <td> <?php echo $fetchrow['create_date']; ?></td>
                                                    <td> <?php echo $fetchrow['name']; ?></td>
                                                    <td>$ <?php echo $fetchrow['totalamount']; ?></td>
                                                    <td><?= (($fetchrow['payment_status'] == 0) ? 'Initated' : (($fetchrow['payment_status'] == 1) ? 'Paid' : 'Failed')) ?></td>
                                                    <td><button type="button" data-toggle="modal" data-target="#exampleModal<?= $fetchrow['id'] ?>" class="btn btn-<?= (($fetchrow['status'] == 0) ? 'info' : (($fetchrow['status'] == 1) ? 'warning' : (($fetchrow['status'] == 2) ? 'danger' : (($fetchrow['status'] == 3) ? 'success' :  'secondary')))) ?>"> <?= (($fetchrow['status'] == 0) ? 'New order' : (($fetchrow['status'] == 1) ? 'On the way' : (($fetchrow['status'] == 2) ? 'Cancelled' : (($fetchrow['status'] == 3) ? 'Order completed' : '')))) ?>
                                                        </button></td>
                                                    <td><?= $varcount ?> Items</td>
                                                </tr>
                                            <?php
                                                $i++;
                                            }
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
