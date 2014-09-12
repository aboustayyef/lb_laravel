<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <?php $pageDescription = Page::getDescription() ?>
  <meta name="description" content="{{$pageDescription}}">
  <link rel="stylesheet" href="{{asset('/css/lebaneseblogs.css')}}">

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{asset('/favicon.ico')}}" >

  <!-- font awesome -->
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

  <?php $pageTitle = Page::getTitle() ?>
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
