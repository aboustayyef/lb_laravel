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

        <!-- Start of StatCounter Code for Default Guide -->
            <script type="text/javascript">
            var sc_project=8489889;
            var sc_invisible=1;
            var sc_security="6ec3dc93";
            var scJsHost = (("https:" == document.location.protocol) ?
            "https://secure." : "http://www.");
            document.write("<sc"+"ript type='text/javascript' src='" +
            scJsHost +
            "statcounter.com/counter/counter.js'></"+"script>");</script>
            <noscript><div class="statcounter"><a title="web counter"
            href="http://statcounter.com/" target="_blank"><img
            class="statcounter"
            src="https://c.statcounter.com/8489889/0/6ec3dc93/1/"
            alt="web counter"></a></div></noscript>
        <!-- End of StatCounter Code for Default Guide -->

</body>
</html>
