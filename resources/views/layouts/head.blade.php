<?php
$siteName = 'LOTTO';
$siteMail = 'support.lotto@gmail.com';
$sitePhone = '+1(901) 5928818';
$domain = 'lotto.com/';
?>
@php $AppSettingsModel = new \App\Models\AppSettings(); @endphp
@php $AppSettings = $AppSettingsModel->getSingleModel() @endphp

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="keywords" content="read, listen, fun, education, nigeria, jamb, weac, school, music, ">
    <meta name="description" content="Access books and exam materials any time, anywhere.">
    <meta name="CreativeLayers" content="ATFN">
    <meta name="MobileOptimized" content="320" />
    <meta property="og:title" content="Access books and exam materials any time, anywhere.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://<?php print $domain;?>/;">
    <meta property="og:image" content="{{$AppSettings->logo_url}}">
    <meta property="og:description" content="Access books and exam materials any time, anywhere.">
    <meta property="og:site_name" content="<?php echo $siteName; ?>">
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="415" />
    <meta property="og:image:secure_url" content="{{$AppSettings->logo_url}}" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="GOOGLEBOT" content="index follow"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="theme-color" content="#1b1363" />

    <!-- Title -->
    <title>{{env('APP_NAME', 'Grandour')}} - {{$pageTitle}}</title>

<!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{$AppSettings->logo_url}}">

    <!-- These plugins only need for the run this page -->
    <link rel="stylesheet" href="{{asset('/css/backEnd/default-assets/modal.css')}}">
    <link rel="stylesheet" href="{{asset('/css/backEnd/default-assets/datatables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('/css/backEnd/default-assets/responsive.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('/css/backEnd/default-assets/buttons.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('/css/backEnd/default-assets/select.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('/css/backEnd/default-assets/sweetalert-2.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/backEnd/toast/jquery.toast.css')}}">
    <link rel="stylesheet" href="{{asset('/css/backEnd/default-assets/summernote.css')}}">

    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="{{asset('/css/backEnd/main_style.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('main/errors/error_css.css')}}" />

    <!-- These plugins only need for the run this page -->
    <link rel="stylesheet" href="{{asset('/css/backEnd/default-assets/new/ekko-lightbox.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/backEnd/default-assets/new/lightbox.min.css')}}">

    <!--tags input-->
    <link rel="stylesheet" href="{{asset('/js/backEnd/tag_input/bootstrap-tagsinput.css')}}" />

</head>

