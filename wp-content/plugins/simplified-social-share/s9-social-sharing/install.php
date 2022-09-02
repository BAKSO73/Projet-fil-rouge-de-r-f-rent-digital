<?php

// Exit if called directly
if (!defined('ABSPATH')) {
    exit();
}
if (!class_exists('S9_Sharing_Install')) {

    /**
     * class responsible for setting default settings for social invite.
     */
    class S9_Sharing_Install {

        /**
         * Constructor
         */
        public function __construct() {
            add_action('admin_enqueue_scripts', array($this, 'share_add_stylesheet'));
            add_action('wp_footer', array($this, 'enqueue_share_scripts'), 1);
        }

        

        /**
         * Add stylesheet and JavaScript to admin section.
         */
        public function share_add_stylesheet($hook) {
            wp_enqueue_style('oss_sharing_style', plugins_url('/assets/css/s9-social-sharing-admin.css', __FILE__));
            wp_enqueue_script('oss_share_admin_javascript', plugins_url('/assets/js/social9_sharing_admin.js', __FILE__), array('jquery'), false, true);
        }

        /**
         * Add stylesheet and JavaScript to client sections
         */
        public function enqueue_share_scripts() {
            wp_enqueue_script('s9-social-sharing');
        }


    }

    new S9_Sharing_Install();
}
