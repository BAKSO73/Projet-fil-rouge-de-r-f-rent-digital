<?php
function ecommercegoldly_ecco_customize_css(){
	if(get_theme_mod('goldly_container_page_layout','content_boxed') == 'boxed_layout'){
    	?>
		<style>	
    	.eco_goldly_section.goldly_title_underline {
		    max-width: <?php echo esc_attr(get_theme_mod('goldly_container_width','1100')); ?>px;
		    margin-left: auto;
		    margin-right: auto;
		}
		</style>
		<?php
    }
    if(get_theme_mod('goldly_container_page_layout','content_boxed') == 'content_boxed'){
    	?>
		<style>	
    	.eco_goldly_section.goldly_title_underline {
		    max-width: <?php echo esc_attr(get_theme_mod('goldly_container_width','1100')); ?>px;
		    margin-left: auto;
		    margin-right: auto;
		}
		</style>
		<?php
    }
    if(get_theme_mod( 'goldly_full_benner_bg_image_section')){
		?>
		<style type="text/css">
			.full_banner_section{
				background: url(<?php echo esc_attr(get_theme_mod('goldly_full_benner_bg_image_section'))?>) rgb(0 0 0 / 0.68);
				background-position: <?php echo esc_attr(get_theme_mod('goldly_full_benner_img_bg_position','center center')); ?>;
			    background-attachment: <?php echo esc_attr(get_theme_mod('goldly_full_benner_bg_attachment','scroll'));?>;
			    background-size: <?php echo esc_attr(get_theme_mod('goldly_full_benner_bg_size','cover'));?>;
			}
		</style>
		<?php
	}else{
		?>
		<style type="text/css">
			.full_banner_section{
				background-color: <?php echo esc_attr(get_theme_mod('goldly_full_benner_bg_color_section','#d5d1d1'))?>;
			}
		</style>
		<?php
	}
	?>
	<style>	
		.ecommerce_product_section{
			background-color: <?php echo esc_attr(get_theme_mod('goldly_product_category_bg_color','#ffffff')); ?>;
			color:  <?php echo esc_attr(get_theme_mod('goldly_product_category_text_color','#333')); ?>;
		}
		h2.product_cat_title{
			color:  <?php echo esc_attr(get_theme_mod('goldly_product_category_title_color','#333')); ?>;
		}
		.product_cat_info{
			background-color: <?php echo esc_attr(get_theme_mod('goldly_product_contain_bg_color','#eeeeee')); ?>;
		}
		.full_banner_title {
		    padding: 50px;
    		color: <?php echo esc_attr(get_theme_mod('goldly_full_benner_text_color','#ffffff'));?>;
		}
		.full_banner_heding h4 {
		    width: fit-content;
		    background: #333;
		    padding: 10px;
		    border-radius: 10px;
		    text-transform: uppercase;
		}   
		.full_banner_section{
			height: 267px;
		}

	</style>
	<?php
}
add_action( 'wp_head', 'ecommercegoldly_ecco_customize_css');
?>