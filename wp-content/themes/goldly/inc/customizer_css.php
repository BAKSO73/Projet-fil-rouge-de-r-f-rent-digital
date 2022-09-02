<?php
function goldly_customize_css(){
	global $goldly_fonttotal;
	$goldly_body_fontfamily = get_theme_mod("goldly_body_fontfamily",5);
    $goldly_body_fontfamily = $goldly_fonttotal[$goldly_body_fontfamily];

    $goldly_Heading_fontfamily = get_theme_mod("goldly_Heading_fontfamily",5);
    $goldly_Heading_fontfamily = $goldly_fonttotal[$goldly_Heading_fontfamily];

    $goldly_Heading1_fontfamily = get_theme_mod("goldly_Heading1_fontfamily",5);
    $goldly_Heading1_fontfamily = $goldly_fonttotal[$goldly_Heading1_fontfamily];

    $goldly_Heading2_fontfamily = get_theme_mod("goldly_Heading2_fontfamily",5);
    $goldly_Heading2_fontfamily = $goldly_fonttotal[$goldly_Heading2_fontfamily];

    $goldly_Heading3_fontfamily = get_theme_mod("goldly_Heading3_fontfamily",5);
    $goldly_Heading3_fontfamily = $goldly_fonttotal[$goldly_Heading3_fontfamily];

    if($goldly_body_fontfamily!='Select Font'){
		?>
		<style type="text/css">
	        body{
	            font-family: <?php echo  esc_attr( $goldly_body_fontfamily );?>            
	        }
        </style>
        <?php
    }
    if($goldly_Heading_fontfamily!='Select Font'){
		?>
		<style type="text/css">
	        h1, h2, h3, h4, h5{
	            font-family: <?php echo esc_attr( $goldly_Heading_fontfamily );?>            
	        }
        </style>
        <?php
    }
    if($goldly_Heading1_fontfamily!='Select Font'){
		?>
		<style type="text/css">
	        h1{
	            font-family: <?php echo esc_attr( $goldly_Heading1_fontfamily );?>            
	        }
        </style>
        <?php
    }
    if($goldly_Heading2_fontfamily!='Select Font'){
		?>
		<style type="text/css">
	        h2{
	            font-family: <?php echo esc_attr( $goldly_Heading2_fontfamily );?>            
	        }
        </style>
        <?php
    }
    if($goldly_Heading3_fontfamily!='Select Font'){
		?>
		<style type="text/css">
	        h3 {
	            font-family: <?php echo esc_attr( $goldly_Heading3_fontfamily );?>            
	        }
        </style>
        <?php
    }
    if(get_theme_mod('feature_product')){
    	?>
		<style>	
		footer#colophon {			
    		background:url(<?php echo  esc_attr(get_theme_mod('feature_product'));?>) rgb(0 0 0 / 0.75);
    		background-position: <?php echo esc_attr(get_theme_mod('goldly_footer_bg_position','center center')); ?>;
    		background-size: <?php echo esc_attr(get_theme_mod('goldly_footer_bg_size','cover')); ?>;
    		background-attachment: <?php echo esc_attr(get_theme_mod('goldly_footer_bg_attachment','scroll')); ?>;
    		background-blend-mode: multiply;
		}
		</style>
		<?php
    }else{
    	?>
		<style>	
		footer#colophon {
			background-color: <?php echo esc_attr(get_theme_mod('goldly_footer_bg_color','#273641'));?>;	
		}
		</style>
		<?php
    }
    if(get_theme_mod( 'goldly_container_containe',true ) == ''){
    	?>
		<style type="text/css">
	    	.blog .goldly_container_data {
			    display: none;
			}
	    </style>
        <?php
    }  
    if(get_theme_mod( 'goldly_container_description',false ) == ''){
    	?>
		<style type="text/css">
	    	.blog article .entry-content {
			    display: none;
			}
	    </style>
        <?php
    }
    if(get_theme_mod( 'goldly_container_date',true ) == ''){
    	?>
		<style type="text/css">
	    	span.posted-on {
			    display: none;
			}
	    </style>
        <?php
    }
    if(get_theme_mod( 'goldly_container_authore',false ) == ''){
    	?>
		<style type="text/css">
			span.byline {
				display: none;
			}
		 </style>
        <?php
    }
    if(get_theme_mod( 'goldly_container_category',true ) == ''){
    	?>
		<style type="text/css">
			span.cat-links {
				display: none;
			}
		 </style>
        <?php
    } 
    if(get_theme_mod( 'goldly_container_comments',false ) == ''){
    	?>
		<style type="text/css">
			span.comments-link {
				display: none;
			}
		 </style>
        <?php
    }	
    if(get_theme_mod( 'goldly_post_sidebar_width_'.get_post_type(),'30')){
    	$secondary_width = get_theme_mod('goldly_post_sidebar_width_'.get_post_type(),'30');
		$primary_width   = absint( 100 - $secondary_width );
		?>
		<style type="text/css">
			aside.widget-area{
				width: <?php echo esc_attr($secondary_width);?>%;
			}
			main#primary{
				width: <?php echo esc_attr($primary_width);?>%;
			}
		</style>
		<?php
	}
	if(get_theme_mod( 'goldly_header_layout','header4') == 'header2'){
		?>
		<style type="text/css">
			.header_info {
			    display: grid;
			    grid-template-columns: auto auto;
			    align-items: center;
			    grid-column-gap: 20px;
			    overflow-wrap: anywhere;
			    justify-content: space-between;
			    padding: 12px 0px;
			    max-width: <?php echo esc_attr(get_theme_mod('goldly_container_width','1100')); ?>px;
			    margin-left: auto;
			    margin-right: auto;
			}
			.top_bar_info {
			    background-color: <?php echo esc_attr(get_theme_mod('goldly_topbar_bg_color','#ffffff')); ?>;
			    color: <?php echo esc_attr(get_theme_mod('goldly_topbar_text_color','#273641')); ?>;
			}
			.main_site_header {
			    background-color: <?php echo esc_attr(get_theme_mod('goldly_header_background_color','#273641')); ?>;
			    color: <?php echo esc_attr(get_theme_mod('goldly_header_text_color','#ffffff')); ?>;
			}
			.main_site_header a {
			    color: <?php echo esc_attr(get_theme_mod('goldly_header_link_color','#ffffff')); ?>;
			}
			.main_site_header a:hover {
			    color: <?php echo esc_attr(get_theme_mod('goldly_header_link_hover_color','#ffffff')); ?>;
			}
		</style>
		<?php
	}
	if(get_theme_mod( 'goldly_header_layout','header4') == 'header4'){
		?>
		<style type="text/css">
			header#masthead {
				background: <?php echo esc_attr(get_theme_mod('alpha_color_setting','rgba(255,255,255,0.3)')); ?>;
			    position: absolute;
			    right: 0;
			    left: 0;
			    width: 100%;
			    border-top: 0;
			    margin: 0 auto;
			    z-index: 99;
			    color: #ffffff;
			}
			.top_bar_info {
			    background-color: none;
			}
			.main_site_header {
			    background-color: none;
			    color: <?php echo esc_attr(get_theme_mod('goldly_transparent_header_text_color','#ffffff')); ?>
			}
			.header_info {
			    display: grid;
			    grid-template-columns: auto auto;
			    align-items: center;
			    grid-column-gap: 20px;
			    overflow-wrap: anywhere;
			    justify-content: space-between;
			    padding: 12px 0px;
			}
			.main_site_header a:hover {
			    color: <?php echo esc_attr(get_theme_mod('goldly_transparent_header_link_hover_color','#ffffff')); ?>;
			}
			.main_site_header a {
			    color: <?php echo esc_attr(get_theme_mod('goldly_transparent_header_link_color','#ffffff')); ?>;
			}
			.featured_slider_image .hentry-inner{
				height: 700px;
			}
			.featured_slider_image .hentry-inner .entry-container {
			    margin: 200px 150px 0;
			}
			.breadcrumb_info {
			    padding-top: 160px;
			    padding-bottom: 90px;
			}
			@media only screen and (max-width: 768px){
				.featured_slider_image .hentry-inner .entry-container {
				    margin: 100px 30px 0;
				}
			}
		</style>
		<?php

	}
	if(get_theme_mod( 'goldly_header_width_layout','content_width') == 'content_width'){
		?>
		<style type="text/css">
			.header_info {
				max-width: <?php echo esc_attr(get_theme_mod('goldly_header_container_width','1100')); ?>px;
			    margin-left: auto;
			    margin-right: auto;
			}
		</style>
		<?php
	}
	if(get_theme_mod( 'goldly_top_bar_width_layout','content_width') == 'content_width'){
		?>
		<style type="text/css">
			.header_topbar_info {
				max-width: <?php echo esc_attr(get_theme_mod('goldly_top_bar_container_width','1100')); ?>px;
			    margin-left: auto;
			    margin-right: auto;
			}
		</style>
		<?php
	}
	if(get_theme_mod( 'goldly_container_page_layout','content_boxed') == 'content_boxed'){
		?>
		<style type="text/css">
			main#primary{
			    background: <?php echo esc_attr(get_theme_mod('goldly_content_boxed_bg_color','#eeeeee')); ?>;
			}
			aside#secondary .widget{
				background: <?php echo esc_attr(get_theme_mod('goldly_content_boxed_bg_color','#eeeeee')); ?>;
			}
			.main_container {
			    padding: 10px;
			}
		</style>
		<?php
	}
	if(get_theme_mod( 'goldly_container_page_layout','content_boxed') == 'boxed_layout'){
		?>
		<style type="text/css">
			.goldly_container_info {
			    background: <?php echo esc_attr(get_theme_mod('goldly_boxed_layout_bg_color','#ffffff')); ?>;
			}
		</style>
		<?php
	}
	if(get_theme_mod( 'goldly_breadcrumb_bg_image')){
		?>
		<style type="text/css">
			.breadcrumb_info{
				background: url(<?php echo esc_attr(get_theme_mod('goldly_breadcrumb_bg_image'))?>) rgb(0 0 0 / 0.75);
			}
		</style>
		<?php
	}else{
		?>
		<style type="text/css">
			.breadcrumb_info{
				background-color: <?php echo esc_attr(get_theme_mod('goldly_breadcrumb_bg_color','#c8c9cb'))?>;
			}
		</style>
		<?php
	}
	if(get_theme_mod( 'goldly_mobile_cart_icon')==''){
		?>
		<style type="text/css">
			@media only screen and (max-width: 768px){
				.add_cart_icon{
					display: none;
				}
			}
		</style>
		<?php
	}
	if(get_theme_mod( 'goldly_mobile_search_icon')==''){
		?>
		<style type="text/css">
			@media only screen and (max-width: 768px){
				div#cl_serch{
					display: none;
				}
			}
		</style>
		<?php
	}	
	if(get_post_meta(get_the_ID(),'breadcrumb_select',true)=='no'){
		?>
		<style>			
			.breadcrumb_info{
			    display: none;
			}	   
		</style>
		<?php
	}
	if(get_theme_mod( 'display_scroll_button',true) == ''){
		?>
		<style>			
			.scrolling-btn {
    			display: none;
			}	   
		</style>
		<?php
	}
	if(get_theme_mod('featuredimage_slider_enable','disable') == 'disable'){
		?>
		<style>			
			.featured-section_data {
			    margin-top: 1.25rem;
    		}   
		</style>
		<?php
	}		
	if(get_theme_mod('our_testimonial_background_image')){
    	?>
		<style>	
		.our_testimonial_section {			
    		background:url(<?php echo  esc_attr(get_theme_mod('our_testimonial_background_image'));?>) rgb(0 0 0 / 0.75);
    		background-position: <?php echo esc_attr(get_theme_mod('our_testimonial_bg_position','center center')); ?>;
    		background-size: <?php echo esc_attr(get_theme_mod('our_testimonial_bg_size','scroll')); ?>;
    		background-attachment: <?php echo esc_attr(get_theme_mod('our_testimonial_bg_attachment','cover')); ?>;
    		background-blend-mode: multiply;
		}
		</style>
		<?php
    }else{
    	?>
		<style>	
		.our_testimonial_section {
			background: <?php echo esc_attr(get_theme_mod('our_team_testimonial_bg_color','#eeeeee')); ?>;
		}
		</style>
		<?php
    }
    if(get_theme_mod('goldly_container_page_layout','content_boxed') == 'boxed_layout'){
    	?>
		<style>	
    	.site-branding,.call_button_info, .breadcrumb_data, .goldly_container_info.boxed_layout, .goldly_container_info.content_boxed, div#featured-section, .about_data, .our_portfolio_data, .our_team_info, .our_testimonial_info, .our_services_info, .our_sponsors_info, .widget_section {
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
    	.site-branding,.call_button_info, .breadcrumb_data, .goldly_container_info.boxed_layout, .goldly_container_info.content_boxed, div#featured-section, .about_data, .our_portfolio_data, .our_team_info, .our_testimonial_info, .our_services_info, .our_sponsors_info, .widget_section {
		    max-width: <?php echo esc_attr(get_theme_mod('goldly_container_width','1100')); ?>px;
		    margin-left: auto;
		    margin-right: auto;
		}
		</style>
		<?php
    }
    if(get_theme_mod('goldly_footer_width_layout','content_boxed') == 'content_boxed'){
    	?>
		<style>	
    	footer#colophon .footer_info{
    		max-width: <?php echo esc_attr(get_theme_mod('goldly_footer_container_width','1100')); ?>px;
		    margin-left: auto;
		    margin-right: auto;
    	}
		</style>
		<?php
    }
    if(get_theme_mod('about_bg_image','')){
    	?>
		<style>	
    		.about_section_info{
    			background:url(<?php echo  esc_attr(get_theme_mod('about_bg_image'));?>) rgb(0 0 0 / 0.75);
    			background-position: <?php echo esc_attr(get_theme_mod('goldly_about_bg_position','center center')); ?>;
	    		background-size: <?php echo esc_attr(get_theme_mod('goldly_about_bg_size','cover')); ?>;
	    		background-attachment: <?php echo esc_attr(get_theme_mod('goldly_about_bg_attachment','fixed')); ?>;
	    		background-blend-mode: multiply;
    		}
		</style>
		<?php
    }else{
    	?>
		<style>	
    		.about_section_info{
    			background: <?php echo esc_attr(get_theme_mod('goldly_about_bg_color','#eeeeee')); ?>;
    		}
		</style>
		<?php
    }
    if(get_theme_mod('our_portfolio_bg_image','')){
    	?>
		<style>	
    		.our_portfolio_info{
    			background:url(<?php echo  esc_attr(get_theme_mod('our_portfolio_bg_image'));?>) rgb(0 0 0 / 0.75);
    			background-position: <?php echo esc_attr(get_theme_mod('goldly_our_portfolio_bg_position','center center')); ?>;
	    		background-size: <?php echo esc_attr(get_theme_mod('goldly_our_portfolio_bg_size','cover')); ?>;
	    		background-attachment: <?php echo esc_attr(get_theme_mod('goldly_our_portfolio_bg_attachment','scroll')); ?>;
	    		background-blend-mode: multiply;
    		}
		</style>
		<?php
    }else{
    	?>
		<style>	
    		.our_portfolio_info{
    			background: <?php echo esc_attr(get_theme_mod('goldly_our_portfolio_bg_color','#ffffff')); ?>;
    		}
		</style>
		<?php
    }
    if(get_theme_mod('our_team_bg_image','')){
    	?>
		<style>	
    		.our_team_section{
    			background:url(<?php echo  esc_attr(get_theme_mod('our_team_bg_image'));?>) rgb(0 0 0 / 68%);
    			background-position: <?php echo esc_attr(get_theme_mod('goldly_our_team_bg_position','center center')); ?>;
	    		background-size: <?php echo esc_attr(get_theme_mod('goldly_our_team_bg_size','cover')); ?>;
	    		background-attachment: <?php echo esc_attr(get_theme_mod('goldly_our_team_bg_attachment','scroll')); ?>;
	    		background-blend-mode: multiply;
    		}
		</style>
		<?php
    }else{
    	?>
		<style>	
    		.our_team_section{
    			background: <?php echo esc_attr(get_theme_mod('our_team_bg_color','#ffffff')); ?>;
    		}
		</style>
		<?php
    }
    if(get_theme_mod('our_services_bg_image','')){
    	?>
		<style>	
    		.our_services_section{
    			background:url(<?php echo  esc_attr(get_theme_mod('our_services_bg_image'));?>) rgb(0 0 0 / 68%);
    			background-position: <?php echo esc_attr(get_theme_mod('goldly_our_services_bg_position','center center')); ?>;
	    		background-size: <?php echo esc_attr(get_theme_mod('goldly_our_services_bg_size','cover')); ?>;
	    		background-attachment: <?php echo esc_attr(get_theme_mod('goldly_our_services_bg_attachment','scroll')); ?>;
	    		background-blend-mode: multiply;
    		}
		</style>
		<?php
    }else{
    	?>
		<style>	
			.our_services_section{
				background-color: <?php echo esc_attr(get_theme_mod('our_services_bg_color','#ffffff')); ?>;
			}
		</style>
		<?php
    }
	?>
	<style>	
		.goldly_container_info.no_sidebar main#primary{
			width: 100%;
		}
		header.site-header.header1 .top_bar_info {
			background-color: <?php echo esc_attr(get_theme_mod('goldly_header1_topbar_bg_color','#ffffff')); ?>;
		}
		.main-navigation .nav-menu ul.sub-menu{
			background-color: <?php echo esc_attr(get_theme_mod('goldly_submenu_bg_color','#ffffff')); ?>;
		}
		.blog main.site-main.content_boxed .main_containor.grid_view article{
		    background: <?php echo esc_attr(get_theme_mod('goldly_content_boxed_bg_color','#eeeeee')); ?>;
			border-radius: <?php echo esc_attr(get_theme_mod('goldly_content_boxed_border_radius','15')); ?>px;
		}
		.breadcrumb_info{
			color: <?php echo esc_attr(get_theme_mod('goldly_breadcrumb_text_color','#333333')); ?>; 
			background-position: <?php echo esc_attr(get_theme_mod('goldly_img_bg_position','center center')); ?>;
		    background-attachment: <?php echo esc_attr(get_theme_mod('goldly_breadcrumb_bg_attachment','scroll'));?>;
		    background-size: <?php echo esc_attr(get_theme_mod('goldly_breadcrumb_bg_size','cover'));?>;
		}
		.blog main#primary {
		    background: none;
		    border-radius: none;
		}
		body {
			font-size: <?php echo esc_attr(get_theme_mod('goldly_body_font_size','15')); ?>px;
			font-weight: <?php echo esc_attr(get_theme_mod('goldly_body_font_weight','400')); ?>;
			text-transform: <?php echo esc_attr(get_theme_mod('goldly_body_text_transform','inherit')); ?>;
		} 
		body a {
			 color: <?php echo esc_attr(get_theme_mod('goldly_link_color','#214462')); ?>;
		} 
		body a:hover {
			 color: <?php echo esc_attr(get_theme_mod('goldly_link_hover_color','#000000')); ?>;
		} 
		h1 {
			font-size: <?php echo esc_attr(get_theme_mod('goldly_heading1_font_size','35'));?>px;
			font-weight: <?php echo esc_attr(get_theme_mod('goldly_heading1_font_weight','bold')); ?>;
			text-transform: <?php echo esc_attr(get_theme_mod('goldly_heading1_text_transform','inherit')); ?>;
		}
		h2 {
			font-size: <?php echo esc_attr(get_theme_mod('goldly_heading2_font_size','28')); ?>px;
			font-weight: <?php echo esc_attr(get_theme_mod('goldly_heading2_font_weight','bold')); ?>;
			text-transform: <?php echo esc_attr(get_theme_mod('goldly_heading2_text_transform','inherit')); ?>;
		}
		h3 {
			font-size: <?php echo esc_attr(get_theme_mod('goldly_heading3_font_size','25')); ?>px;
			font-weight: <?php echo esc_attr(get_theme_mod('goldly_heading3_font_weight','400')); ?>;
			text-transform: <?php echo esc_attr(get_theme_mod('goldly_heading3_text_transform','inherit')); ?>;
		}
		img.custom-logo{
			width: <?php echo esc_attr(get_theme_mod('goldly_logo_width','150'));?>px;
		}
		.call_menu_btn{
			background-color: <?php echo esc_attr(get_theme_mod('goldly_callmenu_btn_bg_color','#ffffff')); ?>;
		    color: <?php echo esc_attr(get_theme_mod('goldly_callmenu_btn_color','#273641')); ?> !important;
		    border: 2px solid <?php echo esc_attr(get_theme_mod('goldly_call_btn_border_color','#273641')); ?>;
		}
		.call_menu_btn:hover {
			background-color: <?php echo esc_attr(get_theme_mod('goldly_callmenu_btn_bghover_color','#273641')); ?>;
		    color: <?php echo esc_attr(get_theme_mod('goldly_call_btn_texthover_color','#ffffff')); ?> !important;
		}
		a.social_icon{
			color: <?php echo esc_attr(get_theme_mod('goldly_social_icon_color','#ffffff')); ?> !important;
		}
		a.social_icon:hover {
			color: <?php echo esc_attr(get_theme_mod('goldly_social_icon_hover_color','#214462')); ?> !important;
		}
		.social_icon i{
			background-color: <?php echo esc_attr(get_theme_mod('goldly_social_icon_bg_color','#273641')); ?>;
		}
		.social_icon i:hover{
			background-color: <?php echo esc_attr(get_theme_mod('goldly_social_icon_bg_hover_color','#02cfaa')); ?>;
		}
		.current-menu-ancestor > a, .current-menu-item > a, .current_page_item > a {
			color: <?php echo esc_attr(get_theme_mod('goldly_menu_active_color','#7fa7c5')); ?> !important;
		}
		aside.widget-area section h3,aside.widget-area section h1, aside.widget-area section h2, label.wp-block-search__label {
			background-color: <?php echo esc_attr(get_theme_mod('goldly_sidebar_heading_bg_color','#273641')); ?>;
			color: <?php echo esc_attr(get_theme_mod('goldly_sidebar_heading_text_color','#ffffff')); ?>;
			padding: 10px;
    		margin: 0px;
		}			
		button, input[type="button"], input[type="reset"], input[type="submit"], .wp-block-search .wp-block-search__button,.nav-previous a, .nav-next a, .buttons, .woocommerce a.button , .woocommerce button, .woocommerce .single-product button, .woocommerce button.button.alt, .woocommerce a.button.alt, .woocommerce button.button,.woocommerce button.button.alt.disabled {
			background-color: <?php echo esc_attr(get_theme_mod('goldly_button_bg_color','#273641')); ?>;
			color: <?php echo esc_attr(get_theme_mod('goldly_button_text_color','#ffffff')); ?> ;
			border: <?php echo esc_attr(get_theme_mod('goldly_borderwidth','2')); ?>px solid <?php echo esc_attr(get_theme_mod('goldly_button_border_color','#273641')); ?> ;
			border-radius: <?php echo esc_attr(get_theme_mod('goldly_button_border_radius','3')); ?>px ;
			padding: <?php echo esc_attr(get_theme_mod('goldly_button_padding','8px 15px')); ?> ;
		}
		button:hover, input[type="button"]:hover , input[type="reset"]:hover , input[type="submit"]:hover , .wp-block-search .wp-block-search__button:hover, .nav-previous a:hover, .buttons:hover, .nav-next a:hover, .woocommerce a.button:hover, .woocommerce button:hover, .woocommerce .single-product button:hover, .woocommerce button.button.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button:hover, .woocommerce button.button.alt.disabled:hover  {			
			color: <?php echo esc_attr(get_theme_mod('goldly_button_texthover_color','#214462')); ?> ;
			background-color: <?php echo esc_attr(get_theme_mod('goldly_button_bg_hover_color','#ffffff')); ?>;
		}
		button::before, input[type="button"]::before, input[type="reset"]::before, input[type="submit"]::before, .wp-block-search .wp-block-search__button::before, .nav-previous a::before, .nav-next a::before,.buttons::before, .woocommerce a.button::before, .woocommerce button::before, .woocommerce .single-product button::before, .woocommerce button.button.alt::before, .woocommerce a.button.alt::before, .woocommerce button.button::before, .woocommerce button.button.alt.disabled::before  {
			background-color: <?php echo esc_attr(get_theme_mod('goldly_button_bg_hover_color','#ffffff')); ?> ;
		}
		.entry-meta span {
		    color: <?php echo esc_attr(get_theme_mod('goldly_link_color','#214462')); ?>;
		}
		.goldly_container_data {
		    background: <?php echo esc_attr(get_theme_mod('goldly_container_bg_color','#ffffff')); ?>;
		}
		.main_containor.grid_view{
			    display: grid;
			    grid-template-columns: repeat(<?php echo esc_attr(get_theme_mod('goldly_container_grid_view_col','3'));?>, 1fr);
			    grid-column-gap :<?php echo esc_attr(get_theme_mod('goldly_container_grid_view_col_gap','20'));?>px;
		}
		.featured-thumbnail i {
		    font-size: <?php echo esc_attr(get_theme_mod('featured_section_icon_size','50'));?>px;
		}
		section#breadcrumb-section a {
		    color: <?php echo esc_attr(get_theme_mod('goldly_breadcrumb_link_color','#273641')); ?>;
		}
		.goldly_title_underline h2:before, .about_main_title h2:before, .our_portfolio_main_title h2:before, .our_team_main_title h2:before, .our_testimonial_main_title h2:before, .our_services_main_title h2:before, .our_sponsors_title h2:before{
			background-color: <?php echo esc_attr(get_theme_mod('design_heding_underline_color','#273641')); ?>;
		}
		.goldly_title_underline h2:after, .about_main_title h2:after, .our_portfolio_main_title h2:after, .our_team_main_title h2:after, .our_testimonial_main_title h2:after, .our_services_main_title h2:after, .our_sponsors_title h2:after  {
			background-color: <?php echo esc_attr(get_theme_mod('design_heding_underline_color','#273641')); ?>;
		}
		/*--------------------------------------------------------------
		# featured slider
		--------------------------------------------------------------*/
		.featured_slider_disc, .featured_slider_title h1 {
			color: <?php echo esc_attr(get_theme_mod('featured_slider_text_color','#ffffff')); ?>;
		}
		button.owl-prev, button.owl-next{
		    background: <?php echo esc_attr(get_theme_mod('featured_slider_arrow_bg_color','#273641')); ?> !important;
			color: <?php echo esc_attr(get_theme_mod('featured_slider_arrow_text_color','#ffffff')); ?> !important;
		}
		button.owl-prev:hover, button.owl-next:hover{
		    background: <?php echo esc_attr(get_theme_mod('featured_slider_arrow_bghover_color','#ffffff')); ?> !important;
			color: <?php echo esc_attr(get_theme_mod('featured_slider_arrow_texthover_color','#273641')); ?> !important;
		}

		/*--------------------------------------------------------------
		# featured section
		--------------------------------------------------------------*/
		.section-featured-wrep{
			background: <?php echo esc_attr(get_theme_mod('goldly_featured_section_bg_color','#eeeeee')); ?>;	
			color: <?php echo esc_attr(get_theme_mod('goldly_featured_section_color','#273641')); ?>;	
		}
		.section-featured-wrep:hover {
			background: <?php echo esc_attr(get_theme_mod('goldly_featured_section_bg_hover_color','#273641')); ?>;	
			color: <?php echo esc_attr(get_theme_mod('goldly_featured_section_text_hover_color','#ffffff')); ?>;	
		}
		.featured-section_data{
			margin: <?php echo esc_attr(get_theme_mod('goldly_featured_section_margin','-70px 0px 20px 0px')); ?>;
		}
		
		/*--------------------------------------------------------------
		# about section
		--------------------------------------------------------------*/
		.about_main_title h2{
			color: <?php echo esc_attr(get_theme_mod('goldly_about_title_text_color','#333333')); ?>;
		}
		.about_section_info{
			/*background: <?php echo esc_attr(get_theme_mod('goldly_about_bg_color','#eeeeee')); ?>;	*/
			color: <?php echo esc_attr(get_theme_mod('goldly_about_Text_color','#273641')); ?>;
		}
		.about_section_info a {
		    color: <?php echo esc_attr(get_theme_mod('goldly_about_link_color','#273641')); ?>;
		}
		.about_section_info a:hover {
		    color: <?php echo esc_attr(get_theme_mod('goldly_about_link_hover_color','#000000')); ?>;
		}

		/*--------------------------------------------------------------
		# our portfolio section
		--------------------------------------------------------------*/
		.our_portfolio_info{
			/*background: <?php echo esc_attr(get_theme_mod('goldly_our_portfolio_bg_color','#ffffff')); ?>;*/
			color: <?php echo esc_attr(get_theme_mod('goldly_our_portfolio_text_color','#333')); ?>;	
		}
		.wrappers .child a, .our_portfolio_sub_heading, .our_portfolio_title{
			color: <?php echo esc_attr(get_theme_mod('goldly_our_portfolio_container_text_color','#ffffff')); ?>;	
		}

		/*--------------------------------------------------------------
		# our team
		--------------------------------------------------------------*/
		.our_team_container_data{
			background: <?php echo esc_attr(get_theme_mod('our_team_container_bg_color','#eeeeee')); ?>;	
			color: <?php echo esc_attr(get_theme_mod('our_team_container_text_color','#273641')); ?>;	
		}
		.our_team_container_data:hover .our_team_title h3, .our_team_container_data:hover .our_team_headline p {
		    color: <?php echo esc_attr(get_theme_mod('our_team_text_hover_color','#ffffff')); ?>;	;
		}
		.our_team_social_icon i {
		    background: <?php echo esc_attr(get_theme_mod('our_team_icon_background_color','#fff')); ?>;
		    color: <?php echo esc_attr(get_theme_mod('our_team_icon_color','#273641')); ?>;
		}
		.our_social_icon i:hover {
		    background: <?php echo esc_attr(get_theme_mod('our_team_icon_bg_hover_color','#273641')); ?>;
		    color:  <?php echo esc_attr(get_theme_mod('our_team_icon_hover_color','#fff')); ?>;
		}
		.our_team_section {
		    /*background: <?php echo esc_attr(get_theme_mod('our_team_bg_color','#ffffff')); ?>;*/
		    color:  <?php echo esc_attr(get_theme_mod('our_team_text_color','#333')); ?>;
		}

		/*--------------------------------------------------------------
		# our testimonial
		--------------------------------------------------------------*/
		.our_testimonial_section{			
			color:  <?php echo esc_attr(get_theme_mod('our_testimonial_text_color','#333')); ?>;
		}
		.testimonials_disc {
		    background: <?php echo esc_attr(get_theme_mod('our_team_testimonial_disc_bg_color','#ffffff')); ?>;
		    color: <?php echo esc_attr(get_theme_mod('our_team_testimonial_text_color','#273641')); ?>;
		}
		.our_services_img i {
		    font-size: <?php echo esc_attr(get_theme_mod('our_services_icon_size','40')); ?>px !important;
		}
		.our_services_data{
			color: <?php echo esc_attr(get_theme_mod('our_services_contain_text_color','#273641')); ?>;
			background-color: <?php echo esc_attr(get_theme_mod('our_services_contain_bg_color','#eeeeee')); ?>;
			border-bottom: 8px solid <?php echo esc_attr(get_theme_mod('our_services_boredr_color','#ffffff')); ?>;
		}
		.our_services_section{
			color: <?php echo esc_attr(get_theme_mod('our_services_text_color','#333')); ?>;			
		}
		.our_services_data:hover {
		    border-color: <?php echo esc_attr(get_theme_mod('our_services_border_hover_color','#273641')); ?>;
		    background-color: <?php echo esc_attr(get_theme_mod('our_services_contain_bg_hover_color','#eeeeee'));?>;
		    color: <?php echo esc_attr(get_theme_mod('our_services_contain_text_hover_color','#273641')); ?>;
		}

		/*--------------------------------------------------------------
		# our Sponsors
		--------------------------------------------------------------*/	
		.our_sponsors_section {
		    background: <?php echo esc_attr(get_theme_mod('our_sponsors_bg_color','#eee')); ?>;
		    color: <?php echo esc_attr(get_theme_mod('our_sponsors_text_color','#333')); ?>;
		}
		.our_sponsors_img:hover{
			background-color: <?php echo esc_attr(get_theme_mod('our_sponsors_img_hover_bg_color','#ffffff')); ?>;
		}	

		/*--------------------------------------------------------------
		# footer
		--------------------------------------------------------------*/
		footer#colophon{
			/*padding: <?php echo esc_attr(get_theme_mod('goldly_footer_padding','10px 10px')); ?>;*/
    		color: <?php echo esc_attr(get_theme_mod('goldly_footer_text_color','#02cfaa')); ?>;
		}
		footer#colophon a {
		    color: <?php echo esc_attr(get_theme_mod('goldly_footer_link_color','#ffffff')); ?>;
		}
		footer#colophon a:hover {
		    color: <?php echo esc_attr(get_theme_mod('goldly_footer_link_hover_color','#afafaf')); ?>;
		}
		.scrolling-btn{
			background-color: <?php echo esc_attr(get_theme_mod('goldly_scroll_button_bg_color','#02cfaa'));?>;
			color: <?php echo esc_attr(get_theme_mod('goldly_scroll_button_color','#ffffff')); ?>;
		}

		

		@media only screen and (max-width: 768px){
			.main-navigation .sub-menu li, .main-navigation ul ul ul.toggled-on li {
			    background: <?php echo esc_attr(get_theme_mod('goldly_mobile_submenu_bg_color','#b1d8f5')); ?>;
			}
			body {
				font-size: <?php echo esc_attr(get_theme_mod('goldly_mobile_font_size','14')); ?>px;
			} 	
			h1 {
				font-size: <?php echo esc_attr(get_theme_mod('goldly_mobile_heading1_font_size','20'));?>px;				
			}
			h2 {
				font-size: <?php echo esc_attr(get_theme_mod('goldly_mobile_heading2_font_size','18')); ?>px;
			}
			h3 {
				font-size: <?php echo esc_attr(get_theme_mod('goldly_mobile_heading3_font_size','14')); ?>px;
			}
			.mobile_menu {
		        background-color: <?php echo esc_attr(get_theme_mod('goldly_mobile_navmenu_bg_color','#273641'));?>;
		    }
		    .mobile_menu ul#primary-menu li a {
		        color: <?php echo esc_attr(get_theme_mod('goldly_mobile_link_color','#ffffff'));?>;
		    }
		    .current-menu-ancestor > a, .current-menu-item > a, .current_page_item > a {
				color: <?php echo esc_attr(get_theme_mod('goldly_mobile_navmenu_active_color','#ffffff')); ?> !important;
			}
		}
	</style>
	<?php
}
add_action( 'wp_head', 'goldly_customize_css');