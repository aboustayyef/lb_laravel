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
	if (!($('#sidebar').hasClass('open'))) {
		$('#sidebar').addClass('open');
	};
	e.stopPropagation();
});

$('#dismissSidebar').on('click', function(e){
	$('#sidebar').removeClass('open');
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

lbApp.clearTopMenus = function(){
	$('#search').removeClass('open');
	$('#about').removeClass('open');	
}

$(document).on('click', function(e){
	lbApp.clearTopMenus();
})

$(document).keyup(function(e) {
  if (e.keyCode == 27) { 
  lbApp.clearTopMenus();
  $('#sidebar').removeClass('open');
   }   // esc
});

$('#searchPosts').on('click', function(e){
	e.stopPropagation();
})