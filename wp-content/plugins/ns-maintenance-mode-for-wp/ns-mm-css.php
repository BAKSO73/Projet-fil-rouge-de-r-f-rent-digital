<?php
// Add css
function ns_load_css_mm() {
	wp_enqueue_style( 'bootstrap.min', plugin_dir_url( __FILE__ ) .'assets/css/bootstrap.min.css', array(), '3.3.5' );
	wp_enqueue_style( 'font-google-apis', '//fonts.googleapis.com/css?family='.get_option('ns_mm_text_font', 'Lato'), array(), '4.5.0' );
	wp_enqueue_style( 'bootstrap-slider', plugin_dir_url( __FILE__ ) .'assets/css/bootstrap-slider.css', array(), '2.0' );
	wp_enqueue_style( 'full-slider', plugin_dir_url( __FILE__ ) .'assets/css/full-slider.css', array(), '2.0' );		
	wp_enqueue_style( 'main', plugin_dir_url( __FILE__ ) .'assets/css/main.css', array(), '3.3.5' );
    wp_register_style( 'ns-fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '4.2.0' );
	wp_enqueue_style( 'ns-fontawesome' );
	

	$ns_img = get_option('ns_mm_background_image', '');
	if($ns_img == '')
		$ns_img = plugin_dir_url(__FILE__).'ns-admin-options/img/1.jpg';
	$custom_dynamic_css = " h1,h2,h3,h4,h5,h6,p, .buttone {
        	font-family: ".get_option('ns_mm_text_font', 'Lato')."!important;
        	color: ".get_option('ns_mm_text_color', '#FFFFFF')." !important;
        }
        a, a:visited, a:link, a:active {
			color: ".get_option('ns_mm_sbl_color', '#FFFFFF')." !important;
		}
		a:hover {
			color: ".get_option('ns_mm_sbl_color_hover', '#FFFFFF')." !important;
		}
		.NSnome, .NSmail{
			border: 1px solid ".get_option('ns_mm_sbl_border_color', '#2693A7')." !important;
		}
		.buttone {
			background-color: ".get_option('ns_mm_sbl_color', '#FFFFFF')." !important;
			color: ".get_option('ns_mm_text_color', '#000000')." !important;
			border: 1px solid ".get_option('ns_mm_sbl_border_color', '#2693A7')." !important;
		}
		.buttone:hover {
			background-color: ".get_option('ns_mm_sbl_color_hover', '#2693A7')." !important;
		}
		.socialll {
			color: ".get_option('ns_mm_sbl_color', '#2693A7')." !important;
		}
		.socialll:hover {
			color: ".get_option('ns_mm_sbl_color_hover', '#FFFFFF')." !important;
		}
		.bgLauncher {
			background: url($ns_img) no-repeat center center fixed; 
			background-size: cover;		
		}";
		
		/* CSS dinamico */
		wp_add_inline_style( 'main', $custom_dynamic_css );
}
add_action( 'wp_enqueue_scripts', 'ns_load_css_mm' );

?>