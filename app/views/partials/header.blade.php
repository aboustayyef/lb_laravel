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
html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}*{box-sizing:Border-box}body{padding:0;margin:0;font-size:16px;backface-visibility:hidden;-webkit-overflow-scrolling:touch}#loading{z-index:25;position:fixed;width:100%;top:94px;background:#d1d1d1;height:100%}#loading .loadingWrapper{position:relative;background-image:url(../img/card_placeholder.png);height:100%;margin:50px;margin-right:0}#loading .hanginthere{display:inline-block;position:absolute;top:-25px;left:10px;font-size:17px;background:yellow;padding:5px;font-weight:bold}#loadingMore{color:white;position:static;width:240px;margin:10px auto;text-align:center;bottom:10px;background:#b12530;padding:15px;border-radius:2px;font-size:14px;font-weight:bold}#loadingMore i{font-size:18px;margin-right:7px}#siteWrapper{position:absolute;width:100%;height:100%;top:0;left:0;right:0;bottom:0;transition:0.2s}#siteWrapper.open{transform:translate3d(320px, 0, 0);opacity:1}#momentumScrollingViewport{position:absolute;top:0;overflow:scroll;width:100%;height:400px}.dynamicLink{cursor:pointer}#topBar{height:50px;position:fixed;top:0;z-index:5;width:100%;background:#b12530;color:white;transition:0.2s}#topBar i{padding:12.5px;font-size:25px}#topBar #logo{width:150px;height:50px;background:url(../img/logo-mobile.png);background-repeat:no-repeat;background-size:150px 40px;background-position-y:5px;position:absolute;top:0;line-height:50px}@media screen and (min-width: 401px){#topBar #logo{width:250px;background:url(../img/logo.png);background-repeat:no-repeat;background-size:250px 40px;background-position-y:5px;margin-left:20px}}#topBar #logo p{width:260px;font-size:12px;line-height:15px;margin-left:300px;margin-top:12px;color:#F3DEE0}#topBar #logo p strong{font-weight:bold;color:white}@media screen and (max-width: 700px){#topBar #logo p{display:none}}#topBar #about{font-size:14px;cursor:pointer;position:absolute;top:10px;right:10px;z-index:5;padding:7px;border:1px solid #e68990}#topBar #about:hover{background:#871c25}#topBar #aboutMenu{top:-220px;opacity:0;z-index:0;display:inline-block;width:250px;position:absolute;transition:0.2s;right:10px}#topBar #aboutMenu li{background:#871c25;padding:10px;border-bottom:1px solid #d53441}#topBar #aboutMenu lilast:child{border-bottom:none}#topBar #aboutMenu li a{font-size:14px;color:white;text-decoration:none}@media screen and (max-width: 360px){#topBar #aboutMenu{width:100%;right:0}}#topBar #about.open{background:#871c25}#topBar #about.open+#aboutMenu{top:50px;opacity:1}#content{padding-top:50px;background:#d1d1d1;overflow:auto;-webkit-overflow-scrolling:touch}#content .currentChannel{position:relative;letter-spacing:3px;border-top:1px dashed white;border-bottom:1px dashed white;color:white;padding:7px;text-transform:uppercase;text-align:center}#content .currentChannel i{margin-right:10px;font-size:16px}#content .currentChannel .close{position:absolute;top:0;left:0;cursor:pointer}#content .currentChannel .close a{display:block;font-size:1.5em;opacity:0.8;height:29px;line-height:29px;width:29px}#content .currentChannel .close a:hover{opacity:1;background:rgba(0,0,0,0.2)}#channelPicker{border-bottom:1px solid silver;z-index:4;position:absolute;top:50px;background:white;width:100%;padding-left:10px;padding-top:5px;padding-bottom:5px}#channelPicker .inner{margin:0 auto;padding:3px 0}#channelPicker ul.channelBar{padding:0;padding-bottom:3px}#channelPicker ul.channelBar li{font-size:12px;display:inline-block;margin-left:0;margin-top:5px;padding:8px 5px;border:1px solid #ebebeb}#channelPicker ul.channelBar li:hover{background-color:#ebebeb}#channelPicker ul.channelBar li.active .channelDesc{color:white;opacity:0.8}#channelPicker ul.channelBar li.active svg,#channelPicker ul.channelBar li.active path{fill:white}#channelPicker ul.channelBar li.chooseACategory{border:none;color:#c62936;text-transform:uppercase}#channelPicker ul.channelBar li svg,#channelPicker ul.channelBar li path{fill:silver}@media all and (max-width: 649px){#channelPicker ul.channelBar{display:none}}#channelPicker #channelSelector{-webkit-appearance:none;-moz-appearance:none;-appearance:none;margin:4px 0;padding:7px;cursor:pointer;outline:none;color:#b12530;font-weight:bold}@media all and (min-width: 650px){#channelPicker #channelSelector{display:none}}
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
    @if (app('env') == 'staging')
      <link rel="stylesheet" href="http://static.lebaneseblogs.com/css/lebaneseblogs.css?v=3.5">
    @else
      <link rel="stylesheet" href="{{asset('/css/lebaneseblogs.css?v=4.0')}}">
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
