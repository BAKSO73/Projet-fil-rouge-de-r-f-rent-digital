<?php
/**
 * Goldly Theme Customizer
 *
 * @package Goldly
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
use \WPTRT\Customize\Control\ColorAlpha;
global $goldly_fonttotal;

$goldly_fonttotal = array(
		__( 'Select Font','goldly' ),
        __( 'Abril Fatface','goldly' ),
        __( 'Indie Flower' ,'goldly'), 
        __( 'Lobster Two' ,'goldly'),
        __( 'Merriweather' ,'goldly'),
        __( 'Monda' ,'goldly'),
    );
function goldly_customize_register( $wp_customize ) {
	$font_weight = array('100' => '100',
			            '200' => '200',
			            '300' => '300',
			            '400' => '400',
						'500' => '500',
						'600' => '600',
						'700' => '700',
						'800' => '800',
						'900' => '900',
						'bold' => 'bold',
						'bolder' => 'bolder',
						'inherit' => 'inherit',
						'initial' => 'initial',
						'normal' => 'normal',
						'revert' => 'revert',
						'unset' => 'unset',
					);

	$text_transform = array(
						'capitalize' => 'Capitalize',
						'inherit'	 => 'Inherit',
						'lowercase'  => 'Lowercase',
						'uppercase'  => 'Uppercase',
	);

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'goldly_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'goldly_customize_partial_blogdescription',
			)
		);
	}

	if ( method_exists( $wp_customize, 'register_section_type' ) ) {
		$wp_customize->register_section_type( 'goldly_pro_Section' );
	}
	if ( ! defined( 'GP_PREMIUM_VERSION' ) ) {
		$wp_customize->add_section(
			new goldly_pro_Section(
				$wp_customize,
				'goldly_pro_Section',
				array(
                	'pro_text' => esc_html__( 'Upgrade To PRO', 'goldly' ),
                	'pro_url'  => 'https://www.xeeshop.com/product/goldly-pro',
					'capability' => 'edit_theme_options',
					'priority' => 0,
					'type' => 'gp-upselles-section',
				)
			)
		);
	}

	if ( method_exists( $wp_customize, 'register_section_type' ) ) {
		$wp_customize->register_section_type( 'goldly_documentation_Upsell_Section' );
	}
	if ( ! defined( 'GP_PREMIUM_VERSION' ) ) {
		$wp_customize->add_section(
			new goldly_documentation_Upsell_Section(
				$wp_customize,
				'goldly_documentation_Upsell_Section',
				array(
					'title'    => esc_html__( 'Documentation', 'goldly' ),
                	'pro_text' => esc_html__( 'Read More', 'goldly' ),
                	'pro_url'  => 'https://www.xeeshop.com/goldly-documentation/',
					'capability' => 'edit_theme_options',
					'priority' => 0,
					'type' => 'gp-upsell-section',
				)
			)
		);
	}

	//color section
		//body link color
			$wp_customize->add_setting( 'goldly_link_color', 
				array(
		            'default'    => '#214462', //Default setting/value to save
		            'type'       => 'theme_mod',
		            'transport'   => 'refresh',
		            'capability'     => 'edit_theme_options',
		            'sanitize_callback' => 'sanitize_hex_color',
		        ) 
		    ); 
	        $wp_customize->add_control( new WP_Customize_Color_Control( 
		        $wp_customize,'goldly_link_color',array(
		            'label'      => __( 'Link Color', 'goldly' ), 
		            'settings'   => 'goldly_link_color', 
		            'priority'   => 10,
		            'section'    => 'colors',
		        ) 
	        ) ); 
	    //body link hover color
			$wp_customize->add_setting( 'goldly_link_hover_color', 
				array(
		            'default'    => '#000000', //Default setting/value to save
		            'type'       => 'theme_mod',
		            'transport'   => 'refresh',
		            'capability'     => 'edit_theme_options',
		            'sanitize_callback' => 'sanitize_hex_color',
		        ) 
		    ); 
	        $wp_customize->add_control( new WP_Customize_Color_Control( 
		        $wp_customize,'goldly_link_hover_color',array(
		            'label'      => __( 'Link Hover Color', 'goldly' ), 
		            'settings'   => 'goldly_link_hover_color', 
		            'priority'   => 10,
		            'section'    => 'colors',
		        ) 
	        ) ); 

	//Social Info our panels
		$wp_customize->add_panel( 'goldly_social_icon', array(
			'title'          => __('Top Bar', 'goldly'),
			'priority'  => 1,
		) );
		// Create Contact Info Section
			$wp_customize->add_section( 'contant_info_section' , array(
				'title'             => 'Contact Info',
				'panel'             => 'goldly_social_icon',
			) );
		    //Contact Info Section in contact number
			    $wp_customize->add_setting( 'goldly_contact_info_number', 
			        array(
			            'default'    => '04463235323', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_text_field',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Control( 
			        $wp_customize,'goldly_contact_info_number', 
			        array(
			            'label'      => __( 'Contact Info Number', 'goldly' ), 
			            'settings'   => 'goldly_contact_info_number',
			            'section'    => 'contant_info_section',
			        ) 
		        ) ); 
		    //Email Info Section in contact number
			    $wp_customize->add_setting( 'goldly_email_info_number', 
			        array(
			            'default'    => 'goldly@gmail.com', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_text_field',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Control( 
			        $wp_customize,'goldly_email_info_number', 
			        array(
			            'label'      => __( 'Email ID', 'goldly' ), 
			            'settings'   => 'goldly_email_info_number',
			            'section'    => 'contant_info_section',
			        ) 
		        ) ); 
		//Create Social icon section
			$wp_customize->add_section( 'social_link_section' , array(
				'title'             => 'Social Links',
				'panel'             => 'goldly_social_icon',
			) ); 
		    //header topbar in twitter link
			    $wp_customize->add_setting( 'goldly_twitter_link', array(		                
			                'default'   => 'https://twitter.com/',
							'priority'  => 10,
							'capability' => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_text_field',
			    ));				    
			    $wp_customize->add_control(  new WP_Customize_Control(
				    	$wp_customize,'goldly_twitter_link', 
				    	array(
			                'label' => 'Twitter Link',
			                'section' => 'social_link_section',
			                'settings' => 'goldly_twitter_link',
				        )
			    ));	
		    //header topbar in facebook link
			    $wp_customize->add_setting( 'goldly_facebook_link', array(		                
			                'default'   => 'https://www.facebook.com/',
							'priority'  => 10,
							'capability' => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_text_field',
			    ));					    
			    $wp_customize->add_control(  new WP_Customize_Control(
				    	$wp_customize,'goldly_facebook_link', 
				    	array(
			                'label' => 'Facebook Link',
			                'section' => 'social_link_section',
			                'settings' => 'goldly_facebook_link',
				        )
			    ));	
		    //header topbar in instagram link
			    $wp_customize->add_setting( 'goldly_instagram_link', array(		                
			                'default'   => 'https://www.instagram.com/',
							'priority'  => 10,
							'capability' => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_text_field',
			    )); 				    
			    $wp_customize->add_control(  new WP_Customize_Control(
				    	$wp_customize,'goldly_instagram_link', 
				    	array(
			                'label' => 'Instagram Link',
			                'section' => 'social_link_section',
			                'settings' => 'goldly_instagram_link',
				        )
			    ));	
		    //header topbar in linkedin link
			    $wp_customize->add_setting( 'goldly_linkedin_link', array(		                
			                'default'   => 'https://www.linkedin.com/feed/',
							'priority'  => 10,
							'capability' => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_text_field',
			    ));				    
			    $wp_customize->add_control(  new WP_Customize_Control(
				    	$wp_customize,'goldly_linkedin_link', 
				    	array(
			                'label' => 'Linkedin Link',
			                'section' => 'social_link_section',
			                'settings' => 'goldly_linkedin_link',
				        )
			    ));
		    //header menu button in pinterest link
			    $wp_customize->add_setting( 'goldly_pinterest_link', array(		                
			                'default'   => 'https://www.pinterest.com',
							'priority'  => 10,
							'capability' => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_text_field',
			    ));					    
			    $wp_customize->add_control(  new WP_Customize_Control(
				    	$wp_customize,'goldly_pinterest_link', 
				    	array(
			                'label' => 'Pinterest Link',
			                'section' => 'social_link_section',
			                'settings' => 'goldly_pinterest_link',
				        )
			    ));	
		    //header menu button in youtube link
			    $wp_customize->add_setting( 'goldly_youtube_link', array(		                
			                'default'   => 'https://www.youtube.com/',
							'priority'  => 10,
							'capability' => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_text_field',
			    ));					    
			    $wp_customize->add_control(  new WP_Customize_Control(
				    	$wp_customize,'goldly_youtube_link', 
				    	array(
			                'label' => 'Youtube Link',
			                'section' => 'social_link_section',
			                'settings' => 'goldly_youtube_link',
				        )
			    ));
			//social icon color	
			    $wp_customize->add_setting( 'goldly_social_icon_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 

		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_social_icon_color',array(
			            'label'      => __( 'Icon Color', 'goldly' ), 
			            'settings'   => 'goldly_social_icon_color', 
			            'priority'   => 10,
			            'section'    => 'social_link_section',
			        ) 
		        ) ); 
			//social icon hover color	
				$wp_customize->add_setting( 'goldly_social_icon_hover_color', 
			        array(
			            'default'    => '#214462', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 

		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_social_icon_hover_color',array(
			            'label'      => __( 'Icon Hover Color', 'goldly' ), 
			            'settings'   => 'goldly_social_icon_hover_color', 
			            'priority'   => 10,
			            'section'    => 'social_link_section',
			        ) 
		        ) );
		    //social icon background color	
				$wp_customize->add_setting( 'goldly_social_icon_bg_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 

		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_social_icon_bg_color',array(
			            'label'      => __( 'Icon Background Color', 'goldly' ), 
			            'settings'   => 'goldly_social_icon_bg_color', 
			            'priority'   => 10,
			            'section'    => 'social_link_section',
			        ) 
		        ) ); 
		    //social icon background hover color	
				$wp_customize->add_setting( 'goldly_social_icon_bg_hover_color', 
			        array(
			            'default'    => '#02cfaa', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_social_icon_bg_hover_color',array(
			            'label'      => __( 'Icon Background Hover Color', 'goldly' ), 
			            'settings'   => 'goldly_social_icon_bg_hover_color', 
			            'priority'   => 10,
			            'section'    => 'social_link_section',
			        ) 
		        ) );         
		//Create Call Menu Button
			$wp_customize->add_section( 'call_menu_btn_section' , array(
				'title'             => 'Call Menu Button',
				'panel'             => 'goldly_social_icon',
			) ); 
			//call menu button display in header option
		        $wp_customize->add_setting( 'goldly_call_menu_btn', array(		                
			                'default'   => true,
							'priority'  => 10,
							'capability' => 'edit_theme_options',
							'sanitize_callback' => 'goldly_sanitize_checkbox',
			    ));
			    $wp_customize->add_control(  new WP_Customize_Control(
				    	$wp_customize,'goldly_call_menu_btn', 
				    	array(
			                'label' => 'Display header Menu Button',
			                'type'  => 'checkbox', // this indicates the type of control
			                'section' => 'call_menu_btn_section',
			                'settings' => 'goldly_call_menu_btn',
				        )
			    ));
			//call menu button title 
			    $wp_customize->add_setting( 'goldly_call_menu_btn_title', array(		                
			                'default'   => "Get A Quote",
							'priority'  => 10,
							'capability' => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control(  new WP_Customize_Control(
				    	$wp_customize,'goldly_call_menu_btn_title', 
				    	array(
			                'label' => 'Title',
			                'type'  => 'text', // this indicates the type of control
			                'section' => 'call_menu_btn_section',
			                'settings' => 'goldly_call_menu_btn_title',
			                'active_callback'  => 'goldly_call_menu_btn_callback',
				        )
			    ));
			//call menu button in add link
		        $wp_customize->add_setting( 'goldly_menu_btn_link', array(
				            'default'        => '#',
				            'capability'     => 'edit_theme_options',
				            'type'           => 'theme_mod',
				            'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_menu_btn_link',
				    	array(
				            'label'      => __('Text Link', 'goldly'),
				            'section'    =>  'call_menu_btn_section',
				            'settings'   => 'goldly_menu_btn_link',
				            'active_callback'  => 'goldly_call_menu_btn_callback',
				        )
		        ));

			//call menu button in add background color
			    $wp_customize->add_setting( 'goldly_callmenu_btn_bg_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize, 'goldly_callmenu_btn_bg_color',array(
			            'label'      => __( 'Background Color', 'goldly' ), 
			            'settings'   => 'goldly_callmenu_btn_bg_color', 
			            'priority'   => 10, 
			            'section'    => 'call_menu_btn_section',
			            'active_callback'  => 'goldly_call_menu_btn_callback',
			        ) 
		        ) );

	        //call menu button in add backround hovor color
		        $wp_customize->add_setting( 'goldly_callmenu_btn_bghover_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize, 'goldly_callmenu_btn_bghover_color', 
			        array(
			            'label'      => __( 'Background Hover Color', 'goldly' ), 
			            'settings'   => 'goldly_callmenu_btn_bghover_color', 
			            'priority'   => 10, 
			            'section'    => 'call_menu_btn_section',
			            'active_callback'  => 'goldly_call_menu_btn_callback', 
			        ) 
		        ) );

	        //call menu button in add text color
		        $wp_customize->add_setting( 'goldly_callmenu_btn_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize, 'goldly_callmenu_btn_color', 
			        array(
			            'label'      => __( 'Text Color', 'goldly' ), 
			            'settings'   => 'goldly_callmenu_btn_color', 
			            'priority'   => 10, 
			            'section'    => 'call_menu_btn_section', 
			            'active_callback'  => 'goldly_call_menu_btn_callback',
			        ) 
		        ) );

	        //call menu button in add Text hovor color
		        $wp_customize->add_setting( 'goldly_call_btn_texthover_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize, 'goldly_call_btn_texthover_color', 
			        array(
			            'label'      => __( 'Text Hover Color', 'goldly' ), 
			            'settings'   => 'goldly_call_btn_texthover_color', 
			            'priority'   => 10, 
			            'section'    => 'call_menu_btn_section', 
			            'active_callback'  => 'goldly_call_menu_btn_callback',
			        ) 
		        ) );

	        //call menu button in add Border color
		        $wp_customize->add_setting( 'goldly_call_btn_border_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize, 'goldly_call_btn_border_color', 
			        array(
			            'label'      => __( 'Border Color', 'goldly' ), 
			            'settings'   => 'goldly_call_btn_border_color', 
			            'priority'   => 10, 
			            'section'    => 'call_menu_btn_section', 
			            'active_callback'  => 'goldly_call_menu_btn_callback',
			        ) 
		        ) );
		//Create top bar width
		    $wp_customize->add_section( 'top_bar_width_section' , array(
				'title'             => 'Top Bar Width',
				'panel'             => 'goldly_social_icon',
			) );
			//Container Option in top bar width layout
		        $wp_customize->add_setting('goldly_top_bar_width_layout', array(
			        'default'        => 'content_width',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_top_bar_width_layout',
			    	array(
				        'settings' => 'goldly_top_bar_width_layout',
				        'label'   => 'Top Bar Width Layouts',
				        'section' => 'top_bar_width_section',
				        'type'    => 'select',
				        'choices' => array(
				        			'full_width' => 'Full Width',
				        			'content_width' => 'Content Width',
				        ),
			        )
			    ));
			//Container Option in top bar container width
		        $wp_customize->add_setting('goldly_top_bar_container_width', array(
			        'default'        => '1100',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_top_bar_container_width',
			    	array(
				        'settings' => 'goldly_top_bar_container_width',
				        'description' => 'in px',
				        'label'   => 'Top Bar Content Width',
				        'section' => 'top_bar_width_section',
				        'type'    => 'text',
				        'active_callback'  => 'goldly_top_bar_content_width_callback',
			        )
			    ));

	//Header Option
		$wp_customize->add_panel( 'goldly_header_panel', array(
			'title'     => __('Header', 'goldly'),
			'priority'  => 2,
		) ); 
		// Create Header option
			$wp_customize->add_section( 'header_option_section' , array(
				'title'             => 'Header Option',
				'panel'             => 'goldly_header_panel',
			) );
			//select header layout	
				$wp_customize->add_setting( 'goldly_header_layout', 
			        array(
			            'default'    => 'header4', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'goldly_sanitize_select',
			        ) 
			    ); 
		        $wp_customize->add_control( new Goldly_Custom_Radio_Image_Control( 
			        $wp_customize,'goldly_header_layout',array(
			        	'label'      => __( 'Header & Transparent Layout', 'goldly' ), 
			            'settings'   => 'goldly_header_layout', 
			            'priority'   => 0,
			            'section'    => 'header_option_section',
			            'type'    => 'select',
			            'choices'    => goldly_header_site_layout(),
			        ) 
		        ) );

		    //Header2
				//Top bar background color	
					$wp_customize->add_setting( 'goldly_topbar_bg_color', 
				        array(
				            'default'    => '#ffffff', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability'     => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'goldly_topbar_bg_color',array(
				            'label'      => __( 'Top Bar Background Color', 'goldly' ), 
				            'settings'   => 'goldly_topbar_bg_color', 
				            'priority'   => 10,
				            'section'    => 'header_option_section',		            
				            'active_callback'  => 'goldly_header2_callback',
			   							[
											[
												'setting'  => 'goldly_header_layout',
												'operator' => '===',
												'value'    => 'header2',
											],
										],

				        ) 
			        ) );
			    //Top bar text color	
					$wp_customize->add_setting( 'goldly_topbar_text_color', 
				        array(
				            'default'    => '#273641', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability'     => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'goldly_topbar_text_color',array(
				            'label'      => __( 'Top Bar Text Color', 'goldly' ), 
				            'settings'   => 'goldly_topbar_text_color', 
				            'priority'   => 10,
				            'section'    => 'header_option_section',
				            //'active_callback' => 'goldly_header2_callback',
				            'active_callback'  => 'goldly_header2_callback',
			   							[
											[
												'setting'  => 'goldly_header_layout',
												'operator' => '===',
												'value'    => 'header2',
											],
										],
				        ) 
			        ) );
			    //Header background color	
					$wp_customize->add_setting( 'goldly_header_background_color', 
				        array(
				            'default'    => '#273641', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability'     => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'goldly_header_background_color',array(
				            'label'      => __( 'Background Color', 'goldly' ), 
				            'settings'   => 'goldly_header_background_color', 
				            'priority'   => 10,
				            'section'    => 'header_option_section',
				            'active_callback'  => 'goldly_header2_callback',
			   							[
											[
												'setting'  => 'goldly_header_layout',
												'operator' => '===',
												'value'    => 'header2',
											],
										],
				        ) 
			        ) );
			    //Header Text color	
					$wp_customize->add_setting( 'goldly_header_text_color', 
				        array(
				            'default'    => '#ffffff', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability'     => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'goldly_header_text_color',array(
				            'label'      => __( 'Text Color', 'goldly' ), 
				            'settings'   => 'goldly_header_text_color', 
				            'priority'   => 10,
				            'section'    => 'header_option_section',
				            'active_callback'  => 'goldly_header2_callback',
			   							[
											[
												'setting'  => 'goldly_header_layout',
												'operator' => '===',
												'value'    => 'header2',
											],
										],
				        ) 
			        ) ); 
			    //Header Link color	
					$wp_customize->add_setting( 'goldly_header_link_color', 
				        array(
				            'default'    => '#ffffff', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability'     => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'goldly_header_link_color',array(
				            'label'      => __( 'Link Color', 'goldly' ), 
				            'settings'   => 'goldly_header_link_color', 
				            'priority'   => 10,
				            'section'    => 'header_option_section',
				            'active_callback'  => 'goldly_header2_callback',
			   							[
											[
												'setting'  => 'goldly_header_layout',
												'operator' => '===',
												'value'    => 'header2',
											],
										],
				        ) 
			        ) ); 
			    //Header Link Hover color	
					$wp_customize->add_setting( 'goldly_header_link_hover_color', 
				        array(
				            'default'    => '#ffffff', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability'     => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'goldly_header_link_hover_color',array(
				            'label'      => __( 'Link Hover Color', 'goldly' ), 
				            'settings'   => 'goldly_header_link_hover_color', 
				            'priority'   => 10,
				            'section'    => 'header_option_section',
				            'active_callback'  => 'goldly_header2_callback',
			   							[
											[
												'setting'  => 'goldly_header_layout',
												'operator' => '===',
												'value'    => 'header2',
											],
										],
				        ) 
			        ) );
			//Transparent Backgound 
			    //Transparent Header background color
				    $wp_customize->add_setting(
				        'alpha_color_setting',
				        array(
				            'default'    => 'rgba(255,255,255,0.3)',
				            'type'       => 'theme_mod',
				            'capability' => 'edit_theme_options',
				            'transport'  => 'refresh',
							'sanitize_callback' => 'goldly_custom_sanitization_callback',
				        )
				    );	
				    $wp_customize->add_control(new WP_Customize_Transparent_Color_Control(
				            $wp_customize,'alpha_color_control',
				            array(
				                'label'        => __( 'Alpha Color Picker', 'goldly' ),
				                'section'      => 'header_option_section',
				                'settings'     => 'alpha_color_setting',
				                'active_callback'  => 'goldly_header4_callback',
				                'show_opacity' => true, // Optional.
				                'palette'      => array(
				                    'rgb(150, 50, 220)',
				                    'rgba(50,50,50,0.8)',
				                    'rgba( 255, 255, 255, 0.2 )',
				                    '#00CC99' // Mix of color types = no problem
				                ),

				            )
				        )
				    );
			    //Transparent Header Text color	
					$wp_customize->add_setting( 'goldly_transparent_header_text_color', 
				        array(
				            'default'    => '#ffffff', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability'     => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'goldly_transparent_header_text_color',array(
				            'label'      => __( 'Transparent Header Text Color', 'goldly' ), 
				            'settings'   => 'goldly_transparent_header_text_color', 
				            'priority'   => 10,
				            'section'    => 'header_option_section',
				            'active_callback'  => 'goldly_header4_callback',
				        ) 
			        ) ); 
			    //Transparent Header Link color	
					$wp_customize->add_setting( 'goldly_transparent_header_link_color', 
				        array(
				            'default'    => '#ffffff', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability'     => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'goldly_transparent_header_link_color',array(
				            'label'      => __( 'Transparent Header Link Color', 'goldly' ), 
				            'settings'   => 'goldly_transparent_header_link_color', 
				            'priority'   => 10,
				            'section'    => 'header_option_section',
				            'active_callback'  => 'goldly_header4_callback',
				        ) 
			        ) ); 
			    //Transparent Header Link Hover color	
					$wp_customize->add_setting( 'goldly_transparent_header_link_hover_color', 
				        array(
				            'default'    => '#ffffff', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability'     => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'goldly_transparent_header_link_hover_color',array(
				            'label'      => __( 'Transparent Header Link Hover Color', 'goldly' ), 
				            'settings'   => 'goldly_transparent_header_link_hover_color', 
				            'priority'   => 10,
				            'section'    => 'header_option_section',
				            'active_callback'  => 'goldly_header4_callback',
				        ) 
			        ) ); 

			//Manu Link Active Color
		        $wp_customize->add_setting( 'goldly_menu_active_color', 
			        array(
			            'default'    => '#7fa7c5', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_menu_active_color',array(
			            'label'      => __( 'Menu Active Color', 'goldly' ), 
			            'settings'   => 'goldly_menu_active_color', 
			            'priority'   => 10,
			            'section'    => 'header_option_section',		   							
			        ) 
		        ) ); 
			//Desktop submenu background color
			    $wp_customize->add_setting( 'goldly_submenu_bg_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_submenu_bg_color',array(
			            'label'      => __( 'Desktop Submenu Background Color', 'goldly' ), 
			            'settings'   => 'goldly_submenu_bg_color', 
			            'priority'   => 10,
			            'section'    => 'header_option_section',		   							
			        ) 
		        ) ); 
		    //Mobile nav menu background color
		        $wp_customize->add_setting( 'goldly_mobile_navmenu_bg_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_mobile_navmenu_bg_color',array(
			            'label'      => __( 'Mobile Nav menu Background Color', 'goldly' ), 
			            'settings'   => 'goldly_mobile_navmenu_bg_color', 
			            'priority'   => 10,
			            'section'    => 'header_option_section',		   							
			        ) 
		        ) ); 
			//mobile submenu background color
			    $wp_customize->add_setting( 'goldly_mobile_submenu_bg_color', 
			        array(
			            'default'    => '#b1d8f5', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_mobile_submenu_bg_color',array(
			            'label'      => __( 'Mobile Submenu Background Color', 'goldly' ), 
			            'settings'   => 'goldly_mobile_submenu_bg_color', 
			            'priority'   => 10,
			            'section'    => 'header_option_section',		   							
			        ) 
		        ) ); 
		    //Mobile nav menu active background color
		        $wp_customize->add_setting( 'goldly_mobile_navmenu_active_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_mobile_navmenu_active_color',array(
			            'label'      => __( 'Mobile Nav Menu Acive Color', 'goldly' ), 
			            'settings'   => 'goldly_mobile_navmenu_active_color', 
			            'priority'   => 10,
			            'section'    => 'header_option_section',		   							
			        ) 
		        ) ); 
		    //mobile menu link color
		        $wp_customize->add_setting( 'goldly_mobile_link_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_mobile_link_color',array(
			            'label'      => __( 'Mobile menu Link Color', 'goldly' ), 
			            'settings'   => 'goldly_mobile_link_color', 
			            'priority'   => 10,
			            'section'    => 'header_option_section',		   							
			        ) 
		        ) ); 
		    

			//display cart option
			    $wp_customize->add_setting( 'goldly_cart_icon', array(		                
			                'default'   => true,
							'priority'  => 10,
							'capability' => 'edit_theme_options',
							'sanitize_callback' => 'goldly_sanitize_checkbox',
			    ));
			    $wp_customize->add_control(  new WP_Customize_Control(
				    	$wp_customize,'goldly_cart_icon', 
				    	array(
			                'label' => 'Display header Cart Icon',
			                'type'  => 'checkbox', // this indicates the type of control
			                'section' => 'header_option_section',
			                'settings' => 'goldly_cart_icon',
				        )
			    )); 
			//display mobile cart option
			    $wp_customize->add_setting( 'goldly_mobile_cart_icon', array(		                
			                'default'   => true,
							'priority'  => 10,
							'capability' => 'edit_theme_options',
							'sanitize_callback' => 'goldly_sanitize_checkbox',
			    ));
			    $wp_customize->add_control(  new WP_Customize_Control(
				    	$wp_customize,'goldly_mobile_cart_icon', 
				    	array(
			                'label' => 'Display Mobile header Cart Icon',
			                'type'  => 'checkbox', // this indicates the type of control
			                'section' => 'header_option_section',
			                'settings' => 'goldly_mobile_cart_icon',
				        )
			    )); 
			//call menu button display in header option
		        $wp_customize->add_setting( 'goldly_search_icon', array(		                
			                'default'   => true,
							'priority'  => 10,
							'capability' => 'edit_theme_options',
							'sanitize_callback' => 'goldly_sanitize_checkbox',
			    ));
			    $wp_customize->add_control(  new WP_Customize_Control(
				    	$wp_customize,'goldly_search_icon', 
				    	array(
			                'label' => 'Display header Search Icon',
			                'type'  => 'checkbox', // this indicates the type of control
			                'section' => 'header_option_section',
			                'settings' => 'goldly_search_icon',
				        )
			    )); 
			//call menu button display mobile in header option
		        $wp_customize->add_setting( 'goldly_mobile_search_icon', array(		                
			                'default'   => true,
							'priority'  => 10,
							'capability' => 'edit_theme_options',
							'sanitize_callback' => 'goldly_sanitize_checkbox',
			    ));
			    $wp_customize->add_control(  new WP_Customize_Control(
				    	$wp_customize,'goldly_mobile_search_icon', 
				    	array(
			                'label' => 'Display Mobile header Search Icon',
			                'type'  => 'checkbox', // this indicates the type of control
			                'section' => 'header_option_section',
			                'settings' => 'goldly_mobile_search_icon',
				        )
			    )); 
		//Header width
			$wp_customize->add_section( 'header_width_section' , array(
				'title'             => 'Header Width',
				'panel'             => 'goldly_header_panel',
			) );
			//Container Option in Header width layout
		        $wp_customize->add_setting('goldly_header_width_layout', array(
			        'default'        => 'content_width',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_header_width_layout',
			    	array(
				        'settings' => 'goldly_header_width_layout',
				        'label'   => 'Header Width Layouts',
				        'section' => 'header_width_section',
				        'type'    => 'select',
				        'choices' => array(
				        			'full_width' => 'Full Width',
				        			'content_width' => 'Content Width',
				        ),
			        )
			    ));
			//Container Option in Header container width
		        $wp_customize->add_setting('goldly_header_container_width', array(
			        'default'        => '1100',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_header_container_width',
			    	array(
				        'settings' => 'goldly_header_container_width',
				        'description'  => 'in px',
				        'label'   => 'Header Content Width',
				        'section' => 'header_width_section',
				        'type'    => 'text',
				        'active_callback'  => 'goldly_header_content_width_callback',
			        )
			    ));

    //Global create in add 
		$wp_customize->add_panel( 'goldly_global_panel', array(
			'title'     => __('Global', 'goldly'),
			'priority'  => 3,
		) );
		// Create global Fonts & Typography option
			$wp_customize->add_section( 'global_body_section' , array(
				'title'  => 'Body Fonts & Typography',
				'panel'  => 'goldly_global_panel',
			) );			
			//global option in body font family add select dropdown
				global $goldly_fonttotal;
		        $wp_customize->add_setting('goldly_body_fontfamily', array(
			        'default'        => 5,
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'goldly_sanitize_select',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_body_fontfamily',
			    	array(
				        'settings' => 'goldly_body_fontfamily',
				        'label'   => 'Body Font Family',
				        'section' => 'global_body_section',
				        'type'    => 'select',
				        'choices' => $goldly_fonttotal,
				    )
				));
			//global otion in body font size 
				$wp_customize->add_setting('goldly_body_font_size', array(
			        'default'        => 15,
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_body_font_size',
			    	array(
				        'settings' => 'goldly_body_font_size',
				        'label'   => 'Body Font Size',
				        'section' => 'global_body_section',
				        'type'  => "number",
				        'description' => 'in px',
		            	'input_attrs' => array(
									    'min' => 1,
									    'max' => 50,
									),
			        )
			    )); 
			//global option in body font weight
			    $wp_customize->add_setting('goldly_body_font_weight', array(
			        'default'        => 400,
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'goldly_sanitize_select',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_body_font_weight',
			    	array(
				        'settings' => 'goldly_body_font_weight',
				        'label'   => 'Body Font Weight',
				        'section' => 'global_body_section',
				        'type'  => "select",
				        'choices' => $font_weight,
			        )
			    ));
			//global option in body text transform
			    $wp_customize->add_setting('goldly_body_text_transform', array(
			        'default'        => 'inherit',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'goldly_sanitize_select',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_body_text_transform',
			    	array(
				        'settings' => 'goldly_body_text_transform',
				        'label'   => 'Body Text Transform',
				        'section' => 'global_body_section',
				        'type'  => "select",
				        'choices' =>  $text_transform,
			        )
			    ));

				//mobile in font size
				    $wp_customize->add_setting( 'goldly_mobile_font_size', 
				        array(
				            'default'    => '14', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_text_field',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Control( 
				        $wp_customize, 'goldly_mobile_font_size', 
				        array(
				            'label'      => __( 'Mobile Font Size', 'goldly' ), 
				            'type'       => "number",
				            'priority'    => 10,
				            'settings'   => 'goldly_mobile_font_size', 
				            'section'    => 'global_body_section',
				            'description' => 'in px',
				            'input_attrs' => array(
											    'min' => 1,
											    'max' => 100,
											),
				        ) 
			        ) );

		// Create global Heading Fonts & Typography option
			$wp_customize->add_section( 'global_heading_section' , array(
				'title'             => 'Heading Fonts & Typography',
				'panel'             => 'goldly_global_panel',
			) );
			//global option in body font family add select dropdown
				global $goldly_fonttotal;
		        $wp_customize->add_setting('goldly_Heading_fontfamily', array(
			        'default'        => 5,
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'goldly_sanitize_select',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_Heading_fontfamily',
			    	array(
				        'settings' => 'goldly_Heading_fontfamily',
				        'label'   => 'Heading Font Family',
				        'section' => 'global_heading_section',
				        'type'    => 'select',
				        'choices' => $goldly_fonttotal,
			        )
			    )); 

			//heading1 Title
			    $wp_customize->add_setting('Heading1_section', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
			    	$wp_customize,'Heading1_section',
			    	array(
				        'settings' => 'Heading1_section',
				        'label'   => 'Heading 1 (H1)',
				        'section' => 'global_heading_section',
				        'type'     => 'ast-description',
			        )
			    ));

				//global option in heading1 font family
					global $goldly_fonttotal;
			        $wp_customize->add_setting('goldly_Heading1_fontfamily', array(
				        'default'        => 5,
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'goldly_sanitize_select',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_Heading1_fontfamily',
				    	array(
					        'settings' => 'goldly_Heading1_fontfamily',
					        'label'   => 'Font Family',
					        'section' => 'global_heading_section',
					        'type'    => 'select',
					        'choices' => $goldly_fonttotal,
				        )
				    ));
				//global heading1 font size
				    $wp_customize->add_setting( 'goldly_heading1_font_size', 
				        array(
				            'default'    => '35', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_text_field',
				        ) 
				    ); 

			        $wp_customize->add_control( new WP_Customize_Control( 
				        $wp_customize, 
				        'goldly_heading1_font_size', 
				        array(
				            'label'      => __( 'Font Size', 'goldly' ), 
				            'type'       => "number",
				            'priority'    => 10,
				            'settings'   => 'goldly_heading1_font_size', 
				            'section'    => 'global_heading_section',
				            'description' => 'in px',
				            'input_attrs' => array(
											    'min' => 1,
											    'max' => 100,
											),
				        ) 
			        ) );
			    //global in heading1 font weight
				    $wp_customize->add_setting('goldly_heading1_font_weight', array(
				        'default'        => 'bold',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'goldly_sanitize_select',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_heading1_font_weight',
				    	array(
					        'settings' => 'goldly_heading1_font_weight',
					        'label'   => 'Font Weight',
					        'section' => 'global_heading_section',
					        'type'  => 'select',
					        'choices' => $font_weight,
				        )
				    ));
				//global in heading1 text transform
				    $wp_customize->add_setting('goldly_heading1_text_transform', array(
				        'default'        => 'inherit',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'goldly_sanitize_select',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_heading1_text_transform',
				    	array(
					        'settings' => 'goldly_heading1_text_transform',
					        'label'   => 'Text Transform',
					        'section' => 'global_heading_section',
					        'type'  => 'select',
					        'choices' =>  $text_transform,
				        )
				    ));
				//mobile in heading1 font size
				    $wp_customize->add_setting( 'goldly_mobile_heading1_font_size', 
				        array(
				            'default'    => '20', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_text_field',
				        ) 
				    ); 

			        $wp_customize->add_control( new WP_Customize_Control( 
				        $wp_customize, 'goldly_mobile_heading1_font_size', 
				        array(
				            'label'      => __( 'Mobile Font Size', 'goldly' ), 
				            'type'       => "number",
				            'priority'    => 10,
				            'settings'   => 'goldly_mobile_heading1_font_size', 
				            'section'    => 'global_heading_section',
				            'description' => 'in px',
				            'input_attrs' => array(
											    'min' => 1,
											    'max' => 100,
											),
				        ) 
			        ) );

		    //heading2 Title
			    $wp_customize->add_setting('Heading2_section', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'goldly_sanitize_select',
			    ));
			    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
			    	$wp_customize,'Heading2_section',
			    	array(
				        'settings' => 'Heading2_section',
				        'label'   => 'Heading 2 (H2)',
				        'section' => 'global_heading_section',
			        )
			    ));
				//global option in heading2 font family
					global $goldly_fonttotal;
			        $wp_customize->add_setting('goldly_Heading2_fontfamily', array(
				        'default'        => 5,
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'goldly_sanitize_select',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_Heading2_fontfamily',
				    	array(
					        'settings' => 'goldly_Heading2_fontfamily',
					        'label'   => 'Font Family',
					        'section' => 'global_heading_section',
					        'type'    => 'select',
					        'choices' => $goldly_fonttotal,
				        )
				    )); 
				//global heading2 font size
				    $wp_customize->add_setting( 'goldly_heading2_font_size', 
				        array(
				            'default'    => '28', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_text_field',
				        ) 
				    ); 

			        $wp_customize->add_control( new WP_Customize_Control( 
				        $wp_customize, 'goldly_heading2_font_size', 
				        array(
				            'label'      => __( 'Font Size', 'goldly' ), 
				            'type'       => "number",
				            'priority'    => 10,
				            'settings'   => 'goldly_heading2_font_size', 
				            'section'    => 'global_heading_section',
				            'description' => 'in px',
				            'input_attrs' => array(
											    'min' => 1,
											    'max' => 100,
											),
				        ) 
			        ) );
			    //global in heading2 font weight
				    $wp_customize->add_setting('goldly_heading2_font_weight', array(
				        'default'        => 'bold',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'goldly_sanitize_select',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_heading2_font_weight',
				    	array(
					        'settings' => 'goldly_heading2_font_weight',
					        'label'   => 'Font Weight',
					        'section' => 'global_heading_section',
					        'type'  => 'select',
					        'choices' => $font_weight,
				        )
				    ));
				//global in heading2 text transform
				    $wp_customize->add_setting('goldly_heading2_text_transform', array(
				        'default'        => 'inherit',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'goldly_sanitize_select',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_heading2_text_transform',
				    	array(
					        'settings' => 'goldly_heading2_text_transform',
					        'label'   => 'Text Transform',
					        'section' => 'global_heading_section',
					        'type'  => 'select',
					        'choices' =>  $text_transform,
				        )
				    ));
				//mobile in heading2 font size
				    $wp_customize->add_setting( 'goldly_mobile_heading2_font_size', 
				        array(
				            'default'    => '18', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_text_field',
				        ) 
				    ); 

			        $wp_customize->add_control( new WP_Customize_Control( 
				        $wp_customize, 'goldly_mobile_heading2_font_size', 
				        array(
				            'label'      => __( 'Mobile Font Size', 'goldly' ), 
				            'type'       => "number",
				            'priority'    => 10,
				            'settings'   => 'goldly_mobile_heading2_font_size', 
				            'section'    => 'global_heading_section',
				            'description' => 'in px',
				            'input_attrs' => array(
											    'min' => 1,
											    'max' => 100,
											),
				        ) 
			        ) );

		    //heading3 Title
			    $wp_customize->add_setting('Heading3_section', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
			    	$wp_customize,'Heading3_section',
			    	array(
				        'settings' => 'Heading3_section',
				        'label'   => 'Heading 3 (H3)',
				        'section' => 'global_heading_section',
			        )
			    ));
				//global option in heading3 font family
					global $goldly_fonttotal;
			        $wp_customize->add_setting('goldly_Heading3_fontfamily', array(
				        'default'        => 5,
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'goldly_sanitize_select',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_Heading3_fontfamily',
				    	array(
					        'settings' => 'goldly_Heading3_fontfamily',
					        'label'   => 'Font Family',
					        'section' => 'global_heading_section',
					        'type'    => 'select',
					        'choices' => $goldly_fonttotal,
				        )
				    ));
			    //global heading3 font size
				    $wp_customize->add_setting( 'goldly_heading3_font_size', 
				        array(
				            'default'    => '25', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_text_field',
				        ) 
				    ); 

			        $wp_customize->add_control( new WP_Customize_Control( 
				        $wp_customize, 'goldly_heading3_font_size', 
				        array(
				            'label'      => __( 'Font Size', 'goldly' ), 
				            'type'       => "number",
				            'priority'    => 10,
				            'settings'   => 'goldly_heading3_font_size', 
				            'section'    => 'global_heading_section',
				            'description' => 'in px',
				            'input_attrs' => array(
											    'min' => 1,
											    'max' => 100,
											),
				        ) 
			        ) );
			    //global in heading3 font weight
				    $wp_customize->add_setting('goldly_heading3_font_weight', array(
				        'default'        => '400',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'goldly_sanitize_select',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_heading3_font_weight',
				    	array(
					        'settings' => 'goldly_heading3_font_weight',
					        'label'   => 'Font Weight',
					        'section' => 'global_heading_section',
					        'type'  => 'select',
					        'choices' => $font_weight,
				        )
				    ));
				//global in heading2 text transform
				    $wp_customize->add_setting('goldly_heading3_text_transform', array(
				        'default'        => 'inherit',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'goldly_sanitize_select',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_heading3_text_transform',
				    	array(
					        'settings' => 'goldly_heading3_text_transform',
					        'label'   => 'Text Transform',
					        'section' => 'global_heading_section',
					        'type'  => 'select',
					        'choices' =>  $text_transform,
				        )
				    ));
				//mobile in heading2 font size
				    $wp_customize->add_setting( 'goldly_mobile_heading3_font_size', 
				        array(
				            'default'    => '14', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_text_field',
				        ) 
				    ); 

			        $wp_customize->add_control( new WP_Customize_Control( 
				        $wp_customize, 'goldly_mobile_heading3_font_size', 
				        array(
				            'label'      => __( 'Mobile Font Size', 'goldly' ), 
				            'type'       => "number",
				            'priority'    => 10,
				            'settings'   => 'goldly_mobile_heading3_font_size', 
				            'section'    => 'global_heading_section',
				            'description' => 'in px',
				            'input_attrs' => array(
											    'min' => 1,
											    'max' => 100,
											),
				        ) 
			        ) );

		// Create Container Option
			$wp_customize->add_section( 'global_container_option' , array(
				'title'  => 'Container',
				'panel'  => 'goldly_global_panel',
			) );
			//Container Option in Backgound Color
				$wp_customize->add_setting( 'goldly_container_bg_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize, 'goldly_container_bg_color', 
			        array(
			            'label'      => __( 'Container Background Color', 'goldly' ), 
			            'settings'   => 'goldly_container_bg_color', 
			            'priority'   => 10, 
			            'section'    => 'global_container_option',
			        ) 
		        ) );	
			//Container Option in container width
		        $wp_customize->add_setting('goldly_container_width', array(
			        'default'        => '1100',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_container_width',
			    	array(
				        'settings' => 'goldly_container_width',
				        'label'   => 'Container Width',
				        'section' => 'global_container_option',
				        'type'    => 'text',
			        )
			    ));
			//Container Option in page layout
		        $wp_customize->add_setting('goldly_container_page_layout', array(
			        'default'        => 'content_boxed',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_container_page_layout',
			    	array(
				        'settings' => 'goldly_container_page_layout',
				        'label'   => 'Page Layouts',
				        'section' => 'global_container_option',
				        'type'    => 'select',
				        'choices' => array(
				        			'full_layout' => 'Full Width / Contained',
				        			'boxed_layout' => 'Boxed Layout',
				        			'content_boxed' => 'Content Boxed',
				        ),
			        )
			    ));
			//Content Boxed background color
		        $wp_customize->add_setting( 'goldly_boxed_layout_bg_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize, 'goldly_boxed_layout_bg_color', 
			        array(
			            'label'      => __( 'Boxed Layout Background Color', 'goldly' ), 
			            'settings'   => 'goldly_boxed_layout_bg_color', 
			            'priority'   => 10, 
			            'section'    => 'global_container_option',
			            'active_callback'  => 'goldly_boxed_layout_callback',
		   							[
										[
											'setting'  => 'goldly_container_page_layout',
											'operator' => '===',
											'value'    => 'boxed_layout',
										],
									],
			        ) 
		        ) );
			//Container Option in blog layout
		        $wp_customize->add_setting('goldly_container_blog_layout', array(
			        'default'        => 'grid_view',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_container_blog_layout',
			    	array(
				        'settings' => 'goldly_container_blog_layout',
				        'label'   => 'Blogs Layouts',
				        'section' => 'global_container_option',
				        'type'    => 'select',
				        'choices' => array(
				        			'list_view' => 'List View',
				        			'list_view1' => 'List View1',
				        			'grid_view' => 'Grid View',
				        ),
			        )
			    ));		    
			//Content Boxed Title
			    $wp_customize->add_setting('content_boxed_section', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
			    	$wp_customize,'content_boxed_section',
			    	array(
				        'settings' => 'content_boxed_section',
				        'label'   => 'Content Box Layout',
				        'section' => 'global_container_option',
				        'type'     => 'ast-description',
				        'active_callback'  => 'goldly_content_boxed_callback',
			   							[
											[
												'setting'  => 'goldly_container_page_layout',
												'operator' => '===',
												'value'    => 'content_boxed',
											],
										],
			        )
			    ));
			    //Content Boxed background color
			        $wp_customize->add_setting( 'goldly_content_boxed_bg_color', 
				        array(
				            'default'    => '#eeeeee', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability'     => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize, 'goldly_content_boxed_bg_color', 
				        array(
				            'label'      => __( 'Content Boxed Background Color', 'goldly' ), 
				            'settings'   => 'goldly_content_boxed_bg_color', 
				            'priority'   => 10, 
				            'section'    => 'global_container_option',
				            'active_callback'  => 'goldly_content_boxed_callback',
			   							[
											[
												'setting'  => 'goldly_container_page_layout',
												'operator' => '===',
												'value'    => 'content_boxed',
											],
										],
				        ) 
			        ) );
			
			//Grid View Title
			    $wp_customize->add_setting('grid_view_section', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
			    	$wp_customize,'grid_view_section',
			    	array(
				        'settings' => 'grid_view_section',
				        'label'   => 'Grid View',
				        'section' => 'global_container_option',
				        'type'     => 'ast-description',
				        'active_callback'  => 'goldly_grid_view_callback',
			   							[
											[
												'setting'  => 'goldly_container_blog_layout',
												'operator' => '===',
												'value'    => 'grid_view',
											],
										],
			        )
			    ));
				//Container Option in grid view columns
			        $wp_customize->add_setting('goldly_container_grid_view_col', array(
				        'default'        => '3',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_container_grid_view_col',
				    	array(
					        'settings' => 'goldly_container_grid_view_col',
					        'label'   => 'Columns',
					        'section' => 'global_container_option',
					        'type'    => 'select',
					        'choices' => array(
					        			'1' => '1',
					        			'2' => '2',
					        			'3' => '3',
					        ),
					        'active_callback'  => 'goldly_grid_view_callback',
			   							[
											[
												'setting'  => 'goldly_container_blog_layout',
												'operator' => '===',
												'value'    => 'grid_view',
											],
										],
				        )
				    ));
				//Container Option in grid view columns gap
			        $wp_customize->add_setting('goldly_container_grid_view_col_gap', array(
				        'default'        => '20',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_container_grid_view_col_gap',
				    	array(
					        'settings' => 'goldly_container_grid_view_col_gap',
					        'label'   => 'Columns Gap',
					        'section' => 'global_container_option',
					        'type'    => 'number',
					        'description' => 'in px',
					        'active_callback'  => 'goldly_grid_view_callback',
			   							[
											[
												'setting'  => 'goldly_container_blog_layout',
												'operator' => '===',
												'value'    => 'grid_view',
											],
										],
				        )
				    ));
			//Display meta and entry-content title
				$wp_customize->add_setting('display_meta_content_section', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
			    	$wp_customize,'display_meta_content_section',
			    	array(
				        'settings' => 'display_meta_content_section',
				        'label'   => 'Display Container',
				        'section' => 'global_container_option',
			        )
			    )); 
			//display containe
		        $wp_customize->add_setting( 'goldly_container_containe', array(		                
					'default'   => true,
					'priority'  => 10,
					'sanitize_callback' => 'goldly_sanitize_checkbox',
				));							    
				$wp_customize->add_control(  new WP_Customize_Control(
					$wp_customize,'goldly_container_containe', 
					array(
						'label' => 'Display Containe',
						'type'  => 'checkbox', // this indicates the type of control
						'section' => 'global_container_option',
						'settings' => 'goldly_container_containe',
						)
				));
			//display container description
		        $wp_customize->add_setting( 'goldly_container_description', array(		                
					'default'   => false,
					'priority'  => 10,
					'sanitize_callback' => 'goldly_sanitize_checkbox',
				));							    
				$wp_customize->add_control(  new WP_Customize_Control(
					$wp_customize,'goldly_container_description', 
					array(
						'label' => 'Display Container Description',
						'type'  => 'checkbox', // this indicates the type of control
						'section' => 'global_container_option',
						'settings' => 'goldly_container_description',
						)
				));
			//display container Date
		        $wp_customize->add_setting( 'goldly_container_date', array(		                
					'default'   => true,
					'priority'  => 10,
					'sanitize_callback' => 'goldly_sanitize_checkbox',
				));							    
				$wp_customize->add_control(  new WP_Customize_Control(
					$wp_customize,'goldly_container_date', 
					array(
						'label' => 'Display Container Date',
						'type'  => 'checkbox', // this indicates the type of control
						'section' => 'global_container_option',
						'settings' => 'goldly_container_date',
						)
				));
			//display container Authore
		        $wp_customize->add_setting( 'goldly_container_authore', array(		                
					'default'   => false,
					'priority'  => 10,
					'sanitize_callback' => 'goldly_sanitize_checkbox',
				));							    
				$wp_customize->add_control(  new WP_Customize_Control(
					$wp_customize,'goldly_container_authore', 
					array(
						'label' => 'Display Container Authore',
						'type'  => 'checkbox', // this indicates the type of control
						'section' => 'global_container_option',
						'settings' => 'goldly_container_authore',
						)
				));
			//display container Category
		        $wp_customize->add_setting( 'goldly_container_category', array(		                
					'default'   => true,
					'priority'  => 10,
					'sanitize_callback' => 'goldly_sanitize_checkbox',
				));							    
				$wp_customize->add_control(  new WP_Customize_Control(
					$wp_customize,'goldly_container_category', 
					array(
						'label' => 'Display Container Category',
						'type'  => 'checkbox', // this indicates the type of control
						'section' => 'global_container_option',
						'settings' => 'goldly_container_category',
						)
				));
			//display container comments
		        $wp_customize->add_setting( 'goldly_container_comments', array(		                
					'default'   => false,
					'priority'  => 10,
					'sanitize_callback' => 'goldly_sanitize_checkbox',
				));							    
				$wp_customize->add_control(  new WP_Customize_Control(
					$wp_customize,'goldly_container_comments', 
					array(
						'label' => 'Display Container Comments',
						'type'  => 'checkbox', // this indicates the type of control
						'section' => 'global_container_option',
						'settings' => 'goldly_container_comments',
						)
				));	

		// Create Button color and Backgound color
			$wp_customize->add_section( 'global_button_option' , array(
				'title'  => 'Buttons',
				'panel'  => 'goldly_global_panel',
			) );
			//Button background color
		        $wp_customize->add_setting( 'goldly_button_bg_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize, 'goldly_button_bg_color', 
			        array(
			            'label'      => __( 'Button Background Color', 'goldly' ), 
			            'settings'   => 'goldly_button_bg_color', 
			            'priority'   => 10, 
			            'section'    => 'global_button_option',
			        ) 
		        ) );
		    //global option in Button Background Hover color
				$wp_customize->add_setting( 'goldly_button_bg_hover_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize, 'goldly_button_bg_hover_color', 
			        array(
			            'label'      => __( 'Background Hover Color', 'goldly' ), 
			            'settings'   => 'goldly_button_bg_hover_color', 
			            'section'    => 'global_button_option',
			        ) 
		        ) );
		    //global option in Button Text color
				$wp_customize->add_setting( 'goldly_button_text_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize, 'goldly_button_text_color', 
			        array(
			            'label'      => __( 'Button Text Color', 'goldly' ), 
			            'settings'   => 'goldly_button_text_color', 
			            'section'    => 'global_button_option',
			        ) 
		        ) ); 
		    //global option in Button Text hover color
				$wp_customize->add_setting( 'goldly_button_texthover_color', 
			        array(
			            'default'    => '#214462', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize, 'goldly_button_texthover_color', 
			        array(
			            'label'      => __( 'Button Text Hover Color', 'goldly' ), 
			            'settings'   => 'goldly_button_texthover_color', 
			            'section'    => 'global_button_option',
			        ) 
		        ) ); 
		    //global option in Button Border color
				$wp_customize->add_setting( 'goldly_button_border_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize, 'goldly_button_border_color', 
			        array(
			            'label'      => __( 'Border Color', 'goldly' ), 
			            'settings'   => 'goldly_button_border_color', 
			            'section'    => 'global_button_option',
			        ) 
		        ) );
		    //global option in button border width
		        $wp_customize->add_setting( 'goldly_borderwidth', 
			        array(
			            'default'    => '2', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_text_field',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Control( 
			        $wp_customize, 'goldly_borderwidth', 
			        array(
			            'label'      => __( 'Border Width', 'goldly' ), 
			            'type'  => "number",
			            'settings'   => 'goldly_borderwidth', 
			            'section'    => 'global_button_option',
			            'description' => 'in px',
			        ) 
		        ) ); 
		    //global option in button border radius
		        $wp_customize->add_setting( 'goldly_button_border_radius', 
			        array(
			            'default'    => '3', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_text_field',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Control( 
			        $wp_customize, 'goldly_button_border_radius', 
			        array(
			            'label'      => __( 'Border Radius', 'goldly' ), 
			            'type'  	 => "number",
			            'settings'   => 'goldly_button_border_radius', 
			            'section'    => 'global_button_option',
			            'description'=> 'in px',
			        ) 
		        ) );
		    //global option in button padding
		        $wp_customize->add_setting( 'goldly_button_padding', 
			        array(
			            'default'    => '8px 15px', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_text_field',
			        ) 
			    ); 

		        $wp_customize->add_control( new WP_Customize_Control( 
			        $wp_customize, 'goldly_button_padding', 
			        array(
			            'label'      => __( 'Button Padding', 'goldly' ), 
			            'type'  	 => "text",
			            'settings'   => 'goldly_button_padding', 
			            'section'    => 'global_button_option',
			            'description'=> '15px 25px',
			        ) 
		        ) );  

		// Create Excerpt Options
			$wp_customize->add_section( 'global_excerpt_option' , array(
				'title'  => 'Excerpt Options',
				'panel'  => 'goldly_global_panel',
			) );
		    //global Option in readmore button
		        $wp_customize->add_setting( 'goldly_container_read_more_btn', array(		                
					'default'   => true,
					'priority'  => 10,
					'sanitize_callback' => 'goldly_sanitize_checkbox',
				));							    
				$wp_customize->add_control(  new WP_Customize_Control(
					$wp_customize,'goldly_container_read_more_btn', 
					array(
						'label' => 'Display Read More Button',
						'type'  => 'checkbox', // this indicates the type of control
						'section' => 'global_excerpt_option',
						'settings' => 'goldly_container_read_more_btn',
						)
				));
			//global option in read more text
		        $wp_customize->add_setting( 'goldly_read_more_btn', 
			        array(
			            'default'    => 'Continue reading', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_text_field',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Control( 
			        $wp_customize, 'goldly_read_more_btn', 
			        array(
			            'label'      => __( 'Read More Text', 'goldly' ), 
			            'type' 		 => 'text',
			            'settings'   => 'goldly_read_more_btn', 
			            'section'    => 'global_excerpt_option',
			        ) 
		        ) ); 

        //Create a scroll button
			$wp_customize->add_section( 'scroll_button_section' , array(
				'title'             => 'Scroll Button',
				'panel'             => 'goldly_global_panel',
			) ); 
			//Scroll Button display
				$wp_customize->add_setting( 'display_scroll_button', array(		                
					'default'   => true,
					'priority'  => 10,
					'sanitize_callback' => 'goldly_sanitize_checkbox',
				));							    
				$wp_customize->add_control(  new WP_Customize_Control(
					$wp_customize,'display_scroll_button', 
					array(
						'label' => 'Display Scroll Button',
						'type'  => 'checkbox', // this indicates the type of control
						'section' => 'scroll_button_section',
						'settings' => 'display_scroll_button',
						)
				));
			//Scroll Button in add Background color
			    $wp_customize->add_setting( 'goldly_scroll_button_bg_color', 
			        array(
			            'default'    => '#02cfaa', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_scroll_button_bg_color', 
			        array(
			            'label'      => __( 'Background Color', 'goldly' ), 
			            'settings'   => 'goldly_scroll_button_bg_color', 
			            'priority'   => 10,
			            'section'    => 'scroll_button_section',
			            'active_callback' => 'goldly_scroll_callback',
			        ) 
		        ) );  
		    //Scroll Button in add color
			    $wp_customize->add_setting( 'goldly_scroll_button_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_scroll_button_color', 
			        array(
			            'label'      => __( 'Scroll Icon Color', 'goldly' ), 
			            'settings'   => 'goldly_scroll_button_color', 
			            'priority'   => 10,
			            'section'    => 'scroll_button_section',
			            'active_callback' => 'goldly_scroll_callback',
			        ) 
		        ) );               

	//Sidebar create in globly
		$wp_customize->add_panel( 'goldly_sidebar_panel', array(
			'title'     => __('Sidebar', 'goldly'),
			'priority'  => 4,
		) ); 
		$post_types = get_post_types(array('public' => true), 'names', 'and');
		foreach ($post_types  as $post_type) {
				$wp_customize->add_section( 'sidebar_section_' .$post_type, array(
					'title'             => $post_type .' Sidebar',
					'panel'             => 'goldly_sidebar_panel',
				) );
				//sidebar in add layout select dropdown
			        $wp_customize->add_setting('goldly_post_sidebar_select_'.$post_type , array(
						'default'   => 'right_sidebar',
				        'type'       => 'theme_mod',
				        'capability'     => 'edit_theme_options',
				        'transport'   => 'refresh',
				        'sanitize_callback' => 'goldly_sanitize_select',		  
				    ));
				    $layout_label= $post_type . ' Layout:';
				    $wp_customize->add_control( new Goldly_Custom_Radio_Image_Control(
				    	$wp_customize,'goldly_post_sidebar_select_'.$post_type,
				    	array(
					        'settings' => 'goldly_post_sidebar_select_'.$post_type,
					        'label'   => $layout_label,
					        'section' => 'sidebar_section_'.$post_type,
					        'type'    => 'select',
					        'choices' => goldly_site_layout(),
				        )
				    ));

			    //sidebar in width text filed
					$wp_customize->add_setting( 'goldly_post_sidebar_width_' . $post_type, 
				        array(
				            'default'    => '30', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'capability'     => 'edit_theme_options',
				            'transport'   => 'refresh',
				            'sanitize_callback' => 'sanitize_text_field',
				        ) 
				    );
			        $wp_customize->add_control( new WP_Customize_Control( 
				        $wp_customize, 
				        'goldly_post_sidebar_width_' . $post_type, 
				        array(
				            'label'      =>$post_type . ' Sidebar Width:', 
				            'type'  => "number",
				            'settings'   => 'goldly_post_sidebar_width_' . $post_type, 
				            'section'    => 'sidebar_section_'.$post_type,
				            'description' => 'in %',
				        ) 
			        ) );
		}  
			$wp_customize->add_section( 'goldly_sidebar_design', array(
				'title'             => 'Design',
				'panel'             => 'goldly_sidebar_panel',
			) );
			    //sidebar heading background color
			        $wp_customize->add_setting( 'goldly_sidebar_heading_bg_color', 
				        array(
				            'default'    => '#273641', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'goldly_sidebar_heading_bg_color', 
				        array(
				            'label'      => __( 'Heading Background Color', 'goldly' ), 
				            'settings'   => 'goldly_sidebar_heading_bg_color', 
				            'priority'   => 10,
				            'section'    => 'goldly_sidebar_design',
				        ) 
			        ) ); 

			    //sidebar heading color
			        $wp_customize->add_setting( 'goldly_sidebar_heading_text_color', 
				        array(
				            'default'    => '#ffffff', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'goldly_sidebar_heading_text_color', 
				        array(
				            'label'      => __( 'Heading Text Color', 'goldly' ), 
				            'settings'   => 'goldly_sidebar_heading_text_color', 
				            'priority'   => 10,
				            'section'    => 'goldly_sidebar_design',
				        ) 
			        ) ); 		    

	//Theme Option in globly
		$wp_customize->add_panel( 'goldly_theme_section', array(
			'title'     => __('Theme Option', 'goldly'),
			'priority'  => 5,
		) );
		
		//Breadcrumb Section			
			$wp_customize->add_section( 'global_breadcrumb_section' , array(
				'title'  => 'Breadcrumb Section',
				'panel'  => 'goldly_theme_section',				

			) );
			//Breadcrumb Section in entire site select 
				$wp_customize->add_setting( 'goldly_display_breadcrumb_section', array(		                
					'default'   => true,
					'priority'  => 10,
					'sanitize_callback' => 'goldly_sanitize_checkbox',
				));							    
				$wp_customize->add_control(  new WP_Customize_Control(
					$wp_customize,'goldly_display_breadcrumb_section', 
					array(
						'label' => 'Display Breadcrumb Section',
						'type'  => 'checkbox',
						'section' => 'global_breadcrumb_section',
						'settings' => 'goldly_display_breadcrumb_section',
						)
				));	
				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial(
						'goldly_display_breadcrumb_section',
						array(
							'selector'        => '.breadcrumb_info',
							'render_callback' => 'goldly_customize_partial_breadcrumb',
						)
					);
				}
			//Breadcrumb Section in Background color
				$wp_customize->add_setting( 'goldly_breadcrumb_bg_color', 
			        array(
			            'default'    => '#c8c9cb', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_breadcrumb_bg_color', 
			        array(
			            'label'      => __( 'Background Color', 'goldly' ), 
			            'settings'   => 'goldly_breadcrumb_bg_color', 
			            'priority'   => 10,
			            'section'    => 'global_breadcrumb_section',
			            'active_callback' => 'goldly_breadcrumb_call_back',
			        ) 
		        ) ); 
		    //Breadcrumb Section in Text color
				$wp_customize->add_setting( 'goldly_breadcrumb_text_color', 
			        array(
			            'default'    => '#333333', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_breadcrumb_text_color', 
			        array(
			            'label'      => __( 'Text Color', 'goldly' ), 
			            'settings'   => 'goldly_breadcrumb_text_color', 
			            'priority'   => 10,
			            'section'    => 'global_breadcrumb_section',
			            'active_callback' => 'goldly_breadcrumb_call_back',
			        ) 
		        ) ); 
		    //Breadcrumb Section in Link color
				$wp_customize->add_setting( 'goldly_breadcrumb_link_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_breadcrumb_link_color', 
			        array(
			            'label'      => __( 'Link Color', 'goldly' ), 
			            'settings'   => 'goldly_breadcrumb_link_color', 
			            'priority'   => 10,
			            'section'    => 'global_breadcrumb_section',
			            'active_callback' => 'goldly_breadcrumb_call_back',
			        ) 
		        ) ); 
		    //Breadcrumb Section background image option
		        $wp_customize->add_setting('goldly_breadcrumb_bg_image', array(
		        	'type'       => 'theme_mod',
			        'transport'     => 'refresh',
			        'height'        => 180,
			        'width'        => 160,
			        'capability' => 'edit_theme_options',
			        'sanitize_callback' => 'esc_url_raw'
			    ));
			    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'goldly_breadcrumb_bg_image', array(
			        'label' => __('Backgroung Image', 'goldly'),
			        'section' => 'global_breadcrumb_section',
			        'settings' => 'goldly_breadcrumb_bg_image',
			        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
			        'active_callback' => 'goldly_breadcrumb_call_back',
			    ))); 
			//Breadcrumb Section in image background position
			    $wp_customize->add_setting('goldly_img_bg_position', array(
			        'default'        => 'center center',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_img_bg_position',
			    	array(
				        'settings' => 'goldly_img_bg_position',
				        'label'   => 'Background Position',
				        'section' => 'global_breadcrumb_section',
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
			        	'active_callback' => 'goldly_breadcrumb_call_back',
			        )
			    )); 
			//Breadcrumb Section in image background attachment
			    $wp_customize->add_setting('goldly_breadcrumb_bg_attachment', array(
			        'default'        => 'scroll',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_breadcrumb_bg_attachment',
			    	array(
				        'settings' => 'goldly_breadcrumb_bg_attachment',
				        'label'   => 'Background Attachment',
				        'section' => 'global_breadcrumb_section',
				        'type'  => 'select',
				        'choices'    => array(
				        	'scroll' => 'Scroll',
				        	'fixed' => 'Fixed',
			        	),
			        	'active_callback' => 'goldly_breadcrumb_call_back',
			        )
			    ));
			//Breadcrumb Section in image background Size
			    $wp_customize->add_setting('goldly_breadcrumb_bg_size', array(
			        'default'        => 'cover',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_breadcrumb_bg_size',
			    	array(
				        'settings' => 'goldly_breadcrumb_bg_size',
				        'label'   => 'Background Size',
				        'section' => 'global_breadcrumb_section',
				        'type'  => 'select',
				        'choices'    => array(
				        	'auto' => 'Auto',
				        	'cover' => 'Cover',
				            'contain' => 'Contain'
			        	),
			        	'active_callback' => 'goldly_breadcrumb_call_back',
			        )
			    ));  		    
		
		//Featured Slider
			$wp_customize->add_section( 'global_featured_slider' , array(
				'title'  => 'Featured Slider',
				'panel'  => 'goldly_theme_section',
			) ); 
			//Featured Slider in tabing
				$wp_customize->add_setting( 'featuredimage_slider_tab', 
			        array(
			            'default'    => 'general', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'goldly_sanitize_select',
			        ) 
			    ); 
		        $wp_customize->add_control( new Goldly_Custom_Radio_Control( 
			        $wp_customize,'featuredimage_slider_tab',array(
			            'settings'   => 'featuredimage_slider_tab', 
			            'priority'   => 10,
			            'section'    => 'global_featured_slider',
			            'type'    => 'select',
			            'choices'    => array(
				        	'general' => 'General',
				        	'design' => 'Design',
			        	),
			        ) 
		        ) );
			//Featured Slider in number of slides
			    $wp_customize->add_setting( 'featuredimage_slider_number', array(
			    	'default'  => 2,
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'goldly_sanitize_number_range',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'featuredimage_slider_number',
			    	array(
						'type' => 'number',
						'settings'   => 'featuredimage_slider_number', 
						'section' => 'global_featured_slider', // // Add a default or your own section
						'label' => 'No of Slides',
						'description' => 'Save and refresh the page if No. of Slides is changed (Max no of slides is 2)',
						'active_callback' => 'goldly_featured_generalcallback',
						'input_attrs' => array(
									    'min' => 1,
									    'max' => 2,
									),					   
					)
				) );

				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial(
						'featuredimage_slider_number',
						array(
							'selector'        => '.featuredimage_slider',
							'render_callback' => 'goldly_customize_partial_featured_slider',
						)
					);
				}
				$slider_number = get_theme_mod( 'featuredimage_slider_number', 2 );
					for ( $i = 1; $i <= $slider_number ; $i++ ) {	
						//Featured slider Heading
							$wp_customize->add_setting('featuredimage_slider'.$i, array(
						        'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
						    ));
						    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
						    	$wp_customize,'featuredimage_slider'.$i,
						    	array(
							        'settings' => 'featuredimage_slider'.$i,
							        'label'   => 'Slider '.$i ,
							        'section' => 'global_featured_slider',
							        'type'     => 'ast-description',
							        'active_callback' => 'goldly_featured_generalcallback',
						        )
						    ));
						//Featured slider title 
							$wp_customize->add_setting( 'featuredimage_slider_title_' . $i , array(
							    'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
							) );
							$wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'featuredimage_slider_title_' . $i,
						    	array(
									'type' => 'text',
									'settings'   => 'featuredimage_slider_title_' . $i, 
									'section' => 'global_featured_slider', // // Add a default or your own section
									'label' => 'Title ' . $i,
									'active_callback' => 'goldly_featured_generalcallback',												   
								)
							) );
						//Featured slider description 
							$wp_customize->add_setting( 'featuredimage_slider_description_' . $i , array(
							    'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_textarea_field',
							) );
							$wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'featuredimage_slider_description_' . $i,
						    	array(
									'type' => 'textarea',
									'settings'   => 'featuredimage_slider_description_' . $i, 
									'section' => 'global_featured_slider', // // Add a default or your own section
									'label' => 'Description ' . $i,  
									'active_callback' => 'goldly_featured_generalcallback',
								)
							) );
						//Featured slider image 
							$wp_customize->add_setting('featured_image_sliders_' . $i, array(
					        	'type'       => 'theme_mod',
						        'transport'     => 'refresh',
						        'height'        => 180,
						        'width'        => 160,
						        'capability' => 'edit_theme_options',
						        'sanitize_callback' => 'esc_url_raw'
						    ));
						    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'featured_image_sliders_' . $i, array(
						        'label' =>  'Image '. $i,
						        'section' => 'global_featured_slider',
						        'settings' => 'featured_image_sliders_' . $i,
						        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
						        'active_callback' => 'goldly_featured_generalcallback',
						    )));
						//Featured slider add button
						    $wp_customize->add_setting( 'featuredimage_slider_button_' . $i , array(
							    'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
							) );
							$wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'featuredimage_slider_button_' . $i,
						    	array(
									'type' => 'text',
									'settings'   => 'featuredimage_slider_button_' . $i, 
									'section' => 'global_featured_slider', // // Add a default or your own section
									'label' => 'Button Text ' . $i,	  
									'active_callback' => 'goldly_featured_generalcallback',
								)
							) );
						//Featured slider add button link
						    $wp_customize->add_setting( 'featuredimage_slider_button_link_' . $i , array(
							    'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
							) );
							$wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'featuredimage_slider_button_link_' . $i,
						    	array(
									'type' => 'text',
									'settings'   => 'featuredimage_slider_button_link_' . $i, 
									'section' => 'global_featured_slider', // // Add a default or your own section
									'label' => 'Button Link ' . $i,	
									'active_callback' => 'goldly_featured_generalcallback',			   
								)
							) );
					}
			//Featured Slider in pro option
				$wp_customize->add_setting('featuredimage_slider_pro', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new Goldly_pro_option_Control(
			    	$wp_customize,'featuredimage_slider_pro',
			    	array(
				        'settings' => 'featuredimage_slider_pro',
				        //'label'   => 'More Options Available in Goldly Pro!',
				        'section' => 'global_featured_slider',
				        'active_callback' => 'goldly_featured_generalcallback',
			        )
			    ));				
			//Featured Slider in add arrow color
			    $wp_customize->add_setting( 'featured_slider_text_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'featured_slider_text_color', 
			        array(
			            'label'      => __( 'Text Color', 'goldly' ), 
			            'settings'   => 'featured_slider_text_color', 
			            'priority'   => 10,
			            'section'    => 'global_featured_slider',
			            'active_callback'  => 'goldly_featured_design_callback',
			        ) 
		        ) );
		   	//Featured Slider arrow in add Text color
			    $wp_customize->add_setting( 'featured_slider_arrow_text_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'featured_slider_arrow_text_color', 
			        array(
			            'label'      => __( 'Arrow Text Color', 'goldly' ), 
			            'settings'   => 'featured_slider_arrow_text_color', 
			            'priority'   => 10,
			            'section'    => 'global_featured_slider',
			            'active_callback'  => 'goldly_featured_design_callback',
			        ) 
		        ) );  	
		    //Featured Slider arrow in add background color
			    $wp_customize->add_setting( 'featured_slider_arrow_bg_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'featured_slider_arrow_bg_color', 
			        array(
			            'label'      => __( 'Arrow Background Color', 'goldly' ), 
			            'settings'   => 'featured_slider_arrow_bg_color', 
			            'priority'   => 10,
			            'section'    => 'global_featured_slider',
			            'active_callback'  => 'goldly_featured_design_callback',
			        ) 
		        ) );
		    //Featured Slider in arrow Text hover color
			    $wp_customize->add_setting( 'featured_slider_arrow_texthover_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'featured_slider_arrow_texthover_color', 
			        array(
			            'label'      => __( 'Arrow Text Hover Color', 'goldly' ), 
			            'settings'   => 'featured_slider_arrow_texthover_color', 
			            'priority'   => 10,
			            'section'    => 'global_featured_slider',
			            'active_callback'  => 'goldly_featured_design_callback',
			        ) 
		        ) );
		    //Featured Slider in add background hover color
			    $wp_customize->add_setting( 'featured_slider_arrow_bghover_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'featured_slider_arrow_bghover_color', 
			        array(
			            'label'      => __( 'Arrow Background Hover Color', 'goldly' ), 
			            'settings'   => 'featured_slider_arrow_bghover_color', 
			            'priority'   => 10,
			            'section'    => 'global_featured_slider',
			            'active_callback'  => 'goldly_featured_design_callback',
			        ) 
		        ) );
		    //Featured Slider in Autoplay True
			    $wp_customize->add_setting('featured_slider_autoplay', array(
			        'default'        => 'true',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'goldly_sanitize_select',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'featured_slider_autoplay',
			    	array(
				        'settings' => 'featured_slider_autoplay',
				        'label'   => 'Autoplay',
				        'section' => 'global_featured_slider',
				        'type'  => 'select',
				        'active_callback'  => 'goldly_featured_design_callback',
				        'choices'    => array(
				        	'true' => 'True',
				        	'false' => 'False',
			        	),
			        )
			    )); 
			//Featured Slider in autoplay speed
			    $wp_customize->add_setting('featured_slider_autoplay_speed', array(
			    	'default'        => '1000',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'featured_slider_autoplay_speed',
			    	array(
				        'settings' => 'featured_slider_autoplay_speed',
				        'label'   => 'AutoplaySpeed',
				        'section' => 'global_featured_slider',
				        'type'  => 'text',
				        'active_callback'  => 'goldly_featured_design_callback',
				        //'active_callback' => 'goldly_featured_slider_callback',
			        )
			    ));  

		//Featured Section
			$wp_customize->add_section( 'global_featured_section' , array(
				'title'  => 'Featured Section',
				'panel'  => 'goldly_theme_section',
			) );
			// Featured Section tabing
				$wp_customize->add_setting( 'featured_section_tab', 
			        array(
			            'default'    => 'general', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'goldly_sanitize_select',
			        ) 
			    ); 
		        $wp_customize->add_control( new Goldly_Custom_Radio_Control( 
			        $wp_customize,'featured_section_tab',array(
			            'settings'   => 'featured_section_tab', 
			            'priority'   => 10,
			            'section'    => 'global_featured_section',
			            'type'    => 'select',
			            'choices'    => array(
				        	'general' => 'General',
				        	'design' => 'Design',
			        	),
			        ) 
		        ) ); 
			//Featured Slider in number of slides
			    $wp_customize->add_setting( 'featured_section_number', array(
			    	'default'  => 3,
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'goldly_sanitize_number_range',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'featured_section_number',
			    	array(
						'type' => 'number',
						'settings'   => 'featured_section_number', 
						'section' => 'global_featured_section', // // Add a default or your own section
						'label' => 'No. of Section',
						'description' => 'Save and refresh the page if No. of Sections is changed (Max no of slides is 3)',
						'input_attrs' => array(
									    'min' => 1,
									    'max' => 3,
									),
						'active_callback' => 'goldly_featured_section_callback',					   
					)
				) );
				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial(
						'featured_section_number',
						array(
							'selector'        => '.featured-section_data',
							'render_callback' => 'goldly_customize_partial_featured_section',
						)
					);
				}
				$about_number = get_theme_mod( 'featured_section_number', 3 );
					for ( $i = 1; $i <= $about_number ; $i++ ) {
						//Featured section Heading
							$wp_customize->add_setting('featured_section'.$i, array(
						        'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
						    ));
						    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
						    	$wp_customize,'featured_section'.$i,
						    	array(
							        'settings' => 'featured_section'.$i,
							        'label'   => 'Featured Section '.$i ,
							        'section' => 'global_featured_section',
							        'type'     => 'ast-description',
							        'active_callback' => 'goldly_featured_section_callback',
						        )
						    ));
						//Featured Section icon
							$wp_customize->add_setting('features_one_icon'. $i,
						        array(
						            'default' => 'fa fa-user',
						            'transport' => 'refresh',
						            'type'       => 'theme_mod',
						            'capability' => 'edit_theme_options',
						            'sanitize_callback' => 'sanitize_text_field',
						        )
						    );
						    $wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'features_one_icon'.$i,
						    	array(
						            'type'        => 'text',
									'settings'    => 'features_one_icon'.$i,
									'label'       => 'Select Features Icon '.$i,
									'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v4.7.0/icons/">Click Here</a> for select icon','goldly'),
									'section'     => 'global_featured_section',
									'active_callback' => 'goldly_featured_section_callback',
						        )
						    ));	
					    //Featured Section Title 
							$wp_customize->add_setting( 'featured_section_title_' . $i , array(
							    'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
							) );
							$wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'featured_section_title_' . $i,
						    	array(
									'type' => 'text',
									'settings'   => 'featured_section_title_' . $i, 
									'section' => 'global_featured_section', // // Add a default or your own section
									'label' => 'Title ' . $i,
									'active_callback' => 'goldly_featured_section_callback',
								)
							) );
						//Featured Section Description 
							$wp_customize->add_setting( 'featured_section_description_' . $i , array(
							    'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
							) );
							$wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'featured_section_description_' . $i,
						    	array(
									'type' => 'text',
									'settings'   => 'featured_section_description_' . $i, 
									'section' => 'global_featured_section', // // Add a default or your own section
									'label' => 'Description ' . $i,
									'active_callback' => 'goldly_featured_section_callback',
								)
							) );
					}
					//Featured Slider in pro option
						$wp_customize->add_setting('featured_section_pro', array(
					        'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
					    ));
					    $wp_customize->add_control( new Goldly_pro_option_Control(
					    	$wp_customize,'featured_section_pro',
					    	array(
						        'settings' => 'featured_section_pro',
						        //'label'   => 'More Options Available in Goldly Pro!',
						        'section' => 'global_featured_section',
						        'active_callback' => 'goldly_featured_section_callback',
					        )
					    ));
					//Featured Section icon size 
						$wp_customize->add_setting( 'featured_section_icon_size', array(
							'default'    => '50',
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'featured_section_icon_size',
					    	array(
								'type' => 'number',
								'settings'   => 'featured_section_icon_size',
								'section' => 'global_featured_section', // // Add a default or your own section
								'label' => 'Icon Size',
								'description' =>'in px',
								'active_callback' => 'goldly_featured_section_design_callback',
							)
						) );
					//Featured Section Background color
					    $wp_customize->add_setting( 'goldly_featured_section_bg_color', 
					        array(
					            'default'    => '#eeeeee', //Default setting/value to save
					            'type'       => 'theme_mod',
					            'transport'   => 'refresh',
					            'capability' => 'edit_theme_options',
					            'sanitize_callback' => 'sanitize_hex_color',
					        ) 
					    ); 
				        $wp_customize->add_control( new WP_Customize_Color_Control( 
					        $wp_customize,'goldly_featured_section_bg_color', 
					        array(
					            'label'      => __( 'Background Color', 'goldly' ), 
					            'settings'   => 'goldly_featured_section_bg_color', 
					            'priority'   => 10,
					            'section'    => 'global_featured_section',
					            'active_callback' => 'goldly_featured_section_design_callback',
					        ) 
				        ) );
				    //Featured Section Text color
					    $wp_customize->add_setting( 'goldly_featured_section_color', 
					        array(
					            'default'    => '#273641', //Default setting/value to save
					            'type'       => 'theme_mod',
					            'transport'   => 'refresh',
					            'capability' => 'edit_theme_options',
					            'sanitize_callback' => 'sanitize_hex_color',
					        ) 
					    ); 
				        $wp_customize->add_control( new WP_Customize_Color_Control( 
					        $wp_customize,'goldly_featured_section_color', 
					        array(
					            'label'      => __( 'Color', 'goldly' ), 
					            'settings'   => 'goldly_featured_section_color', 
					            'priority'   => 10,
					            'section'    => 'global_featured_section',
					            'active_callback' => 'goldly_featured_section_design_callback',
					        ) 
				        ) ); 
				    //Featured Section Background hover color
					    $wp_customize->add_setting( 'goldly_featured_section_bg_hover_color', 
					        array(
					            'default'    => '#273641', //Default setting/value to save
					            'type'       => 'theme_mod',
					            'transport'   => 'refresh',
					            'capability' => 'edit_theme_options',
					            'sanitize_callback' => 'sanitize_hex_color',
					        ) 
					    ); 
				        $wp_customize->add_control( new WP_Customize_Color_Control( 
					        $wp_customize,'goldly_featured_section_bg_hover_color', 
					        array(
					            'label'      => __( 'Background Hover Color', 'goldly' ), 
					            'settings'   => 'goldly_featured_section_bg_hover_color', 
					            'priority'   => 10,
					            'section'    => 'global_featured_section',
					            'active_callback' => 'goldly_featured_section_design_callback',
					        ) 
				        ) ); 
				    //Featured Section Text hover color
					    $wp_customize->add_setting( 'goldly_featured_section_text_hover_color', 
					        array(
					            'default'    => '#ffffff', //Default setting/value to save
					            'type'       => 'theme_mod',
					            'transport'   => 'refresh',
					            'capability' => 'edit_theme_options',
					            'sanitize_callback' => 'sanitize_hex_color',
					        ) 
					    ); 
				        $wp_customize->add_control( new WP_Customize_Color_Control( 
					        $wp_customize,'goldly_featured_section_text_hover_color', 
					        array(
					            'label'      => __( 'Text Hover Color', 'goldly' ), 
					            'settings'   => 'goldly_featured_section_text_hover_color', 
					            'priority'   => 10,
					            'section'    => 'global_featured_section',
					            'active_callback' => 'goldly_featured_section_design_callback',
					        ) 
				        ) ); 
				    //Featured Section margin
				        $wp_customize->add_setting( 'goldly_featured_section_margin', 
					        array(
					            'default'    => '-70px 0px 20px 0px', //Default setting/value to save
					            'type'       => 'theme_mod',
					            'transport'   => 'refresh',
					            'capability' => 'edit_theme_options',
					            'sanitize_callback' => 'sanitize_text_field',
					        ) 
					    ); 
				        $wp_customize->add_control( new WP_Customize_Control( 
					        $wp_customize,'goldly_featured_section_margin', 
					        array(
					            'label'      => __( 'Margin', 'goldly' ), 
					            'description'=> '-70px 0px 20px 0px',
					            'settings'   => 'goldly_featured_section_margin', 
					            'priority'   => 10,
					            'section'    => 'global_featured_section',
					            'active_callback' => 'goldly_featured_section_design_callback',
					        ) 
				        ) ); 

		//About Section
			$wp_customize->add_section( 'global_about_section' , array(
				'title'  => 'About Section',
				'panel'  => 'goldly_theme_section',
			) );
			// about Section tabing
				$wp_customize->add_setting( 'about_section_tab', 
			        array(
			            'default'    => 'general', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'goldly_sanitize_select',
			        ) 
			    ); 
		        $wp_customize->add_control( new Goldly_Custom_Radio_Control( 
			        $wp_customize,'about_section_tab',array(
			            'settings'   => 'about_section_tab', 
			            'priority'   => 10,
			            'section'    => 'global_about_section',
			            'type'    => 'select',
			            'choices'    => array(
				        	'general' => 'General',
				        	'design' => 'Design',
			        	),
			        ) 
		        ) ); 
			//About Section in title
			    $wp_customize->add_setting( 'about_title_section', array(
			    	'default'  => 'About Us',
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'about_title_section',
			    	array(
						'type'     => 'text',
						'settings' => 'about_title_section', 
						'section'  => 'global_about_section', // // Add a default or your own section
						'label'    => 'About Title',
						'active_callback' => 'goldly_about_section_general_callback',
					)
				) );
				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial(
						'about_title_section',
						array(
							'selector'        => '.about_section_info',
							'render_callback' => 'goldly_customize_partial_about',
						)
					);
				}
			//About Section  in Discription
				$wp_customize->add_setting( 'about_section_main_discription', array(
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'about_section_main_discription',
			    	array(
						'type' => 'textarea',
						'settings' => 'about_section_main_discription',
						'section' => 'global_about_section', // // Add a default or your own section
						'label' => 'About Section Discription',
						'active_callback' => 'goldly_about_section_general_callback',
					)
				) );
			//About Section image 
				$wp_customize->add_setting('about_image_sliders', array(
		        	'type'       => 'theme_mod',
			        'transport'     => 'refresh',
			        'height'        => 180,
			        'width'        => 160,
			        'capability' => 'edit_theme_options',
			        'sanitize_callback' => 'esc_url_raw'
			    ));
			    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'about_image_sliders' , array(
			        'label' =>  'Image',
			        'section' => 'global_about_section',
			        'settings' => 'about_image_sliders',
			        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
			        'active_callback' => 'goldly_about_section_general_callback',
			    ))); 
			//About Section in number of section
			    $wp_customize->add_setting( 'about_section_number', array(
			    	'default'  => 4,
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'goldly_sanitize_number_range',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'about_section_number',
			    	array(
						'type' => 'number',
						'settings'   => 'about_section_number', 
						'section' => 'global_about_section', // // Add a default or your own section
						'label' => 'No. of Section',
						'description' => 'Save and refresh the page if No. of Sections is changed (Max no of section is 5)',
						'input_attrs' => array(
									    'min' => 1,
									    'max' => 5,
									),		
						'active_callback' => 'goldly_about_section_general_callback',			   
					)
				) );
				$about_section_number = get_theme_mod( 'about_section_number', 4 );
				for ( $i = 1; $i <= $about_section_number ; $i++ ) {
						//Featured section Heading
							$wp_customize->add_setting('about_section_'.$i, array(
						        'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
						    ));
						    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
						    	$wp_customize,'about_section_'.$i,
						    	array(
							        'settings' => 'about_section_'.$i,
							        'label'   => 'About Section '.$i ,
							        'section' => 'global_about_section',
							        'type'     => 'ast-description',
							        'active_callback' => 'goldly_about_section_general_callback',
						        )
						    ));
						//About Section icon
							$wp_customize->add_setting('about_one_icon'. $i,
						        array(
						            'default' => 'fa fa-user',
						            'transport' => 'refresh',
						            'type'       => 'theme_mod',
						            'capability' => 'edit_theme_options',
						            'sanitize_callback' => 'sanitize_text_field',
						        )
						    );
						    $wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'about_one_icon'.$i,
						    	array(
						            'type'        => 'text',
									'settings'    => 'about_one_icon'.$i,
									'label'       => 'Select Features Icon '.$i,
									'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v4.7.0/icons/">Click Here</a> for select icon','goldly'),
									'section'     => 'global_about_section',
									'active_callback' => 'goldly_about_section_general_callback',
						        )
						    ));	
						//About Section Title
						    $wp_customize->add_setting('about_section_title_'.$i, array(
						        'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
						    ));
						    $wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'about_section_title_'.$i,
						    	array(
							        'settings' => 'about_section_title_'.$i,
							        'label'   => 'Title '.$i ,
							        'section' => 'global_about_section',
							        'type'     => 'text',
							        'active_callback' => 'goldly_about_section_general_callback',
						        )
						    ));
						//About Section Link Title Url
						    $wp_customize->add_setting('about_section_title_url_'.$i, array(
						    	'default'   => '#',
						        'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
						    ));
						    $wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'about_section_title_url_'.$i,
						    	array(
							        'settings' => 'about_section_title_url_'.$i,
							        'label'   => 'Link Title '.$i ,
							        'section' => 'global_about_section',
							        'type'     => 'text',
							        'active_callback' => 'goldly_about_section_general_callback',
						        )
						    ));
						//About Section Description
						    $wp_customize->add_setting('about_section_description_'.$i, array(
						        'type'       => 'theme_mod',
						        'transport'   => 'refresh',
						        'capability'     => 'edit_theme_options',
						        'sanitize_callback' => 'sanitize_text_field',
						    ));
						    $wp_customize->add_control( new WP_Customize_Control(
						    	$wp_customize,'about_section_description_'.$i,
						    	array(
							        'settings' => 'about_section_description_'.$i,
							        'label'   => 'Description '.$i ,
							        'section' => 'global_about_section',
							        'type'     => 'text',
							        'active_callback' => 'goldly_about_section_general_callback',
						        )
						    ));
			    }
			//About section in title Text color
			    $wp_customize->add_setting( 'goldly_about_title_text_color', 
			        array(
			            'default'    => '#333333', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_about_title_text_color', 
			        array(
			            'label'      => __( 'Title Text Color', 'goldly' ), 
			            'settings'   => 'goldly_about_title_text_color', 
			            'priority'   => 10,
			            'section'    => 'global_about_section',
			            'active_callback' => 'goldly_about_section_design_callback',
			        ) 
		        ) ); 
		    //About section in Text color
			    $wp_customize->add_setting( 'goldly_about_Text_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_about_Text_color', 
			        array(
			            'label'      => __( 'Text Color', 'goldly' ), 
			            'settings'   => 'goldly_about_Text_color', 
			            'priority'   => 10,
			            'section'    => 'global_about_section',
			            'active_callback' => 'goldly_about_section_design_callback',
			        ) 
		        ) ); 
		    //About section in Link color
			    $wp_customize->add_setting( 'goldly_about_link_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_about_link_color', 
			        array(
			            'label'      => __( 'Link Color', 'goldly' ), 
			            'settings'   => 'goldly_about_link_color', 
			            'priority'   => 10,
			            'section'    => 'global_about_section',
			            'active_callback' => 'goldly_about_section_design_callback',
			        ) 
		        ) ); 
		    //About section in Link Hover color
			    $wp_customize->add_setting( 'goldly_about_link_hover_color', 
			        array(
			            'default'    => '#000000', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_about_link_hover_color', 
			        array(
			            'label'      => __( 'Link Hover Color', 'goldly' ), 
			            'settings'   => 'goldly_about_link_hover_color', 
			            'priority'   => 10,
			            'section'    => 'global_about_section',
			            'active_callback' => 'goldly_about_section_design_callback',
			        ) 
		        ) ); 
		    //About Section in Background Title
		    	$wp_customize->add_setting('about_background_section', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
			    	$wp_customize,'about_background_section',
			    	array(
				        'settings' => 'about_background_section',
				        'label'   => 'Background Color Or Image',
				        'section' => 'global_about_section',
				        'type'     => 'ast-description',
				        'active_callback' => 'goldly_about_section_design_callback',
			        )
			    ));    
			    //About section in background color
				    $wp_customize->add_setting( 'goldly_about_bg_color', 
				        array(
				            'default'    => '#eeeeee', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'goldly_about_bg_color', 
				        array(
				            'label'      => __( 'Background Color', 'goldly' ), 
				            'settings'   => 'goldly_about_bg_color', 
				            'priority'   => 10,
				            'section'    => 'global_about_section',
				            'active_callback' => 'goldly_about_section_design_callback',
				        ) 
			        ) ); 
			    //About Section in Background Image
			    	$wp_customize->add_setting('about_bg_image', array(
			    		'default'  => '',
			        	'type'       => 'theme_mod',
				        'transport'     => 'refresh',
				        'height'        => 180,
				        'width'        => 160,
				        'capability' => 'edit_theme_options',
				        'sanitize_callback' => 'esc_url_raw'
				    ));
				    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'about_bg_image', array(
				        'label' => __('Backgroung Image', 'goldly'),
				        'section' => 'global_about_section',
				        'settings' => 'about_bg_image',
				        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
				        'active_callback' => 'goldly_about_section_design_callback',
				    )));
				//About Section in Background Position
				    $wp_customize->add_setting('goldly_about_bg_position', array(
				        'default'        => 'center center',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_about_bg_position',
				    	array(
					        'settings' => 'goldly_about_bg_position',
					        'label'   => 'Background Position',
					        'section' => 'global_about_section',
					        'type'  => 'select',
					        'active_callback' => 'goldly_about_section_design_callback',
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
				//About Section in Background Attachment
					$wp_customize->add_setting('goldly_about_bg_attachment', array(
				        'default'        => 'fixed',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_about_bg_attachment',
				    	array(
					        'settings' => 'goldly_about_bg_attachment',
					        'label'   => 'Background Attachment',
					        'section' => 'global_about_section',
					        'type'  => 'select',
					        'choices'    => array(
					        	'scroll' => 'Scroll',
					        	'fixed' => 'Fixed',
				        	),
				        	'active_callback' => 'goldly_about_section_design_callback',
				        )
				    ));
				//About Section in image background Size
				    $wp_customize->add_setting('goldly_about_bg_size', array(
				        'default'        => 'cover',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_about_bg_size',
				    	array(
					        'settings' => 'goldly_about_bg_size',
					        'label'   => 'Background Size',
					        'section' => 'global_about_section',
					        'type'  => 'select',
					        'active_callback' => 'goldly_about_section_design_callback',
					        'choices'    => array(
					        	'auto' => 'Auto',
					        	'cover' => 'Cover',
					            'contain' => 'Contain'
				        	),
				        )
				    ));   

		//Our Portfolio
			$wp_customize->add_section( 'goldly_our_portfolio_section' , array(
				'title'  => 'Our Portfolio',
				'panel'  => 'goldly_theme_section',
			) );
			//Our Portfolio tabing
				$wp_customize->add_setting( 'our_portfolio_section_tab', 
			        array(
			            'default'    => 'general', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'goldly_sanitize_select',
			        ) 
			    ); 
		        $wp_customize->add_control( new Goldly_Custom_Radio_Control( 
			        $wp_customize,'our_portfolio_section_tab',array(
			            'settings'   => 'our_portfolio_section_tab', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_portfolio_section',
			            'type'    => 'select',
			            'choices'    => array(
				        	'general' => 'General',
				        	'design' => 'Design',
			        	),
			        ) 
		        ) );
			//Our Portfolio in Title
				$wp_customize->add_setting( 'our_portfolio_main_title', array(
					'default'    => 'Our Portfolio',
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_portfolio_main_title',
			    	array(
						'type' => 'text',
						'settings' => 'our_portfolio_main_title',
						'section' => 'goldly_our_portfolio_section', // // Add a default or your own section
						'label' => 'Our Portfolio Title',
						'active_callback' => 'goldly_our_portfolio_general_callback',
					)
				) );
				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial(
						'our_portfolio_main_title',
						array(
							'selector'        => '.our_portfolio_info',
							'render_callback' => 'goldly_customize_partial_name',
						)
					);
				}
			//Our Portfolio in Discription
				$wp_customize->add_setting( 'our_portfolio_main_discription', array(
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_portfolio_main_discription',
			    	array(
						'type' => 'textarea',
						'settings' => 'our_portfolio_main_discription',
						'section' => 'goldly_our_portfolio_section', // // Add a default or your own section
						'label' => 'Our Portfolio Discription',
						'active_callback' => 'goldly_our_portfolio_general_callback',
					)
				) );
			//Our Portfolio in number of section
			    $wp_customize->add_setting( 'our_portfolio_number', array(
			    	'default'  => 3,
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'goldly_sanitize_number_range',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_portfolio_number',
			    	array(
						'type' => 'number',
						'settings'   => 'our_portfolio_number', 
						'section' => 'goldly_our_portfolio_section', // // Add a default or your own section
						'label' => 'No. of Section',
						'description' => 'Save and refresh the page if No. of Sections is changed (Max no of section is 6)',
						'input_attrs' => array(
									    'min' => 1,
									    'max' => 6,
									),	
						'active_callback' => 'goldly_our_portfolio_general_callback',				   
					)
				) );
				$our_portfolio_number = get_theme_mod( 'our_portfolio_number', 3 );
				for ( $i = 1; $i <= $our_portfolio_number ; $i++ ) {
					//Our Portfolio Heading
						$wp_customize->add_setting('our_portfolio_'.$i, array(
					        'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
					    ));
					    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
					    	$wp_customize,'our_portfolio_'.$i,
					    	array(
						        'settings' => 'our_portfolio_'.$i,
						        'label'   => 'Our Portfolio '.$i ,
						        'section' => 'goldly_our_portfolio_section',
						        'type'     => 'ast-description',
						        'active_callback' => 'goldly_our_portfolio_general_callback',
					        )
					    ));
					//Our Portfolio Image
					    $wp_customize->add_setting('our_portfolio_image_' .$i, array(
				        	'type'       => 'theme_mod',
					        'transport'     => 'refresh',
					        'height'        => 180,
					        'width'        => 160,
					        'capability' => 'edit_theme_options',
					        'sanitize_callback' => 'esc_url_raw'
					    ));
					    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'our_portfolio_image_' .$i , array(
					        'label' =>  'Image',
					        'section' => 'goldly_our_portfolio_section',
					        'settings' => 'our_portfolio_image_' .$i,
					        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
					        'active_callback' => 'goldly_our_portfolio_general_callback',
					    ))); 
					//Our Portfolio Title
						$wp_customize->add_setting('our_portfolio_title_'.$i, array(
					        'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
					    ));
					    $wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_portfolio_title_'.$i,
					    	array(
						        'settings' => 'our_portfolio_title_'.$i,
						        'label'   => 'Our Portfolio Title '.$i ,
						        'section' => 'goldly_our_portfolio_section',
						        'type'     => 'text',
						        'active_callback' => 'goldly_our_portfolio_general_callback',
					        )
					    ));
					//Our Portfolio subheading Title
						$wp_customize->add_setting('our_portfolio_subheading_'.$i, array(
					        'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
					    ));
					    $wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_portfolio_subheading_'.$i,
					    	array(
						        'settings' => 'our_portfolio_subheading_'.$i,
						        'label'   => 'Sub Heading ' .$i,
						        'section' => 'goldly_our_portfolio_section',
						        'type'     => 'text',
						        'active_callback' => 'goldly_our_portfolio_general_callback',
					        )
					    ));
					//Our Portfolio button
					    $wp_customize->add_setting('our_portfolio_button_'. $i,
					        array(
					            'default' => 'fa fa-arrow-right',
					            'transport' => 'refresh',
					            'type'       => 'theme_mod',
					            'capability' => 'edit_theme_options',
					            'sanitize_callback' => 'sanitize_text_field',
					        )
					    );
					    $wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_portfolio_button_'.$i,
					    	array(
					            'type'        => 'text',
								'settings'    => 'our_portfolio_button_'.$i,
								'label'       => 'Select Our Portfolio button '.$i,
								'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v4.7.0/icons/">Click Here</a> for select icon','goldly'),
								'section'     => 'goldly_our_portfolio_section',
								'active_callback' => 'goldly_our_portfolio_general_callback',
					        )
					    ));	
					//Our Portfolio button link
						$wp_customize->add_setting('our_portfolio_buttonlink_'.$i, array(
							'default'    => '#',
					        'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
					    ));
					    $wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_portfolio_buttonlink_'.$i,
					    	array(
						        'settings' => 'our_portfolio_buttonlink_'.$i,
						        'label'   => 'Our Portfolio button link ' .$i,
						        'section' => 'goldly_our_portfolio_section',
						        'type'     => 'text',
						        'active_callback' => 'goldly_our_portfolio_general_callback',
					        )
					    ));
			    }
			//Our Portfolio in pro option
				$wp_customize->add_setting('our_portfolio_pro', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new Goldly_pro_option_Control(
			    	$wp_customize,'our_portfolio_pro',
			    	array(
				        'settings' => 'our_portfolio_pro',
				        //'label'   => 'More Options Available in Goldly Pro!',
				        'section' => 'goldly_our_portfolio_section',
				        'active_callback' => 'goldly_our_portfolio_general_callback',
			        )
			    ));
			//Our Portfolio in Background Title
				$wp_customize->add_setting('our_portfolio_bg_heading', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
			    	$wp_customize,'our_portfolio_bg_heading',
			    	array(
				        'settings' => 'our_portfolio_bg_heading',
				        'label'   => 'Background',
				        'section' => 'goldly_our_portfolio_section',
				        'type'     => 'ast-description',
				        'active_callback' => 'goldly_our_portfolio_design_callback',
			        )
			    )); 
				//Our Portfolio Section in Background Image
			    	$wp_customize->add_setting('our_portfolio_bg_image', array(
			    		'default'  => '',
			        	'type'       => 'theme_mod',
				        'transport'     => 'refresh',
				        'height'        => 180,
				        'width'        => 160,
				        'capability' => 'edit_theme_options',
				        'sanitize_callback' => 'esc_url_raw'
				    ));
				    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'our_portfolio_bg_image', array(
				        'label' => __('Backgroung Image', 'goldly'),
				        'section' => 'goldly_our_portfolio_section',
				        'settings' => 'our_portfolio_bg_image',
				        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
				        'active_callback' => 'goldly_our_portfolio_design_callback',
				    )));
				//Our Portfolio  in image background position
				    $wp_customize->add_setting('goldly_our_portfolio_bg_position', array(
				        'default'        => 'center center',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_our_portfolio_bg_position',
				    	array(
					        'settings' => 'goldly_our_portfolio_bg_position',
					        'label'   => 'Background Position',
					        'section' => 'goldly_our_portfolio_section',
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
				        	'active_callback' => 'goldly_our_portfolio_design_callback',
				        )
				    )); 
				//Our Portfolio  in image background attachment
				    $wp_customize->add_setting('goldly_our_portfolio_bg_attachment', array(
				        'default'        => 'scroll',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_our_portfolio_bg_attachment',
				    	array(
					        'settings' => 'goldly_our_portfolio_bg_attachment',
					        'label'   => 'Background Attachment',
					        'section' => 'goldly_our_portfolio_section',
					        'type'  => 'select',
					        'choices'    => array(
					        	'scroll' => 'Scroll',
					        	'fixed' => 'Fixed',
				        	),
				        	'active_callback' => 'goldly_our_portfolio_design_callback',
				        )
				    ));
				//Our Portfolio  in image background Size
				    $wp_customize->add_setting('goldly_our_portfolio_bg_size', array(
				        'default'        => 'cover',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_our_portfolio_bg_size',
				    	array(
					        'settings' => 'goldly_our_portfolio_bg_size',
					        'label'   => 'Background Size',
					        'section' => 'goldly_our_portfolio_section',
					        'type'  => 'select',
					        'choices'    => array(
					        	'auto' => 'Auto',
					        	'cover' => 'Cover',
					            'contain' => 'Contain'
				        	),
				        	'active_callback' => 'goldly_our_portfolio_design_callback',
				        )
				    ));  
  
			//Our Portfolio in background color
			   	$wp_customize->add_setting( 'goldly_our_portfolio_bg_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_our_portfolio_bg_color', 
			        array(
			            'label'      => __( 'Background Color', 'goldly' ), 
			            'settings'   => 'goldly_our_portfolio_bg_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_portfolio_section',
			            'active_callback' => 'goldly_our_portfolio_design_callback',
			        ) 
		        ) ); 
		    //Our Portfolio in text color
			   	$wp_customize->add_setting( 'goldly_our_portfolio_text_color', 
			        array(
			            'default'    => '#333', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_our_portfolio_text_color', 
			        array(
			            'label'      => __( 'Text Color', 'goldly' ), 
			            'settings'   => 'goldly_our_portfolio_text_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_portfolio_section',
			            'active_callback' => 'goldly_our_portfolio_design_callback',
			        ) 
		        ) );    
		    //Our Portfolio in Container text color
			   	$wp_customize->add_setting( 'goldly_our_portfolio_container_text_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_our_portfolio_container_text_color', 
			        array(
			            'label'      => __( 'Container Text Color', 'goldly' ), 
			            'settings'   => 'goldly_our_portfolio_container_text_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_portfolio_section',
			            'active_callback' => 'goldly_our_portfolio_design_callback',
			        ) 
		        ) );   

		//Our Team
			$wp_customize->add_section( 'goldly_our_team_section' , array(
				'id'       => 'goldly_our_team_section',
	         	'title'    => __( 'Our Team', 'goldly' ),
	         	'panel'    => 'goldly_theme_section',
			) );
			//Our Team tabing 
				$wp_customize->add_setting( 'our_team_section_tab', 
			        array(
			            'default'    => 'general', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'goldly_sanitize_select',
			        ) 
			    ); 
		        $wp_customize->add_control( new Goldly_Custom_Radio_Control( 
			        $wp_customize,'our_team_section_tab',array(
			            'settings'   => 'our_team_section_tab', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_team_section',
			            'type'    => 'select',
			            'choices'    => array(
				        	'general' => 'General',
				        	'design' => 'Design',
			        	),
			        ) 
		        ) );
			//Our Team in Title
				$wp_customize->add_setting( 'our_team_main_title', array(
					'default'    => 'Our Team',
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_team_main_title',
			    	array(
						'type' => 'text',
						'settings' => 'our_team_main_title',
						'section' => 'goldly_our_team_section', // // Add a default or your own section
						'label' => 'Our Team Title',
						'active_callback' => 'goldly_our_team_general_callback',
					)
				) );
				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial(
						'our_team_main_title',
						array(
							'selector'        => '.our_team_section',
							'render_callback' => 'goldly_customize_partial_our_team',
						)
					);
				}
			//Our Team in Discription
				$wp_customize->add_setting( 'our_team_main_discription', array(
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_team_main_discription',
			    	array(
						'type' => 'textarea',
						'settings' => 'our_team_main_discription',
						'section' => 'goldly_our_team_section', // // Add a default or your own section
						'label' => 'Our Team Discription',
						'active_callback' => 'goldly_our_team_general_callback',  
					)
				) );
			//Our Team in number of section
			    $wp_customize->add_setting( 'our_team_number', array(
			    	'default'  => 4,
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'goldly_sanitize_number_range',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_team_number',
			    	array(
						'type' => 'number',
						'settings'   => 'our_team_number', 
						'section' => 'goldly_our_team_section', // // Add a default or your own section
						'label' => 'No. of Section',
						'description' => 'Save and refresh the page if No. of Sections is changed (Max no of section is 8)',
						'input_attrs' => array(
									    'min' => 1,
									    'max' => 8,
									),		
						'active_callback' => 'goldly_our_team_general_callback',			   
					)
				) );
				$our_team_number = get_theme_mod( 'our_team_number', 4 );
				for ( $i = 1; $i <= $our_team_number ; $i++ ) {
					//Our Team in headline
						$wp_customize->add_setting( 'our_team_heading_'.$i, array(
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
					    	$wp_customize,'our_team_heading_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_team_heading_'.$i, 
								'section' => 'goldly_our_team_section', // // Add a default or your own section
								'label' => 'Our Team ' .$i,
								'active_callback' => 'goldly_our_team_general_callback',	
							)
						) );					
					//Our Team image option
				        $wp_customize->add_setting('our_team_image'.$i, array(
				        	'type'       => 'theme_mod',
					        'transport'     => 'refresh',
					        'height'        => 180,
					        'width'        => 160,
					        'capability' => 'edit_theme_options',
					        'sanitize_callback' => 'esc_url_raw'
					    ));
					    $wp_customize->add_control( new WP_Customize_Image_Control( 
					    	$wp_customize, 'our_team_image'.$i, array(
						        'label' => 'Image '.$i, 
						        'section' => 'goldly_our_team_section',
						        'settings' => 'our_team_image'.$i,
						        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
						        'active_callback' => 'goldly_our_team_general_callback',
						    )
					    ) );
					//Our Team in title
						$wp_customize->add_setting( 'our_team_title_'.$i, array(
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_team_title_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_team_title_'.$i, 
								'section' => 'goldly_our_team_section', // // Add a default or your own section
								'label' => 'Title ' .$i,
								'active_callback' => 'goldly_our_team_general_callback',
							)
						) );
					//Our Team in title
						$wp_customize->add_setting( 'our_team_title_link_'.$i, array(
							'default'  => '#',
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_team_title_link_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_team_title_link_'.$i, 
								'section' => 'goldly_our_team_section', // // Add a default or your own section
								'label' => 'Link ' .$i,
								'active_callback' => 'goldly_our_team_general_callback',
							)
						) );
					//Our Team in headline
						$wp_customize->add_setting( 'our_team_headline_'.$i, array(
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_team_headline_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_team_headline_'.$i, 
								'section' => 'goldly_our_team_section', // // Add a default or your own section
								'label' => 'Description ' .$i,	 
								'active_callback' => 'goldly_our_team_general_callback',
							)
						) );
					//header topbar in twitter link
					    $wp_customize->add_setting( 'our_team_twitter_link_'.$i, array(		                
					                'default'   => 'https://twitter.com/',
									'priority'  => 10,
									'capability' => 'edit_theme_options',
									'sanitize_callback' => 'sanitize_text_field',
					    ));				    
					    $wp_customize->add_control(  new WP_Customize_Control(
						    	$wp_customize,'our_team_twitter_link_'.$i, 
						    	array(
					                'label' => 'Twitter Link',
					                'section' => 'goldly_our_team_section',
					                'settings' => 'our_team_twitter_link_'.$i,
					                'active_callback' => 'goldly_our_team_general_callback',
						        )
					    ));
					//Our Team in facebook link
					    $wp_customize->add_setting( 'our_team_facebook_link_'.$i, array(		                
					                'default'   => 'https://www.facebook.com/',
									'priority'  => 10,
									'capability' => 'edit_theme_options',
									'sanitize_callback' => 'sanitize_text_field',
					    ));					    
					    $wp_customize->add_control(  new WP_Customize_Control(
						    	$wp_customize,'our_team_facebook_link_'.$i, 
						    	array(
					                'label' => 'Facebook Link',
					                'section' => 'goldly_our_team_section',
					                'settings' => 'our_team_facebook_link_'.$i, 
					                'active_callback' => 'goldly_our_team_general_callback',
						        )
					    ));	
				    //Our Team in instagram link
					    $wp_customize->add_setting( 'our_team_instagram_link_'.$i, array(		                
					                'default'   => 'https://www.instagram.com/',
									'priority'  => 10,
									'capability' => 'edit_theme_options',
									'sanitize_callback' => 'sanitize_text_field',
					    )); 				    
					    $wp_customize->add_control(  new WP_Customize_Control(
						    	$wp_customize,'our_team_instagram_link_'.$i, 
						    	array(
					                'label' => 'Instagram Link',
					                'section' => 'goldly_our_team_section',
					                'settings' => 'our_team_instagram_link_'.$i,
					                'active_callback' => 'goldly_our_team_general_callback',
						        )
					    ));	
				    //Our Team in linkedin link
					    $wp_customize->add_setting( 'our_team_linkedin_link_'.$i, array(		                
					                'default'   => 'https://www.linkedin.com/feed/',
									'priority'  => 10,
									'capability' => 'edit_theme_options',
									'sanitize_callback' => 'sanitize_text_field',
					    ));				    
					    $wp_customize->add_control(  new WP_Customize_Control(
						    	$wp_customize,'our_team_linkedin_link_'.$i, 
						    	array(
					                'label' => 'Linkedin Link',
					                'section' => 'goldly_our_team_section',
					                'settings' => 'our_team_linkedin_link_'.$i,
					                'active_callback' => 'goldly_our_team_general_callback',
						        )
					    ));
				}
			//Our Team in pro option
				$wp_customize->add_setting('our_team_pro', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new Goldly_pro_option_Control(
			    	$wp_customize,'our_team_pro',
			    	array(
				        'settings' => 'our_team_pro',
				        //'label'   => 'More Options Available in Goldly Pro!',
				        'section' => 'goldly_our_team_section',
				        'active_callback' => 'goldly_our_team_general_callback',
			        )
			    ));
			//Our Team Section in Background Title
		    	$wp_customize->add_setting('our_team_background_section', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
			    	$wp_customize,'our_team_background_section',
			    	array(
				        'settings' => 'our_team_background_section',
				        'label'   => 'Background Color Or Image',
				        'section' => 'goldly_our_team_section',
				        'type'     => 'ast-description',
				        'active_callback' => 'goldly_our_team_design_callback',
			        )
			    ));
			    //Our Team backgroung Image
			    	$wp_customize->add_setting('our_team_bg_image', array(
			    		'default'  => '',
			        	'type'       => 'theme_mod',
				        'transport'     => 'refresh',
				        'height'        => 180,
				        'width'        => 160,
				        'capability' => 'edit_theme_options',
				        'sanitize_callback' => 'esc_url_raw'
				    ));
				    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'our_team_bg_image', array(
				        'label' => __('Backgroung Image', 'goldly'),
				        'section' => 'goldly_our_team_section',
				        'settings' => 'our_team_bg_image',
				        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
				        'active_callback' => 'goldly_our_team_design_callback',
				    )));
				//Our Team in Background Position
				    $wp_customize->add_setting('goldly_our_team_bg_position', array(
				        'default'        => 'center center',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_our_team_bg_position',
				    	array(
					        'settings' => 'goldly_our_team_bg_position',
					        'label'   => 'Background Position',
					        'section' => 'goldly_our_team_section',
					        'type'  => 'select',
					        'active_callback' => 'goldly_our_team_design_callback',
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
				//Our Team Section in Background Attachment
					$wp_customize->add_setting('goldly_our_team_bg_attachment', array(
				        'default'        => 'scroll',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_our_team_bg_attachment',
				    	array(
					        'settings' => 'goldly_our_team_bg_attachment',
					        'label'   => 'Background Attachment',
					        'section' => 'goldly_our_team_section',
					        'type'  => 'select',
					        'choices'    => array(
					        	'scroll' => 'Scroll',
					        	'fixed' => 'Fixed',
				        	),
				        	'active_callback' => 'goldly_our_team_design_callback',
				        )
				    ));
				//Our Team Section in image background Size
				    $wp_customize->add_setting('goldly_our_team_bg_size', array(
				        'default'        => 'cover',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'goldly_our_team_bg_size',
				    	array(
					        'settings' => 'goldly_our_team_bg_size',
					        'label'   => 'Background Size',
					        'section' => 'goldly_our_team_section',
					        'type'  => 'select',
					        'active_callback' => 'goldly_our_team_design_callback',
					        'choices'    => array(
					        	'auto' => 'Auto',
					        	'cover' => 'Cover',
					            'contain' => 'Contain'
				        	),
				        )
				    ));   
				//Our team background color
					$wp_customize->add_setting( 'our_team_bg_color', 
				        array(
				            'default'    => '#ffffff', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'our_team_bg_color', 
				        array(
				            'label'      => __( 'Background Color', 'goldly' ), 
				            'settings'   => 'our_team_bg_color', 
				            'priority'   => 10,
				            'section'    => 'goldly_our_team_section',
				            'active_callback' => 'goldly_our_team_design_callback',
				        ) 
			        ) );      
		    //Our team text color
				$wp_customize->add_setting( 'our_team_text_color', 
			        array(
			            'default'    => '#333', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_team_text_color', 
			        array(
			            'label'      => __( 'Text Color', 'goldly' ), 
			            'settings'   => 'our_team_text_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_team_section',
			            'active_callback' => 'goldly_our_team_design_callback',
			        ) 
		        ) ); 
			//Our team container background color
				$wp_customize->add_setting( 'our_team_container_bg_color', 
			        array(
			            'default'    => '#eeeeee', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_team_container_bg_color', 
			        array(
			            'label'      => __( 'Container Background Color', 'goldly' ), 
			            'settings'   => 'our_team_container_bg_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_team_section',
			            'active_callback' => 'goldly_our_team_design_callback',
			        ) 
		        ) );  
		    //Our team container text color
				$wp_customize->add_setting( 'our_team_container_text_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_team_container_text_color', 
			        array(
			            'label'      => __( 'Container Text Color', 'goldly' ), 
			            'settings'   => 'our_team_container_text_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_team_section',
			            'active_callback' => 'goldly_our_team_design_callback',
			        ) 
		        ) );  
		    //Our team text hover color
				$wp_customize->add_setting( 'our_team_text_hover_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_team_text_hover_color', 
			        array(
			            'label'      => __( 'hover on Text Color', 'goldly' ), 
			            'settings'   => 'our_team_text_hover_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_team_section',
			            'active_callback' => 'goldly_our_team_design_callback',
			        ) 
		        ) );  
		    //Our team icon color
				$wp_customize->add_setting( 'our_team_icon_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_team_icon_color', 
			        array(
			            'label'      => __( 'Icon Color', 'goldly' ), 
			            'settings'   => 'our_team_icon_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_team_section',
			            'active_callback' => 'goldly_our_team_design_callback',
			        ) 
		        ) );  
		    //Our team icon hover color
				$wp_customize->add_setting( 'our_team_icon_hover_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_team_icon_hover_color', 
			        array(
			            'label'      => __( 'Icon Hover Color', 'goldly' ), 
			            'settings'   => 'our_team_icon_hover_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_team_section',
			            'active_callback' => 'goldly_our_team_design_callback',
			        ) 
		        ) );  
		    //Our team icon background color
				$wp_customize->add_setting( 'our_team_icon_background_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_team_icon_background_color', 
			        array(
			            'label'      => __( 'Icon Background Color', 'goldly' ), 
			            'settings'   => 'our_team_icon_background_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_team_section',
			            'active_callback' => 'goldly_our_team_design_callback',
			        ) 
		        ) );  
		    //Our team icon background hover color
				$wp_customize->add_setting( 'our_team_icon_bg_hover_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_team_icon_bg_hover_color', 
			        array(
			            'label'      => __( 'Icon Background Hover Color', 'goldly' ), 
			            'settings'   => 'our_team_icon_bg_hover_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_team_section',
			            'active_callback' => 'goldly_our_team_design_callback',
			        ) 
		        ) );  

	    //Our Testimonial
			$wp_customize->add_section( 'goldly_our_testimonial_section' , array(
				'title'  => 'Our Testimonial',
				'panel'  => 'goldly_theme_section',
			) );
			//Our Testimonial Tabing
			 	$wp_customize->add_setting( 'our_testimonial_section_tab', 
			        array(
			            'default'    => 'general', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'goldly_sanitize_select',
			        ) 
			    ); 
		        $wp_customize->add_control( new Goldly_Custom_Radio_Control( 
			        $wp_customize,'our_testimonial_section_tab',array(
			            'settings'   => 'our_testimonial_section_tab', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_testimonial_section',
			            'type'    => 'select',
			            'choices'    => array(
				        	'general' => 'General',
				        	'design' => 'Design',
			        	),
			        ) 
		        ) );
			//Our Testimonial in Title
				$wp_customize->add_setting( 'our_testimonial_main_title', array(
					'default'    => 'Our Testimonial',
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_testimonial_main_title',
			    	array(
						'type' => 'text',
						'settings' => 'our_testimonial_main_title',
						'section' => 'goldly_our_testimonial_section', // // Add a default or your own section
						'label' => 'Our Testimonial Title',
						'active_callback' => 'goldly_our_testimonial_general_callback',
					)
				) );
				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial(
						'our_testimonial_main_title',
						array(
							'selector'        => '.our_testimonial_section',
							'render_callback' => 'goldly_customize_partial_testimonial',
						)
					);
				}
			//Our Testimonial in Discription
				$wp_customize->add_setting( 'our_testimonial_main_discription', array(
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_testimonial_main_discription',
			    	array(
						'type' => 'textarea',
						'settings' => 'our_testimonial_main_discription',
						'section' => 'goldly_our_testimonial_section', // // Add a default or your own section
						'label' => 'Our Testimonial Discription',  
						'active_callback' => 'goldly_our_testimonial_general_callback',
					)
				) );
			//Our Testimonial in number of section
			    $wp_customize->add_setting( 'our_testimonial_number', array(
			    	'default'  => 3,
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'goldly_sanitize_number_range',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_testimonial_number',
			    	array(
						'type' => 'number',
						'settings'   => 'our_testimonial_number', 
						'section' => 'goldly_our_testimonial_section', // // Add a default or your own section
						'label' => 'No. of Slider',
						'description' => 'Save and refresh the page if No. of Slider is changed (Max no of section is 3)',
						'input_attrs' => array(
									    'min' => 1,
									    'max' => 3,
									),	
						'active_callback' => 'goldly_our_testimonial_general_callback',				   
					)
				) );
				$our_testimonial_number = get_theme_mod( 'our_testimonial_number', 4 );
				for ( $i = 1; $i <= $our_testimonial_number ; $i++ ) {
					//Our Testimonial in headline
						$wp_customize->add_setting( 'our_testimonial_heading_'.$i, array(
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
					    	$wp_customize,'our_testimonial_heading_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_testimonial_heading_'.$i, 
								'section' => 'goldly_our_testimonial_section', 
								'label' => 'Our Testimonial ' .$i,
								'active_callback' => 'goldly_our_testimonial_general_callback',
							)
						) );	
					//Our Testimonial in Title
						$wp_customize->add_setting( 'our_testimonial_title_'.$i, array(
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_testimonial_title_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_testimonial_title_'.$i, 
								'section' => 'goldly_our_testimonial_section', 
								'label' => 'Title ' .$i,
								'active_callback' => 'goldly_our_testimonial_general_callback',	
							)
						) );
					//Our Testimonial in sub headline
						$wp_customize->add_setting( 'our_testimonial_subheadline_'.$i, array(
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_testimonial_subheadline_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_testimonial_subheadline_'.$i, 
								'section' => 'goldly_our_testimonial_section', 
								'label' => 'Sub Headline ' .$i,
								'active_callback' => 'goldly_our_testimonial_general_callback',	
							)
						) );
					//Our Testimonial in Description
						$wp_customize->add_setting( 'our_testimonial_description_'.$i, array(
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_testimonial_description_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_testimonial_description_'.$i, 
								'section' => 'goldly_our_testimonial_section', 
								'label' => 'Description ' .$i,
								'active_callback' => 'goldly_our_testimonial_general_callback',	
							)
						) );	
					//Our Team image option
				        $wp_customize->add_setting('our_testimonial_image_'.$i, array(
				        	'type'       => 'theme_mod',
					        'transport'     => 'refresh',
					        'height'        => 180,
					        'width'        => 160,
					        'capability' => 'edit_theme_options',
					        'sanitize_callback' => 'esc_url_raw'
					    ));
					    $wp_customize->add_control( new WP_Customize_Image_Control( 
					    	$wp_customize, 'our_testimonial_image_'.$i, array(
						        'label' => 'Image '.$i, 
						        'section' => 'goldly_our_testimonial_section',
						        'settings' => 'our_testimonial_image_'.$i,
						        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
						        'active_callback' => 'goldly_our_testimonial_general_callback',
						    )
					    ) );	
				}
				//Our Testimonial in pro option
					$wp_customize->add_setting('our_testimonial_pro', array(
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new Goldly_pro_option_Control(
				    	$wp_customize,'our_testimonial_pro',
				    	array(
					        'settings' => 'our_testimonial_pro',
					        //'label'   => 'More Options Available in Goldly Pro!',
					        'section' => 'goldly_our_testimonial_section',
					        'active_callback' => 'goldly_our_testimonial_general_callback',
				        )
				    ));
				//Our Testimonial in background color
					$wp_customize->add_setting( 'our_team_testimonial_bg_color', 
				        array(
				            'default'    => '#eeeeee', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'our_team_testimonial_bg_color', 
				        array(
				            'label'      => __( 'Background Color', 'goldly' ), 
				            'settings'   => 'our_team_testimonial_bg_color', 
				            'priority'   => 10,
				            'section'    => 'goldly_our_testimonial_section',
				            'active_callback' => 'goldly_our_testimonial_design_callback',
				        ) 
			        ) ); 
			    //Our Testimonial background image option
			        $wp_customize->add_setting('our_testimonial_background_image', array(
			        	'type'       => 'theme_mod',
				        'transport'     => 'refresh',
				        'height'        => 180,
				        'width'        => 160,
				        'capability' => 'edit_theme_options',
				        'sanitize_callback' => 'esc_url_raw'
				    ));
				    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'our_testimonial_background_image', array(
				        'label' => __('Backgroung Image', 'goldly'),
				        'section' => 'goldly_our_testimonial_section',
				        'settings' => 'our_testimonial_background_image',
				        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
				        'active_callback' => 'goldly_our_testimonial_design_callback',
				    )));
				//Our Testimonial in image background position
				    $wp_customize->add_setting('our_testimonial_bg_position', array(
				        'default'        => 'center center',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'our_testimonial_bg_position',
				    	array(
					        'settings' => 'our_testimonial_bg_position',
					        'label'   => 'Background Position',
					        'section' => 'goldly_our_testimonial_section',
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
				        	'active_callback' => 'goldly_our_testimonial_design_callback',
				        )
				    )); 
				//Our Testimonial in image background attachment
				    $wp_customize->add_setting('our_testimonial_bg_attachment', array(
				        'default'        => 'scroll',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'our_testimonial_bg_attachment',
				    	array(
					        'settings' => 'our_testimonial_bg_attachment',
					        'label'   => 'Background Attachment',
					        'section' => 'goldly_our_testimonial_section',
					        'type'  => 'select',
					        'choices'    => array(
					        	'scroll' => 'Scroll',
					        	'fixed' => 'Fixed',
				        	),
				        	'active_callback' => 'goldly_our_testimonial_design_callback',
				        )
				    ));
				//Our Testimonial in image background Size
				    $wp_customize->add_setting('our_testimonial_bg_size', array(
				        'default'        => 'cover',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'our_testimonial_bg_size',
				    	array(
					        'settings' => 'our_testimonial_bg_size',
					        'label'   => 'Background Size',
					        'section' => 'goldly_our_testimonial_section',
					        'type'  => 'select',
					        'choices'    => array(
					        	'auto' => 'Auto',
					        	'cover' => 'Cover',
					            'contain' => 'Contain'
				        	),
				        	'active_callback' => 'goldly_our_testimonial_design_callback',
				        )
				    ));  		   
			    //Our Testimonial in Text color
					$wp_customize->add_setting( 'our_testimonial_text_color', 
				        array(
				            'default'    => '#333', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'our_testimonial_text_color', 
				        array(
				            'label'      => __( 'Text Color', 'goldly' ), 
				            'settings'   => 'our_testimonial_text_color', 
				            'priority'   => 10,
				            'section'    => 'goldly_our_testimonial_section',
				            'active_callback' => 'goldly_our_testimonial_design_callback',
				        ) 
			        ) );   

			    //Our Testimonial in Description background color
					$wp_customize->add_setting( 'our_team_testimonial_disc_bg_color', 
				        array(
				            'default'    => '#ffffff', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'our_team_testimonial_disc_bg_color', 
				        array(
				            'label'      => __( 'Description Background Color', 'goldly' ), 
				            'settings'   => 'our_team_testimonial_disc_bg_color', 
				            'priority'   => 10,
				            'section'    => 'goldly_our_testimonial_section',
				            'active_callback' => 'goldly_our_testimonial_design_callback',
				        ) 
			        ) );  
			    //Our Testimonial in Description Text color
					$wp_customize->add_setting( 'our_team_testimonial_text_color', 
				        array(
				            'default'    => '#273641', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'our_team_testimonial_text_color', 
				        array(
				            'label'      => __( 'Description Text Color', 'goldly' ), 
				            'settings'   => 'our_team_testimonial_text_color', 
				            'priority'   => 10,
				            'section'    => 'goldly_our_testimonial_section',
				            'active_callback' => 'goldly_our_testimonial_design_callback',
				        ) 
			        ) );  
			    //Our Testimonial in Autoplay True
				    $wp_customize->add_setting('our_testimonial_slider_autoplay', array(
				        'default'        => 'true',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'goldly_sanitize_select',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'our_testimonial_slider_autoplay',
				    	array(
					        'settings' => 'our_testimonial_slider_autoplay',
					        'label'   => 'Autoplay',
					        'section' => 'goldly_our_testimonial_section',
					        'type'  => 'select',
					        'choices'    => array(
					        	'true' => 'True',
					        	'false' => 'False',
				        	),
				        	'active_callback' => 'goldly_our_testimonial_design_callback',
				        )
				    )); 
				//Our Testimonial Slider in autoplay speed
				    $wp_customize->add_setting('our_testimonial_slider_autoplay_speed', array(
				    	'default'        => '1000',
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',		
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new WP_Customize_Control(
				    	$wp_customize,'our_testimonial_slider_autoplay_speed',
				    	array(
					        'settings' => 'our_testimonial_slider_autoplay_speed',
					        'label'   => 'AutoplaySpeed',
					        'section' => 'goldly_our_testimonial_section',
					        'type'  => 'text',  
					        'active_callback' => 'goldly_our_testimonial_design_callback', 
				        )
				    ));    

		//OUR SERVICES
			$wp_customize->add_section( 'goldly_our_services_section' , array(
				'title'  => 'Our Services',
				'panel'  => 'goldly_theme_section',
			) );
			//OUR SERVICES Tabing
				$wp_customize->add_setting( 'our_services_tab', 
			        array(
			            'default'    => 'general', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'goldly_sanitize_select',
			        ) 
			    ); 
		        $wp_customize->add_control( new Goldly_Custom_Radio_Control( 
			        $wp_customize,'our_services_tab',array(
			            'settings'   => 'our_services_tab', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_services_section',
			            'type'    => 'select',
			            'choices'    => array(
				        	'general' => 'General',
				        	'design' => 'Design',
			        	),
			        ) 
		        ) );
			//Our services in Title
				$wp_customize->add_setting( 'our_services_main_title', array(
					'default'    => 'Our Services',
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_services_main_title',
			    	array(
						'type' => 'text',
						'settings' => 'our_services_main_title',
						'section' => 'goldly_our_services_section', // // Add a default or your own section
						'label' => 'Our Services Title',
						'active_callback' => 'goldly_our_services_general_callback', 
					)
				) );
				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial(
						'our_services_main_title',
						array(
							'selector'        => '.our_services_section',
							'render_callback' => 'goldly_customize_partial_services',
						)
					);
				}
			//Our services in Title
				$wp_customize->add_setting( 'our_services_main_discription', array(
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_services_main_discription',
			    	array(
						'type' => 'textarea',
						'settings' => 'our_services_main_discription',
						'section' => 'goldly_our_services_section', // // Add a default or your own section
						'label' => 'Our Services Discription',
						'active_callback' => 'goldly_our_services_general_callback', 
					)
				) );
			//Our services in number of section
			    $wp_customize->add_setting( 'our_services_number', array(
			    	'default'  => 6,
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'goldly_sanitize_number_range',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_services_number',
			    	array(
						'type' => 'number',
						'settings'   => 'our_services_number', 
						'section' => 'goldly_our_services_section', // // Add a default or your own section
						'label' => 'No. of Section',
						'description' => 'Save and refresh the page if No. of Section is changed (Max no of section is 6)',
						'input_attrs' => array(
									    'min' => 1,
									    'max' => 6,
									),
						'active_callback' => 'goldly_our_services_general_callback', 				   
					)
				) );
				$our_services_number = get_theme_mod( 'our_services_number', 6 );
				for ( $i = 1; $i <= $our_services_number ; $i++ ) {
					//Our services in headline
						$wp_customize->add_setting( 'our_services_heading_'.$i, array(
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
					    	$wp_customize,'our_services_heading_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_services_heading_'.$i, 
								'section' => 'goldly_our_services_section', 
								'label' => 'Our Services ' .$i, 
								'active_callback' => 'goldly_our_services_general_callback',   
							)
						) );
					//Featured Section icon
						$wp_customize->add_setting('our_services_icon_'. $i,
					        array(
					            'default' => 'fa fa-user',
					            'transport' => 'refresh',
					            'type'       => 'theme_mod',
					            'capability' => 'edit_theme_options',
					            'sanitize_callback' => 'sanitize_text_field',
					        )
					    );
					    $wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_services_icon_'.$i,
					    	array(
					            'type'        => 'text',
								'settings'    => 'our_services_icon_'.$i,
								'label'       => 'Select Features Icon '.$i,
								'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v4.7.0/icons/">Click Here</a> for select icon','goldly'),
								'section'     => 'goldly_our_services_section', 
								'active_callback' => 'goldly_our_services_general_callback',   
					        )
					    ));	
					//Our services in Title
						$wp_customize->add_setting( 'our_services_title_'.$i, array(
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_services_title_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_services_title_'.$i, 
								'section' => 'goldly_our_services_section', 
								'label' => 'Title ' .$i, 
								'active_callback' => 'goldly_our_services_general_callback',  
							)
						) );
					//Our services in Link
						$wp_customize->add_setting( 'our_services_title_link_'.$i, array(
							'default'   => '#',
						    'type'      => 'theme_mod',
					        'transport'  => 'refresh',
					        'capability' => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_services_title_link_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_services_title_link_'.$i, 
								'section' => 'goldly_our_services_section', 
								'label' => 'Title Link ' .$i,
								'active_callback' => 'goldly_our_services_general_callback',  
							)
						) );
					//Our services in Description
						$wp_customize->add_setting( 'our_services_description_'.$i, array(
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_textarea_field',
						) );
						$wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_services_description_'.$i,
					    	array(
								'type' => 'textarea',
								'settings'   => 'our_services_description_'.$i, 
								'section' => 'goldly_our_services_section', 
								'label' => 'Description ' .$i,	
								'active_callback' => 'goldly_our_services_general_callback',      
							)
						) );	
					
				}
			//Our services in pro option
				$wp_customize->add_setting('our_services_pro', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new Goldly_pro_option_Control(
			    	$wp_customize,'our_services_pro',
			    	array(
				        'settings' => 'our_services_pro',
				        //'label'   => 'More Options Available in Goldly Pro!',
				        'section' => 'goldly_our_services_section',
				        'active_callback' => 'goldly_our_services_general_callback',  
			        )
			    ));
			//Our services Section in Background Title
		    	$wp_customize->add_setting('our_services_background_section', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
			    	$wp_customize,'our_services_background_section',
			    	array(
				        'settings' => 'our_services_background_section',
				        'label'   => 'Background Color Or Image',
				        'section' => 'goldly_our_services_section',
				        'type'     => 'ast-description',
				        'active_callback' => 'goldly_our_services_design_callback',
			        )
			    ));
			//Our services Section in Background Image
			    	$wp_customize->add_setting('our_services_bg_image', array(
			    		'default'  => '',
			        	'type'       => 'theme_mod',
				        'transport'     => 'refresh',
				        'height'        => 180,
				        'width'        => 160,
				        'capability' => 'edit_theme_options',
				        'sanitize_callback' => 'esc_url_raw'
				    ));
				    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'our_services_bg_image', array(
				        'label' => __('Backgroung Image', 'goldly'),
				        'section' => 'goldly_our_services_section',
				        'settings' => 'our_services_bg_image',
				        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
				        'active_callback' => 'goldly_our_services_design_callback',
				    )));
			//Our services Section in Background Position
			    $wp_customize->add_setting('goldly_our_services_bg_position', array(
			        'default'        => 'center center',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_our_services_bg_position',
			    	array(
				        'settings' => 'goldly_our_services_bg_position',
				        'label'   => 'Background Position',
				        'section' => 'goldly_our_services_section',
				        'type'  => 'select',
				        'active_callback' => 'goldly_our_services_design_callback',
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
			//Our services Section in Background Attachment
				$wp_customize->add_setting('goldly_our_services_bg_attachment', array(
			        'default'        => 'scroll',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_our_services_bg_attachment',
			    	array(
				        'settings' => 'goldly_our_services_bg_attachment',
				        'label'   => 'Background Attachment',
				        'section' => 'goldly_our_services_section',
				        'type'  => 'select',
				        'choices'    => array(
				        	'scroll' => 'Scroll',
				        	'fixed' => 'Fixed',
			        	),
			        	'active_callback' => 'goldly_our_services_design_callback',
			        )
			    ));
			//Our services Section in image background Size
			    $wp_customize->add_setting('goldly_our_services_bg_size', array(
			        'default'        => 'cover',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_our_services_bg_size',
			    	array(
				        'settings' => 'goldly_our_services_bg_size',
				        'label'   => 'Background Size',
				        'section' => 'goldly_our_services_section',
				        'type'  => 'select',
				        'active_callback' => 'goldly_our_services_design_callback',
				        'choices'    => array(
				        	'auto' => 'Auto',
				        	'cover' => 'Cover',
				            'contain' => 'Contain'
			        	),
			        )
			    ));   
			//Our services in Background color
				$wp_customize->add_setting( 'our_services_bg_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_services_bg_color', 
			        array(
			            'label'      => __( 'Background Color', 'goldly' ), 
			            'settings'   => 'our_services_bg_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_services_section', 
			            'active_callback' => 'goldly_our_services_design_callback',  
			        ) 
		        ) ); 

		    //Our services in Text color
				$wp_customize->add_setting( 'our_services_text_color', 
			        array(
			            'default'    => '#333', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_services_text_color', 
			        array(
			            'label'      => __( 'Text Color', 'goldly' ), 
			            'settings'   => 'our_services_text_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_services_section', 
			            'active_callback' => 'goldly_our_services_design_callback',     
			        ) 
		        ) ); 
		    //Our services in Contain Background color
				$wp_customize->add_setting( 'our_services_contain_bg_color', 
			        array(
			            'default'    => '#eeeeee', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_services_contain_bg_color', 
			        array(
			            'label'      => __( 'Contain Background Color', 'goldly' ), 
			            'settings'   => 'our_services_contain_bg_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_services_section',
			            'active_callback' => 'goldly_our_services_design_callback',     
			        ) 
		        ) );   
		    //Our services in Contain Background Hover color
				$wp_customize->add_setting( 'our_services_contain_bg_hover_color', 
			        array(
			            'default'    => '#eeeeee', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_services_contain_bg_hover_color', 
			        array(
			            'label'      => __( 'Contain Background Hover Color', 'goldly' ), 
			            'settings'   => 'our_services_contain_bg_hover_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_services_section', 
			            'active_callback' => 'goldly_our_services_design_callback',     
			        ) 
		        ) ); 
		    //Our services in Contain text color
				$wp_customize->add_setting( 'our_services_contain_text_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_services_contain_text_color', 
			        array(
			            'label'      => __( 'Contain Text Color', 'goldly' ), 
			            'settings'   => 'our_services_contain_text_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_services_section',  
			            'active_callback' => 'goldly_our_services_design_callback',   
			        ) 
		        ) ); 
		    //Our services in Contain text hover color
				$wp_customize->add_setting( 'our_services_contain_text_hover_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_services_contain_text_hover_color', 
			        array(
			            'label'      => __( 'Contain Text Hover Color', 'goldly' ), 
			            'settings'   => 'our_services_contain_text_hover_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_services_section', 
			            'active_callback' => 'goldly_our_services_design_callback',   
			        ) 
		        ) ); 
		    //Our services in border color
				$wp_customize->add_setting( 'our_services_boredr_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_services_boredr_color', 
			        array(
			            'label'      => __( 'Border Color', 'goldly' ), 
			            'settings'   => 'our_services_boredr_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_services_section',   
			            'active_callback' => 'goldly_our_services_design_callback',  
			        ) 
		        ) ); 
		    //Our services in border hover color
				$wp_customize->add_setting( 'our_services_border_hover_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'our_services_border_hover_color', 
			        array(
			            'label'      => __( 'Border Hover Color', 'goldly' ), 
			            'settings'   => 'our_services_border_hover_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_services_section',  
			            'active_callback' => 'goldly_our_services_design_callback',   
			        ) 
		        ) ); 
		    //Our services in icon font size
		        $wp_customize->add_setting('our_services_icon_size', array(
		        	'default'    => '40',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_textarea_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_services_icon_size',
			    	array(
				        'settings' => 'our_services_icon_size',
				        'label'   => 'Icon Size',
				        'section' => 'goldly_our_services_section',
				        'type'    => 'number',
				        'description' => 'in px',  
				        'input_attrs' => array(
								    'min' => 1,
								    'max' => 100,
								),	
				        'active_callback' => 'goldly_our_services_design_callback',  
				    )
				));	

	    //Our Sponsors
			$wp_customize->add_section( 'goldly_our_sponsors_section' , array(
				'title'  => 'Our Sponsors',
				'panel'  => 'goldly_theme_section',
			) );
			//Our Sponsors in Tabing
				$wp_customize->add_setting( 'our_sponsors_tab', 
			        array(
			            'default'    => 'general', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability'     => 'edit_theme_options',
			            'sanitize_callback' => 'goldly_sanitize_select',
			        ) 
			    ); 
		        $wp_customize->add_control( new Goldly_Custom_Radio_Control( 
			        $wp_customize,'our_sponsors_tab',array(
			            'settings'   => 'our_sponsors_tab', 
			            'priority'   => 10,
			            'section'    => 'goldly_our_sponsors_section',
			            'type'    => 'select',
			            'choices'    => array(
				        	'general' => 'General',
				        	'design' => 'Design',
			        	),
			        ) 
		        ) );

			//Our Sponsors in Title
				$wp_customize->add_setting( 'our_sponsors_main_title', array(
					'default'    => 'Our Sponsors',
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_sponsors_main_title',
			    	array(
						'type' => 'text',
						'settings' => 'our_sponsors_main_title',
						'section' => 'goldly_our_sponsors_section', // // Add a default or your own section
						'label' => 'Our Sponsors Title',
						'active_callback' => 'goldly_our_sponsors_general_callback',    
					)
				) );
				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial(
						'our_sponsors_main_title',
						array(
							'selector'        => '.our_sponsors_section',
							'render_callback' => 'goldly_customize_partial_sponsors',
						)
					);
				}
			//Our Sponsors in Discription
				$wp_customize->add_setting( 'our_sponsors_main_discription', array(
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_sponsors_main_discription',
			    	array(
						'type' => 'textarea',
						'settings' => 'our_sponsors_main_discription',
						'section' => 'goldly_our_sponsors_section', // // Add a default or your own section
						'label' => 'Our Sponsors Discription', 
						'active_callback' => 'goldly_our_sponsors_general_callback',    
					)
				) );	
			//Our Sponsors in number of section
			    $wp_customize->add_setting( 'our_sponsors_number', array(
			    	'default'  => 5,
				    'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'goldly_sanitize_number_range',
				) );
				$wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'our_sponsors_number',
			    	array(
						'type' => 'number',
						'settings'   => 'our_sponsors_number', 
						'section' => 'goldly_our_sponsors_section', // // Add a default or your own section
						'label' => 'No. of Section',
						'description' => 'Save and refresh the page if No. of Section is changed (Max no of section is 5)',
						'input_attrs' => array(
									    'min' => 1,
									    'max' => 5,
									),	
						'active_callback' => 'goldly_our_sponsors_general_callback',    		   
					)
				) );
			$our_sponsors_number = get_theme_mod( 'our_sponsors_number', 5 );
				for ( $i = 1; $i <= $our_sponsors_number ; $i++ ) {
					//Our sponsors in headline
						$wp_customize->add_setting( 'our_sponsors_heading_'.$i, array(
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
					    	$wp_customize,'our_sponsors_heading_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_sponsors_heading_'.$i, 
								'section' => 'goldly_our_sponsors_section', 
								'label' => 'Our Sponsors ' .$i, 
								'active_callback' => 'goldly_our_sponsors_general_callback',    
							)
						) );
					//Our sponsors image option
				        $wp_customize->add_setting('our_sponsors_image_'.$i, array(
				        	'type'       => 'theme_mod',
					        'transport'     => 'refresh',
					        'height'        => 180,
					        'width'        => 160,
					        'capability' => 'edit_theme_options',
					        'sanitize_callback' => 'esc_url_raw'
					    ));
					    $wp_customize->add_control( new WP_Customize_Image_Control( 
					    	$wp_customize, 'our_sponsors_image_'.$i, array(
						        'label' => 'Image '.$i,
						        'section' => 'goldly_our_sponsors_section',
						        'settings' => 'our_sponsors_image_'.$i,
						        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
						        'active_callback' => 'goldly_our_sponsors_general_callback',    
						    )
					    ) );
					//Our sponsors in image link
						$wp_customize->add_setting( 'our_sponsors_image_link_'.$i, array(
						    'type'       => 'theme_mod',
					        'transport'   => 'refresh',
					        'capability'     => 'edit_theme_options',
					        'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( new WP_Customize_Control(
					    	$wp_customize,'our_sponsors_image_link_'.$i,
					    	array(
								'type' => 'text',
								'settings'   => 'our_sponsors_image_link_'.$i, 
								'section' => 'goldly_our_sponsors_section', 
								'label' => 'Image Link ' .$i,
								'active_callback' => 'goldly_our_sponsors_general_callback',    
							)
						) );
				}
				//Our sponsors in pro option
					$wp_customize->add_setting('our_sponsors_pro', array(
				        'type'       => 'theme_mod',
				        'transport'   => 'refresh',
				        'capability'     => 'edit_theme_options',
				        'sanitize_callback' => 'sanitize_text_field',
				    ));
				    $wp_customize->add_control( new Goldly_pro_option_Control(
				    	$wp_customize,'our_sponsors_pro',
				    	array(
					        'settings' => 'our_sponsors_pro',
					        //'label'   => 'More Options Available in Goldly Pro!',
					        'section' => 'goldly_our_sponsors_section',
					        'active_callback' => 'goldly_our_sponsors_general_callback',    
				        )
				    ));
				//Our sponsors in Text color
					$wp_customize->add_setting( 'our_sponsors_text_color', 
				        array(
				            'default'    => '#333', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'our_sponsors_text_color', 
				        array(
				            'label'      => __( 'Text Color', 'goldly' ), 
				            'settings'   => 'our_sponsors_text_color', 
				            'priority'   => 10,
				            'section'    => 'goldly_our_sponsors_section',
				            'active_callback' => 'goldly_our_sponsors_design_callback',      
				        ) 
			        ) ); 
			    //Our sponsors in background color
					$wp_customize->add_setting( 'our_sponsors_bg_color', 
				        array(
				            'default'    => '#eee', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'our_sponsors_bg_color', 
				        array(
				            'label'      => __( 'Background Color', 'goldly' ), 
				            'settings'   => 'our_sponsors_bg_color', 
				            'priority'   => 10,
				            'section'    => 'goldly_our_sponsors_section',  
				            'active_callback' => 'goldly_our_sponsors_design_callback',    
				        ) 
			        ) );  	
			    //Our sponsors in image hover background color
					$wp_customize->add_setting( 'our_sponsors_img_hover_bg_color', 
				        array(
				            'default'    => '#fff', //Default setting/value to save
				            'type'       => 'theme_mod',
				            'transport'   => 'refresh',
				            'capability' => 'edit_theme_options',
				            'sanitize_callback' => 'sanitize_hex_color',
				        ) 
				    ); 
			        $wp_customize->add_control( new WP_Customize_Color_Control( 
				        $wp_customize,'our_sponsors_img_hover_bg_color', 
				        array(
				            'label'      => __( 'Image Hover Background Color', 'goldly' ), 
				            'settings'   => 'our_sponsors_img_hover_bg_color', 
				            'priority'   => 10,
				            'section'    => 'goldly_our_sponsors_section', 
				            'active_callback' => 'goldly_our_sponsors_design_callback',     
				        ) 
			        ) );  	 	

		//Ordering Section
			$wp_customize->add_section( 'global_ordering_section' , array(
				'title'  => 'Home Page Hide & show Section',
				'panel'  => 'goldly_theme_section',	
			) );
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
							'Goldly_our_portfolio_section'	=> 'Our Portfolio',
							'Goldly_our_team_section'	=> 'Our Team',
							'Goldly_our_testimonial_section'	=> 'Our Testimonial',
							'Goldly_our_services_section'	=> 'Our Services',	
							'Goldly_our_sponsors_section'	=> 'Our Sponsors',												
						),
				    )
				));

				$wp_customize->add_setting('goldly_diseble', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_diseble',
			    	array(
				        'settings' => 'goldly_diseble',
				        'section' => 'global_ordering_section',
				        'type'    => 'hidden',
				    )
				));	

				//Featured Slider in pro option
				$wp_customize->add_setting('goldly_hide_show_pro', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new Goldly_drag_drop_option_Control(
			    	$wp_customize,'goldly_hide_show_pro',
			    	array(
				        'settings' => 'goldly_hide_show_pro',
				        'label'   => 'Drag & Drop Section in Goldly Pro!',
				        'section' => 'global_ordering_section',
			        )
			    ));		

		//Design Section
			$wp_customize->add_section( 'global_thme_design_section' , array(
				'title'  => 'Design',
				'panel'  => 'goldly_theme_section',	
			) );
			//Design in Heding Underline color
				$wp_customize->add_setting( 'design_heding_underline_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'design_heding_underline_color', 
			        array(
			            'label'      => __( 'Heading Underline Color', 'goldly' ), 
			            'settings'   => 'design_heding_underline_color', 
			            'priority'   => 10,
			            'section'    => 'global_thme_design_section',     
			        ) 
		        ) );
	
    //Footer create in globly
		//footer section
			$wp_customize->add_section( 'goldly_footer_section' , array(
				'title'  => 'Footer',
				'priority'  => 6,
			) );
			//footer contain width
		        $wp_customize->add_setting('goldly_footer_width_layout', array(
			        'default'        => 'content_width',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_footer_width_layout',
			    	array(
				        'settings' => 'goldly_footer_width_layout',
				        'label'   => 'Footer Width Layouts',
				        'section' => 'goldly_footer_section',
				        'type'    => 'select',
				        'choices' => array(
				        			'full_width' => 'Full Width',
				        			'content_width' => 'Content Width',
				        ),
			        )
			    ));
			//Container Option in footer container width
		        $wp_customize->add_setting('goldly_footer_container_width', array(
			        'default'        => '1100',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_footer_container_width',
			    	array(
				        'settings' => 'goldly_footer_container_width',
				        'label'   => 'Footer Content Width',
				        'description' => 'in px',
				        'section' => 'goldly_footer_section',
				        'type'    => 'text',
				        'active_callback'  => 'goldly_footer_content_width_callback',
			        )
			    ));

			//footer Colors title
		        $wp_customize->add_setting('footer_color_title', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
			    	$wp_customize,'footer_color_title',
			    	array(
				        'settings' => 'footer_color_title',
				        'label'   => 'Footer Colors',
				        'section' => 'goldly_footer_section',
			        )
			    ));
			//footer in add Background color
			    $wp_customize->add_setting( 'goldly_footer_bg_color', 
			        array(
			            'default'    => '#273641', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_footer_bg_color', 
			        array(
			            'label'      => __( 'Background Color', 'goldly' ), 
			            'settings'   => 'goldly_footer_bg_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_footer_section',
			        ) 
		        ) );  
			//footer in add Text color
			    $wp_customize->add_setting( 'goldly_footer_text_color', 
			        array(
			            'default'    => '#02cfaa', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_footer_text_color', 
			        array(
			            'label'      => __( 'Text Color', 'goldly' ), 
			            'settings'   => 'goldly_footer_text_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_footer_section',
			        ) 
		        ) );  
		    //footer in add link color
			    $wp_customize->add_setting( 'goldly_footer_link_color', 
			        array(
			            'default'    => '#ffffff', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_footer_link_color', 
			        array(
			            'label'      => __( 'Link Color', 'goldly' ), 
			            'settings'   => 'goldly_footer_link_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_footer_section',
			        ) 
		        ) );  
		    //footer in add link hover color
			    $wp_customize->add_setting( 'goldly_footer_link_hover_color', 
			        array(
			            'default'    => '#afafaf', //Default setting/value to save
			            'type'       => 'theme_mod',
			            'transport'   => 'refresh',
			            'capability' => 'edit_theme_options',
			            'sanitize_callback' => 'sanitize_hex_color',
			        ) 
			    ); 
		        $wp_customize->add_control( new WP_Customize_Color_Control( 
			        $wp_customize,'goldly_footer_link_hover_color', 
			        array(
			            'label'      => __( 'Link Hover Color', 'goldly' ), 
			            'settings'   => 'goldly_footer_link_hover_color', 
			            'priority'   => 10,
			            'section'    => 'goldly_footer_section',
			        ) 
		        ) );
		    //footer backgroung image title
		        $wp_customize->add_setting('footer_bg_section', array(
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',	
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new goldly_GeneratePress_Upsell_Section(
			    	$wp_customize,'footer_bg_section',
			    	array(
				        'settings' => 'footer_bg_section',
				        'label'   => 'Footer Background Image',
				        'section' => 'goldly_footer_section',
			        )
			    ));
		    //footer background image option
		        $wp_customize->add_setting('feature_product', array(
		        	'type'       => 'theme_mod',
			        'transport'     => 'refresh',
			        'height'        => 180,
			        'width'        => 160,
			        'capability' => 'edit_theme_options',
			        'sanitize_callback' => 'esc_url_raw'
			    ));
			    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'feature_product', array(
			        'label' => __('Backgroung Image', 'goldly'),
			        'section' => 'goldly_footer_section',
			        'settings' => 'feature_product',
			        'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
			    )));
			//footer in image background position
			    $wp_customize->add_setting('goldly_footer_bg_position', array(
			        'default'        => 'center center',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_footer_bg_position',
			    	array(
				        'settings' => 'goldly_footer_bg_position',
				        'label'   => 'Background Position',
				        'section' => 'goldly_footer_section',
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
			//footer in image background attachment
			    $wp_customize->add_setting('goldly_footer_bg_attachment', array(
			        'default'        => 'scroll',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_footer_bg_attachment',
			    	array(
				        'settings' => 'goldly_footer_bg_attachment',
				        'label'   => 'Background Attachment',
				        'section' => 'goldly_footer_section',
				        'type'  => 'select',
				        'choices'    => array(
				        	'scroll' => 'Scroll',
				        	'fixed' => 'Fixed',
			        	),
			        )
			    ));
			//footer in image background Size
			    $wp_customize->add_setting('goldly_footer_bg_size', array(
			        'default'        => 'cover',
			        'type'       => 'theme_mod',
			        'transport'   => 'refresh',
			        'capability'     => 'edit_theme_options',		
			        'sanitize_callback' => 'sanitize_text_field',
			    ));
			    $wp_customize->add_control( new WP_Customize_Control(
			    	$wp_customize,'goldly_footer_bg_size',
			    	array(
				        'settings' => 'goldly_footer_bg_size',
				        'label'   => 'Background Size',
				        'section' => 'goldly_footer_section',
				        'type'  => 'select',
				        'choices'    => array(
				        	'auto' => 'Auto',
				        	'cover' => 'Cover',
				            'contain' => 'Contain'
			        	),
			        )
			    ));  

	//logo option in image width title_tagline
	    $wp_customize->add_setting('goldly_logo_width', array(
	    	'default'    => '150',
	        'type'       => 'theme_mod',
	        'capability' => 'edit_theme_options',
	        'transport'  => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',		  
	    ));
	    $wp_customize->add_control( new WP_Customize_Control(
	    	$wp_customize,'goldly_logo_width',
	    	array(
		        'settings' => 'goldly_logo_width',
		        'label'    => 'Logo Image Width',
		        'section'  => 'title_tagline',
		        'type'  => "number",
		        'description' => 'in px',
	        )
	    ));
	//$wp_customize->get_section('goldly_our_team_section')->title = __( 'Product Sale' );

}
add_action( 'customize_register', 'goldly_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function goldly_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function goldly_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function goldly_customize_preview_js() {
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'goldly-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
	wp_register_script( 'goldly-customize-custom-js', get_template_directory_uri() . '/assets/js/customs.js' );
	$temp = array(
    	'ajaxUrl' => admin_url( 'admin-ajax.php' )
	);
}
add_action( 'customize_preview_init', 'goldly_customize_preview_js' );

function goldly_customizer_css() {

    wp_enqueue_style( 'goldly-customize-controls-style', get_template_directory_uri() . '/assets/css/customizer-admin.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'goldly_customizer_css',0 );

if ( ! function_exists( 'goldly_sanitize_select' ) ) :

    /**
     * Sanitize select.
     *
     * @since 1.0.0
     *
     * @param mixed                $input The value to sanitize.
     * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
     * @return mixed Sanitized value.
     */
    function goldly_sanitize_select( $input, $setting ) {

        // Ensure input is a slug.
        $input = sanitize_text_field( $input );

        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

    }
endif;
if ( ! function_exists( 'goldly_sanitize_checkbox' ) ) :

    /**
     * Sanitize checkbox.
     *
     * @since 1.0.0
     *
     * @param bool $checked Whether the checkbox is checked.
     * @return bool Whether the checkbox is checked.
     */
    function goldly_sanitize_checkbox( $checked ) {

        return ( ( isset( $checked ) && true === $checked ) ? true : false );

    }
endif;

add_action( 'wp_enqueue_scripts', 'goldly_theme_scripts' );
function goldly_theme_scripts() {

	
    $goldly_body_fontfamily = get_theme_mod("goldly_body_fontfamily",5);    
    if($goldly_body_fontfamily!=''){
        global $goldly_fonttotal;
        $font_args = array(
            'family'    => rawurlencode($goldly_fonttotal[$goldly_body_fontfamily]),
        );
        $font_url = add_query_arg($font_args,'//fonts.googleapis.com/css');
        wp_enqueue_style( 'factory-lite-font', $font_url, array() );
    }
    $goldly_Heading_fontfamily = get_theme_mod("goldly_Heading_fontfamily",5);    
    if($goldly_Heading_fontfamily!=''){
        global $goldly_fonttotal;
        $font_args = array(
            'family'    => rawurlencode($goldly_fonttotal[$goldly_Heading_fontfamily]),
        );
        $font_url = add_query_arg($font_args,'//fonts.googleapis.com/css');
        wp_enqueue_style( 'factory-lite-font-a', $font_url, array() );
    }
    $goldly_Heading1_fontfamily = get_theme_mod("goldly_Heading1_fontfamily",5);    
    if($goldly_Heading1_fontfamily!=''){
        global $goldly_fonttotal;
        $font_args = array(
            'family'    => rawurlencode($goldly_fonttotal[$goldly_Heading1_fontfamily]),
        );
        $font_url = add_query_arg($font_args,'//fonts.googleapis.com/css');
        wp_enqueue_style( 'factory-lite-font-b', $font_url, array() );
    }
    $goldly_Heading2_fontfamily = get_theme_mod("goldly_Heading2_fontfamily",5);    
    if($goldly_Heading2_fontfamily!=''){
        global $goldly_fonttotal;
        $font_args = array(
            'family'    => rawurlencode($goldly_fonttotal[$goldly_Heading2_fontfamily]),
        );
        $font_url = add_query_arg($font_args,'//fonts.googleapis.com/css');
        wp_enqueue_style( 'factory-lite-font-c', $font_url, array() );
    }
    $goldly_Heading3_fontfamily = get_theme_mod("goldly_Heading3_fontfamily",5);    
    if($goldly_Heading3_fontfamily!=''){
        global $goldly_fonttotal;
        $font_args = array(
            'family'    => rawurlencode($goldly_fonttotal[$goldly_Heading3_fontfamily]),
        );
        $font_url = add_query_arg($font_args,'//fonts.googleapis.com/css');
        wp_enqueue_style( 'factory-lite-font-d', $font_url, array() );
    }
}  

function goldly_call_menu_btn_callback(){
	$goldly_call_menu_btn = get_theme_mod( 'goldly_call_menu_btn');
	if ( true === $goldly_call_menu_btn ) {
		return true;
	}
	return false;
}
if ( ! function_exists( 'goldly_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function goldly_site_layout() {
        $goldly_site_layout = array(
            'no_sidebar'  => get_template_directory_uri() . '/assets/images/full.png',
            'left_sidebar' => get_template_directory_uri() . '/assets/images/left.png',
            'right_sidebar' => get_template_directory_uri() . '/assets/images/right.png',
        );
        $output = apply_filters( 'goldly_site_layout', $goldly_site_layout );
        return $output;
    }
endif;

function goldly_header2_callback(){
	$goldly_header_layout = get_theme_mod( 'goldly_header_layout','header4');
	if ( 'header2' === $goldly_header_layout ) {
		return true;
	}
	return false;
}
function goldly_grid_view_callback(){
	$goldly_container_blog_layout = get_theme_mod( 'goldly_container_blog_layout','grid_view');
	if ( 'grid_view' === $goldly_container_blog_layout ) {
		return true;
	}
	return false;
}
function goldly_content_boxed_callback(){
	$goldly_container_page_layout = get_theme_mod( 'goldly_container_page_layout','content_boxed');
	if ( 'content_boxed' === $goldly_container_page_layout ) {
		return true;
	}
	return false;
}
function goldly_boxed_layout_callback(){
	$goldly_container_page_layout = get_theme_mod( 'goldly_container_page_layout','content_boxed');
	if ( 'boxed_layout' === $goldly_container_page_layout ) {
		return true;
	}
	return false;
}

if ( ! function_exists( 'goldly_header_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function goldly_header_site_layout() {
        $goldly_header_site_layout = array(
            //'header1'  => get_template_directory_uri() . '/assets/images/header1.png',
            'header2' => get_template_directory_uri() . '/assets/images/header2.png',
            'header4' => get_template_directory_uri() . '/assets/images/header4.png',
        );

        $output = apply_filters( 'goldly_header_site_layout', $goldly_header_site_layout );
        return $output;
    }
endif;
function goldly_customize_partial_name() {
	bloginfo( 'our_portfolio_main_title' );
}
function goldly_customize_partial_our_team(){
	bloginfo( 'our_team_main_title' );
}
function goldly_customize_partial_testimonial(){
	bloginfo( 'our_testimonial_main_title' );
}
function goldly_customize_partial_services(){
	bloginfo( 'our_services_main_title' );
}
function goldly_customize_partial_sponsors(){
	bloginfo( 'our_sponsors_main_title' );
}
function goldly_customize_partial_about(){
	bloginfo( 'about_title_section' );
}
function goldly_customize_partial_featured_section(){
	bloginfo( 'featured_section_number' );
}
function goldly_customize_partial_featured_slider(){
	bloginfo( 'featuredimage_slider_number' );
}
function goldly_customize_partial_breadcrumb(){
	bloginfo( 'goldly_display_breadcrumb_section' );
}
function goldly_featured_slider_callback(){
	$featured_slider_autoplay = get_theme_mod( 'featured_slider_autoplay','true');
	if ( 'true' === $featured_slider_autoplay ) {
		return true;
	}
	return false;
}
function goldly_scroll_callback(){
	$display_scroll_button = get_theme_mod( 'display_scroll_button');
	if ( true === $display_scroll_button ) {
		return true;
	}
	return false;
}

function goldly_sanitize_number_range( $number, $setting ) {

    // Ensure input is an absolute integer.
    $number = absint( $number );

    // Get the input attributes associated with the setting.
    $atts = $setting->manager->get_control( $setting->id )->input_attrs;


    // Get minimum number in the range.
    $min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

    // Get maximum number in the range.
    $max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

    // Get step.
    $step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

    // If the number is within the valid range, return it; otherwise, return the default
    return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}
function goldly_featured_design_callback(){
	$featuredimage_slider_tab = get_theme_mod( 'featuredimage_slider_tab','general');
	if ( 'design' === $featuredimage_slider_tab ) {
		return true;
	}
	return false;
}
function goldly_featured_generalcallback(){
	$featuredimage_slider_tab = get_theme_mod( 'featuredimage_slider_tab','general');
	if ( 'general' === $featuredimage_slider_tab ) {
		return true;
	}
	return false;
}
function goldly_featured_section_callback(){
	$featured_section_tab = get_theme_mod( 'featured_section_tab','general');
	if ( 'general' === $featured_section_tab ) {
		return true;
	}
	return false;
}
function goldly_featured_section_design_callback(){
	$featured_section_tab = get_theme_mod( 'featured_section_tab','general');
	if ( 'design' === $featured_section_tab ) {
		return true;
	}
	return false;
}
function goldly_about_section_general_callback(){
	$about_section_tab = get_theme_mod( 'about_section_tab','general');
	if ( 'general' === $about_section_tab ) {
		return true;
	}
	return false;
}
function goldly_about_section_design_callback(){
	$about_section_tab = get_theme_mod( 'about_section_tab','general');
	if ( 'design' === $about_section_tab ) {
		return true;
	}
	return false;
}
function goldly_our_portfolio_general_callback(){
	$our_portfolio_section_tab = get_theme_mod( 'our_portfolio_section_tab','general');
	if ( 'general' === $our_portfolio_section_tab ) {
		return true;
	}
	return false;
}
function goldly_our_portfolio_design_callback(){
	$our_portfolio_section_tab = get_theme_mod( 'our_portfolio_section_tab','general');
	if ( 'design' === $our_portfolio_section_tab ) {
		return true;
	}
	return false;
}
function goldly_our_team_general_callback(){
	$our_team_section_tab = get_theme_mod( 'our_team_section_tab','general');
	if ( 'general' === $our_team_section_tab ) {
		return true;
	}
	return false;
}
function goldly_our_team_design_callback(){
	$our_team_section_tab = get_theme_mod( 'our_team_section_tab','general');
	if ( 'design' === $our_team_section_tab ) {
		return true;
	}
	return false;
}
function goldly_our_testimonial_general_callback(){
	$our_testimonial_section_tab = get_theme_mod( 'our_testimonial_section_tab','general');
	if ( 'general' === $our_testimonial_section_tab ) {
		return true;
	}
	return false;
}
function goldly_our_testimonial_design_callback(){
	$our_testimonial_section_tab = get_theme_mod( 'our_testimonial_section_tab','general');
	if ( 'design' === $our_testimonial_section_tab ) {
		return true;
	}
	return false;
}
function goldly_our_services_general_callback(){
	$our_services_tab = get_theme_mod( 'our_services_tab','general');
	if ( 'general' === $our_services_tab ) {
		return true;
	}
	return false;
}
function goldly_our_services_design_callback(){
	$our_services_tab = get_theme_mod( 'our_services_tab','general');
	if ( 'design' === $our_services_tab ) {
		return true;
	}
	return false;
}
function goldly_our_sponsors_general_callback(){
	$our_sponsors_tab = get_theme_mod( 'our_sponsors_tab','general');
	if ( 'general' === $our_sponsors_tab ) {
		return true;
	}
	return false;
}
function goldly_our_sponsors_design_callback(){
	$our_sponsors_tab = get_theme_mod( 'our_sponsors_tab','general');
	if ( 'design' === $our_sponsors_tab ) {
		return true;
	}
	return false;
}
function goldly_breadcrumb_call_back(){
	$goldly_display_breadcrumb_section = get_theme_mod( 'goldly_display_breadcrumb_section',true);
	if ( true === $goldly_display_breadcrumb_section ) {
		return true;
	}
	return false;
}
function goldly_header4_callback(){
	$goldly_header_layout = get_theme_mod( 'goldly_header_layout','header4');
	if ( 'header4' === $goldly_header_layout ) {
		return true;
	}
	return false;
}
function goldly_header_content_width_callback(){
	$goldly_header_width_layout = get_theme_mod( 'goldly_header_width_layout','content_width');
	if ( 'content_width' === $goldly_header_width_layout ) {
		return true;
	}
	return false;
}
function goldly_top_bar_content_width_callback(){
	$goldly_top_bar_width_layout = get_theme_mod( 'goldly_top_bar_width_layout','content_width');
	if ( 'content_width' === $goldly_top_bar_width_layout ) {
		return true;
	}
	return false;
}
function goldly_footer_content_width_callback(){
	$goldly_footer_width_layout = get_theme_mod( 'goldly_footer_width_layout','content_width');
	if ( 'content_width' === $goldly_footer_width_layout ) {
		return true;
	}
	return false;
}
function goldly_custom_sanitization_callback( $value ) {
	// This pattern will check and match 3/6/8-character hex, rgb, rgba, hsl, & hsla colors.
	$pattern = '/^(\#[\da-f]{3}|\#[\da-f]{6}|\#[\da-f]{8}|rgba\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)(,\s*(0\.\d+|1))\)|hsla\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)(,\s*(0\.\d+|1))\)|rgb\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)|hsl\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)\))$/';
	\preg_match( $pattern, $value, $matches );
	// Return the 1st match found.
	if ( isset( $matches[0] ) ) {
		if ( is_string( $matches[0] ) ) {
			return $matches[0];
		}
		if ( is_array( $matches[0] ) && isset( $matches[0][0] ) ) {
			return $matches[0][0];
		}
	}
	// If no match was found, return an empty string.
	return '';
}

