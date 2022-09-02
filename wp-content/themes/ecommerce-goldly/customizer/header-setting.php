<?php
function ecommercegoldly_child_customizer_section($wp_customize){
	$wp_customize->get_section('goldly_our_portfolio_section')->title = __( 'Best Selling', 'ecommerce-goldly' );
 	$wp_customize->get_control( 'our_portfolio_main_title' )->label = __( 'Best Offer', 'ecommerce-goldly');
 	$wp_customize->get_control( 'our_portfolio_main_discription' )->label = __( 'Best Selling Discription', 'ecommerce-goldly');
 	$our_portfolio_number = get_theme_mod( 'our_portfolio_number', 3 );
		for ( $i = 1; $i <= $our_portfolio_number ; $i++ ) {
			$wp_customize->get_control('our_portfolio_'.$i)->label = __( 'Best Selling ','ecommerce-goldly').$i;
			$wp_customize->get_control('our_portfolio_title_'.$i)->label = __( 'Best Selling Title ', 'ecommerce-goldly' ).$i;
			$wp_customize->get_control('our_portfolio_button_'.$i)->label = __( 'Best Selling Button ', 'ecommerce-goldly' ).$i;
			$wp_customize->get_control('our_portfolio_buttonlink_'.$i)->label = __( 'Best Selling Button Link ', 'ecommerce-goldly' ).$i;
		}

	$wp_customize->get_section('goldly_our_team_section')->title = __( 'New Arrivals', 'ecommerce-goldly' );
 	$wp_customize->get_control('our_team_main_title')->label = __( 'New Arrivals Title' , 'ecommerce-goldly');
 	$wp_customize->get_control('our_team_main_discription')->label = __( 'New Arrivals Description', 'ecommerce-goldly' );
 	$our_team_number = get_theme_mod( 'our_team_number', 4 );
		for ( $i = 1; $i <= $our_team_number ; $i++ ) {
			$wp_customize->get_control('our_team_heading_'.$i)->label = __( 'New Arrivals ', 'ecommerce-goldly' ).$i;
			$wp_customize->remove_control('our_team_twitter_link_'.$i);
			$wp_customize->remove_control('our_team_facebook_link_'.$i);
			$wp_customize->remove_control('our_team_instagram_link_'.$i);
			$wp_customize->remove_control('our_team_linkedin_link_'.$i);
		}

		if ( method_exists( $wp_customize, 'register_section_type' ) ) {
		$wp_customize->register_section_type( 'ecommercegoldly_pro_Section' );
		}
		if ( ! defined( 'GP_PREMIUM_VERSION' ) ) {
			$wp_customize->add_section(
				new ecommercegoldly_pro_Section(
					$wp_customize,
					'ecommercegoldly_pro_Section',
					array(
	                	'pro_text' => esc_html__( 'Upgrade To PRO', 'ecommerce-goldly' ),
	                	'pro_url'  => 'https://www.xeeshop.com/product/ecommerce-goldly-pro/',
						'capability' => 'edit_theme_options',
						'priority' => 0,
						'type' => 'gp-upselles-sections',
					)
				)
			);
		}

		if ( method_exists( $wp_customize, 'register_section_type' ) ) {
			$wp_customize->register_section_type( 'ecommercegoldly_documentation_Upsell_Sections' );
		}
		if ( ! defined( 'GP_PREMIUM_VERSION' ) ) {
			$wp_customize->add_section(
				new ecommercegoldly_documentation_Upsell_Sections(
					$wp_customize,
					'ecommercegoldly_documentation_Upsell_Sections',
					array(
						'title'    => esc_html__( 'Documentation', 'ecommerce-goldly' ),
	                	'pro_text' => esc_html__( 'Read More', 'ecommerce-goldly' ),
	                	'pro_url'  => 'https://www.xeeshop.com/ecommerce-goldly-documentation/',
						'capability' => 'edit_theme_options',
						'priority' => 0,
						'type' => 'gp-upsell-sections',
					)
				)
			);
		}

		//add Control
			$wp_customize->add_setting('global_ordering', array(
				'default'  => array( 
						'Goldly_featuredimage_slider',
						'Goldly_featured_section',
						'Goldly_widget_section',
						'Goldly_about_section',
						'Goldly_our_portfolio_section',
						'Goldly_our_team_section',
						'Goldly_our_testimonial_section',
						'Goldly_our_services_section',
						'Goldly_our_sponsors_section',
						'Goldly_full_banner_section',
						'Goldly_product_category_section',
						
					),
		        'type'       => 'theme_mod',
		        'transport'   => 'refresh',
		        'capability'     => 'edit_theme_options',		
		        'sanitize_callback' => 'goldly_sanitize_select',
		    ));
		    $wp_customize->add_control( new goldly_custom_ordering(
		    	$wp_customize,'global_ordering',
		    	array(
			        'settings' => 'global_ordering',
			        'label'   => 'Select Section',
			        'description' => 'Hide & show Sections',
			        'section' => 'global_ordering_section',
			        'type'    => 'sortable_repeater',
			        'choices'     => array(
						'Goldly_featuredimage_slider' => 'Featured Slider',
						'Goldly_featured_section' => 'Featured Section',
						'Goldly_widget_section'  => 'Widget Section',	
						'Goldly_about_section'	=> 'About Section',
						'Goldly_our_portfolio_section'	=> 'Best Selling',
						'Goldly_our_team_section'	=> 'New Arrivals',
						'Goldly_our_testimonial_section'	=> 'Our Testimonial',
						'Goldly_our_services_section'	=> 'Our Services',	
						'Goldly_our_sponsors_section'	=> 'Our Sponsors',	
						'Goldly_full_banner_section' => 'full_banner',	
						'Goldly_product_category_section' => 'product_category'										
					),
			    )
			));
		

	    //Add Section in theme option
	    	$wp_customize->add_section( 'global_full_benner_section' , array(
				'title'  => 'Full Benner',
				'panel'  => 'goldly_theme_section',	
			) );
			//banner section in title
				$wp_customize->add_setting( 'goldly_full_benner_title', 
			        array(
			            'default'    => 'SHOP AND SAVE BIG ON HOTTEST TABLETS', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_text_field',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Control( 
			        $wp_customize,'goldly_full_benner_title', 
			        array(
			            'label'      => __( 'Title', 'goldly' ), 
			            'type'       => 'text',
			            'settings'   => 'goldly_full_benner_title', 
			            'priority'   => 10,
			            'section'    => 'global_full_benner_section',
			        ) 
		        ) ); 
		    //banner section in sub title
				$wp_customize->add_setting( 'goldly_full_benner_subtitle', 
			        array(
			            'default'    => 'Starting At $79 ', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_text_field',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Control( 
			        $wp_customize,'goldly_full_benner_subtitle', 
			        array(
			            'label'      => __( 'Sub Heding', 'goldly' ), 
			            'type'       => 'text',
			            'settings'   => 'goldly_full_benner_subtitle', 
			            'priority'   => 10,
			            'section'    => 'global_full_benner_section',
			        ) 
		        ) ); 
			//banner section in Link
				$wp_customize->add_setting( 'goldly_full_benner_link', 
			        array(
			            'default'    => '#', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_text_field',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Control( 
			        $wp_customize,'goldly_full_benner_link', 
			        array(
			            'label'      => __( 'Link', 'goldly' ), 
			            'settings'   => 'goldly_full_benner_link', 
			            'type'       => 'text',
			            'priority'   => 10,
			            'section'    => 'global_full_benner_section',
			        ) 
		        ) ); 
			//add full benner section in bg color
				$wp_customize->add_setting('goldly_full_benner_bg_color_section', array(
		        	'default'    => '#d5d1d1', //Default setting/value to save
		            'type'       => 'theme_mod',
		            'transport'   => 'refresh',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'sanitize_hex_color',
			    ));
			    $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_full_benner_bg_color_section', 
			        array(
			            'label'      => __( 'Background Color', 'ecommerce-goldly' ), 
			            'settings'   => 'goldly_full_benner_bg_color_section', 
			            'priority'   => 10,
			            'section'    => 'global_full_benner_section',
			        ) 
		        ) ); 
			//banner section in ecommerce goldly text color
				$wp_customize->add_setting( 'goldly_full_benner_text_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_full_benner_text_color', 
			        array(
			            'label'      => __( 'Text Color', 'ecommerce-goldly' ), 
			            'settings'   => 'goldly_full_benner_text_color', 
			            'priority'   => 10,
			            'section'    => 'global_full_benner_section',
			        ) 
		        ) );
		    //add full benner section in ecommerce goldly
				$wp_customize->add_setting('goldly_full_benner_bg_image_section', array(
		        	'type'       => 'theme_mod',
			        'transport'     => 'refresh',
			        'height'        => 180,
			        'width'        => 160,
			        'capability' => 'edit_theme_options',
			        'sanitize_callback' => 'esc_url_raw'
			    ));
			    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'goldly_full_benner_bg_image_section', array(
			        'label' => __('Backgroung Image', 'ecommerce-goldly'),
			        'section' => 'global_full_benner_section',
			        'settings' => 'goldly_full_benner_bg_image_section',
			        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
			    ))); 
			//full benner section in image background position
			    $wp_customize->add_setting('goldly_full_benner_img_bg_position', array(
			        'default'        => 'center center',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_full_benner_img_bg_position',
			    	array(
				        'settings' => 'goldly_full_benner_img_bg_position',
				        'label'   => 'Background Position',
				        'section' => 'global_full_benner_section',
				        'type'  => 'select',
				        'choices'    => array(
				        	'left top' => 'Left Top',
				        	'left center' => 'Left Center',
				        	'left bottom' => 'Left Bottom',
				            'right top' => 'Right Top',
				            'right center' => 'Right Center',
				            'right bottom' => 'Right Bottom',
				            'center top' => 'Center Top',
				            'center center' => 'Center Center',
				            'center bottom' => 'Center Bottom',
			        	),
			        )
			    )); 
			//full benner section in image background attachment
			    $wp_customize->add_setting('goldly_full_benner_bg_attachment', array(
			        'default'        => 'scroll',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_full_benner_bg_attachment',
			    	array(
				        'settings' => 'goldly_full_benner_bg_attachment',
				        'label'   => 'Background Attachment',
				        'section' => 'global_full_benner_section',
				        'type'  => 'select',
				        'choices'    => array(
				        	'scroll' => 'Scroll',
				        	'fixed' => 'Fixed',
			        	),
			        )
			    ));
			//full benner section in image background Size
			    $wp_customize->add_setting('goldly_full_benner_bg_size', array(
			        'default'        => 'cover',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_full_benner_bg_size',
			    	array(
				        'settings' => 'goldly_full_benner_bg_size',
				        'label'   => 'Background Size',
				        'section' => 'global_full_benner_section',
				        'type'  => 'select',
				        'choices'    => array(
				        	'auto' => 'Auto',
				        	'cover' => 'Cover',
				            'contain' => 'Contain'
			        	),
			        )
			    ));  		    

		//Add Product Category
		    $wp_customize->add_section( 'global_product_category_section' , array(
				'title'  => 'Product Category',
				'panel'  => 'goldly_theme_section',	
			) ); 
			//Product Category in Tabing
				$wp_customize->add_setting( 'product_categoryu_tab', 
			        array(
			            'default'    => 'general', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'goldly_sanitize_select',
			        ) 
			    ); 
		        $wp_customize->add_control( new Goldly_Custom_Radio_Control( 
			        $wp_customize,'product_categoryu_tab',array(
			            'settings'   => 'product_categoryu_tab', 
			            'priority'   => 10,
			            'section'    => 'global_product_category_section',
			            'type'    => 'select',
			            'choices'    => array(
				        	'general' => 'General',
				        	'design' => 'Design',
			        	),
			        ) 
		        ) );
		    //Add Product checkbox
				$wp_customize->add_setting( "ecommerce_product_checkbox", array(
					'default'  => 'true',
					'sanitize_callback' => 'goldly_sanitize_checkbox',
					'type'      		=> 'theme_mod',
					'transport'        => 'refresh',
			        'capability'     => 'edit_theme_options',
				) );
				
				$wp_customize->add_control( 'ecommerce_product_checkbox', array(
					'label'             => esc_html__( 'Display Product Category', 'ecommerce-goldly' ),
					'section'           => 'global_product_category_section',
					'type'				=> 'checkbox',
					'settings'          => 'ecommerce_product_checkbox',
					'active_callback' => 'ecommercegoldly_product_category_general_callback',    
				) );  
				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial(
						'ecommerce_product_checkbox',
						array(
							'selector'        => '.ecommerce_product_section',
							'render_callback' => 'goldly_customize_partial_product_category',
						)
					);
				}
			//Add Product Title
				$wp_customize->add_setting( "ecommerce_product_title", array(
					'default'  => 'Collections',
					'sanitize_callback' => 'sanitize_text_field',
					'type'      		=> 'theme_mod',
					'transport'        => 'refresh',
			        'capability'     => 'edit_theme_options',
				) );
				
				$wp_customize->add_control( 'ecommerce_product_title', array(
					'label'             => esc_html__( 'Product Category Title', 'ecommerce-goldly' ),
					'section'           => 'global_product_category_section',
					'type'				=> 'text',
					'settings'          => 'ecommerce_product_title',
					'active_callback' => 'ecommercegoldly_product_category_general_callback',    
				) );  

			//Add Product category
				$wp_customize->add_setting( "ecommerce_goldly_category", array(
					'default'     =>  "Select Category",
					'sanitize_callback' => 'goldly_sanitize_select',
					'type'      		=> 'theme_mod',
					'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
				) );
				
				$wp_customize->add_control( 'ecommerce_goldly_category', array(
					'label'             => esc_html__( 'Select Product Category', 'ecommerce-goldly' ),
					'section'           => 'global_product_category_section',
					'type'				=> 'select',
					'settings'          => 'ecommerce_goldly_category',
					'choices'			=> ecommercegoldly_get_product_categories(),
					'active_callback' => 'ecommercegoldly_product_category_general_callback',  
				) ); 
			//Add Product Button Label Title
				$wp_customize->add_setting( "ecommerce_product_btn_lable", array(
					'default'  => 'View Product',
					'sanitize_callback' => 'sanitize_text_field',
					'type'      		=> 'theme_mod',
					'transport'        => 'refresh',
			        'capability'     => 'edit_theme_options',
				) );
				
				$wp_customize->add_control( 'ecommerce_product_btn_lable', array(
					'label'             => esc_html__( 'Button Label', 'ecommerce-goldly' ),
					'section'           => 'global_product_category_section',
					'type'				=> 'text',
					'settings'          => 'ecommerce_product_btn_lable',
					'active_callback' => 'ecommercegoldly_product_category_general_callback',  
				) ); 
			//Add Product category title Color
				$wp_customize->add_setting( 'goldly_product_category_title_color', 
			        array(
			            'default'    => '#333', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_product_category_title_color', 
			        array(
			            'label'      => __( 'Title Color', 'ecommerce-goldly' ), 
			            'settings'   => 'goldly_product_category_title_color', 
			            'priority'   => 10,
			            'section'    => 'global_product_category_section',
			            'active_callback' => 'ecommercegoldly_product_category_design_callback',
			        ) 
		        ) ); 
			//Add Product category background Color
				$wp_customize->add_setting( 'goldly_product_category_bg_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_product_category_bg_color', 
			        array(
			            'label'      => __( 'Background Color', 'ecommerce-goldly' ), 
			            'settings'   => 'goldly_product_category_bg_color', 
			            'priority'   => 10,
			            'section'    => 'global_product_category_section',
			            'active_callback' => 'ecommercegoldly_product_category_design_callback',
			        ) 
		        ) );
		    //Add Product category Text Color
				$wp_customize->add_setting( 'goldly_product_category_text_color', 
			        array(
			            'default'    => '#333', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_product_category_text_color', 
			        array(
			            'label'      => __( 'Text Color', 'ecommerce-goldly' ), 
			            'settings'   => 'goldly_product_category_text_color', 
			            'priority'   => 10,
			            'section'    => 'global_product_category_section',
			            'active_callback' => 'ecommercegoldly_product_category_design_callback',
			        ) 
		        ) );
		    //Add Product category contain bg Color
				$wp_customize->add_setting( 'goldly_product_contain_bg_color', 
			        array(
			            'default'    => '#eeeeee', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_product_contain_bg_color', 
			        array(
			            'label'      => __( 'Containe Background Color', 'ecommerce-goldly' ), 
			            'settings'   => 'goldly_product_contain_bg_color', 
			            'priority'   => 10,
			            'section'    => 'global_product_category_section',
			            'active_callback' => 'ecommercegoldly_product_category_design_callback',
			        ) 
		        ) );

		//Hide & Show and drag & drop in pro option
			$wp_customize->add_setting('goldly_hide_show_pro', array(
		        'type'       => 'theme_mod',
		        'transport'   => 'refresh',
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
		    ));
		    $wp_customize->add_control( new ecommercegoldly_Drag_Drop_pro_option_Control(
		    	$wp_customize,'goldly_hide_show_pro',
		    	array(
			        'settings' => 'goldly_hide_show_pro',
			        'label'   => 'Drag & Drop Section in Ecommerce Goldly Pro!',
			        'section' => 'global_ordering_section',
		        )
		    ));	
}
add_action( 'customize_register', 'ecommercegoldly_child_customizer_section',20 );


function ecommercegoldly_customizer_css() {

    wp_enqueue_style( 'ecommercegoldly-customize-controls-style', get_stylesheet_directory_uri() . '/assets/css/customizer-admin.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'ecommercegoldly_customizer_css',0 );

/*
 * List product category id's
 */
function ecommercegoldly_get_product_categories(){

	$args = array(
			'taxonomy' => 'product_cat',
			'orderby' => 'date',
			'order' => 'ASC',
			'show_count' => 1,
			'pad_counts' => 0,
			'hierarchical' => 0,
			'title_li' => '',
			'hide_empty' => 1,
	);

	$cats = get_categories($args);

	$arr = array();
	$arr['0'] = esc_html__('Select Category', 'ecommerce-goldly');
	foreach($cats as $cat){
		$arr[$cat->term_id] = $cat->name;
	}
	return $arr;
}

function ecommercegoldly_product_category_general_callback(){
	$product_categoryu_tab = get_theme_mod( 'product_categoryu_tab','general');
	if ( 'general' === $product_categoryu_tab ) {
		return true;
	}
	return false;
}
function ecommercegoldly_product_category_design_callback(){
	$product_categoryu_tab = get_theme_mod( 'product_categoryu_tab','general');
	if ( 'design' === $product_categoryu_tab ) {
		return true;
	}
	return false;
}
function goldly_customize_partial_product_category(){
	bloginfo( 'ecommerce_product_checkbox' );
}