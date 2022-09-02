<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package goldly
 */

$quantity  = get_theme_mod( 'featuredimage_slider_number', 2 );
?>
<div class="featured_slider_image">
	<div id="owl-demo" class="owl-carousel owl-theme featuredimage_slider">
		<?php
		for ( $i = 1; $i <= $quantity; $i++ ) {
			$goldly_post_title = get_theme_mod( 'featuredimage_slider_title_' . $i );
			$goldly_image_slider_description = get_theme_mod( 'featuredimage_slider_description_' . $i );
			$goldly_image_sliders= get_theme_mod( 'featured_image_sliders_' . $i );
			?>	
			<div class="item">
			  	<div class="hentry-inner">
					<div class="post-thumbnail">
						<?php if(get_theme_mod( 'featured_image_sliders_' . $i )){ ?>
							<img src="<?php echo esc_attr($goldly_image_sliders); ?>" alt="The Last of us">

						<?php }else{
							?>
							<img src="<?php echo esc_attr(get_template_directory_uri()); ?>/assets/images/no-thumb.jpg" alt="The Last of us">
							<?php
						} ?> 
					</div>	
					<div class="entry-container">
				  		<?php if($goldly_post_title){
				  			?>
				  			<header class=" featured_slider_title entry-header">					
							<h1 class="entry-title">
						  		<?php echo esc_attr($goldly_post_title); ?>
						  	</h1>
						</header>
				  			<?php
				  		} ?>						
					  	<div class="featured_slider_disc entry-summary"><?php echo esc_html($goldly_image_slider_description); ?></div>
					  	<?php if(get_theme_mod( 'featuredimage_slider_button_' . $i) != ''){ ?>
						  	<div class="image_btn button">
								<a href="<?php echo esc_attr(get_theme_mod( 'featuredimage_slider_button_link_'. $i)); ?>" class="buttons"><?php echo esc_html(get_theme_mod( 'featuredimage_slider_button_' . $i)); ?></a>
							</div>
						<?php } ?>
					</div>				  	
				</div>
			</div>
			
		<?php } ?>
	</div>
</div>