<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="description" content="{{$pageDescription}}">
  <link rel="stylesheet" href="{{asset('/css/lebaneseblogs.css')}}">

  {{-- for font awesome consider using CDN when done--}}
  <link rel="stylesheet" href="{{asset('/css/font-awesome/css/font-awesome.min.css?t='.time())}}">

  <title>{{$pageTitle}}</title>
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
