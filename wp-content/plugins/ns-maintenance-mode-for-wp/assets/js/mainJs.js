// hide email sent message
jQuery(document).ready(function($) {

	  //jQuery('form#mm-subscription').submit(function() {
		t = setTimeout('fade_message()', 2000);
	  //});


});

	function fade_message() {
		jQuery('#mm-spaghetti-mailsent').fadeOut(1000);	
		clearTimeout(t);
	}