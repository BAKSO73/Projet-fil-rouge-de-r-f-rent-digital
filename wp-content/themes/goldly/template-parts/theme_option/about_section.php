<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package goldly
 */
$quantity  = get_theme_mod( 'about_section_number', 4 );
	?>
	<div class="about_section_info">
		<div class="about_data">
			<?php
			if(!empty(get_theme_mod( 'about_title_section', 'About Us' ))){
				?>
				<div class="about_main_title">
					<h2><?php echo esc_html(get_theme_mod( 'about_title_section', 'About Us' )); ?></h2>
				</div>
				<?php
			} 
			?>	
			<div class="about_main_discription">
				<p><?php echo esc_html(get_theme_mod( 'about_section_main_discription')); ?></p>
			</div>
			<div class="about_section_container">
				<div class="about_featured_image">
					<?php if(get_theme_mod( 'about_image_sliders')){ ?>
						<img src="<?php echo esc_attr(get_theme_mod( 'about_image_sliders')); ?>" alt="The Last of us">

					<?php }else{
						?>
						<img src="<?php echo esc_attr(get_template_directory_uri()); ?>/assets/images/no-thumb.jpg" alt="The Last of us">
						<?php
					} ?> 
				</div>
				<div class="about_container_data">
					<?php for ( $i = 1; $i <= $quantity ; $i++ ) { ?>
						<div class="about_container">
							<?php if(!empty(get_theme_mod( 'about_one_icon'.$i,'fa fa-user'))){
								?>
								<div class="about_icon buttons"> 
									<i class="<?php echo esc_attr(get_theme_mod( 'about_one_icon'.$i,'fa fa-user'))?>"></i>
								</div>	
								<?php
							} ?>											
							<div class="entry-header">
								<?php
								if(!empty(get_theme_mod( 'about_section_title_url_'.$i, '#'))){
									?>
									<div class="about_title">
										<a href="<?php echo esc_attr(get_theme_mod( 'about_section_title_url_'.$i, '#')); ?>"><h3><?php echo esc_html(get_theme_mod( 'about_section_title_'.$i)); ?></h3></a>
									</div>
									<?php
								}
								if(!empty(get_theme_mod( 'about_section_description_'.$i))){
									?>
									<div class="about_sub_heading">
										<p><?php echo esc_html(get_theme_mod( 'about_section_description_'.$i)); ?></p>
									</div>
									<?php
								}
								?>
							</div>				
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>