lbApp.resizeViewport = function(){
  // this function is only used with cards
  // it serves to recalculate the viewport's width to center the posts

  var columns = Math.floor(($(window).width())/320);
  $('div.posts').css('width',columns*320);

  // masonry automatically reflow posts on resize, so no need for custom reflowing of posts.
}

lbApp.loadLazyImages = function(){
  $('img.lazy').each(function(){
    $(this).attr('src', $(this).data('original'));
    $(this).removeClass('lazy');
  });
}

lbApp.flowPosts = function(){

  // This function is only used with cards
  // it applies the Masonry effect to the initial
  // set of posts

  var $container = $('.posts');
  $container.masonry({
    // options
    itemSelector: 'div.post_wrapper',
    transitionDuration: 1, // no animation
  });
}

lbApp.showLoadingCurtain = function(fadein){
  // This function shows the "loading" window
  // after everything has loaded
  if (fadein == "true") {
    $('#loading').fadeIn("fast");
  }else{
    $('#loading').show();
  }
}

lbApp.hideLoadingCurtain = function(){
  // This function hides the "loading" window
  // after everything has loaded
  $('#loading').hide();
}

lbApp.showPostsLoadingIndicator = function(){
  $('.posts').after('<div id ="loadingMore"><i class="fa fa-cog fa-spin"></i> Loading More Posts</div>');
  $w = $(window).width();
  $a = $('#loadingMore').outerWidth();
  $center = ($w - $a)/2;
  $('#loadingMore').css('left', $center);
}

lbApp.hidePostsLoadingIndicator = function(){
  $('#loadingMore').remove();
}

lbApp.addMorePosts = function(){

  // The Ajax call to load more posts,

  lbApp.busy = true; // to avoid simultaneous calls
  $.ajax({
    url: lbApp.ajaxPath,
    type: "GET",
    data: {startFrom: $('.post_body').length }, //counts posts we already have
    success: function(data){
      $data = $(data);
      if ($('.posts').hasClass('cards')) {
        $container = $('.posts');
        $container.append( $data ).masonry( 'appended', $data, true );
      }
      $('.post_wrapper').css('visibility','visible');
      lbApp.busy = false;
      lbApp.hidePostsLoadingIndicator();
      lbApp.loadLazyImages();
    }
  });
}

