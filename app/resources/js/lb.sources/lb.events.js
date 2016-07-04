$(document).ready(function(){
  // initialize dynamic links behavior
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
  }
});

// Remove menu if clicked outside of it
$(document).on('click', function(){
  $('#about').removeClass('open');
  $('#aboutMenu').removeClass('open');
})

$(window).on('scroll', function(){
  lbApp.checkIfMorePostsNeedToBeAdded();
});

lbApp.checkIfMorePostsNeedToBeAdded = function(){
  if (!lbApp.busy && !lbApp.reachedEndOfPosts) {
    $distanceToBottom = $('#content').height() - $(window).scrollTop();
    console.log($distanceToBottom);
    if ($distanceToBottom < 1500) { // add more posts whenever there's a thousand pixels to bottom
        lbApp.showPostsLoadingIndicator();
        lbApp.addMorePosts();
    }
  }
};
