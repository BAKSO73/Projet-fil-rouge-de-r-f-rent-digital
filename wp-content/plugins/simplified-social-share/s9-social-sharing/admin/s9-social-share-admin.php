<?php
// Exit if called directly
if (!defined('ABSPATH')) {
    exit();
}

/**
 * The main class and initialization point of the mailchimp plugin admin.
 */
if (!class_exists('S9_Social_Share_Admin')) {

    class S9_Social_Share_Admin
    {

        /**
         * S9_Social_Share_Admin class instance
         *
         * @var string
         */
        private static $instance;

        /**
         * Get singleton object for class S9_Social_Share_Admin
         *
         * @return object S9_Social_Share_Admin
         */
        public static function get_instance()
        {
            if (!isset(self::$instance) && !(self::$instance instanceof S9_Social_Share_Admin)) {
                self::$instance = new S9_Social_Share_Admin();
            }
            return self::$instance;
        }

        /*
         * Constructor for class S9_Social_Share_Admin
         */

        public function __construct()
        {
            require_once(S9_CORE_DIR . 'lib/social9_sdk.php');
            $this->s9sdk = new Social9();
            // Registering hooks callback for admin section.
            $this->register_hook_callbacks();

            add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'), 5);
            add_action('wp_ajax_social9_trigger_widget_status', array($this, 'social9TriggerWidgetStatus'));
            
        }

        /*
         * Register admin hook callbacks
         */

        public function register_hook_callbacks()
        {
            add_action('admin_init', array($this, 'admin_init'));
        }


        public static function enqueue_admin_scripts()
        {
            wp_enqueue_script("s9-jquery-ui", "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js", array('jquery'), S9_PLUGIN_VERSION);
            wp_enqueue_script("social9_sharing_admin", S9_SHARE_PLUGIN_URL."assets/js/social9_sharing_admin.js", array('s9-jquery-ui'), S9_PLUGIN_VERSION);
            wp_localize_script('social9_sharing_admin', 's9_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
            wp_enqueue_style('s9-admin-style');
        }

        /**
         * Callback for admin_menu hook,
         * Register Social9_settings and its sanitization callback. Add Login Radius meta box to pages and posts.
         */
        public function admin_init()
        {
            register_setting('oss_share_settings', 'Social9_share_settings');
        }

        public function social9TriggerWidgetStatus(){
            $widgetId = isset($_POST['widget_id']) ? trim($_POST['widget_id']) : "";
            $widgetAction = isset($_POST['widget_action']) ? trim($_POST['widget_action']) : "active";
            $output = array();
            $output["status"] = "error";
            if (empty($widgetId)) {
                $output["message"] = _e("Widget ID is Required.", "Social9");
            } else if (!is_email($widgetAction)) {
                $output["message"] = _e("Widget Action is Invalid.", "Social9");
            } else {
                $actionFunction = $widgetAction == "active"?'deactiveWidget':'activeWidget';
                $social9AccountId = get_option('social9_account_id');
                $social9AccessToken = get_option('social9_access_token');
                $output["data"] = $actionFunction($social9AccountId, $widgetId, $social9AccessToken);
            }
            //save plugin options data user_id and apikey
            echo json_encode($output);
            wp_die();
        }

        /*
         * Callback for add_menu_page,
         * This is the first function which is called while plugin admin page is requested
         */
        public static function options_page()
        {
            include_once S9_SHARE_PLUGIN_DIR . "admin/s9-widget-list-table.php";
            include_once S9_SHARE_PLUGIN_DIR . "admin/views/settings.php";
            S9_Social_Share_Settings::render_options_page();
        }
    }

    new S9_Social_Share_Admin();
}
