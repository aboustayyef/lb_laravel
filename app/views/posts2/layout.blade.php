<html>
<head>
    {{-- Redirect mobile --}}
    @include('posts2.components.redirectScript')

    {{-- Critical css. copy/paste criticalcss.css --}}
    @include('posts2.components.criticalCss')

    {{-- Metadata --}}
    @include('posts2.components.metadata')

    <!-- Style Sheet -->
    @if (app('env') == 'staging')
      <link rel="stylesheet" href="http://static.lebaneseblogs.com/css/lebaneseblogs2.css?v=3.5">
    @else
      <link rel="stylesheet" href="{{asset('/css/lebaneseblogs2.css?v=4.0')}}">
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('/img/favicon.ico')}}" >

    <!-- Page specific scripts -->
    @yield('headScript')

</head>

    {{-- Init script. Will prepare app state object --}}
    @include('posts2.components.initScript')

<body>

<header>
    <h1>Lebanese Blogs</h1>
</header>

<section id="posts_canvas">
    @yield('content')
</section>

<footer>
    <p>footer</p>
</footer>

<script src = "/js/bundle.js" > </script>

</body>
</html>