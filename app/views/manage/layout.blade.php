<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Core CSS -->
    <link rel="stylesheet" href="/css/manage.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
   
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
            <a class="navbar-brand" href="/"><img src="/img/logo.png" height="40" width="auto"></a>
            </div>
        </div>
        <!-- /.container -->
    </nav>


    <!-- Page Content -->
    <div class="container">
      @if(Session::has('lbSuccessMessage'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{Session::get('lbSuccessMessage')}}
        </div>
      @endif
      
      @yield('content')
    </div>
    <!-- /.container -->
    @yield('scripts.footer')

    <!-- Google Analytics -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-40418714-1', 'lebaneseblogs.com');
      ga('require', 'displayfeatures');
      ga('send', 'pageview');
    </script>

</body>

</html>
