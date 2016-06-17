// jQuery
var $ = require('jquery')

// Masonry
var jQueryBridget = require('jquery-bridget'); // we need it so that Masonry can be used w/ jquery
var Masonry = require('masonry-layout');
jQueryBridget('masonry', Masonry, $);

var init = function(){
	
	var $canvas = $('#'+lbApp.posts_wrapper);
	var card_width = 300;
	var gutter = 10;
	var maxColumns = 5;
	var minimumMargin = 20;

	lbApp.CanvasRefreshDimensions = function(){

		var w = window.outerWidth;
		var e_col = card_width + gutter ;							// effective column width = column width + gutter
		var cols = Math.floor( w / e_col ); 						// number of columns
		cols = cols > maxColumns ? maxColumns : cols;				// limit columns to maxColumns
		var new_width = cols * e_col ;								// new width
		var margin_left = ( w - ( new_width - gutter )) / 2 ;		// add extra gutter for the right

		// if margins are two small, remove one column
		if (margin_left < minimumMargin) {
			new_width -= e_col;
			margin_left += e_col / 2 ;
		}

		$canvas.outerWidth(new_width);
		$canvas.css('margin-left', margin_left );

		this.CanvasRefresh();
	};

	lbApp.CanvasRefresh = function(){
		$canvas.masonry()
	}

}

module.exports = {
	init: init
}