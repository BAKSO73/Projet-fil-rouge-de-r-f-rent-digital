/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.site-title a, .site-description' ).css( {
					color: to,
				} );
			}
		} );
	} );
	/*wp.customize.controlConstructor['sortable'] = wp.customize.Control.extend( {

		// When we're finished loading continue processing
		ready: function () {
			'use strict';
			console.log("dddddaa");
		}
	});*/

	//ordering js
	/*wp.customize.controlConstructor['sortable'] = wp.customize.Control.extend( {

	});*/
	//console.log(wp.customize);
	//wp.customize( 'global_ordering', function( setting ) {
		 //var section = setting.get(); 
		 //control.sortableContainer = control.container.find( 'ul.sortable' ).first();
	    //console.log(section);
	  /*  console.log(sortableContainer);*/
	//});control.container
	/*wp.customize( 'global_ordering', function( control ) {
		control.sortableContainer = jQuery('ul.sortable').first();		
		control.sortableContainer
		       .sortable( {

			       // Update value when we stop sorting.
			       stop: function () {
				       control.updateValue();
			       }
		       } )
		       .disableSelection()
		       .find( 'li' )
		       .each( function () {
		       	alert('gredfgv');

			       // Enable/disable options when we click on the eye of Thundera.
			       jQuery( this )
				       .find( 'i.visibility' )
				       .click( function () {
					       jQuery( this )
						       .toggleClass( 'dashicons-visibility-faint' )
						       .parents( 'li:eq(0)' )
						       .toggleClass( 'invisible' );
				       } );
		       } )
		       .click( function () {

			       // Update value on click.
			       control.updateValue();
		       } );
	} );*/
	//},
	/*console.log("gggg");
   	jQuery('#sortablea').sortable({
   			update: function( event, ui ) {
  				$data = jQuery(this).find("li").attr('value');
  				alert($data);

  			

  			}*/
   		/*update: function( event, ui ) {
  			$data = jQuery(this).find(".wpv_dd_filed").attr('value');

  			var or_drop_index = new Array();
      		jQuery('.sortable li').each(function() {
				    or_drop_index.push(jQuery(this).find('.wpv_dd_filed').attr("id"));
			     });

  		}*/

   	//});

/*_.each( wp.customize.control, function ( obj, type ) {
	wp.customize.controlConstructor[
		type
		] = wp.customize.consultstreetDynamicControl.extend( {} );
} );
console.log(controlConstructor);*/


	// wp.customize('global_ordering', function(setting) {
 //    var section = setting.get(); // aka section.about_me
	//    setting.bind(function onClick(){
	// 		wp.customize.control('global_ordering', function(control) {
	// 			console.log(control);
	// 			control.sectionToHide = api.previewer.preview.container.find('.' + section);


	// 		});
	// 	});

	// });
	/*wp.customize.control( 'global_ordering' ).section();
	control.sortableContainer = control.container.find( 'ul.sortable' ).first();
	
	control.sortableContainer
		       .sortable( {

		       });*/

}( jQuery ) );


