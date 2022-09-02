<?php

add_action( 'admin_init', 'ecommercegoldly_remove_menu_pages' );

function ecommercegoldly_remove_menu_pages() {          
  remove_submenu_page( 'themes.php', 'goldly-about' );                                          
}

function ecommercegoldly_about_menu() {
	add_theme_page( esc_html__( 'Ecommerce Goldly About Theme', 'ecommerce-goldly' ), esc_html__( 'Ecommerce Goldly About Theme', 'ecommerce-goldly' ), 'edit_theme_options', 'eco-goldly-about', 'ecommercegoldly_about_display' );
}
add_action( 'admin_menu', 'ecommercegoldly_about_menu' );

function ecommercegoldly_about_display(){
	?>
	<div class="goldly_about_data">
		<div class="goldly_about_title">
			<h1>Ecommerce Goldly</h1>
			<div class="goldly_about_theme">
				<div class="goldly_about_description">
					<p>
					Ecommerce Goldly is a clean, modern, user friendly, responsive and highly customizable WordPress Theme. you’ll easily find the design of this theme impressive and suitable for your Website. This goldly WordPress theme, carries an abundance of crucial features and functionalities. For instance, featured slider, featured Section, About Section, Our Portfolio, Our team Section, Testimonial Slider, Our Services, Our Sponsors, Sticky Header, Social Information, Sidebar, Excerpt Options, and many more. All of these highly-customizable features and sections are completely responsive and absolutely easy to customize. </p>
					<div class="action">
						<a href="https://xeeshop.com/eccogoldy" class="button button-secondary"><?php echo esc_html( 'View Demo', 'ecommerce-goldly' ); ?></a>

						<a href="https://www.xeeshop.com/ecommerce-goldly-documentation/" target="_blank" class="button button-primary" ><?php echo esc_html( 'Theme Instructions', 'ecommerce-goldly' ); ?></a>

						<a href="#" class="button button-secondary"><?php echo esc_html( 'Rate this theme', 'ecommerce-goldly' ); ?></a>

						<a href="https://www.xeeshop.com/product/ecommerce-goldly-pro/" target="_blank" class="button button-primary"><?php echo esc_html( 'Compare free Vs Pro',  'ecommerce-goldly' ); ?></a>

					</div>
				</div>
				<div class="goldly_about_image">
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.png">
				</div>
			</div>
		</div>
		<ul class="tabs">
			<li class="tab-link current" data-tab="about">About</li>
		</ul> 
		<div id="about" class="tab-content current">
			<div class="about_section">
				<div class="about_info_data theme_info">
					<div class="about_theme_title">
						<h2>Theme Customizer</h2>
					</div>
					<div class="about_theme_data">
						<p>All Theme Options are available via Customize screen.</p>
					</div>
					<div class="about_theme_btn">
						<a class="customize_btn button button-primary" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>">Customize</a>
					</div>
				</div>
				<div class="theme_que theme_info">
					<div class="about_theme_que">
						<h2>Got theme support question?</h2>
					</div>
					<div class="about_que_data">
						<p>Get genuine support from genuine people. Whether it's customization or compatibility, our seasoned developers deliver tailored solutions to your queries.</p>
					</div>
					<div class="about_que_btn">
						<a class="support_forum button button-primary" href="https://www.xeeshop.com/support-us/">Support Forum</a>
					</div>
				</div>
			</div>
			<div class="about_shortcode theme_info">
				<div class="about_single_page_post_shortcode">
					<h2>Single Page And Post Add shortcode</h2>
				</div>
				<ul>
					<h3>Featured Slider :</h3>
					<li>[theme_section section='Goldly_featuredimage_slider']</li>
					<h3>Featured Section :</h3>
					<li>[theme_section section='Goldly_featured_section']</li>
					<h3>About Section :</h3>
					<li>[theme_section section='Goldly_about_section']</li>
					<h3>Our Portfolio :</h3>
					<li>[theme_section section='Goldly_our_portfolio_section']</li>
					<h3>Our Team :</h3>
					<li>[theme_section section='Goldly_our_team_section']</li>
					<h3>Our Testimonial :</h3>
					<li>[theme_section section='Goldly_our_testimonial_section']</li>
					<h3>Our Services :</h3>
					<li>[theme_section section='Goldly_our_services_section']</li>
					<h3>Our Sponsors :</h3>
					<li>[theme_section section='Goldly_our_sponsors_section']</li>
					<h3>Widget Section :</h3>
					<li>[theme_section section='Goldly_widget_section']</li>
				</ul>
			</div>
		</div>
	</div>
	<?php
}
?>