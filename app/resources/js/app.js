//prerequisits 

// jQuery
var $ = require('jquery');

// Masonry
var jQueryBridget = require('jquery-bridget'); // we need it so that Masonry can be used w/ jquery
var Masonry = require('masonry-layout');
jQueryBridget('masonry', Masonry, $);

// Lb App Modules
var lbPosts = require('./lbModules/lbPosts.js');
var lbCanvas = require('./lbModules/lbCanvas.js');
var lbEvents = require('./lbModules/lbEvents.js');

// Global App object is initialized from within HTML

// Main App
$(document).ready(function(){

	// initialize Masonry
	lbApp.grid = $('#'+lbApp.posts_wrapper).masonry({
		itemSelector: '.card',
		transitionDuration: 0,
		gutter:10,
	});

	// initialize sub modules
	lbPosts.init();

	// initialize Canvas
	lbCanvas.init();

	// initialize Events
	lbEvents.init();

	// all other code goes here
	lbApp.getPosts();
});