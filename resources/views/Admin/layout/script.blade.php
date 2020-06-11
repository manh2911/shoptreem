<!-- Bootstrap core JavaScript-->
<script src="{{ asset('Admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('Admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('Admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('Admin/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('Admin/js/ste-image.js') }}"></script>
<script src="{{ asset('Admin/js/ste.js') }}"></script>
<script src="{{ asset('Admin/js/order.js') }}"></script>
<script src="{{ asset('Admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('Admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

@stack('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "aoColumnDefs" : [ {
                "bSortable" : false,
                "aTargets" : [ "sorting_disabled" ]
            } ]
        });
    });
</script>

</body>

</html>
