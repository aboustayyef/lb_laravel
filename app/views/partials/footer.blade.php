    </div> <!-- / siteWrapper -->
    <div id="footer">
      <!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->

      {{-- Minify and combine JS assets later  --}}

      <script>

        // Initiate app object
        if ( typeof lbApp != 'object'){
          lbApp = {}
        };
        // Set up app Variables that require php and blade logic
          lbApp.imagePlaceHolder = '{{asset('/img/grey.gif')}}';
          lbApp.rootPath = '{{URL::to('/')}}';
          lbApp.ajaxTop5Path = '{{URL::to('/ajax/GetTop5')}}';

      </script>
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <script src ="{{asset('js/lebaneseblogs.min.js')}}"></script>
    </div>
</body>
</html>
