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
                    <h1><?= $title ?> </h1>
                </div>
                <ul class="actions top-right">
                    <li>
                        <button onclick="history.back()" class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                    </li>
                </ul>
            </div>
        </header>
        <section class="page-content container-fluid">
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
                                    <th>Product</th>
                                    <th>Name</th>
                                    <th>Headline</th>
                                    <th>Review</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <?php
                            $i = 1;
                            if (!empty($review)) {
                                foreach ($review as $row) {
                            ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <?php echo $row['name']; ?><br>
                                            </td>
                                            <td>
                                                <?php echo $row['headline']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['review']; ?>
                                            </td>
                                            <td>
                                                <img src="<?php echo base_url() . 'uploads/review/' . $row['image']; ?>" style="height: 200px;" />
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url() . 'admin_Dashboard/deletebanner/' . $row['bid']; ?>" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                            <?php
                                    $i++;
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <!-- container-scroller -->
    <?php $this->load->view('admin/template/footer_link'); ?>
</body>
</html>
