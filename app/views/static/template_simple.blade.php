<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Lebanese Blogs</title>
  <link rel="stylesheet" href="{{asset('css/static.css')}}">
</head>


<body>

<div id="pageWrapper">
  <header>
    <div class="inner">
    <a href="{{URL::to('/posts/all')}}"><div id="logo">
        Lebanese Blogs;
      </div></a>
    </div>
  </header>
  <div id="contentWrapper" class="inner">
      <div class="simple_content">
        @yield('content')
      </div>
  </div>
  <footer>
    <div class="inner">
      <?php echo 'Lebanese Blogs ' . date('Y') . ' &copy;'; ?>
    </div>
  </footer>
</div> <!-- /pageWrapper -->

</body>
</html>
