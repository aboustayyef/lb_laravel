    <div id="footer">
      <!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->

      {{-- Minify and combine JS assets later  --}}

      @if (User::signedIn() == true)
        <script>
          lbApp.signedIn = true;
        </script>
      @else
        <script>
          lbApp.signedIn = false;
        </script>
      @endif

      
      @if (app('env') == 'staging')
        <script async src ="http://static.lebaneseblogs.com/js/lebaneseblogs.min.js?v=4"></script>
        <!-- Start of Google Analytics Code -->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-40418714-1', 'lebaneseblogs.com');
          ga('require', 'displayfeatures');
          ga('send', 'pageview');
        </script>
      @else
        <script async src ="{{asset('js/lebaneseblogs.min.js?v=4.1')}}"></script>
        <script>var ga = function(){}</script>
      @endif
    </div>
</body>
</html>
