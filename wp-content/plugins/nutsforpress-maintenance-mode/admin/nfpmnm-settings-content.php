<?php
//if this file is called directly, die.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//define a function to be used further
if(!function_exists('nfpmnm_post_type_to_include')) {
	
	function nfpmnm_post_type_to_include() {

		$nfpmnm_registered_post_types_args = array(
		
			'exclude_from_search' => false,
			'public'   => true,
			'_builtin' => false,
			'publicly_queryable' => true
			
		);
			
		$nfpmnm_registered_post_types = get_post_types($nfpmnm_registered_post_types_args);
	
		//define builtin post types
		$nfpmnm_post_types_to_search = array('post','page');
		
		foreach($nfpmnm_registered_post_types as $nfpmnm_registered_post_type){
			
			//add custom post types
			$nfpmnm_post_types_to_search[] = $nfpmnm_registered_post_type;
			
		}
		
		return $nfpmnm_post_types_to_search;
		
	}
		
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpmnm_post_type_to_include" already exists');
	
}
	
//with this function we will define the NutsForPress menu page content
if(!function_exists('nfpmnm_settings_content')) {
	
	function nfpmnm_settings_content() {

		//create steps for page dropdown
		$nfpmnm_page_dropdown_values = array();
		$nfpmnm_page_dropdown_step = 1;
				
		$nfpmnm_home_page_id = get_option('page_on_front');
				
		if(!empty($nfpmnm_home_page_id)) {
			
			$nfpmnm_page_dropdown_values[$nfpmnm_page_dropdown_step]['option-value'] = $nfpmnm_home_page_id;
			$nfpmnm_page_dropdown_values[$nfpmnm_page_dropdown_step]['option-text'] = 'Homepage (id: '.$nfpmnm_home_page_id.')';
			$nfpmnm_page_dropdown_values[$nfpmnm_page_dropdown_step]['option-selected'] = 'selected';
			$nfpmnm_page_dropdown_step++;
			
		}
		
		$nfpmnm_pages_query_args = array(
		
			'post_type' => nfpmnm_post_type_to_include(),
			'post_status' => array('publish'),
			'post__not_in' => array($nfpmnm_home_page_id),
			'orderby' => 'post_title',
			'order' => 'asc',
			'posts_per_page' => -1,	
			'meta_query' => array(
			
				'relation' => 'AND',
								
				array(
				
					'key' => '_nfpmnm_is_restricted',
					'compare' => 'NOT EXISTS'
				),

				array(
				
					'key' => '_rsmd_is_restricted',
					'compare' => 'NOT EXISTS'
					
				)
				
			)
						
		);
		 
		$nfpmnm_pages_query = new WP_Query($nfpmnm_pages_query_args);
		 
		if($nfpmnm_pages_query->have_posts()){

			while($nfpmnm_pages_query->have_posts()) {
				
				$nfpmnm_pages_query->the_post();
				
				$nfpmnm_page_id = get_the_ID();
				$nfpmnm_page_title = get_the_title();
				
				$nfpmnm_page_dropdown_values[$nfpmnm_page_dropdown_step]['option-value'] = $nfpmnm_page_id;
				$nfpmnm_page_dropdown_values[$nfpmnm_page_dropdown_step]['option-text'] = $nfpmnm_page_title.' (id: '.$nfpmnm_page_id.')';
				$nfpmnm_page_dropdown_values[$nfpmnm_page_dropdown_step]['option-selected'] = null;
				$nfpmnm_page_dropdown_step++;
				
			}
			
		} 
		
		wp_reset_postdata();
				
		//create steps for allowed administrators list
		$nfpmnm_login_allowed_users = get_users(   
			
			array(   
			
				'role' => 'administrator',
				'meta_key' => '_nfpmnm_can_login_on_maintenance',
				'meta_value' => '1',		
				'fields' => array(
				
					'ID',
					'display_name',
					'user_email',
				
				)
			
			) 
			
		);		
		
		if(
		
			empty($nfpmnm_login_allowed_users)
			|| !is_array($nfpmnm_login_allowed_users)
			
		){
			
			$nfprct_administrators_allowed_list = __('All the Administrators are currently allowed to login; if you want to allow to login only some of them, please move to their profiles and find the "Allow Login" checkbox', 'nfpmnmlang');
			
			
		} else {
			
			$nfprct_administrators_allowed_list = '<ul class="nfpmnm-administrators-list">';
			
			foreach($nfpmnm_login_allowed_users as $nfpmnm_login_allowed_user){
				
				$nfpmnm_login_allowed_user_profile_url = get_edit_user_link($nfpmnm_login_allowed_user->ID);
				
				$nfprct_administrators_allowed_list .= '<li><a href="'.$nfpmnm_login_allowed_user_profile_url.'#nfpmnm-login-on-maintenance">'.$nfpmnm_login_allowed_user->display_name.' ('.$nfpmnm_login_allowed_user->user_email.')</a></li>';				
			}
			
			$nfprct_administrators_allowed_list .= '</ul>';
			
			
		}
	
		$nfpmnm_settings_content = array(
		
			array(
			
				'container-title'	=> __('Maintenance Mode','nfpmnmlang'),
				
				'container-id'		=> 'nfpmnm_maintenance_mode_container',
				'container-class' 	=> 'nfpmnm-maintenance-mode-container',
				'input-name'		=> 'nfproot_maintenance_mode',
				'add-to-settings'	=> 'global',
				'data-save'			=> 'nfpmnm',
				'input-id'			=> 'nfpmnm_maintenance_mode',
				'input-class'		=> 'nfpmnm-maintenance-mode',
				'input-description'	=> __('If switched on, all the visitors that are not logged in as Administrator will be redirected to the page defined below','nfpmnmlang'),
				'arrow-before'		=> true,
				'after-input'		=> '',
				'input-type' 		=> 'switch',
				'input-value'		=> '1',
				
				'childs'			=> array(

					array(
						
						'container-title'	=> __('Landing Page','nfpmnmlang'),
					
						'container-id'		=> 'nfpmnm_landing_page_container',
						'container-class' 	=> 'nfpmnm-landing-page-container',					
						'input-name' 		=> 'nfproot_landing_page',
						'add-to-settings'	=> 'local',
						'data-save'			=> 'nfpmnm',
						'input-id' 			=> 'nfpmnm_landing_page',
						'input-class'		=> 'nfpmnm-landing-page',
						'input-description' => __('Select the page you want to redirect the visitors that are not logged in as Administrator','nfpmnmlang'),
						'arrow-before'		=> false,
						'after-input'		=> '',
						'input-type' 		=> 'dropdown',
						'input-value'		=> $nfpmnm_page_dropdown_values,
						
					),
					
					array(
						
						'container-title'	=> __('Redirect Sitemap','nfpmnmlang'),
					
						'container-id'		=> 'nfpmnm_redirect_sitemap_container',
						'container-class' 	=> 'nfpmnm-redirect-sitemap-container',					
						'input-name' 		=> 'nfproot_redirect_sitemap',
						'add-to-settings'	=> 'global',
						'data-save'			=> 'nfpmnm',
						'input-id' 			=> 'nfpmnm_redirect_sitemap',
						'input-class'		=> 'nfpmnm-redirect-sitemap',
						'input-description' => __('If switched on, the default WordPress sitemap page and the "NutsForPress Indexing and SEO" sitemap page will redirect all the visitors that are not logged in as Administrator to the above page too','nfpmnmlang'),
						'arrow-before'		=> false,
						'after-input'		=> '',
						'input-type' 		=> 'switch',
						'input-value'		=> '1',
						
					),
					
					array(
						
						'container-title'	=> __('Hide REST API','nfpmnmlang'),
					
						'container-id'		=> 'nfpmnm_restrict_rest_container',
						'container-class' 	=> 'nfpmnm-restrict-rest-container',					
						'input-name' 		=> 'nfproot_restrict_rest',
						'add-to-settings'	=> 'global',
						'data-save'			=> 'nfpmnm',
						'input-id' 			=> 'nfpmnm_restrict_rest',
						'input-class'		=> 'nfpmnm-restrict-rest',
						'input-description' => __('If switched on, the REST API pages will show an authentication error for all the visitors that are not logged in as Administrator','nfpmnmlang'),
						'arrow-before'		=> false,
						'after-input'		=> '',
						'input-type' 		=> 'switch',
						'input-value'		=> '1',
						
					),
					
				),
				
			),
			
			array(
			
				'container-title'	=> __('Administrators allowed to login','nfpmnmlang'),
				
				'container-id'		=> 'nfprct_administrators_allowed_container',
				'container-class' 	=> 'nfprct-administrators-allowed-container',
				'input-name'		=> 'nfproot_administrators_allowed',
				'add-to-settings'	=> 'global',
				'data-save'			=> 'nfprct',
				'input-id'			=> 'nfprct_administrators_allowed',
				'input-class'		=> 'nfprct-administrators-allowed',
				'input-description'	=> false,
				'arrow-before'		=> true,
				'after-input'		=> array(
				
					array(
					
						'type' 		=> 'paragraph',
						'id' 		=> 'nfpmnm_administrators_allowed_description',
						'class' 	=> 'nfproot-after-input nfpmnm-administrators-allowed-description',
						'hidden' 	=> false,
						'content' 	=> __('Click on the arrow to get a list of the Administrators currently allowed to login when Maintenance Mode is switched on','nfpmnmlang'),
						'value'		=> ''
					
					),
				
				),
				
				'input-type' 		=> false,
				'childs'			=> array(
					
					array(
					
						'container-title'	=> __('Administrators allowed list','nfpmnmlang'),
					
						'container-id'		=> 'nfprct_administrators_allowed_list_container',
						'container-class' 	=> 'nfprct-administrators-allowed-list-container',					
						'input-name' 		=> 'nfproot_administrators_allowed_list',
						'add-to-settings'	=> 'global',
						'data-save'			=> 'nfprct',
						'input-id' 			=> 'nfprct_administrators_allowed_list',
						'input-class'		=> 'nfprct-administrators-allowed-list',
						'input-description' => false,
						'arrow-before'		=> false,
						'after-input'		=> '',
						'input-type' 		=> 'textonly',
						'input-value'		=> $nfprct_administrators_allowed_list,
						
					),
					
				),
				
			),
				
		);
						
		return $nfpmnm_settings_content;
		
	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpmnm_settings_content" already exists');
	
}