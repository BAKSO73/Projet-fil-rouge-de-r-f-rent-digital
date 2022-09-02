<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package goldly
 */

if(get_theme_mod('goldly_display_breadcrumb_section',true) != ''){
	goldly_breadcrumb_slider();
}elseif(get_post_type()){	
	if(get_post_meta(get_the_ID(),'breadcrumb_select',true) == 'yes'){
		goldly_breadcrumb_slider();
	}
}