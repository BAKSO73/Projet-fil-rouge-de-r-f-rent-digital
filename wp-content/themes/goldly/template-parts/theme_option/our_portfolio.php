<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package goldly
 */
$quantity  = get_theme_mod( 'our_portfolio_number', 3 );
	?>
		<div class="our_portfolio_info" id="our_portfolio_info">
			<div class="our_portfolio_data">
				<?php if(get_theme_mod('our_portfolio_main_title','Our Portfolio')){
					?>
					<div class="our_portfolio_main_title">
						<h2><?php echo esc_html(get_theme_mod('our_portfolio_main_title','Our Portfolio'));?></h2>
						
					</div>
					<?php
				} ?>
				<div class="our_portfolio_main_disc">
					<p><?php echo esc_html(get_theme_mod( 'our_portfolio_main_discription'));?></p>
				</div>		
				<div class="wrappers our_portfolio_section">
					<?php for ( $i = 1; $i <= $quantity ; $i++ ) { ?>
						<div class="parent our_portfolio_caption">
							<div class="child our_portfolio_image">
								<div class="our_portfolio_container">
									<?php if(get_theme_mod( 'our_portfolio_image_' .$i)){ ?>
										<img src="<?php echo esc_attr(get_theme_mod('our_portfolio_image_' .$i)); ?>" alt="The Last of us">
									<?php }else{
										?>
										<img src="<?php echo esc_attr(get_template_directory_uri()); ?>/assets/images/no-thumb.jpg" alt="The Last of us">
										<?php
									} ?>
									<div class="our_portfolio_title" >
										<h3><?php echo esc_html(get_theme_mod('our_portfolio_title_' .$i));?></h3>
									</div> 
									<div class="our_portfolio_sub_heading">
										<p><?php echo esc_html(get_theme_mod('our_portfolio_subheading_' .$i)); ?></p>
									</div>
								</div>
								<div class="our_portfolio_btn">
									<a href="<?php echo esc_attr(get_theme_mod('our_portfolio_buttonlink_' .$i , '#')); ?>"><i class="<?php echo esc_attr(get_theme_mod('our_portfolio_button_' .$i,'fa fa-arrow-right')); ?>"></i></a>
								</div>
							</div>					
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		