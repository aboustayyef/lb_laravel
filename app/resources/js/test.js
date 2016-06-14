var $ = require('jquery');

var init = function(){
	$(document).ready(function(){
		console.log('This code was loaded from a module');
	});
	$('p').on('click', function(){
		console.log('a <p> tag was clicked. This code was from a bundled file');
	});
}

module.exports = {
	init: init
}