<!DOCTYPE html>

<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{$pageDescription}}">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Page Title -->
    <title>{{$pageTitle}}</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="{{asset('/img/chrome-touch-icon-192x192.png')}}">

    <!-- Facebook Open Graph Data -->
    <meta property="og:url" content="https://lebaneseblogs.com/posts/all">
    <meta property="og:title" content="Lebanese Blogs">
    <meta property="og:description" content="The best place to discover, read and organize Lebanon's top blogs and vlogs">
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
    @if (app('env') == 'staging')
      <link rel="stylesheet" href="https://static.lebaneseblogs.com/css/lebaneseblogs.css?v=4.9">
    @else
      <link rel="stylesheet" href="{{asset('/css/lebaneseblogs.css?v=4.9')}}">
    @endif
    

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('/img/favicon.ico')}}" >
</head>
      <script>
        // Initiate Lebanese Blogs App object
        if ( typeof lbApp != 'object'){
          lbApp = {}
        };
        // Set up app Variables that require php and blade logic
          lbApp.imagePlaceHolder = '{{asset('/img/transparent.png')}}';
          lbApp.rootPath = '{{URL::to('/')}}';
          lbApp.pageKind = '{{Session::get('pageKind')}}';
          lbApp.currentPage = '{{Request::path()}}';
          lbApp.currentPageNumber= 1;
          lbApp.reachedEndOfPosts = false;
      </script>
<body>
