window.jQuery = require('jquery');
window.$ = window.jQuery;

require('./thirdparty/jquery-tagsinput');
require('bootstrap');

var Dropzone = require("dropzone");

// Disabling autoDiscover, otherwise Dropzone will try to attach twice.
Dropzone.autoDiscover = false;

$(function() {

	// Tags
	$('#tags').tagsInput();

	// make sure only two categories are checked
	$('.checkbox input').on('change', function(){
		if ($('.checkbox input:checked').length > 2) {
			$('#maxCategoriesWarning').text('You cannot select more than two categories');
		}else{
			$('#maxCategoriesWarning').text('');
		}
	})

	// Dropzone
	if ($('.dropzone').length > 0) {		
		var defaultMessage = "Click Here To upload new avatar";
		var showMessage = $('.dropzone').data('message') || defaultMessage;

		var myDropzone = new Dropzone(".dropzone", {
			maxFiles : 1,
			acceptedFiles: "image/*",
			dictDefaultMessage: showMessage	
		});

		myDropzone.on("addedfile", function(file) {
			// location.reload();
			// event to happen upon succesful change
	  	});
	}

})