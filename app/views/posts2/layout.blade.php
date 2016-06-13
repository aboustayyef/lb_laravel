<!DOCTYPE html>

<html lang="en">
<head>
    {{-- Redirect mobile --}}
    @include('posts2.components.redirectScript')

    {{-- Critical css. copy/paste criticalcss.css --}}
    @include('posts2.components.criticalCss')

    {{-- Metadata --}}
    @include('posts2.components.metadata')

    <!-- Style Sheet -->
    @if (app('env') == 'staging')
      <link rel="stylesheet" href="http://static.lebaneseblogs.com/css/lebaneseblogs.css?v=3.5">
    @else
      <link rel="stylesheet" href="{{asset('/css/lebaneseblogs2.css?v=4.0')}}">
    @endif  

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('/img/favicon.ico')}}" >
</head>

    {{-- Init script. Will prepare app state object --}}
    @include('posts2.components.initScript')

<body>
@yield('content')
</body>

<footer>
  
</footer>