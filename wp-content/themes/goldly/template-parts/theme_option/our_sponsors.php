<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package goldly
 */

$our_sponsors_number = get_theme_mod( 'our_sponsors_number', 5 );
	?>
		<div class="our_sponsors_section">
			<div class="our_sponsors_info">
				<div class="our_sponsors_data">
					<div class="our_sponsors_title">
						<h2><?php echo esc_html(get_theme_mod( 'our_sponsors_main_title', 'Our Sponsors' )); ?></h2>
					</div>
					<div class="our_sponsors_disc">
						<p><?php echo esc_html(get_theme_mod( 'our_sponsors_main_discription')); ?></p>
					</div>
				</div>
				<div class="our_sponsors_contain">
					<?php
					for ( $i = 1; $i <= $our_sponsors_number ; $i++ ) {
					?>
						<div class="our_sponsors_img">
							<?php if(get_theme_mod( 'our_sponsors_image_'.$i)){
								?>
								<a href='<?php echo esc_attr(get_theme_mod( 'our_sponsors_image_link_'.$i))?>'><img src="<?php echo esc_attr(get_theme_mod( 'our_sponsors_image_'.$i))?>"></a>
								<?php
							}else{
								?>
								<a href='<?php echo esc_attr(get_theme_mod( 'our_sponsors_image_link_'.$i))?>'><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/assets/images/no-thumb.jpg" alt="The Last of us"></a>
								<?php
							} ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>