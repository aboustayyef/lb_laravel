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
    $(this).toggleClass('open');
	e.stopPropagation();
});


$(document).on('click', ".shareButton", function(e){
	if ($(this).hasClass('active')) {
		$(this).removeClass('active');
		$(this).html('<i class="fa fa-share"></i> Share');
	} else {
		$(this).addClass('active');
		$(this).html('<i class ="fa fa-times"> </i> Close');
	};
});

lbApp.clearMenus = function(){
	$('#search').removeClass('open');
	$('#about').removeClass('open');
  $('#sidebar').removeClass('open');
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
