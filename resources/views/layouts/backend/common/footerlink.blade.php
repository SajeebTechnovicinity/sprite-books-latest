<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/backend_asset')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- ChartJS -->
<script src="{{asset('public/backend_asset')}}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('public/backend_asset')}}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{asset('public/backend_asset')}}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('public/backend_asset')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('public/backend_asset')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{asset('public/backend_asset')}}/plugins/moment/moment.min.js"></script>
<script src="{{asset('public/backend_asset')}}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('public/backend_asset')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Select2 -->
<script src="{{asset('public/backend_asset')}}/plugins/select2/js/select2.full.min.js"></script>
<!-- Summernote -->
<script src="{{asset('public/backend_asset')}}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('public/backend_asset')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/backend_asset')}}/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="{{asset('public/backend_asset')}}/dist/js/demo.js"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('public/backend_asset')}}/dist/js/pages/dashboard.js"></script>



<script>
  $(function () {
      
       $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    
    
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    
  });
  
  function confirmItem() {
    if (confirm("Are you sure?")) {
       return true;
    }else{
    return false;
   }
  }
  
  $(document).ready(function() {
    $('#summernote').summernote({
        placeholder: 'Start Typing ...',
        tabsize: 2,
        height: 200
      });
});
 
</script>