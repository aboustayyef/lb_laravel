<!DOCTYPE html>

<html lang="en">
<head>

    @include('partials/redirectToMobileScript')

    <!-- mobile critical css -->
    <style type="text/css">
        #curtain{background:#d1d1d1;position:fixed;left:0;top:50px;height:calc(100% - 50px);width:100%;z-index:100}#curtain #hangInThere{background:yellow;display:inline-block;padding:3px;margin-left:15px;margin-top:15px;font-weight:bold}#curtain #backgroundPattern{min-height:100%;background-image:url(../../img/card_placeholder_mobile.png);margin-left:10px;margin-top:10px}
    </style>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="The best place to discover, read and organize Lebanon's top blogs">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Page Title -->
    <title>Welcome To Lebanese Blogs</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="{{asset('/img/chrome-touch-icon-192x192.png')}}">

    <!-- Facebook Open Graph Data -->
    <meta property="og:url" content="http://lebaneseblogs.com/posts/all">
    <meta property="og:title" content="Lebanese Blogs">
    <meta property="og:description" content="The best place to discover, read and organize Lebanon's top blogs">
    <meta property="og:image" content="{{asset('img/lb_screenshot.jpg')}}">

    <!-- Link to Facebook Page -->
    <meta property="fb:app_id" content="1419973148218767" />

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="LB">

    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/img/apple-touch-icons/76x76.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('/img/apple-touch-icons/120x120.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('/img/apple-touch-icons/152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/img/apple-touch-icons/180x180.png')}}">

    <!-- Style Sheet -->
    <link rel="stylesheet" href="{{asset('/css/mobile.css?v=1.7')}}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('/img/favicon.ico')}}" >
</head>
<body>
