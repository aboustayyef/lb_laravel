//prerequisits 
var $ = require('jquery');
var Masonry = require('masonry-layout');

// Lb App Modules
var addPosts = require('./addPosts.js');

// Global App object is initialized from within HTML


// Main App
$(document).ready(function(){

	// initialize sub modules
	addPosts.init();

	// all other code goes here
	lbApp.addPosts();
});