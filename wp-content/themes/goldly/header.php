<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Goldly
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'goldly' ); ?></a>

	<header id="masthead" class="site-header <?php echo esc_attr(get_theme_mod( 'goldly_header_layout'));?>">
		<div class="top_bar_info">
			<?php
				goldly_social_section();
			?>
		</div>
		<div class="main_site_header">
			<div class="header_info">
				<div class="header_data">
					<div class="site-branding">
						<?php
						the_custom_logo();
						?>
						<div class="header_logo">
							<?php
							if ( is_front_page() && is_home() ) :
								?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
							else :
								?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
							endif;
							$goldly_description = get_bloginfo( 'description', 'display' );
							if ( $goldly_description || is_customize_preview() ) :
								?>
								<p class="site-description"><?php echo esc_html($goldly_description); ?></p>
							<?php endif; ?>
						</div>
					</div><!-- .site-branding -->
				</div>
				<div class="menu_call_button">
					<div class="call_button_info">
						<nav id="site-navigation" class="main-navigation">
							<button class="menu-toggle" id="navbar-toggle" aria-controls="primary-menu" aria-expanded="false">
								<i class="fa fa-bars"></i>
								<!-- <i class="fa fa-close"></i> -->
							</button>
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
								)
							);
							?>							
						</nav><!-- #site-navigation -->
						<div class="mobile_menu main-navigation" id="mobile_primary">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
								)
							);
							?>
							
							<div class="header_social_icon">
								<div class="socials_icons">
									<?php
									if(get_theme_mod( 'goldly_twitter_link',true ) != ''){
										?>
										<a class="twitter social_icon" href="<?php echo esc_attr(get_theme_mod( 'goldly_twitter_link','https://twitter.com/' ));?>" target="_blank">
											<i class="fa fa-twitter"></i>
										</a>
									<?php } 
									if(get_theme_mod( 'goldly_facebook_link',true ) != ''){
									?>
										<a class="facebook social_icon" href="<?php echo esc_attr(get_theme_mod( 'goldly_facebook_link' ,'https://www.facebook.com/'));?>" target="_blank">
											<i class="fa fa-facebook"></i>
										</a>
									<?php } 
									if(get_theme_mod( 'goldly_instagram_link',true ) != ''){
									?>
										<a class="instagram social_icon" href="<?php echo esc_attr(get_theme_mod( 'goldly_instagram_link' ,'https://www.instagram.com/'));?>" target="_blank">
											<i class="fa fa-instagram"></i>
										</a>
									<?php } 
									if(get_theme_mod( 'goldly_linkedin_link',true ) != ''){
									?>
										<a class="linkedin social_icon" href="<?php echo esc_attr(get_theme_mod( 'goldly_linkedin_link','https://www.linkedin.com/feed/' ));?>" target="_blank">
											<i class="fa fa-linkedin"></i>
										</a>
									<?php } 
									if(get_theme_mod( 'goldly_pinterest_link',true ) != ''){
									?>
										<a class="pinterest social_icon" href="<?php echo esc_attr(get_theme_mod( 'goldly_pinterest_link' ,'https://www.pinterest.com'));?>" target="_blank">
											<i class="fa fa-pinterest"></i>
										</a>
									<?php } 
									if(get_theme_mod( 'goldly_youtube_link',true ) != ''){
									?>
										<a class="youtube social_icon" href="<?php echo esc_attr(get_theme_mod( 'goldly_youtube_link','https://www.youtube.com/' ));?>" target="_blank">
											<i class="fa fa-youtube"></i>
										</a>
									<?php } ?>
								</div>
								<?php if(!empty( get_theme_mod( 'goldly_call_menu_btn',true))){ ?>
									<div class="goldly_menu_btn">
										<a class="call_menu_btn" href="<?php echo esc_attr(get_theme_mod( 'goldly_menu_btn_link','#')); ?>"><?php echo esc_html(get_theme_mod( 'goldly_call_menu_btn_title','Get A Quote')); ?></a>
									</div>
								<?php } ?>
							</div>			
							<button class="menu-toggle" id="mobilepop"  aria-expanded="false">
								<i class="fa fa-close"></i>
							</button>				
						</div>

						<div class="cart_search_icon">
							<?php
							if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
								if(!empty(get_theme_mod('goldly_cart_icon',true))){
									?>
									<div class="add_cart_icon">							
										<a href="<?php echo esc_attr(wc_get_cart_url()); ?>">
											<i class="fa fa-shopping-cart" aria-hidden="true"></i>
										</a>
									</div>
								<?php } 
							} ?>
							<?php if(!empty(get_theme_mod( 'goldly_search_icon' ,true))){?>
							<div id="cl_serch" class="cl_serch">
								<a href="#" id="searchlink" class="cl_res_serch_icon searchlink">	
									<i id="serches" class="fa fa-search fa-lg serches" aria-hidden="true"></i>
								</a>								
								<div class="searchform">
							        <form id="search" class="serching" action="">
								        <input type="text" class="s" id="s" name="s" placeholder="keywords...">
								        <button type="submit" class="sbtn"><i class="fa fa-search"></i></button>
							        </form>										    
						    	</div>
						    </div>
						<?php } ?>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->	
	<?php echo esc_attr(goldly_breadcrumb_sections()); ?>
	<div class="theme_section_info">

	<?php 
		$goldly_diseble = get_theme_mod( 'goldly_diseble' );
		$goldly_diseble_array =  explode(",",$goldly_diseble);

		$orderarr = array('Goldly_featuredimage_slider','Goldly_featured_section','Goldly_widget_section','Goldly_about_section','Goldly_our_portfolio_section','Goldly_our_team_section','Goldly_our_testimonial_section','Goldly_our_services_section','Goldly_our_sponsors_section');
		$orderarr = apply_filters('goldly_order_settings', $orderarr);

		$global_ordering_array = get_theme_mod( 'global_ordering',$orderarr );
		?>
		<?php
		if(is_front_page()){
			if(!empty($global_ordering_array)){
				foreach ($global_ordering_array as $global_ordering_arraydd) { 
					if(!in_array( $global_ordering_arraydd, $goldly_diseble_array)){
						call_user_func($global_ordering_arraydd);
					}		
				}
			}	
		} ?>
	</div>
	<div class="goldly_container_data">
		<?php
		if(get_post_meta(get_the_ID(),'sidebar_select',true)){
			?>
			<div class="goldly_container_info <?php echo esc_attr(get_post_meta(get_the_ID(),'sidebar_select',true));?> <?php echo esc_attr(get_theme_mod( 'goldly_container_blog_layout','grid_view'));?> <?php echo esc_attr(get_theme_mod( 'goldly_container_page_layout','content_boxed'));?>">
				<?php
		}else{
		?>
		<div class="goldly_container_info <?php echo esc_attr(get_theme_mod( 'goldly_post_sidebar_select_'.get_post_type(),'right_sidebar'));?> <?php echo esc_attr(get_theme_mod( 'goldly_container_blog_layout','grid_view'));?> <?php echo esc_attr(get_theme_mod( 'goldly_container_page_layout','content_boxed'));?>">
<?php }