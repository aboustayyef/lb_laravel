lbApp.hideCurrentTopFive = function(){
	$('.toplist ul').css('background','rgb(235,235,235)').find('li').css('opacity',0);
	$('.toplist ul').prepend('<span class="loading"><i class="fa fa-refresh fa-spin"></i> Loading</span>');
}

lbApp.showCurrentTopFive = function(){
	$('.toplist ul').css('background','white').find('li').css('opacity',1);
	$('.loading').hide();
}

lbApp.resetTopListImages = function(){
	$('.toplist .thumb img').each(function(){
		$(this).attr('src',lbApp.imagePlaceHolder);
	});
}

lbApp.updateTopFive = function(data){
	$.each(data,function(key){
		$item = $('.toplist ul').find('li:eq(' + key + ')');
		$item.find('h3').text(data[key].post_title);
		$item.find('h4').text(data[key].blog_name);
		$item.find('.thumb img').addClass('lazy').attr({'src':data[key].post_image});
		if (data[key].post_image_height > data[key].post_image_width) {
			$item.find('.thumb img').attr({'width':100,'height':'auto'});
		}else{
			$item.find('.thumb img').attr({'height':100,'width':'auto'});
		};
	});
}

lbApp.loadNewTopFive = function(hours){
	lbApp.hideCurrentTopFive();
	$.ajax({
		url: lbApp.ajaxTop5Path,
		type: "GET",
		data: {hours: hours},
		success: function(data){
			lbApp.updateTopFive(data);
			lbApp.showCurrentTopFive();
			lbApp.flowPosts();
		},
	})
}

$('#topListScoper').on('change', function(){
	lbApp.resetTopListImages();
	lbApp.loadNewTopFive($(this).val());
})
