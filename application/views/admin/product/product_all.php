<?php $this->load->view('admin/template/header', $title);
$sCateId = $this->input->get('sCateId');
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-sm-0 "><?= $title ?></h2>
                        <a href="<?= base_url("productAdd"); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-3" id="datepicker2">
                    <label>Sub Category</label>
                    <select name="searchBySubCategory" class="form-select" id="searchBySubCategory">
                        <option value="">-----All-----</option>
                        <?php
                        if ($all_sub_category) {
                            foreach ($all_sub_category as $s_list) {
                        ?>
                                <option value="<?= encryptId($s_list['sub_category_id']) ?>" <?= (decryptId($sCateId) == $s_list['sub_category_id']) || (sessionId('sCateId') == $s_list['sub_category_id']) ? 'selected' : '' ?>><?= $s_list['sub_category_name'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="ajax_table" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Product Type</th>
                                        <th>Market Price</th>
                                        <th>Sale Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/template/footer'); ?>

<script>
    var dataTable = $('#ajax_table').DataTable({
        "stateSave": true,
        "scrollX": true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'responsive': true,

        order: [
            [0, 'asc']
        ],
        'ajax': {
            'url': '<?= $ajax_table ?>',
            'data': function(data) {

                var subCategory = $('#searchBySubCategory').val();
                data.searchBySubCategory = subCategory;

            }
        },
        <?php if (isset($col_stop)) { ?> "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [<?= $col_stop ?>]
            }]
        <?php echo ",";
        } ?> 'columns': <?= $table_column ?>,
    });

    $('#searchBySubCategory').change(function() {
        dataTable.draw();
    });
</script>