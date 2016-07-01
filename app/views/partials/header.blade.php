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
    @if (app('env') == 'staging')
      <link rel="stylesheet" href="http://static.lebaneseblogs.com/css/lebaneseblogs.css?v=3.5">
    @else
      <link rel="stylesheet" href="{{asset('/css/lebaneseblogs.css?v=3.5')}}">
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
    <div id="loading">
      <div class="loadingWrapper">
        <div class="hanginthere">
          Loading... Hang in there
        </div>
      </div>
    </div>
    <div id="siteWrapper">
