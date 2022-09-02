// Display image in input type text after choosen
jQuery(document).ready(function($){
	
	if($('#ns_mm_background_image').val() != ''){
		$('#ns_reset_logo').css('color', '#900');
	}
	
	// Clear logo image in admin general
	$('#ns_reset_logo').click(function() {
        $('#ns_mm_background_image').removeAttr('value');
		$(this).css('color', '#ccc');
    });
	
	var _custom_media = true,
	_orig_send_attachment = wp.media.editor.send.attachment;

	$('#ns_mm_background_image_button').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		var id = button.attr('id').replace('_button', '');
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media ) {
				$("#"+id).val(attachment.url);
				$('#ns_reset_logo').css('color', '#900');
			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			};
		}

		wp.media.editor.open(button);
		return false;
	});

	$('.add_media').on('click', function(){
		_custom_media = false;
	});
	
	$('#export-csv').on('click', function(){
		jQuery.ajax({
			 url : ns_mm_create_csv_subscriber.ajax_url,
			 type : 'post',
			 data : {
				action : 'ns_mm_create_csv_subscriber',
			 },
			 success : function( response ) {
				// console.log(response);
				var a = document.getElementById("export-csv-a");
				var file = new Blob([response.replace(/\n/g, "\r\n")], {type: 'text/plain'});
				a.href = URL.createObjectURL(file);
				a.download = 'subscribers';
				a.click();
			 },
			 error: function(errorThrown){
				alert(errorThrown.responseText);
			 }
		});
	
	});
});