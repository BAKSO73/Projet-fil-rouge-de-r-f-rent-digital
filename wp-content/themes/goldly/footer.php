<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Goldly
 */

?>
</div>
</div>
	<footer id="colophon" class="site-footer">
		<div class="footer_info">
			<div class="site_icon_nav_footer">
<!-- 				<ul id="sidebar" class="footer_widgets"> -->
				<div class='footer_logo footer_widgets'>
					<div class="logo_images">		        	
						<div class="footer_description">
							<?php
				        		dynamic_sidebar('footer1'); 
				        	?>
						</div>	
					</div>
				</div>				
<!-- 			    </ul>  -->
			    <div class="footer_nav_bar footer_widgets">
					<?php
					   dynamic_sidebar('footer3'); 
					?>			
				</div>
				<div class="footer_categories footer_widgets">
					<?php
	        		dynamic_sidebar('footer4'); 
	        	?>
				</div>
	        	
	        	<div class="footer_about_company footer_widgets">
	        		<?php
	        		dynamic_sidebar('footer5'); 
	        	?>
	        	</div>        	
			</div>
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'goldly' ) ); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'goldly' ), 'WordPress' );
					?>
				</a>
				<span class="sep"> | </span>
					<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'goldly' ), 'goldly', '<a href="https://www.xeeshop.com/">reviewexchanger</a>' );
					?>
			</div><!-- .site-info -->
		</div>			
	</footer><!-- #colophon -->
<!-- </div> --><!-- #page -->
<button type="button" class="scrollingUp scrolling-btn is-active" aria-label="scrollingUp"><i class="fa fa-angle-up"></i></button>
<?php wp_footer(); ?>

</body>
</html>
