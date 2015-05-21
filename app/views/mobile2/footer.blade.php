</body>
  <footer>
    {{-- later --}}
  </footer>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script type="text/javascript" src="/js/mobile2-min.js"></script>


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
$('document').ready(function(){
  $('.miniCard').on('click',function(){
    window.location.href = $(this).data('post-url');
  });
});

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



</script>
</html>
