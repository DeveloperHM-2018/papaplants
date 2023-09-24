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
                        <a href="<?= base_url('admin_Dashboard/add_subcategory') ?>" class="btn btn-primary align-left">Add sub-Category</a>
                    </div>
                </div>
            </section>
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
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>S No</th>
                                                    <th>Category Name</th>
                                                    <th>Sub Category Name</th>
                                                    <th>Image</th>
                                                    <th>Disable</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
												if ($category) {
                                                foreach ($category as $row) {
                                                    // print_r($row);
                                                    $cat = getRowById('category', 'id', $row['parent_id']);
                                                    // print_r($cat);
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo ((empty($cat[0]['name'])) ? 'deleted' : $cat[0]['name']); ?></td>
                                                        <td><?php echo $row['name']; ?></td>
                                                        <td>
                                                            <img src="<?= setImage($row['image_url'], 'uploads/category/') ?>" style="width: 50px;height: 50px;" />
                                                        </td>
                                                        <!-- <td class="text-center"><a href="<?php echo base_url() . 'show_products/' . $row['sub_category_id'] . "/" . url_title($row['name']) . "/" . url_title($cat[0]['name']);  ?>"><i class="fas fa-eye btn btn-light"></i></a></td> -->
                                                        <td>
                                                            <a href="<?php echo base_url() . 'admin_Dashboard/disable/' . $row['id'] . '/sub_category/' . (($row['is_visible'] == 1) ? '0' : '1'); ?>" class="btn btn-light">
                                                                <?php if ($row['is_visible'] == 1) { ?><i class="fas fa-eye"></i><?php } else { ?> <i class="fas fa-eye-slash"></i><?php } ?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url() . 'admin_Dashboard/edit_subcategory/' . encryptId($row['id']); ?>" class="btn btn-success edit"><i class="fas fa-pencil-alt"></i></a>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url() . 'admin_Dashboard/product_subcategory?BdID=' . encryptId($row['id']) . '&&img=' . $row['image_url'];  ?>" class="btn btn-danger" onclick="return confirm('Are you sure ?')" ><i class="fas fa-trash-alt"></i></a>
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
            </section>
            <?php include('template/footer.php') ?>
            <?php include('template/footer_link.php'); ?>
            </body>
            </html>
