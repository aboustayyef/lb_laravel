var $ = require('jquery');

var init = function(){
	
	var resizeTimer;
	
	// when document is ready. Adjust dimensions
	$(document).ready(function(){
		lbApp.CanvasRefreshDimensions();
	});

	// debounced resize
	$(window).on('resize', function(e) {

	  clearTimeout(resizeTimer);
	  resizeTimer = setTimeout(function() {

	    lbApp.CanvasRefreshDimensions();
	            
	  }, 250);

	});

}

module.exports = {
	init: init
}