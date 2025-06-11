<script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/4.22.1/basic/ckeditor.js"></script>
{{-- <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script> --}}
<script src="{{ asset('frontend/js/jquery.barfiller.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.nicescroll.min.js') }}"></script>
{{-- <script src="{{ asset('frontend/js/main.js') }}"></script> --}}
<script src="{{ asset('global/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
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
<script>
    function logout() {
        $.ajax({
            type: "GET",
            url: "{{ route('auth.logout') }}",
            success: function (response) {

                // window.location.href = "/";
                location.reload();
            }
        });
        // window.open('{{ route('auth.logout') }}', '_self');
    }
</script>
