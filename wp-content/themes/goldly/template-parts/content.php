<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Goldly
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php goldly_post_thumbnail(); ?>
	<div class="main_container">
		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					goldly_posted_on();
					goldly_posted_by();
					goldly_entry_footer();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->	

		<div class="entry-content">
			<?php
			if ( !(is_single())){
				the_excerpt('30');
			}else{
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'goldly' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'goldly' ),
						'after'  => '</div>',
					)
				);
			}
			?>
		</div><!-- .entry-content -->
		<?php
			if(get_theme_mod( 'goldly_container_read_more_btn',true) != ''){
			?>
				<div class="read_btn">	
					<a class='read_more buttons btn btn-primary btn-like-icon' href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html(get_theme_mod( 'goldly_read_more_btn','Continue reading') );?>
					</a>
				</div>
			<?php
			}
		
		?>
	</div>
	<footer class="entry-footer">
		<?php //goldly_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
