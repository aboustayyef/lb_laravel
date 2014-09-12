$(window).load(function(){

  // cards specific action. Fix layout before showing posts
  if ($('.posts').hasClass('cards')) {
      lbApp.resizeViewport();
      console.log('pssst');
      lbApp.flowPosts();
      // momentum scrolling hack
      $('#momentumScrollingViewport').css('-webkit-overflow-scrolling: touch;');
  };
  lbApp.fixViewportHeight();
  // show initial posts
  $('.post_wrapper').css('visibility','visible');
  lbApp.hideLoadingCurtain();
  lbApp.loadLazyImages();

  // dynamic links
  $('.dynamicLink').on('click', function(){
    console.log('clicked Dynamic link');
    $destination = $(this).data('destination');
    lbApp.clearMenus();
    lbApp.showLoadingCurtain("true");
    window.location.href = $destination ;
  });

});

$( window ).on('resize', function(){
  if ($('.posts').hasClass('cards')) {
      lbApp.resizeViewport();
      lbApp.fixViewportHeight();
      lbApp.checkIfMorePostsNeedToBeAdded();
  };
});

$('#momentumScrollingViewport').on('scroll', function(){
  lbApp.checkIfMorePostsNeedToBeAdded();
});

lbApp.checkIfMorePostsNeedToBeAdded = function(){
  if (!lbApp.busy) {
    $heightOfContent = $('#content').height(); // the height of the total posts content
    $positionOfContentTop = $('#content').position().top; // a negative number indicating how far content has scrolled
    $distanceToBottom = $heightOfContent + $positionOfContentTop;
    if ($distanceToBottom < 1500) { // add more posts whenever there's a thousand pixels to bottom
        lbApp.showPostsLoadingIndicator();
        lbApp.addMorePosts();
    };
  };
}
