<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package goldly
 */

?>
<div class="header_topbar_info">
	<?php if(get_theme_mod( 'goldly_contact_info_number','04463235323' ) || get_theme_mod( 'goldly_email_info_number','goldly@gmail.com' )){ ?>
	<div class="header_top_bar">
		<?php if(!empty(get_theme_mod( 'goldly_contact_info_number','04463235323' ))){ ?>
			<div class="contact_data">
				<div class="contact_icon">
					<i class="fa fa-phone"></i>
				</div>
				<div class="contact_info">
					<p><?php echo esc_html(get_theme_mod( 'goldly_contact_info_number','04463235323' )); ?></p>
				</div>
			</div>
		<?php } 
		if(!empty(get_theme_mod( 'goldly_email_info_number','goldly@gmail.com' ))){ ?>
			<div class="email_data">
				<div class="email_icon">
					<i class="fa fa-envelope"></i>
				</div>
				<div class="email_info">
					<p><?php echo esc_html(get_theme_mod( 'goldly_email_info_number','goldly@gmail.com' )); ?></p>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php } ?>
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
</div>