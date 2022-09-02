<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package goldly
 */

$quantity  = get_theme_mod( 'featured_section_number', 3 );
?>
	<div class="featured-section_data">
	    <div id="featured-section" class="featured-section section">
			<div class="card-container featured_content">
			<?php for ( $i = 1; $i <= $quantity ; $i++ ) { ?>
				<?php if(!empty(get_theme_mod( 'features_one_icon'.$i,'fa fa-user')) || !empty(get_theme_mod( 'featured_section_title_'.$i)) || !empty(get_theme_mod( 'featured_section_description_'.$i))){
				?>
				<div class="card section-featured-wrep"> 
					<div class="side featured-thumbnail">
						<?php
						if(!empty(get_theme_mod( 'features_one_icon'.$i,'fa fa-user'))){
							?>
							<div class="featured-icon"> 
								<i class="<?php echo esc_attr(get_theme_mod( 'features_one_icon'.$i,'fa fa-user'))?>"></i>
							</div>
							<?php
						} 
						?>						
						<div class="featured-title"> 
							<?php if(!empty(get_theme_mod( 'featured_section_title_'.$i))){ ?>
								<header class="entry-header">
									<h4>
										<?php echo esc_attr(get_theme_mod( 'featured_section_title_'.$i )); ?>
									</h4>
								</header>
							<?php } ?>
							<?php if(!empty(get_theme_mod( 'featured_section_description_'.$i))){ ?>
								<div class="entry-content">
									<?php echo esc_attr(get_theme_mod( 'featured_section_description_'.$i )); ?>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="side back featured-thumbnail">
						<div class="featured-icon"> 
							<i class="<?php echo esc_attr(get_theme_mod( 'features_one_icon'.$i,'fa fa-user'))?>"></i>
						</div>
						<div class="featured-title"> 
							<header class="entry-header">
								<h4>
									<?php echo esc_attr(get_theme_mod( 'featured_section_title_'.$i )); ?>
								</h4>
							</header>
							<div class="entry-content">
								<?php echo esc_attr(get_theme_mod( 'featured_section_description_'.$i )); ?>
							</div>
						</div>
					</div>
				</div>
			<?php } } ?>
			</div>
		</div>
	</div>