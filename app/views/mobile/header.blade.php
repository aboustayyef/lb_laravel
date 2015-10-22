<!DOCTYPE html>

<html lang="en">
<head>
{{-- Critical css. copy/paste criticalcss.css --}}
<!-- Critical Css -->
<style type="text/css">
    body{padding:0;margin:0;font-size:16px;backface-visibility:hidden;-webkit-overflow-scrolling:touch}#loading{z-index:25;position:fixed;width:100%;top:0;background:white;height:100%;background:#fff;background:linear-gradient(to bottom, #fff 0%, #f6f6f6 47%, #ededed 100%);filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed', GradientType=0 )}#loading .loadingWrapper{font-family:sans-serif;position:absolute;width:120px;height:120px;top:50%;left:50%;text-align:center;transform:translate(-60px, -60px)}#loading .loadingWrapper i{opacity:0.4;margin:5px;font-size:25px}#loadingMore{color:white;position:static;width:240px;margin:10px auto;text-align:center;bottom:10px;background:#b12530;padding:15px;border-radius:2px;font-size:14px;font-weight:bold}#loadingMore i{font-size:18px;margin-right:7px}#siteWrapper{position:absolute;width:100%;height:100%;top:0;left:0;right:0;bottom:0;transition:0.2s}#siteWrapper.open{transform:translate3d(320px, 0, 0);opacity:1}#momentumScrollingViewport{position:absolute;top:0;overflow:scroll;width:100%;height:400px}.dynamicLink{cursor:pointer}
</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="The best place to discover, read and organize Lebanon's top blogs">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

  @if($isBlogger)
    <link rel="canonical" href="http://lebaneseblogs.com/blogger/{{$whichBlog}}" />
  @else
    <link rel="canonical" href="http://lebaneseblogs.com/posts/{{$channel}}" />
  @endif


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
