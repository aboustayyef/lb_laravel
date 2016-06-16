var $ = require('jquery');
var Mustache = require('mustache');

var init = function(){
	
	var template;

	$.get('/js/post_template.html', function(data){
		template = data;
	})

	lbApp.renderPostHtml = function(absoluteIndex, post){
		post.absoluteIndex = absoluteIndex;
		return Mustache.render(template, post);
	}

}

module.exports = {
	init: init
}