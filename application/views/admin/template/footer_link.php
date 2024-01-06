<script src="<?= base_url() ?>/assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>/assets/admin/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url() ?>/assets/admin/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url() ?>/assets/admin/libs/node-waves/waves.min.js"></script>

<script src="<?= base_url() ?>/assets/admin/js/pages/two-step-verification.init.js"></script>
<script src="<?= base_url() ?>/assets/admin/libs/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url() ?>/assets/admin/libs/toastr/build/toastr.min.js"></script>

<script src="<?= base_url() ?>/assets/admin/libs/select2/js/select2.min.js"></script>
<script src="<?= base_url() ?>/assets/admin/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="<?= base_url() ?>/assets/admin/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?= base_url() ?>/assets/admin/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>

<script src="<?= base_url() ?>/assets/admin/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="<?= base_url() ?>/assets/admin/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>

<script src="<?= base_url() ?>/assets/admin/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url() ?>/assets/admin/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>

<script src="<?= base_url() ?>/assets/admin/libs/parsleyjs/parsley.min.js"></script>
<script src="<?= base_url() ?>/assets/admin/js/pages/form-validation.init.js"></script>

<script src="<?= base_url() ?>/assets/admin/js/pages/form-advanced.init.js"></script>
<script src="<?= base_url() ?>/assets/admin/js/app.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $('#datatable').DataTable({
        "scrollX": true,
        // dom: 'Bfrtip',
        // buttons: [
        //     'excelHtml5',
        // ]
    });

    $("form[name='form_submit_common']").validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        submitHandler: function(form) {
            $("#save_common").text("").html("Loading.. <i class='fa fa-spin fa-spinner'></i>").attr('disabled', true);
            preLoader(1);
            form.submit();
        },
        errorPlacement: function(error, element) {
            if ($(element).is('select.select2')) {
                element.next().after(error);
            } else {
                error.insertAfter(element);
            }
        }
    });

    $(document).on('click', '.confirm_data', function(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        swal({
                title: $(this).attr('title'),
                text: $(this).attr('title-text'),
                icon: $(this).attr('icon'),
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = urlToRedirect;
                    $(this).text("").html("Loading.. <i class='fa fa-spin fa-spinner'></i>").attr('disabled', true);
                }
            });
    });
</script>