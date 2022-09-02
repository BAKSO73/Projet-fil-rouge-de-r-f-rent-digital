<?php

require get_stylesheet_directory() . '/customizer/header-setting.php';
require get_stylesheet_directory() . '/customizer/customizer-control.php';
require get_stylesheet_directory() . '/customizer/ecommerce-about.php';
require get_stylesheet_directory() . '/customizer/customizer-css.php';

/* enqueue script for parent theme stylesheeet */        
function ecommercegoldly_childtheme_parent_styles() {
 
 // enqueue style
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'ecommerce-goldly' ) );
}
add_action( 'wp_enqueue_scripts', 'ecommercegoldly_childtheme_parent_styles');

function ecommercegoldly_theme_mods() {
    if(empty(get_theme_mod( 'goldly_excerpt_length' )))
        set_theme_mod('goldly_excerpt_length', '50');
    if(empty(get_theme_mod( 'goldly_sticky_bg_color' )))
        set_theme_mod('goldly_sticky_bg_color', '#333');
    if(empty(get_theme_mod( 'goldly_button_bg_color' )))
        set_theme_mod('goldly_button_bg_color', '#333');
    if(empty(get_theme_mod( 'goldly_button_texthover_color' )))
        set_theme_mod('goldly_button_texthover_color', '#333');
    if(empty(get_theme_mod( 'goldly_button_border_color' )))
        set_theme_mod('goldly_button_border_color', '#333');
    if(empty(get_theme_mod( 'goldly_scroll_button_bg_color' )))
        set_theme_mod('goldly_scroll_button_bg_color', '#000000');
    if(empty(get_theme_mod( 'goldly_sidebar_heading_bg_color' )))
        set_theme_mod('goldly_sidebar_heading_bg_color', '#333');
    if(empty(get_theme_mod( 'goldly_footer_bg_color' )))
        set_theme_mod('goldly_footer_bg_color', '#333');
    if(empty(get_theme_mod( 'goldly_breadcrumb_text_color' )))
        set_theme_mod('goldly_breadcrumb_text_color', '#ffffff');
    if(empty(get_theme_mod( 'goldly_breadcrumb_link_color' )))
        set_theme_mod('goldly_breadcrumb_link_color', '#85e2dc');
    if(empty(get_theme_mod( 'featured_slider_arrow_bg_color' )))
        set_theme_mod('featured_slider_arrow_bg_color', '#333333');
    if(empty(get_theme_mod( 'featured_slider_arrow_texthover_color' )))
        set_theme_mod('featured_slider_arrow_texthover_color', '#333333');
    if(empty(get_theme_mod( 'goldly_featured_section_color' )))
        set_theme_mod('goldly_featured_section_color', '#333333');
    if(empty(get_theme_mod( 'goldly_featured_section_bg_hover_color' )))
        set_theme_mod('goldly_featured_section_bg_hover_color', '#333333');
    if(empty(get_theme_mod( 'our_team_container_text_color' )))
        set_theme_mod('our_team_container_text_color', '#333333');
    if(empty(get_theme_mod( 'our_team_icon_bg_hover_color' )))
        set_theme_mod('our_team_icon_bg_hover_color', '#333333');
    if(empty(get_theme_mod( 'our_team_testimonial_text_color' )))
        set_theme_mod('our_team_testimonial_text_color', '#333333');
    if(empty(get_theme_mod( 'our_services_contain_text_color' )))
        set_theme_mod('our_services_contain_text_color', '#333333');
    if(empty(get_theme_mod( 'our_services_contain_text_hover_color' )))
        set_theme_mod('our_services_contain_text_hover_color', '#333333');
    if(empty(get_theme_mod( 'our_services_border_hover_color' )))
        set_theme_mod('our_services_border_hover_color', '#333333');
    if(empty(get_theme_mod( 'goldly_link_color' )))
        set_theme_mod('goldly_link_color', '#000000');
    if(empty(get_theme_mod( 'goldly_topbar_text_color' )))
        set_theme_mod('goldly_topbar_text_color', '#333333');
    if(empty(get_theme_mod( 'goldly_header_background_color' )))
        set_theme_mod('goldly_header_background_color', '#333333');
    if(empty(get_theme_mod( 'goldly_social_icon_bg_color' )))
        set_theme_mod('goldly_social_icon_bg_color', '#333333');
    if(empty(get_theme_mod( 'goldly_social_icon_hover_color' )))
        set_theme_mod('goldly_social_icon_hover_color', '#333333');
    if(empty(get_theme_mod( 'goldly_social_icon_bg_hover_color' )))
        set_theme_mod('goldly_social_icon_bg_hover_color', '#a5a5a5');
    if(empty(get_theme_mod( 'goldly_callmenu_btn_bghover_color' )))
        set_theme_mod('goldly_callmenu_btn_bghover_color', '#333333');
    if(empty(get_theme_mod( 'goldly_callmenu_btn_color' )))
        set_theme_mod('goldly_callmenu_btn_color', '#333333');
    if(empty(get_theme_mod( 'goldly_call_btn_border_color' )))
        set_theme_mod('goldly_call_btn_border_color', '#333333');
    if(empty(get_theme_mod( 'goldly_mobile_navmenu_bg_color' )))
        set_theme_mod('goldly_mobile_navmenu_bg_color', '#333333');
    if(empty(get_theme_mod( 'goldly_mobile_submenu_bg_color' )))
        set_theme_mod('goldly_mobile_submenu_bg_color', '#adabab');
    if(empty(get_theme_mod( 'goldly_submenu_bg_color' )))
        set_theme_mod('goldly_submenu_bg_color', '#adabab');
    if(empty(get_theme_mod( 'goldly_breadcrumb_bg_color' )))
        set_theme_mod('goldly_breadcrumb_bg_color', '#707070');
    if(empty(get_theme_mod( 'goldly_header_layout' )))
        set_theme_mod('goldly_header_layout', 'header4');
    if(empty(get_theme_mod( 'goldly_footer_text_color' )))
        set_theme_mod('goldly_footer_text_color', '#85e2dc');
    if(empty(get_theme_mod( 'our_sponsors_main_title' )))
        set_theme_mod('our_sponsors_main_title', 'Our Brand');
	if(empty(get_theme_mod( 'our_portfolio_main_title' )))
        set_theme_mod('our_portfolio_main_title', 'Best Selling Off The Week...');
    if(empty(get_theme_mod( 'our_team_main_title' )))
        set_theme_mod('our_team_main_title', 'Something New For You');
	if(empty(get_theme_mod( 'design_heding_underline_color' )))
        set_theme_mod('design_heding_underline_color', '#333333');
	if(empty(get_theme_mod( 'goldly_transparent_header_link_hover_color' )))
        set_theme_mod('goldly_transparent_header_link_hover_color', '#b5b5b5');
}
add_action( 'init', 'ecommercegoldly_theme_mods' );

function ecommercegoldly_widgets_init()
{
    register_sidebar(
		array(
			'name'          => esc_html__( 'Product Section', 'ecommerce-goldly' ),
			'id'            => 'section',
			'description'   => esc_html__( 'Add widgets here.', 'ecommerce-goldly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'ecommercegoldly_widgets_init');

add_filter( 'goldly_recommended_plugins', 'ecommercegoldly_recommended_plugins' );
function ecommercegoldly_recommended_plugins( $plugins ){

    $plugins = array(

        array(
            'name'     => esc_html__( 'One Click Demo Import', 'ecommerce-goldly' ),
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ),
        array(
            'name'     => esc_html__( 'Reviewexchanger Demo Importer', 'ecommerce-goldly' ),
            'slug'     => 'reviewexchanger-demo-importer',
            'required' => false
        ),
        array(
            'name' => esc_html__('WooCommerce','ecommerce-goldly'),
            'slug' => 'woocommerce',
            'required' => false,
        ),
		array(
            'name' => esc_html__('Page Section For Themereviewer','ecommerce-goldly'),
            'slug' => 'page-section-for-themereviewer',
            'required' => false,
        ),
    );
    return $plugins;
}

add_filter( 'goldly_plugins', 'ecommercegoldly_plugins', 999 );
function ecommercegoldly_plugins(){
	$plugins = array(
		array(
			'slug' => 'one-click-demo-import/one-click-demo-import.php',
			'zip'  => 'one-click-demo-import'
		),	
		array(
			'slug' => 'reviewexchanger-demo-importer/reviewexchanger-demo-importer.php',
			'zip' => 'reviewexchanger-demo-importer'
		),
		array(
            'slug' => 'woocommerce/woocommerce.php',
            'zip' => 'woocommerce'
        ),
		array(
			'slug' => 'page-section-for-themereviewer/page-section-for-themereviewer.php',
			'zip' => 'page-section-for-themereviewer'
		),	
	);
	return $plugins;
}

add_action( 'after_setup_theme', 'ecommercegoldly_setup_theme' );
function ecommercegoldly_setup_theme() {

    add_theme_support( 'title-tag' );
}

add_action( 'wp_body_open', 'ecommercegoldly_add_balls_animation' );
function ecommercegoldly_add_balls_animation() {
    ?>
    <div id="tf-partical-wrap"></div>
    <?php
}

function ecommercegoldly_ordering_child($orderarr){
    $orderarr[] ='Goldly_full_banner_section';
    $orderarr[] ='Goldly_product_category_section';
    return $orderarr;
}
add_filter( 'goldly_order_settings', 'ecommercegoldly_ordering_child');


function goldly_proversinline($link){
    $link ='https://www.xeeshop.com/product/ecommerce-goldly-pro/';
    return $link;
}
add_filter( 'goldly_proversinline', 'goldly_proversinline');