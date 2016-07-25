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
            <a class="navbar-brand" href="#">Manage Your Blogs</a>
            </div>
        </div>
        <!-- /.container -->
    </nav>


    <!-- Page Content -->
    <div class="container">
      @if(Session::has('lbSuccessMessage'))
        <div class="alert alert-success">
          {{Session::get('lbSuccessMessage')}}
        </div>
      @endif
      
    <a href="/manage/{{$blog->blog_id}}" class="btn btn-default btn-large">&larr; Go Back</a>

      @yield('content')
    </div>
    <!-- /.container -->
    @yield('scripts.footer')

</body>

</html>
