</body>
  <footer>
    {{-- later --}}
  </footer>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script type="text/javascript" src="/js/mobile-min.js"></script>


<script>

// Layout Masonry and reveal once done
$('document').ready(function(){
  var $container = $('#posts');

  $container.imagesLoaded(function(){
    $container.masonry({
      itemSelector: '.miniCard'
    });
    $('#curtain.active').removeClass('active');
  });
});


// fix the scrolling window's height
$('document').ready(function(){
  $('#scrolling').css('height',$(window).outerHeight());
});


// clicking behavior of cards (change later to add sharing)
// $('document').ready(function(){
//   $(document).on('click','.miniCard', function(e){
//     $('.sharingbackground.active').removeClass('active');
//     $(this).find('.sharingbackground').addClass('active');
//     // window.location.href = $(this).data('post-url');
//   });
//   $(document).on('click', '.close', function(e){
//     e.stopPropagation();
//     $('.sharingbackground.active').removeClass('active');
//   });
// });

// behavior of various buttons
$('document').ready(function(){

  // Clicking 'About' in header
  $('#aboutbutton').on('click', function(){
    $('.takeover.active').removeClass('active');
    $('#about').addClass('active');
  });

  // clicking the close button
  $('.closebutton').on('click', function(){
    $('.takeover.active').removeClass('active');
  });

  // Clicking 'Show Top Posts'
  $('#showtopposts').on('click', function(){
    $('.takeover.active').removeClass('active');
    $('#topposts').addClass('active');
  });

});

// Adding More posts

$('document').ready(function(){

  addMorePosts = function(howmany){
    var existingPosts = $('.miniCard').length;

    $.get( "/mobileAjax/" + (existingPosts + 1) + "/" + howmany , function( data ) {
      $data = $(data);
      $data.imagesLoaded(function(){
        $('#posts').append($data).masonry('appended', $data);
        $('#loadMorePosts.disabled').removeClass('disabled').addClass('enabled');
      })
    });
  }

  $('#loadMorePosts.enabled div').on('click', function(){
    $('#loadMorePosts.enabled').removeClass('enabled').addClass('disabled');
    addMorePosts(10);
  });

});




</script>


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

      <!-- Statcounter -->
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

</html>
