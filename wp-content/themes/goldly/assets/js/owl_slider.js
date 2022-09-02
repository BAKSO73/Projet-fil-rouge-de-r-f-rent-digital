jQuery(document).ready(function() {
	if(main_vars.img_autoplay === 'true'){
		var img_auto=true;		
	}else{
		var img_auto=false;
	}
	var img_autospeed = main_vars.img_autoplayspped;   
	jQuery('.featuredimage_slider').each(function() {
		jQuery(this).addClass('owl-loaded owl-drag').owlCarousel({
	    	navigation : true, // Show next and prev buttons 
	    	loop: true,	
		    slideSpeed : 300,
		    paginationSpeed : 400,	 
		    items : 1, 
		    itemsDesktop : false,
		    itemsDesktopSmall : false,
		    itemsTablet: false,
		    itemsMobile : false,
		    nav: true,
		    autoplay: img_auto,
	        autoplaySpeed: img_autospeed,
	    	navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		});
	});

	if(main_vars.autoplay === 'true'){
		var auto=true;		
	}else{
		var auto=false;
	}
	var autospeed = main_vars.autoplayspped;   

	jQuery('.testinomial_owl_slider').each(function() {
		jQuery(this).addClass('owl-loaded owl-drag').owlCarousel({
		//jQuery('#testinomial_owl_slider').owlCarousel({
	    	navigation : true, // Show next and prev buttons 
	    	loop: true,	
		    slideSpeed : 300,
		    paginationSpeed : 400,	 
		    items : 3, 
		    itemsDesktop : false,
		    itemsDesktopSmall : false,
		    itemsTablet: false,
		    itemsMobile : false,
	    	margin:10,
	    	autoplay: auto,
	        autoplaySpeed: autospeed,
	    	responsive:{
		        0:{
		            items:1,
		            nav:true
		        },
		        600:{
		            items:3,
		            nav:false
		        }
		    }
		});	
	});
});
