<!DOCTYPE html>
<html>
<script type="text/javascript">
    const baseURL = "{{ url('/') }}";
    const csrf = "{{ csrf_token() }}";
</script>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminPanel | Dog</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @section('styles')
        <!-- Bootstrap 3.3.7 -->
            <link rel="stylesheet" href="{{ asset('/') }}admin/css/bootstrap.min.css">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="{{ asset('/') }}admin/css/font-awesome.min.css">
            <!-- Ionicons -->
            <link rel="stylesheet" href="{{ asset('/') }}admin/css/ionicons.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="{{ asset('/') }}admin/css/AdminLTE.min.css">
            <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
            <link rel="stylesheet" href="{{ asset('/') }}admin/css/_all-skins.min.css">
            <!-- Morris chart -->
            <link rel="stylesheet" href="{{ asset('/') }}admin/css/morris.css">
            <!-- jvectormap -->
            <link rel="stylesheet" href="{{ asset('/') }}admin/css/jquery-jvectormap.css">
            <!-- Date Picker -->
            <link rel="stylesheet" href="{{ asset('/') }}admin/css/bootstrap-datepicker.min.css">
            <!-- Daterange picker -->
            <link rel="stylesheet" href="{{ asset('/') }}admin/css/daterangepicker.css">
            <!-- bootstrap wysihtml5 - text editor -->
            <link rel="stylesheet" href="{{ asset('/') }}admin/css/bootstrap3-wysihtml5.min.css">
    @show


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('partials.admin.header')
    <!-- Left side column. contains the logo and sidebar -->
    @include('partials.admin.aside-left')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
{{--        @include('partials.admin.content')--}}
    </div>
    <!-- /.content-wrapper -->
    @include('partials.admin.footer')

    <!-- Control Sidebar -->
    @include('partials.admin.aside-right')
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
@section('scripts')
    <!-- jQuery 3 -->
    <script src="{{asset('/')}}admin/js/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('/')}}admin/js/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('/')}}admin/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="{{asset('/')}}admin/js/raphael.min.js"></script>
    <script src="{{asset('/')}}admin/js/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="{{asset('/')}}admin/js/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="{{asset('/')}}admin/js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="{{asset('/')}}admin/js/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('/')}}admin/js/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{asset('/')}}admin/js/moment.min.js"></script>
    <script src="{{asset('/')}}admin/js/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="{{asset('/')}}admin/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset('/')}}admin/js/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="{{asset('/')}}admin/js/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="{{asset('/')}}admin/js/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('/')}}admin/js/adminlte.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('/')}}admin/js/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('/')}}admin/js/demo.js"></script>
@show

</body>
</html>
