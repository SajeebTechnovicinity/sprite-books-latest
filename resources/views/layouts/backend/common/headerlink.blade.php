  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $globalSetting->app_name }} | Dashboard</title>
<meta name="csrf_token" content="{{ csrf_token() }}" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/backend_asset')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('public/backend_asset')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('public/backend_asset')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('public/backend_asset')}}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/backend_asset')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('public/backend_asset')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('public/backend_asset')}}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('public/backend_asset')}}/plugins/summernote/summernote-bs4.min.css">
  
    <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/backend_asset')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('public/backend_asset')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('public/backend_asset')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- jQuery -->
<script src="{{asset('public/backend_asset')}}/plugins/jquery/jquery.min.js"></script>


  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('public/backend_asset')}}/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{asset('public/backend_asset')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<!-- jQuery UI 1.11.4 -->
<script src="{{asset('public/backend_asset')}}/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="{{asset('public/backend_asset')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('public/backend_asset')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('public/backend_asset')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('public/backend_asset')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('public/backend_asset')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('public/backend_asset')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('public/backend_asset')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('public/backend_asset')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('public/backend_asset')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('public/backend_asset')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('public/backend_asset')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('public/backend_asset')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/basic.min.css" integrity="sha512-MeagJSJBgWB9n+Sggsr/vKMRFJWs+OUphiDV7TJiYu+TNQD9RtVJaPDYP8hA/PAjwRnkdvU+NsTncYTKlltgiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  @yield('style')
  <style>
    .success_msg{
    text-align: center;
    color: yellowgreen;
    margin-bottom: 15px;
    }

    .loader{
      position: absolute;
      background: #1d1b1bbd;
      width: 100%;
      height: 100%;
      z-index: 1000;
      display: flex;
      justify-content: center;
      padding-top: 200px;
    }



    /**/
    .loaderSpin {
      border: 16px solid #f3f3f3; /* Light grey */
      border-top: 16px solid #3498db; /* Blue */
      border-radius: 50%;
      width: 120px;
      height: 120px;
      animation: spin 2s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }






    /**/
    
  /*.loader {*/
    /*top: 50%;*/
    /*left: 50%;*/
    /*width: 100px;*/
    /*height: 100px;*/
    /*display: inline-block;*/
    /*position: absolute;*/
    /*z-index: 999;*/
    /*display: none;*/
/*}*/
/*.loader::after,*/
/*.loader::before {*/
  /*content: '';  */
  /*box-sizing: border-box;*/
  /*width: 100px;*/
  /*height: 100px;*/
  /*border-radius: 50%;*/
  /*background: #ffd700 ;*/
  /*position: absolute;*/
  /*left: 0;*/
  /*top: 0;*/
  /*animation: animloader 2s linear infinite;*/
/*}*/
/*.loader::after {*/
  /*animation-delay: 1s;*/
/*}*/

@keyframes animloader {
  0% {
    transform: scale(0);
    opacity: 1;
  }
  100% {
    transform: scale(1);
    opacity: 0;
  }
}
</style>    
