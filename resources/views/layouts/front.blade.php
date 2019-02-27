<!DOCTYPE html>
<html lang="en">

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
@include('components.front.banner')
<!-- //banner -->
<!-- Modal1 -->
@include('components.front.login_modal')
<!-- //Modal1 -->
<!-- Modal2 -->
@include('components.front.register_modal')
<!-- //Modal2 -->
@yield('content')
<!-- welcome -->
@include('components.front.welcome')
<!-- //welcome -->

<!-- /services -->
@include('components.front.services')
<!-- //services -->

<!-- about -->
@include('components.front.services_2')
<!-- //services -->
<!-- w3-agilesale -->
@include('components.front.contact_us')
<!-- //w3-agilesale -->
<!-- subscribe -->
@include('components.front.subscribe')
<!-- //subscribe -->

<!-- copy rights start here -->
@include('components.front.footer')
@include('components.front.notification_modal')

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
    <script type="text/javascript">
        $(document).ready(function () {
            $('.w3ls_agile').textFx({
                type: 'fadeIn',
                iChar: 100,
                iAnim: 1000
            });
            $('.w3_text').textFx({
                type: 'fadeIn',
                iChar: 100,
                iAnim: 1000
            });
            $('#horizontalTab').easyResponsiveTabs({
                type: 'default', //Types: default, vertical, accordion
                width: 'auto', //auto or any width like 600px
                fit: true, // 100% fit in a container
                closed: 'accordion', // Start closed if in accordion view
                activate: function (event) { // Callback function if tab is switched
                    var $tab = $(this);
                    var $info = $('#tabInfo');
                    var $name = $('span', $info);
                    $name.text($tab.text());
                    $info.show();
                }
            });
            $('#verticalTab').easyResponsiveTabs({
                type: 'vertical',
                width: 'auto',
                fit: true
            });
            $(".scroll").click(function (event) {
                event.preventDefault();

                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
        <!-- password-script -->
        window.onload = function () {
            document.getElementById("password1").onchange = validatePassword;
            document.getElementById("password2").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("password2").value;
            var pass1 = document.getElementById("password1").value;
            if (pass1 != pass2)
                document.getElementById("password2").setCustomValidity("Passwords Don't Match");
            else
                document.getElementById("password2").setCustomValidity('');
            //empty string means no validation error
        }
        <!-- password-script -->
    </script>

    <!-- //copy right end here -->


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