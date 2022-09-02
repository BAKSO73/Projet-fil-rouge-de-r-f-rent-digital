<?php
function ns_mm_activate_set_back_to_top_options()
{
    add_option('ns_mm_background_image', plugins_url('assets/img/1.jpg', __FILE__));
    add_option('ns_mm_facebook_icon_link', '#');
    add_option('ns_mm_twitter_icon_link', '#');
    add_option('ns_mm_google_icon_link', '#');
    add_option('ns_mm_footer_text', 'Footer text');
    add_option('ns_mm_text_color', '#FFFFFF');
    add_option('ns_mm_sbl_color_hover', '#FFFFFF');
    add_option('ns_mm_sbl_border_color', '#FF0000');
    add_option('ns_mm_title_text', 'STAY UPDATE!');
    add_option('ns_mm_subtitle_text', 'Subscribe for latest update on our website');
    add_option('ns_mm_text_font', 'Lato');  
    add_option('ns_mm_rec_enabled', '');
    add_option('ns_mm_site_key', '');
    add_option('ns_mm_secret_key', '');         
   
}

register_activation_hook( __FILE__, 'ns_mm_activate_set_back_to_top_options');



function ns_mm_register_options_group()
{
    register_setting('ns_mm_options_group', 'ns_mm_background_image');
    register_setting('ns_mm_options_group', 'ns_mm_facebook_icon_link');
    register_setting('ns_mm_options_group', 'ns_mm_twitter_icon_link');
    register_setting('ns_mm_options_group', 'ns_mm_google_icon_link');
    register_setting('ns_mm_options_group', 'ns_mm_footer_text');
    register_setting('ns_mm_options_group', 'ns_mm_text_color');
    register_setting('ns_mm_options_group', 'ns_mm_sbl_color');
    register_setting('ns_mm_options_group', 'ns_mm_sbl_color_hover');
    register_setting('ns_mm_options_group', 'ns_mm_title_text');  
    register_setting('ns_mm_options_group', 'ns_mm_subtitle_text');
    register_setting('ns_mm_options_group', 'ns_mm_text_font');
    register_setting('ns_mm_options_group', 'ns_mm_sbl_border_color');   
    register_setting('ns_mm_options_group', 'ns_mm_rec_enabled');  
    register_setting('ns_mm_options_group', 'ns_mm_site_key');  
    register_setting('ns_mm_options_group', 'ns_mm_secret_key');    

}
 
add_action ('admin_init', 'ns_mm_register_options_group');

?>