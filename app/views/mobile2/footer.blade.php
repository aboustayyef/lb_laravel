</body>
  <footer>
    {{-- later --}}
  </footer>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script type="text/javascript" src="/js/mobile2-min.js"></script>


<script>

$('document').ready(function(){
  var $container = $('#posts');

  $container.imagesLoaded(function(){
    $container.masonry({
      itemSelector: '.miniCard'
    });
  });
});

$('document').ready(function(){
  $('#scrolling').css('height',$(window).outerHeight());
});

$('document').ready(function(){

  $('.miniCard').on('click',function(){
    window.location.href = $(this).data('post-url');
  });

});

</script>
</html>
