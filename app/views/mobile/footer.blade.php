</body>
  <footer>
    {{-- later --}}
  </footer>
  <script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script async type="text/javascript" src="/js/mobile-min.js"></script>


<script>

// Layout Masonry and reveal once done
$('document').ready(function(){
  var $container = $('#posts');

  $container.imagesLoaded(function(){
    $container.masonry({
      itemSelector: '.miniCard'
    });
    $('#curtain').css('display','none');

    // hack for situation in mobile safari where off-canvas panes prevent scrolling
    $('.takeover').css('display','block');

  });
});


// fix the scrolling window's height
$('document').ready(function(){
  $('#scrolling').css('height',$(window).outerHeight());
});


// clicking behavior of cards

$('document').ready(function(){
  $(document).on('click','li.miniCard.post .body', function(e){

    $blogid = $(this).data('blog-id');
    $twitterlink = $(this).data('twitter-link');
    $posttitle = $(this).data('post-title');
    $exitlink = $(this).data('exit-url');
    $blogpage = $(this).data('blog-url');
    $postexcerpt = $(this).data('post-excerpt');
    $blogname = $(this).data('blog-name');

    // check if post has an image
    var postImage = $(this).find('.image img');

    // remove existing image from sharesheet
    $('#sharesheet').find('.featureImage').remove();

    if (postImage.length > 0) {
      $('#sharesheet a.exitlink').after('<div class="featureImage"><a href="' + $exitlink + '"><img src="' + postImage.attr('src') + '"></a></div>');
    };

    $('#sharesheet').find('a.bloglink').attr('href', $blogpage);
    $('#sharesheet').find('.avatar').attr('src', '/img/thumbs/' + $blogid + '.jpg');
    $('#sharesheet').find('.title').text($blogname);
    $('#sharesheet').find('.goto a').attr('href',$exitlink);
    $('#sharesheet').find('p').text($postexcerpt);
    $('#sharesheet').find('.twittershare a').attr('href',$twitterlink);
    $('#sharesheet').find('a.exitlink').attr('href', $exitlink);
    $('#sharesheet').find('.bloggerpage a').attr('href',$blogpage);
    $('#sharesheet').find('h2').text($posttitle);
    $('#sharesheet').addClass('active');
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

// Adding More posts

$('document').ready(function(){

  addMorePosts = function(howmany){
    var existingPosts = $('.miniCard.post').length;

    @if(!$isBlogger)
      <?php $ajaxExpression = "/mobileAjax/$channel/" ?>
    @else
      <?php $ajaxExpression = "/mobileAjax/b/$whichBlog/" ?>
    @endif

    $.get( "{{$ajaxExpression}}" + (existingPosts + 1) + "/" + howmany , function( data ) {
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

// Channel Picker
$('document').ready(function(){
  $('.categoriesButton').on('click', function(){
    $('#channelPicker').addClass('active');
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

</html>
