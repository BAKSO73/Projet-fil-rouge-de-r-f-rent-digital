jQuery(document).ready(function(){

	/*jQuery('.sortable').sortable({

	 	update: function(event, ui) {
	 		$data = jQuery(this).find(".repeater").attr('value');
				//var or_drop_index = new Array();
		 		var control  = this,
		 		    or_drop_index = [];

		 		    
		       		jQuery('.sortable li').each(function() {

		 			    or_drop_index.push(jQuery(this).attr("value"));
		 			    //alert(or_drop_index);
		 		    });
		 		    var ddd = or_drop_index.join(",");
		 		    //console.log();
					jQuery('#_customize-input-globalddd_ordering').val(ddd);
					jQuery('#_customize-input-globalddd_ordering').trigger('change');
		}
	});*/
	jQuery(".repeater-input i.visibility").click(function(){  
		 var drop_index = new Array();
	     jQuery(this).closest( "li.repeater" ).toggleClass("invisibility");    
	     $data = jQuery(this).closest( "li.repeater" ).attr('value');
	     	jQuery('.sortable li.invisibility').each(function() {
	    		
			     drop_index.push(jQuery(this).attr("value"));
			
			     if ( !jQuery(this).is( '.invisibility' ) ) {
				 	drop_index = jQuery( this ).data( 'value' ) ;
				 } 
		    });	
		    var ddd = drop_index.join(",");
			jQuery('#_customize-input-goldly_diseble').val(ddd);
			jQuery('#_customize-input-goldly_diseble').trigger('change');
	});	



    /* Call the Color Picker */
    jQuery( 'input.alpha-color-picker' ).alphaColorPicker();
});