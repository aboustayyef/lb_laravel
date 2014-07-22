$('document').ready(function(){

  // cards specific action. Fix layout before showing posts
  if ($('.posts').hasClass('cards')) {
      lbApp.resizeViewport();
      lbApp.flowPosts();
  };

  // show initial posts
  $('.post_wrapper').css('visibility','visible');
  lbApp.hideLoadingCurtain();
  lbApp.loadLazyImages();
});

$( window ).on('resize', function(){ 
  if ($('.posts').hasClass('cards')) {
      lbApp.resizeViewport();
  };
});

$( window ).on('scroll', function(){
  if (!lbApp.busy) {
    $viewHeight = $(window).height();
    $docHeight = $(document).height();
    $scrollAmount = $(window).scrollTop();
    $bottomOfPage = $docHeight - $viewHeight;
    
    if (($(window).scrollTop()) > ($bottomOfPage-(2*($viewHeight)))) {
        lbApp.showPostsLoadingIndicator();
        lbApp.addMorePosts();
    };
  };
})