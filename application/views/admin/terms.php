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
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Particulars</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                if (!empty($terms)) {
                                    foreach ($terms as $row) {
                                ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo substr($row['particulars'], 0, 120); ?></td>
                                                <td>
                                                    <a href="<?php echo base_url() . 'admin_Dashboard/edit_terms/' . $row['tid']; ?>" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
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
