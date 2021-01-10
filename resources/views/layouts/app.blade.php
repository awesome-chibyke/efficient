<?php
$siteName = 'LOTTO';
$siteMail = 'support.lotto@gmail.com';
$sitePhone = '+1(901) 5928818';
$domain = 'lotto.com/';
?>
        <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="read, listen, fun, education, nigeria, jamb, weac, school, music, ">
    <meta name="description" content="Access books and exam materials any time, anywhere.">
    <meta name="CreativeLayers" content="ATFN">
    <meta name="MobileOptimized" content="320" />
    <meta property="og:title" content="Access books and exam materials any time, anywhere.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://<?php print $domain;?>/;">
    <meta property="og:image" content="{{asset('img/logo.png')}}">
    <meta property="og:description" content="Access books and exam materials any time, anywhere.">
    <meta property="og:site_name" content="<?php echo $siteName; ?>">
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="415" />
    <meta property="og:image:secure_url" content="{{asset('img/logo.png')}}" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="GOOGLEBOT" content="index follow"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="theme-color" content="#1b1363" />

    <!-- Title -->
@yield('title')

<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('img/favicon.png')}}">
    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="{{asset('/css/backEnd/main_style.css')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/backEnd/default-assets/sweetalert-2.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/backEnd/toast/jquery.toast.css')}}">

</head>

<body class="login-area vertical-dark">

<!-- Preloader -->
<div id="preloader"></div>

@include('layouts.modal')

<!-- ======================================
******* Page Wrapper Area Start **********
======================================= -->
@yield('contents')

<!-- ======================================
********* Page Wrapper Area End ***********
======================================= -->

<!-- Must needed plugins to the run this Template -->
<script src="{{asset('/js/backEnd/jquery.min.js')}}"></script>
<script src="{{asset('/js/backEnd/popper.min.js')}}"></script>
<script src="{{asset('js/backEnd/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/backEnd/bundle.js')}}"></script>


<!-- Active JS -->
<script src="{{asset('/js/backEnd/default-assets/active.js')}}"></script>
<script src="{{asset('/js/backEnd/toast/jquery.toast.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/sweetalert2.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/sweetalert-init.js')}}"></script>

</body>

</html>
