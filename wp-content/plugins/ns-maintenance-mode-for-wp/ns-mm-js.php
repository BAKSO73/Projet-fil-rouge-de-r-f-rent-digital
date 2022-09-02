<?php
/* *** include admin css/js *** */
function ns_mm_load_admin_css($hook) {
    wp_enqueue_style( 'ns-mm-admin-style', plugin_dir_url( __FILE__ ) .'/assets/css/ns-mm-admin-style.css', array(), '1.0.0' );
	wp_enqueue_style( 'font-awesome-min-css', plugin_dir_url( __FILE__ ) .'/assets/css/font-awesome.min.css', array(), '1.0.0' );

	wp_enqueue_media();
	wp_enqueue_script( 'ns-mm-admin-script', plugin_dir_url( __FILE__ ) . '/assets/js/ns-mm-admin-script.js', array('media-upload','thickbox'), '1.0.0', true );	
	wp_enqueue_script( 'ns-mm-main-js', plugin_dir_url( __FILE__ ) . '/assets/js/mainJs.js', array('jquery'), '1.0' );
	
	wp_localize_script( 'ns-mm-admin-script', 'ns_mm_create_csv_subscriber', array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
}
add_action( 'admin_enqueue_scripts', 'ns_mm_load_admin_css' );