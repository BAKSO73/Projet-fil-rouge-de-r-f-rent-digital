<?php
/*Service for ajax call to create csv*/
add_action( 'wp_ajax_nopriv_ns_mm_create_csv_subscriber', 'ns_mm_create_csv_subscriber' );
add_action( 'wp_ajax_ns_mm_create_csv_subscriber', 'ns_mm_create_csv_subscriber' );
function ns_mm_create_csv_subscriber(){
	
	if(isset($_POST['action']) && $_POST['action'] == 'ns_mm_create_csv_subscriber'){
		$args = array(
			'post_type' => 'subscriber',
		); 
		
		$users_sub = get_posts( $args );
		$subscribers = array();
		foreach($users_sub as $sub){
			echo get_post_meta($sub->ID, 'ns-maintenance-mode-email', true).','.get_post_meta($sub->ID, 'ns-maintenance-mode-name', true).PHP_EOL;
		}
		
		//print_r(implode(',', $subscribers));
	}
	
	die();
}
?>