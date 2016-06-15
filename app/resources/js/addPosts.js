var $ = require('jquery');

var init = function(){
	
	lbApp.addPosts = function(){
		$.getJSON('/api/posts/' + this.channel + '/' + this.posts + '/' + this.posts_per_load, function(data){
			if (data.status == 'ok') {
				var elems ='';
				var $posts = data.posts;
				
				$.each($posts, function(index, currentPost){
					var absoluteIndex = lbApp.posts + index;
					elems += 
					'<div class="card">' +
					'<header>' +
						absoluteIndex + ' ' + currentPost.post_title +
					'</header>' +
					'</div>'
				});
				$('#'+lbApp.posts_wrapper).append(elems);

				// Update loaded posts number
				lbApp.posts += lbApp.posts_per_load;
			}
		})
	};

}

module.exports = {
	init: init
}