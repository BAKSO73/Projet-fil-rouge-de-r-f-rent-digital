<?php
/*
Plugin Name: NS Maintenance Mode for WP
Plugin URI: http://www.nsthemes.com
Description: This plugin allow to enable maintenance mode
Version: 1.3.1
Author: NsThemes
Author URI: https://profiles.wordpress.org/nsthemes/
 */


/** 
 * @author        PluginEye
 * @copyright     Copyright (c) 2019, PluginEye.
 * @version         1.1.1
 * @license       https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 * PLUGINEYE SDK
*/

require_once('plugineye/plugineye-class.php');
$plugineye = array(
    'main_directory_name'       => 'ns-maintenance-mode-for-wp',
    'main_file_name'            => 'ns-maintenance-mode.php',
    'redirect_after_confirm'    => 'admin.php?page=ns-maintenance-mode-for-wp%2Fns-mm-options-page-html.php',
    'plugin_id'                 => '276',
    'plugin_token'              => 'NWQwMGIzODFjMTY0MGVmYzg1YmU0ZWVmM2ZjYTI3MGJjY2Q2ZDk4Mzc1MWVmYWMxOGExZDM1YWM5NDc0NGUxNmU2N2ZmZTcwNGE0OTY=',
    'plugin_dir_url'            => plugin_dir_url(__FILE__),
    'plugin_dir_path'           => plugin_dir_path(__FILE__)
);

$plugineyeobj276 = new pluginEye($plugineye);
$plugineyeobj276->pluginEyeStart();      


if ( ! defined( 'WPMM_NS_PLUGIN_DIR' ) )
    define( 'WPMM_NS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/* *** plugin options *** */
require_once( WPMM_NS_PLUGIN_DIR.'/ns-mm-options.php');
require_once( WPMM_NS_PLUGIN_DIR.'/ns-admin-options/ns-admin-options-setup.php');

require_once( WPMM_NS_PLUGIN_DIR.'/ns-mm-template-mail.php');

require_once( WPMM_NS_PLUGIN_DIR.'/csvMaker.php');

/* *** include js *** */
require_once( WPMM_NS_PLUGIN_DIR.'/ns-mm-js.php');

/* *** fonts array page *** */
require_once( WPMM_NS_PLUGIN_DIR.'/ns-mm-fonts.php');

function ns_maintenance_mode_page_maintenance_mode_redirect(){
    if( ! current_user_can( 'administrator' )){
        /* *** include css *** */
        require_once( WPMM_NS_PLUGIN_DIR.'/ns-mm-css.php');
        /* *** include index *** */
        require_once( WPMM_NS_PLUGIN_DIR.'/index.php');
        exit();
    }
}
add_action( 'template_redirect', 'ns_maintenance_mode_page_maintenance_mode_redirect' );



add_action( 'init', 'ns_maintenance_mode_create_post_type' );
function ns_maintenance_mode_create_post_type() {
  register_post_type( 'subscriber',
    array(
      'labels' => array(
        'name' => __( 'Subscribers' ),
        'singular_name' => __( 'Subscriber' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
 
}

//HTML Mail code
function ns_mm_set_mail_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','ns_mm_set_mail_content_type' );

// ADD NAME META BOX
function ns_maintenance_mode_adding_custom_meta_boxes( $post_type, $post ) {
    add_meta_box( 
        'ns-maintenance-mode-name',
        __( 'Name' ),
        'ns_maintenance_mode_render_name',
        'subscriber',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'ns_maintenance_mode_adding_custom_meta_boxes', 10, 2 );

function ns_maintenance_mode_render_name($post, $args){
?>
   <p>
<label for="ns-maintenance-mode-name">Name: </label>
<input type="text" name="ns-maintenance-mode-name" value="<?php echo esc_html(get_post_meta($post->ID, 'ns-maintenance-mode-name', true)) ?>" />
   </p>
<?php    
}

function ns_maintenance_mode_save_meta_box( $post_id ) {
    // Save logic goes here. Don't forget to include nonce checks!
	$name = '';
	if(isset($_REQUEST['ns-maintenance-mode-name'])){
		$name = sanitize_text_field($_REQUEST['ns-maintenance-mode-name']);
	}
    if($name != ''){
        update_post_meta($post_id, 'ns-maintenance-mode-name', $name);
    }
}
add_action( 'save_post', 'ns_maintenance_mode_save_meta_box' );

// ADD EMAIL META BOX
function ns_maintenance_mode_adding_custom_meta_boxes_email( $post_type, $post ) {
    add_meta_box( 
        'ns-maintenance-mode-email',
        __( 'Email' ),
        'ns_maintenance_mode_render_email',
        'subscriber',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'ns_maintenance_mode_adding_custom_meta_boxes_email', 10, 2 );

function ns_maintenance_mode_render_email($post, $args){
?>
   <p>
<label for="ns-maintenance-mode-email">Email: </label>
<input type="text" name="ns-maintenance-mode-email" value="<?php echo esc_html(get_post_meta($post->ID, 'ns-maintenance-mode-email', true)); ?>" />
   </p>
<?php    
}

function ns_maintenance_mode_save_meta_box_email( $post_id ) {
    // Save logic goes here. Don't forget to include nonce checks!
	$email = '';
	if(isset($_REQUEST['ns-maintenance-mode-email'])){
		$email = sanitize_text_field($_REQUEST['ns-maintenance-mode-email']);
	}
    if($email != ''){
        update_post_meta($post_id, 'ns-maintenance-mode-email', $email);
    }
}
add_action( 'save_post', 'ns_maintenance_mode_save_meta_box_email' );

// ADD THE COLUM
add_filter('manage_subscriber_posts_columns','ns_maintenance_mode_filter_cpt_columns');

function ns_maintenance_mode_filter_cpt_columns( $columns ) {
    // this will add the column to the end of the array
    $columns['name'] = 'Name';
    $columns['email'] = 'Email';
    //add more columns as needed

    // as with all filters, we need to return the passed content/variable
    return $columns;
}

// ADD THE COLUMN CONTENT
add_action( 'manage_posts_custom_column','ns_maintenance_mode_action_custom_columns_content', 10, 2 );
function ns_maintenance_mode_action_custom_columns_content ( $column_id, $post_id ) {
    //run a switch statement for all of the custom columns created
    switch( $column_id ) { 
        case 'name':
            echo ($value = get_post_meta($post_id, 'ns-maintenance-mode-name', true ) ) ? $value : 'No Name';           
        break;

        //add more items here as needed, just make sure to use the column_id in the filter for each new item.

   }
}

// ADD THE COLUMN CONTENT
add_action( 'manage_posts_custom_column','ns_maintenance_mode_action_custom_columns_content2', 10, 2 );
function ns_maintenance_mode_action_custom_columns_content2 ( $column_id, $post_id ) {
    //run a switch statement for all of the custom columns created
    switch( $column_id ) { 
        case 'email':
            echo ($value2 = get_post_meta($post_id, 'ns-maintenance-mode-email', true ) ) ? $value2 : 'No Email';          
        break;

        //add more items here as needed, just make sure to use the column_id in the filter for each new item.

   }
}

// EXPORT CSV
add_filter( 'views_edit-subscriber', 'ns_maintenance_mode_add_button_to_views' );
function ns_maintenance_mode_add_button_to_views( $views )
{
    $views['my-button'] = '<a href="" id="export-csv-a"></a><button id="export-csv" type="button" title="Export CSV" class="button">Export CSV</button>';

    return $views;
}

/* *** add link premium *** */
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'ns_maintenance_mode_add_action_links' );

function ns_maintenance_mode_add_action_links ( $links ) {	
 $mylinks = array('<a id="nspblinkpremium" href="https://www.nsthemes.com/?ref-ns=2&campaign=MM-linkpremium" target="_blank">'.__( 'Join NS Club', 'ns-maintenance-mode' ).'</a>');
return array_merge( $links, $mylinks );
}
?>