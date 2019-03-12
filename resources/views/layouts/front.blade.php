<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
    const baseURL = "{{ url('/') }}";
    const csrf = "{{ csrf_token() }}";
</script>
<head>
    <title>@yield('title','Pets care')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Pets Care Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
	SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    @section('styles')
        <!-- Custom Theme files -->
        <link href="{{ asset('/') }}css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
        <link href="{{ asset('/') }}css/easy-responsive-tabs.css" rel='stylesheet' type='text/css' />
        <!-- easy-responsive-tabs -->
        <link href="{{ asset('/') }}css/style.css" type="text/css" rel="stylesheet" media="all">
        <link href="{{ asset('/') }}css/font-awesome.css" rel="stylesheet">

        <!-- font-awesome icons -->
        <!-- //Custom Theme files -->
    @show

    @section('fonts')
        <!-- web-fonts -->
        <link href="//fonts.googleapis.com/css?family=Limelight" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Junge" rel="stylesheet">
        <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
              rel='stylesheet' type='text/css'>
        <!-- //web-fonts -->
    @show

</head>

<body>
<!-- banner -->
@include('partials.front.banner')
<!-- //banner -->
<!-- Modal1 -->
@include('partials.front.login_modal')
<!-- //Modal1 -->
<!-- Modal2 -->
@include('partials.front.register_modal')
<!-- //Modal2 -->
@yield('content')
<!-- welcome -->
{{--@include('partials.front.welcome')--}}
<!-- //welcome -->

<!-- /services -->
{{--@include('partials.front.services')--}}
<!-- //services -->

<!-- about -->
{{--@include('partials.front.services_2')--}}
<!-- //services -->
<!-- w3-agilesale -->
{{--@include('partials.front.contact_us')--}}
<!-- //w3-agilesale -->
<!-- subscribe -->
{{--@include('partials.front.subscribe')--}}
<!-- //subscribe -->

<!-- copy rights start here -->
@include('partials.front.footer')
@include('partials.front.notification_modal')

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
@section('scripts')
    <!-- js -->
    <script src="{{ asset('/') }}js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('/') }}js/bootstrap.js"></script>
    <!-- //js -->
    <!-- text-effect -->
    <script type="text/javascript" src="{{ asset('/') }}js/jquery.transit.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}js/jquery.textFx.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}js/templatescripts.js"></script>
    <!-- script for responsive tabs -->
    <script src="js/easy-responsive-tabs.js"></script>
    <!-- script for responsive tabs -->
    <script src="js/SmoothScroll.min.js"></script>
    <!-- start-smooth-scrolling -->
    <script type="text/javascript" src="{{ asset('/') }}js/move-top.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}js/easing.js"></script>
    <!-- //smooth-scrolling-of-move-up -->
@show

</body>

</html>