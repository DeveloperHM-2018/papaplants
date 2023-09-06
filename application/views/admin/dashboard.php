<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/template/header_link'); ?>
<body class="sidebar-fixed">
  <div id="app">
    <?php $this->load->view('admin/template/header'); ?>
    <?php $this->load->view('admin/template/sidebar'); ?>
    <!--START PAGE HEADER -->
    <main>
      <div class="container-fluid site-width">
        <div class="row">
          <div class="col-sm-10  align-self-center">
            <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
              <div class="w-sm-100 mr-auto">
                <h4 class="mb-0"><?= $title ?></h4>
              </div>
            </div>
          </div>
        </div>
        <section class="page-content container-fluid">
          <div class="row">
          </div>
      </div>
      <?php $this->load->view('admin/template/footer_link'); ?>
</body>
</html>
