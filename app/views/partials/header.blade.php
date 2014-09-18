<!DOCTYPE html>




<html lang="en">
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php $pageDescription = Page::getDescription() ?>
    <meta name="description" content="{{$pageDescription}}">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Page Title -->
    <?php $pageTitle = Page::getTitle() ?>
    <title>{{$pageTitle}}</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/touch/chrome-touch-icon-192x192.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Web Starter Kit">
    <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">




  <link rel="stylesheet" href="{{asset('/css/lebaneseblogs.css')}}">

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{asset('/img/favicon.ico')}}" >

  <!-- font awesome -->
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
    <div id="loading">
      <div class="loadingWrapper">
      	<img src="{{asset('/img/lb-loading.png')}}" width="60" height="60" alt="">
      	<br>
        <h3>Loading ..</h3>
      	<!-- <i class="fa fa-cog fa-spin"></i> -->
      </div>
    </div>
    <div id="siteWrapper">
