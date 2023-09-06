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
                    <div class="col-sm-2  align-self-center">
                    </div>
                </div>
            </section>
            <section class="page-content container-fluid">
                <div class="row">
                    <div class="col-md-12  ">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <div class="form-group">
                                                <label class=""> Select size </label>
                                                <div class="pos-relative">
                                                    <select class="form-control" name="option_values" id="option_values">
                                                        <option value="">Select Product Size</option>
                                                        <?php
                                                        foreach ($size as $row) {
                                                        ?>
                                                            <option value="<?= $row['id']; ?>"><?= $row['label']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <div class="form-group">
                                                <label class="">SKU </label>
                                                <div class="pos-relative">
                                                    <input class="form-control pd-r-80" required="" type="text" name="sku_id">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <div class="form-group">
                                                <label class="">Price </label>
                                                <div class="pos-relative">
                                                    <input class="form-control pd-r-80" type="text" name="price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <div class="form-group">
                                                <label class="">Discounted Price </label>
                                                <div class="pos-relative">
                                                    <input class="form-control pd-r-80" required="" type="text" name="sale_price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <div class="form-group"><br>
                                                <button type="submit" class="btn  btn-light">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row  ">
                    <div class="col-lg-12 col-xl-12 pt-4">
                        <div class="card">
                            <div class="card-body  ">
                                <?php if ($msg = sessionId('msg')) :
                                    $msg_class = sessionId('msg_class') ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="alert  <?= $msg_class; ?>"><?= $msg; ?></div>
                                        </div>
                                    </div>
                                <?php
                                    $this->session->unset_userdata('msg');
                                endif; ?>
                                <div class="row  p-4">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>S. No.</th>
                                                    <th>Option</th>
                                                    <th>SKU</th>
                                                    <th>Price</th>
                                                    <th>Discounted Price</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                if ($productvar != '') {
                                                    foreach ($productvar as $row) {
                                                        $option = json_decode($row['option_values'], true);
                                                        // print_r($option);
                                                ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $option[0]['label']; ?></td>
                                                            <td><?php echo $row['sku_id']; ?></td>
                                                            <td>$ <?php echo $row['price']; ?></td>
                                                            <td>$ <?php echo $row['sale_price']; ?></td>
                                                            <td>
                                                                <a href="<?php echo base_url() . 'admin_Dashboard/deletevariants/' . encryptId($row['id']);  ?>" class="btn btn-danger" onclick="return confirm('Are you sure ?')"><i class="fas fa-trash-alt"></i></a>
                                                            </td>
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
        </div>
        </section>
</div>
<?php include('template/footer.php') ?>
<?php include('template/footer_link.php'); ?>
</body>
</html>
