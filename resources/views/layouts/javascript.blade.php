<script src="{{ asset('assets/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{ asset('assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('asset/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/dist/js/demo.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/dist/js/demo.js') }}"></script>
@if ($message = Session::get('success'))
<script>
    $(document).ready(function(){toastr.success("{{ $message }}")});
</script>
@endif
@if ($message = Session::get('error'))
<script>
    $(document).ready(function() {toastr.error('{{ $message }}')});
</script>
@endif
<script>
    $(function(){$("#example1").DataTable({responsive:!0,lengthChange:!0,autoWidth:!0}).buttons().container().appendTo("#example1_wrapper .col-md-6:eq(0)"),$("#example2").DataTable({paging:!0,lengthChange:!0,searching:!0,ordering:!0,info:!0,autoWidth:!0,responsive:!0})}),$(function(){$(".select2").select2(),$(".select2bs4").select2({theme:"bootstrap4"})});
</script>
@yield('customjs')

