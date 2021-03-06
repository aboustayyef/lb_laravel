lbApp.veryFirstLoad= function(){

  // adjust sizes of DOM elements
    lbApp.resizeViewport();
  // momentum scrolling hack
  $('#momentumScrollingViewport').css('-webkit-overflow-scrolling: touch;');

  // if not mobile, use masonry to flow the posts
  if ($(window).width() > 430) {
    lbApp.flowPosts();
  }else{
    lbApp.mobileFlowPosts();
  }

  // more adjusting of DOM element sizes
  lbApp.fixViewportHeight();

  // show initial posts (and remove 'loading curtain')
  $('.post_wrapper').css('visibility','visible');
  lbApp.hideLoadingCurtain();

  // refresh dimensions one more time
  lbApp.resizeViewport();

  // show lazy images
  lbApp.loadLazyImages();
};


lbApp.resizeViewport = function(){
  
  if ($(window).width() > 500) {
    
    var columns = Math.floor((($(window).width() - 190 ))/320) ;
    if (columns > 5 ) { columns = 5 ;} // maximum: 4 columns + side column
    if (columns < 3 ) { columns = 3 ;} // minimum: 2 columns + side column
    var $postsWidth = columns*320;
    var $contentWidth = $postsWidth;
  } else {
    var $contentWidth = $(window).width() - 10;
  }
    $('div.ut__inner').css('width', $contentWidth);
    $('#aboutMenu').css('left', $('#about').position().left + $('#about').outerWidth() - $('#aboutMenu').outerWidth());
};

lbApp.loadLazyImages = function(){
  $('.lazy').each(function(){
    if ($(this).data('bg') != undefined) {
      $(this).css('background-image', 'url("'+ $(this).data('bg') +'")');
    } else {
      $(this).attr('src', $(this).data('original'));
    }
    $(this).removeClass('lazy');
  });
};

lbApp.fixViewportHeight = function(){
  $winHeight = $(window).height();
  $('#momentumScrollingViewport').height($winHeight);
  //fix the grey area to stretch fully even if little content

  if ($('#content').height() < $winHeight) {
    $('#content').height($winHeight);
  }

  // fix modal height. it's always 20 pixels smaller than height
    $('#lbModal').height(($winHeight - 100));
};

lbApp.flowPosts = function(){

  // This function is only used with cards
  // it applies the Masonry effect to the initial
  // set of posts

  var $container = $('#posts');
  // $container.masonry({
  //   // options
  //   itemSelector: 'div.post_wrapper',
  //   transitionDuration: 1, // no animation
  // });
};

lbApp.mobileFlowPosts = function(){
  var $cardWidth = $(window).width() - 40;
  $('.cardImage').each(function(){
    $ratio = $(this).attr('height') / $(this).attr('width');
    $height = $cardWidth * $ratio;
    $(this).attr('width', $cardWidth).attr('height',$height);
  });
};

lbApp.showLoadingCurtain = function(fadein){
  // This function shows the "loading" window
  // after everything has loaded
  if (fadein == "true") {
    $('#loading').fadeIn("fast");
  }else{
    $('#loading').show();
  }
};

lbApp.hideLoadingCurtain = function(){
  // This function hides the "loading" window
  // after everything has loaded
  $('#loading').hide();
  ga('send', 'event', 'LB Custom Analytics', 'Page Completely Loaded' , '');
  console.log('page Loaded');
};

lbApp.showPostsLoadingIndicator = function(){
  $('.posts').after('<div id ="loadingMore"><i class="fa fa-cog fa-spin"></i> Loading More Posts</div>');
  $w = $(window).width();
  $a = $('#loadingMore').outerWidth();
  $center = ($w - $a)/2;
  $('#loadingMore').css('left', $center);
};

lbApp.hidePostsLoadingIndicator = function(){
  $('#loadingMore').remove();
};


lbApp.addMorePosts = function(){

  // The Ajax call to load more posts,

  lbApp.busy = true; // to avoid simultaneous calls
  $.ajax({
    url: lbApp.rootPath + '/ajax/GetMorePosts',
    type: "GET",
    success: function(data){
      $data = $(data);
      $container = $('#posts');
      $container.append( $data );

      $('.post_wrapper').css('visibility','visible');
      lbApp.currentPageNumber = lbApp.currentPageNumber + 1;
      lbApp.busy = false;
      ga('send','pageview', lbApp.currentPage + '/page-' + lbApp.currentPageNumber );
      lbApp.hidePostsLoadingIndicator();
      lbApp.loadLazyImages();
    }
  });
};

