var $ = require('jquery');
var template = require('./postTemplate.js');

template.init();

var init = function(){
	
	var absoluteIndex;
	var elems;

	// Get posts from the Api
	// requires channel and the number of posts

	lbApp.getPosts = function(){
		var path = '/api/posts/' + this.channel + '/' + this.posts + '/' + this.posts_per_load;
		$.getJSON(path, lbApp.renderPosts)
	};

	
	// Loops through the posts, get the html and append to the DOM
	// Also checks for extra cards

	lbApp.renderPosts = function(data){
		if (data.status == 'ok') {
			elems ='';
			var $posts = data.posts;
			
			$.each($posts, function(index, currentPost){
				
				absoluteIndex = lbApp.cards + index;
				
				// check for cards like ads/widgets/etc
				lbApp.checkForExtraCards(absoluteIndex);

				elems += lbApp.renderPostHtml(absoluteIndex, currentPost)
			});

			//Append result to the DOM
			$elems = $(elems);
			lbApp.grid.append($elems).masonry( 'appended', $elems);

			// Update Statistics (number of posts, number of cards)
			lbApp.posts += lbApp.posts_per_load;
			lbApp.cards += lbApp.posts_per_load; // to do: add extra cards too
		}
	};


	// Checks for extra cards (adds/widgets/etc) and then displays them using template

	lbApp.checkForExtraCards = function(){

		if (absoluteIndex == 30) {
			elems += 
			'<hr><div class="card"> <header>' +
				absoluteIndex + ' THIS IS AN EXTRA CARD' +
			'<hr></header></div>';
			lbApp.cards += 1;
			absoluteIndex += 1;
		}
	};

	
}

module.exports = {
	init: init
}