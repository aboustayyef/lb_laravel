<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="{{$pageDescription}}">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	
	<!-- Page Title -->
	<title>{{$pageTitle}}</title>

	<!-- Facebook Open Graph Data -->
	<meta property="og:title" content="{{$pageTitle}}">
	<meta property="og:description" content="$pageDescription">
	<meta property="og:image" content="{{asset('img/lb_screenshot.jpg')}}">

	<!-- Add to homescreen for Chrome on Android -->
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="icon" sizes="192x192" href="{{asset('/img/chrome-touch-icon-192x192.png')}}">

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

</head>
<body>
	{{-- IMPORTANT - Handles redirects between mobile and desktop versions --}}
	@include('partials/redirectToMobileScript')

	<h1>Mobile Version: {{$pageTitle}}</h1>
	<p>{{Request::path()}}</p>
</body>
</html>