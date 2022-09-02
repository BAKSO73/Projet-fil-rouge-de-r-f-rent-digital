<?php
//get_template_part( '/install-recommended-plugins/class-tgm-plugin-activation.php');
require_once get_template_directory() . '/install-recommended-plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'goldly_wtb_register_required_plugins' );

function goldly_wtb_register_required_plugins() {
	
	$plugins = array(            
        
        array(
            'name' => esc_html__('One Click Demo Import','goldly'),
            'slug' => 'one-click-demo-import',
            'required' => false,
        ),
        array(
            'name' => esc_html__('Reviewexchanger Demo Importer','goldly'),
            'slug' => 'reviewexchanger-demo-importer',
            'required' => false,
        ),
		array(
            'name' => esc_html__('Page Section For Themereviewer','goldly'),
            'slug' => 'page-section-for-themereviewer',
            'required' => false,
        ),
    );

	$plugins = apply_filters( 'goldly_recommended_plugins', $plugins );
	
	$config = array(
		'id'           => 'goldly',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}