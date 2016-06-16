//prerequisits 
var $ = require('jquery');

// Masonry
var jQueryBridget = require('jquery-bridget'); // we need it so that Masonry can be used w/ jquery
var Masonry = require('masonry-layout');
jQueryBridget('masonry', Masonry, $);

// Lb App Modules
var addPosts = require('./addPosts.js');

// Global App object is initialized from within HTML


// Main App
$(document).ready(function(){

	// initialize Masonry
	lbApp.grid = $('#'+lbApp.posts_wrapper).masonry({
		itemSelector: '.card',
		columns: 2,
		gutter:10,
	});

	// initialize sub modules
	addPosts.init();

	// all other code goes here
	lbApp.getPosts();
});