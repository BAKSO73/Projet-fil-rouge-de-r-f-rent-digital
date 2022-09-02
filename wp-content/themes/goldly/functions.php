<?php
/**
 * Goldly functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Goldly
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'goldly_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function goldly_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Goldly, use a find and replace
		 * to change 'goldly' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'goldly', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'goldly' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'goldly_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'goldly_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $goldly_content_width
 */
function goldly_content_width() {
	$GLOBALS['goldly_content_width'] = apply_filters( 'goldly_content_width', 640 );
}
add_action( 'after_setup_theme', 'goldly_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function goldly_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'goldly' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'goldly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer1', 'goldly' ),
			'id'            => 'footer1',
			'description'   => esc_html__( 'Add widgets here.', 'goldly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer2', 'goldly' ),
			'id'            => 'footer2',
			'description'   => esc_html__( 'Add widgets here.', 'goldly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer3', 'goldly' ),
			'id'            => 'footer3',
			'description'   => esc_html__( 'Add widgets here.', 'goldly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer4', 'goldly' ),
			'id'            => 'footer4',
			'description'   => esc_html__( 'Add widgets here.', 'goldly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer5', 'goldly' ),
			'id'            => 'footer5',
			'description'   => esc_html__( 'Add widgets here.', 'goldly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'goldly_widgets_init' );


function goldly_wpdocs_setup_theme() {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 600, 350, true );
}
add_action( 'after_setup_theme', 'goldly_wpdocs_setup_theme' );

// if ( ! function_exists( 'goldly_excerpt_length' ) ) :
// 	function goldly_excerpt_length( $length ) {
// 		if ( is_admin() ) {
// 			return $length;
// 		}
// 		$length	= get_theme_mod( 'goldly_excerpt_length', 20 );

// 		return absint( $length );
// 	}
// endif; //goldly_excerpt_length
// add_filter( 'excerpt_length', 'goldly_excerpt_length', 999 );

function goldly_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'goldly_excerpt_length', 999 );

// Add custom meta box
add_action("add_meta_boxes", "goldly_add_sidebar_meta_box");
function goldly_add_sidebar_meta_box()
{
	$post_types = get_post_type();
    add_meta_box("goldly-meta-box", "Custom Meta Box","goldly_sidebar_meta_box_markup", $post_types, "normal", "high", null);
}
function goldly_sidebar_meta_box_markup($object){
	?>
	<table class="admin_sidebar_select">
		<tr><td><label><h2 class="custom_meta">Breadcrumb</h2></label></td></tr>
	   	<tr>
	   		<td>
	   			<label for="breadcrumb_select">
	   				<input type="radio" name="breadcrumb_select" id="breadcrumb_select" value="yes" <?php if(get_post_meta($object->ID,'breadcrumb_select',true)=='yes'){echo "checked";}?>>Yes 
	   				<input type="radio" name="breadcrumb_select" id="breadcrumb_select" value="no" <?php if(get_post_meta($object->ID,'breadcrumb_select',true)=='no'){echo "checked";}?>>No
	   			</label>
	   		</td>
	   	</tr>
	   	<tr><td><label><h2 class="custom_meta">Sidebar</h2></label></td></tr>
   		<tr>
	   		<td>
	   			<label for="no_sidebar">		   				
	   				<input type="radio" name="sidebar_select" id="no_sidebar" class="no_sidebar" value="no_sidebar" <?php if(get_post_meta($object->ID,'sidebar_select',true)=='no_sidebar'){echo "checked";}?>>
		   				<img src="<?php echo esc_url(get_template_directory_uri()) . '/assets/images/full.png' ?>">
		   			</input>
	   			</label>
	   			<label for="left_sidebar">
	   				<input type="radio" name="sidebar_select" id="left_sidebar" class="left_sidebar" value="left_sidebar" <?php if(get_post_meta($object->ID,'sidebar_select',true)=='left_sidebar'){echo "checked";}?>>
	   					<img src="<?php echo esc_url(get_template_directory_uri()) . '/assets/images/left.png' ?>">
	   				</input>
	   			</label>
	   			<label for="right_sidebar">			   				
	   				<input type="radio" name="sidebar_select" id="right_sidebar" class="right_sidebar" value="right_sidebar" <?php if(get_post_meta($object->ID,'sidebar_select',true)=='right_sidebar'){echo "checked";}?>>
	   					<img src="<?php echo esc_url(get_template_directory_uri()) . '/assets/images/right.png' ?>">
	   				</input>
	   			</label>			
	   		</td>
	   	</tr>
	</table>
	<?php
}
add_action( 'save_post','goldly_save_sidebar_meta_box_data');
function goldly_save_sidebar_meta_box_data( $post_id ) {
	
	if(isset($_REQUEST['breadcrumb_select'])){
		$breadcrumb_select = sanitize_text_field( wp_unslash($_REQUEST['breadcrumb_select'] ));
		update_post_meta($post_id,'breadcrumb_select',$breadcrumb_select);
	}
	if(isset($_REQUEST['sidebar_select'])){
		$sidebar_select = sanitize_text_field( wp_unslash($_REQUEST['sidebar_select'] ));
		update_post_meta($post_id,'sidebar_select',$sidebar_select);
	}
}

function goldly_breadcrumb_slider(){
	?>
	<div class="breadcrumb_info">
		<div class="breadcrumb_data">
			<section id="breadcrumb-section" class="breadcrumb-area breadcrumb-centerc">
				<div class="breadcrumb-content">
					<div class="breadcrumb-heading">
						<h1><?php  goldly_breadcrumb_title();	?></h1>
					</div>
					<ol class="breadcrumb-list">
						<li>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
							<?php echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;"; ?>
						</li>
						<li>
							<?php goldly_breadcrumb_title();?>
						</li>
					</ol>
				</div> 
			</section>
		</div>		
	</div>
	<?php
}
/**
 * Enqueue scripts and styles.
 */
function goldly_scripts() {
	wp_enqueue_script('jquery', false, array(), false, false);
	wp_enqueue_style( 'goldly-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'goldly-style', 'rtl', 'replace' );

	wp_enqueue_script( 'goldly-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );
			wp_localize_script( 'goldly-navigation', 'aboutdata', 
							array(
								'about_sec' => esc_attr(get_theme_mod('goldly_diseble')),
							)
         	);
	wp_enqueue_script( 'goldly-owl_slider', get_template_directory_uri() . '/assets/js/owl_slider.js', array(), _S_VERSION, true );	
	wp_enqueue_script( 'goldly-owl-carousel-min', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), _S_VERSION, true );	
	wp_enqueue_style( 'theme-css', esc_url(get_template_directory_uri()).'/assets/css/theme.css' , array(), _S_VERSION );
	wp_enqueue_style( 'fontawesome-css', esc_url(get_template_directory_uri()).'/assets/fontawesome/css/font-awesome.css' , array(), _S_VERSION );
	wp_enqueue_style( 'owl-carousel-min-css', esc_url(get_template_directory_uri()).'/assets/css/owl.carousel.min.css' , array(), _S_VERSION );
	wp_enqueue_style( 'owl-carousel_theme-min-css', esc_url(get_template_directory_uri()).'/assets/css/owl.theme.min.css' , array(), _S_VERSION );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'goldly_scripts' );

function goldly_admin_script_style() {
	wp_enqueue_style( 'admin_site-css', esc_url(get_template_directory_uri()).'/assets/css/admin_site.css' , array(), _S_VERSION );
	wp_enqueue_script( 'goldly-install-recommended-plugins', get_template_directory_uri() . '/install-recommended-plugins/admin.js', array( 'jquery' ), false, false );
    wp_enqueue_script('alpha-color-picker',	get_template_directory_uri() . '/assets/js/alpha-color-picker.js',array( 'jquery', 'wp-color-picker' ), null,true);
	wp_enqueue_style('alpha-color-picker',get_template_directory_uri() . '/assets/css/alpha-color-picker.css',array( 'wp-color-picker' ));
}
add_action('admin_enqueue_scripts', 'goldly_admin_script_style');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/customizer-control.php';

require get_template_directory() . '/inc/customizer_css.php';

require get_parent_theme_file_path( '/inc/about.php' );

require get_template_directory() . '/install-recommended-plugins/index.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

require_once get_template_directory() . '/install-recommended-plugins/wtb-required-plugins.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

function goldly_main_js() {
    wp_enqueue_script( 'main-js', get_theme_file_uri( '/assets/js/owl_slider.js' ), array(), '1.0', true );
    // Localize the script with new data and pass php variables to JS.
    $main_js_data = array(
        /* FOR LATER USE. */
        'img_autoplay' => get_theme_mod('featured_slider_autoplay', true),
        'img_autoplayspped' => get_theme_mod('featured_slider_autoplay_speed','1000'),
        'autoplay' => get_theme_mod('our_testimonial_slider_autoplay', true),
        'autoplayspped' => get_theme_mod('our_testimonial_slider_autoplay_speed','1000'),
    );
    wp_localize_script( 'main-js', 'main_vars', $main_js_data );
}
add_action( 'wp_enqueue_scripts', 'goldly_main_js' );

add_action( 'admin_notices', 'goldly_admin_notice_demo_data' );
function goldly_admin_notice_demo_data() {
	if( !empty( $_GET['status'] ) && $_GET['status'] == 'goldly_hide_msg' ){
		update_option( 'goldly_hide_msg', true );
	}

	$status = get_option( 'goldly_hide_msg' );
	if( $status == true ){
		return;
	} 

	$recommended_plugins = apply_filters( 'goldly_plugins', $plugins = array() );
	if( empty( $recommended_plugins ) ){
		return;
	}
	$my_theme = wp_get_theme();
	$theme_name = $my_theme->get( 'Name' );
	$nonce = wp_create_nonce("goldly_install_plugins");
	?>
	 <div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
                <div class="goldly-getting-started-notice clearfix">
                    <div class="goldly-theme-screenshot">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.png" class="screenshot" alt="<?php esc_attr_e( 'Theme Screenshot', 'goldly' ); ?>" />
                    </div><!-- /.goldly-theme-screenshot -->
                    <div class="theme-info-wrapper">
				        <?php 
				        echo '<strong style="font-size: 20px; padding-bottom: 10px; display: block;">';
						
				        printf(
				        	esc_html__( 'Thank you for installing %1$s', 'goldly' ),
				        	esc_attr($theme_name)
				        ); 
				        echo '</strong>';
				        echo '<p>' . esc_html__( "It comes with prebuild templates so that you don't have to build it from the start. Clicking the button below will install all the recommended plugins for this theme." , 'goldly' ) . '</p>';
				        ?>

				        <div class="button_wrapper_theme" style="margin-top: 20px;">
					        <a 
					        href="javascript:void(0)" 
					        class="button button-primary button-hero goldly_install_plugins" 
					        data-nonce="<?php echo esc_attr( $nonce ); ?>"
					        data-redirect="<?php echo esc_url( admin_url( 'themes.php?page=one-click-demo-import' ) ); ?>"
					        >
					        <img class="lodear_img" src="<?php echo esc_url(get_template_directory_uri().'/assets/images/loder.gif') ?>" style="display: none;">
					        <span><?php esc_html_e( 'Get Started', 'goldly' ) ?></span>
					    	</a>

					        <a 
					        href="<?php echo esc_url( admin_url('/?status=goldly_hide_msg') ); ?>" 
					        class="button button-default button-hero goldly_dismiss" ><?php esc_html_e( 'Close', 'goldly' ) ?></a>
				        </div>
			        </div>   
                </div>
            </div>    
    <?php
}

add_filter( 'goldly_plugins', function(){

	$plugins = array(
		array(
			'slug' => 'one-click-demo-import/one-click-demo-import.php',
			'zip'  => 'one-click-demo-import'
		),	
		'reviewexchanger-demo-importer' => array(
			'slug' => 'reviewexchanger-demo-importer/reviewexchanger-demo-importer.php',
			'zip' => 'reviewexchanger-demo-importer'
		),
		'page-section-for-themereviewer' => array(
			'slug' => 'page-section-for-themereviewer/page-section-for-themereviewer.php',
			'zip' => 'page-section-for-themereviewer'
		),	
	);
	return $plugins;
});
add_filter( 'ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
function goldly_ocdi_change_time_of_single_ajax_call() {
    return 10;
}
add_filter( 'ocdi/time_for_one_ajax_call', 'goldly_ocdi_change_time_of_single_ajax_call' );
