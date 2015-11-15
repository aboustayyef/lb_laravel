lbApp.showPost = function(details){
		event.preventDefault(); // links degrade gracefully;
		console.log(details);

		// fill in the info of the Modal before showing it
		
		var $modalTitle = $('h2.lbModal__postTitle');
		var $modalImage = $('.lbModal__postImage img');
		var $modalExcerpt = $('.lbModal__postExcerpt');
		var $modalBlogTitle = $('.lbModal__blogTitle');

		// Blog Title

		$modalBlogTitle.text(details.blog.blog_name);

		// Title

		$modalTitle.text(details.post_title);

		// if post has an image, display it, else hide the image placeholder;
		
		if (details.post_image) {
			// adjust image dimensions
			$modalImage.show();
			var $width = 680 ; // the width of the containing div
			var $height = $width * (details.post_image_height / details.post_image_width); // auto-adjust proportions
			$modalImage.attr('src',details.post_image); // clear the image first (to remove previous one)
			$modalImage.attr('width', $width);
			$modalImage.attr('height', $height);
			$modalImage.attr('src',details.post_image); // then replace it 
		} else {
			$modalImage.hide();
		};



		// excerpt
		
		$modalExcerpt.text(details.post_excerpt);

		// Activate modal
		$('#lbModalWrapper').addClass('active');
};

// we define this only once
$('#lbModal__closeButton').on('click', function(){
	  $('#lbModalWrapper').removeClass('active');
});