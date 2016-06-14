var $ = require('jquery');
var Masonry = require('masonry-layout');
var test = require('./test.js');

$(document).ready(function(){
	console.log('document is ready!. Browserify is working');
	console.log('Type of Masonry is ' + typeof(Masonry));
	test.init();
});