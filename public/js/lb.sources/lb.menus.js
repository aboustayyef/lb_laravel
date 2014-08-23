$('#about').on('click', function(e){
	$(this).toggleClass('open');
	$('#search').removeClass('open');
	e.stopPropagation();
});

$('#search').on('click', function(e){
	$(this).toggleClass('open');
	$('#about').removeClass('open');
	//$('#searchPosts').focus();
	e.stopPropagation();
});

$('#hamburger').on('click', function(e){
		$('#sidebar').toggleClass('open');
    $('#siteWrapper').toggleClass('open');
    //$(this).toggleClass('open');
  	e.stopPropagation();
});
$('#sidebar .close').on('click', function(e){
    e.preventDefault();
    $('#sidebar').removeClass('open');
    $('#siteWrapper').removeClass('open');
    e.stopPropagation();
});

$(document).on('click', ".action", function(e){
  $fatherPost = $(this).closest('div.post_wrapper');
	if ($(this).hasClass('active')) {
    // undim background
    $fatherPost.css('background-color','');
    $fatherPost.find('img.thumbnail').css('opacity','');
    $fatherPost.find('.viralityBox').css('opacity','');
    $fatherPost.find('img.cardImage').css('opacity','');

    $(this).removeClass('active');
    $(this).html('<i class="fa fa-share"></i> More');
	} else {
		$(this).addClass('active');
		$(this).html('<i class ="fa fa-times"> </i> Close');
    // dim background
    $fatherPost.css('background-color','silver');
    $fatherPost.find('img.thumbnail').css('opacity',0.5);
    $fatherPost.find('.viralityBox').css('opacity',0.5);
    $fatherPost.find('img.cardImage').css('opacity',0.5);
	};
});

lbApp.clearMenus = function(){
	$('#search').removeClass('open');
	$('#about').removeClass('open');
  $('#sidebar').removeClass('open');
  $('#siteWrapper').removeClass('open');
  $('#topBar').removeClass('open');
}

$(document).on('click', function(e){
	lbApp.clearMenus();
})

$(document).keyup(function(e) {
  if (e.keyCode == 27) {
  lbApp.clearMenus();
  $('#sidebar').removeClass('open');
   }   // esc
});

$('#searchPosts').on('click', function(e){
	e.stopPropagation();
})
