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
            <div class="content-wrapper">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="filter_status" id="filter_status" class="form-control">
                                    <option value="">Select status</option>
                                    <option value="0">New</option>
                                    <option value="1">On-working</option>
                                    <option value="2">Cancelled and refunded</option>
                                    <option value="3">Completed</option>
                                    <option value="4">Cancel Requested</option>
                                    <!--<option value="">On-working</option>-->
                                </select>
                            </div>
                            <!--<div class="col-md-2">-->
                            <!--   <select name="filter_payment" class="form-control">-->
                            <!--                                             <option value="0">Payment done</option>-->
                            <!--                                             <option value="1">Payment notdone</option>-->
                            <!--                                         </select>-->
                            <!--</div>-->
                            <div class="col-md-2">
                                <input type="button" id="find" class="btn btn-danger" value="View Order list" />
                            </div>
                        </div>
                    </div>
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
                                <div id="data"></div>
                            </div>
                        </div>
                    </div>
        </section>
        <!-- container-scroller -->
        <?php $this->load->view('admin/template/footer_link'); ?>
        <script>
            $('#find').click(function() {
                getdata();
            });
            getdata();
            function getdata() {
                var filter_status = $('#filter_status').val();
                $.ajax({
                    url: "<?= base_url('Admin_Dashboard/fetchorder') ?>",
                    method: "POST",
                    data: {
                        filter_status: filter_status
                    },
                    success: function(data) {
                        console.log(data);
                        $('#data').html(data);
                    }
                });
            }
        </script>
</body>
</html>
