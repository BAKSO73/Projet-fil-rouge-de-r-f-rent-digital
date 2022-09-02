<?php

// Exit if called directly
if (!defined('ABSPATH')) {
    exit();
}

if (!class_exists('S9_Social_Sharing')) {

    /**
     * The main class and initialization point of the plugin.
     */
    class S9_Social_Sharing
    {

        /**
         * Constructor
         */
        public function __construct()
        {

            // Declare constants and load dependencies.
            $this->define_constants();
            $this->load_dependencies();

            add_filter('script_loader_tag', array($this, 'social9_front_script'), 10, 3);
            add_action('wp_enqueue_scripts', array($this, 'enqueue_front_scripts'), 5);
            add_action('s9_admin_page', array($this, 'create_oss_menu'), 3);
        }

        function create_oss_menu()
        {

            //if (!class_exists('S9_Social_Login')) {
                // Create Menu.		
              //  add_menu_page('Social9', 'Social Sharing', 'manage_options', 'social9_share', array('S9_Social_Share_Admin', 'options_page'), S9_CORE_URL . 'assets/images/favicon.ico');
            //} else {
                // Add Social Sharing menu.
                add_submenu_page('social9', 'Social Sharing Settings', 'Social Sharing', 'manage_options', 'social9_share', array('S9_Social_Share_Admin', 'options_page'));
            //}
        }

        /**
         * Define constants needed across the plug-in.
         */
        private function define_constants()
        {
            define('S9_SHARE_PLUGIN_DIR', plugin_dir_path(__FILE__));
            define('S9_SHARE_PLUGIN_URL', plugin_dir_url(__FILE__));
        }

        /**
         * Function for adding default social_profile_data settings at activation.
         */
        public static function set_options($options) {
            update_option('social9_account_id',$options['account_id']);
            update_option('social9_apikey',$options['apikey']);
            update_option('social9_access_token',$options['access_token']);
        }

        public static function enqueue_front_scripts()
        {
            wp_enqueue_script("s9-sdk", "//cdn.social9.com/js/socialshare.min.js");
            wp_enqueue_style('s9-social-sharing-front', S9_SHARE_PLUGIN_URL . 'assets/css/s9-social-sharing-front.css', array(), S9_PLUGIN_VERSION);
        }
        /**
         * 
         */
        function social9_front_script($tag, $handle, $src)
        {
            $social9AccountId = get_option('social9_account_id');
            if ('s9-sdk' != $handle) {
                return $tag;
            }
            return '<script id="s9-sdk" async defer data-hide-popup="true" content="'.$social9AccountId.'" src="//cdn.social9.com/js/socialshare.min.js"></script>';
        }


        /**
         * Loads PHP files that required by the plug-in
         *
         * @global oss_commenting_settings
         */
        private function load_dependencies()
        {
            // Load Social9 files.
            require_once(S9_SHARE_PLUGIN_DIR . 'admin/s9-social-share-admin.php');
            require_once(S9_SHARE_PLUGIN_DIR . 'includes/shortcode/shortcode.php');
        }
    }

    new S9_Social_Sharing();
}
