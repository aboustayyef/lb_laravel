$('#about').on('click', function(e){
	$('#aboutMenu').toggleClass('open');
  $('#about').toggleClass('open');
	e.stopPropagation();
});


$(document).on('click', ".action", function(event){
  event.stopPropagation();
  $fatherPost = $(this).closest('div.post_wrapper');
	if ($(this).hasClass('active')) {
    $(this).removeClass('active');
    $(this).html('<i class="fa fa-share"></i> More');
	} else {
		$(this).addClass('active');
		$(this).html('<i class ="fa fa-times"> </i> Close');
	}
});


lbApp.clearMenus = function(){
	$('#about').removeClass('open');
  $('#sidebar').removeClass('open');
  $('#siteWrapper').removeClass('open');
  $('#topBar').removeClass('open');
  $('#lbModalWrapper').removeClass('active');
  $('.action.active').each(function(){
    $(this).removeClass('active');
  });
};


$(document).keyup(function(e) {
  if (e.keyCode == 27) {
  lbApp.clearMenus();
  }
});

// open links depending on whether or not external tab switched is on

$('.exitLink').on('click',function(e){
    e.preventDefault();
    var targetLocation = $(e.currentTarget).attr('href');
    if ($('#newtabs:checked').length === 0 ){
        location.href = targetLocation;
    }else{
        window.open(targetLocation,'_blank');
    }
});
