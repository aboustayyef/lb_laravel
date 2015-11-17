lbApp.showPost = function(details, exiturl){

		var minimumHeight = 780;

		// First check that window is not too small
		if ($(window).height() < minimumHeight ) {
			return;
		};

		event.preventDefault(); // links degrade gracefully;
		console.log(details);

		// fill in the info of the Modal before showing it
		
		var $modal = $('#lbModal');
		var $modalTitle = $('h2.lbModal__postTitle');
		var $modalImage = $('.lbModal__postImage img');
		var $modalExcerpt = $('.lbModal__postExcerpt');
		var $modalBlogTitle = $('.lbModal__blogTitle');

		// stuff we get from initiating card
		var $initiatingCard = $('.post_wrapper.postID-' + details.post_id);
		var $twitterExitLink = $initiatingCard.find('.tweetit a').attr('href');
		var $facebookExitLink = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(details.post_url);

		// Fill Blog Title

		$modalBlogTitle.text(details.blog.blog_name);

		// Fill Title

		$modalTitle.text(details.post_title);

		// Place Image (if Any)
		
		if (details.post_image) {
			// adjust image dimensions
			$modalImage.show();
			var $width = 678 ; // the width of the containing div - 2px border
			var $height = $width * (details.post_image_height / details.post_image_width); // auto-adjust proportions
			$modalImage.attr('src',details.post_image); // clear the image first (to remove previous one)
			$modalImage.attr('width', $width);
			$modalImage.attr('height', $height);
			$modalImage.attr('href',details.post_image); // then replace it 
			var $highlightColor = 'hsl(' + details.post_image_hue + ', 60% , 40%)';
		} else {
			$modalImage.hide();
			var $highlightColor = '#555';
		}

		// Style the word "PREVIEW":
		$('#lbModal h4').css('background-color', $highlightColor);

		// Fill the Excerpt
		
		$modalExcerpt.html( '...' + details.post_excerpt);
		$modalExcerpt.find('a').css({'color': $highlightColor});
		$modal.find('h5').css({'color': $highlightColor, 'opacity': 0.7});

		// Initiate exit links

		$('.exitUrl').attr('href', exiturl);
		$('.shareOnFacebook').attr('href', $facebookExitLink);
		$('.shareOnTwitter').attr('href', $twitterExitLink);
		
		// Activate the modal
		
		$('#lbModalWrapper').addClass('active');



};

// we define this only once
$('#lbModal__closeButton').on('click', function(){
	  $('#lbModalWrapper').removeClass('active');
});