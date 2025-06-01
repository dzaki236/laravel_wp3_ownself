<script src="{{ asset('backend/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- include libraries(jQuery, bootstrap) -->
<script src="https://cdn.ckeditor.com/4.22.1/basic/ckeditor.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('backend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/extra-libs/sparkline/sparkline.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('backend/dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('backend/dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('backend/dist/js/custom.min.js') }}"></script>
<!--This page JavaScript -->
<!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
<!-- Charts js Files -->
<script src="{{ asset('backend/assets/libs/flot/excanvas.js') }}"></script>
<script src="{{ asset('backend/assets/libs/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('backend/assets/libs/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('backend/assets/libs/flot/jquery.flot.time.js') }}"></script>
<script src="{{ asset('backend/assets/libs/flot/jquery.flot.stack.js') }}"></script>
<script src="{{ asset('backend/assets/libs/flot/jquery.flot.crosshair.js') }}"></script>
<script src="{{ asset('backend/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('backend/dist/js/pages/chart/chart-page-init.js') }}"></script>
<script src="{{ asset('global/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('global/ijaboCropTool/ijabocroptool.min.js') }}"></script>
<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#zero_config').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/2.2.2/i18n/id.json',
        },
    });
    $("form").attr("autocomplete", "off");
    $("form").attr("enctype", "multipart/form-data");
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                Swal.fire({
                    title: 'Hapus data ini?',
                    text: "Aksi ini tidak bisa dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        button.closest('form').submit();
                    }
                });
            });
        });
    });
</script>
