<!DOCTYPE html>

<html lang="en">
<head>
    {{-- Redirect mobile --}}

    <script type="text/javascript">
      <!--
      if (screen.width <= 500) {
        var lb_url = window.location.href;

        // if it's a blogger's page
        var is_blogger = lb_url.split('/blogger/');
        if (is_blogger.length > 1) {
          var this_blogger = is_blogger.pop();
          window.location = "/mobile/blogger/" + this_blogger
        };
        var is_posts = lb_url.split('/posts/');
        if (is_posts.length > 1) {
          var this_posts = is_posts.pop();
          window.location = "/mobile/posts/" + this_posts
        };

        //window.location = "/posts/mobile";
      }
      //-->
    </script>

    {{-- Critical css. copy/paste criticalcss.css --}}
<!-- Critical Css -->
<style type="text/css">
body{padding:0;margin:0;font-size:16px;backface-visibility:hidden;-webkit-overflow-scrolling:touch}#loading{z-index:25;position:fixed;width:100%;top:94px;background:#d1d1d1;height:100%}#loading .loadingWrapper{position:relative;background-image:url(../img/card_placeholder.png);height:100%;margin:50px;margin-right:0}#loading .hanginthere{display:inline-block;position:absolute;top:-25px;left:10px;font-size:17px;background:yellow;padding:5px;font-weight:bold}#loadingMore{color:white;position:static;width:240px;margin:10px auto;text-align:center;bottom:10px;background:#b12530;padding:15px;border-radius:2px;font-size:14px;font-weight:bold}#loadingMore i{font-size:18px;margin-right:7px}#siteWrapper{position:absolute;width:100%;height:100%;top:0;left:0;right:0;bottom:0;transition:0.2s}#siteWrapper.open{transform:translate3d(320px, 0, 0);opacity:1}#momentumScrollingViewport{position:absolute;top:0;overflow:scroll;width:100%;height:400px}.dynamicLink{cursor:pointer}
   
</style>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php $pageDescription = Page::getDescription() ?>
    <meta name="description" content="{{$pageDescription}}">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    {{-- Alternate (mobile) --}}
    <link rel="alternate" media="only screen and (max-width: 500px)"
      href="http://lebaneseblogs.com/mobile/{{Request::path()}}" >

    <!-- Page Title -->
    <?php $pageTitle = Page::getTitle() ?>
    <title>{{$pageTitle}}</title>

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
    <link rel="stylesheet" href="{{asset('/css/lebaneseblogs.css?v=3.1')}}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('/img/favicon.ico')}}" >
</head>

      <script>
        // Initiate Lebanese Blogs App object
        if ( typeof lbApp != 'object'){
          lbApp = {}
        };
        // Set up app Variables that require php and blade logic
          lbApp.imagePlaceHolder = '{{asset('/img/grey.gif')}}';
          lbApp.rootPath = '{{URL::to('/')}}';
          lbApp.pageKind = '{{Session::get('pageKind')}}';
          lbApp.currentPage = '{{Request::path()}}';
          lbApp.currentPageNumber= 1;
          lbApp.reachedEndOfPosts = false;
      </script>


<body>
    <div id="loading">
      <div class="loadingWrapper">
        <div class="hanginthere">
          Loading... Hang in there
        </div>
      </div>
    </div>
    <div id="siteWrapper">
