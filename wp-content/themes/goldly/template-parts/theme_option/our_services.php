<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package goldly
 */


$our_services_number = get_theme_mod( 'our_services_number', 6 );
	?>
		<div class="our_services_section">
			<div class="our_services_info">
				<div class="our_services_main_info">
					<div class="our_services_main_title">
						<h2><?php echo esc_html(get_theme_mod( 'our_services_main_title', 'Our Services' )); ?></h2>
					</div>
					<div class="our_services_main_disc">
						<p><?php echo  esc_html(get_theme_mod( 'our_services_main_discription'));?></p>
					</div>
				</div>
				<div class="our_services_section_data">
					<?php
					for ( $i = 1; $i <= $our_services_number ; $i++ ) {
						?>
						<div class="our_services_data">
							<div class="our_services_img buttons">
								<i class="<?php echo esc_attr(get_theme_mod( 'our_services_icon_'.$i,'fa fa-user'))?>"></i>
							</div>
							<div class="our_services_container">
								<div class="our_services_title">
									<a href="<?php echo esc_attr(get_theme_mod( 'our_services_title_link_'.$i, '#')); ?>">
										<h3><?php echo esc_html(get_theme_mod( 'our_services_title_'.$i)); ?></h3>
									</a>
								</div>
								<div class="our_services_discription">
									<p><?php echo esc_html(get_theme_mod( 'our_services_description_'.$i)); ?></p>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>