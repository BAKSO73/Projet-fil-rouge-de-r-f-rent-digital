<?php
// Exit if called directly
if (!defined('ABSPATH')) {
    exit();
}

if (!class_exists('S9_Activation_Admin')) {

    /**
     * The main class and initialization point of the plugin.
     */
    class S9_Activation_Admin
    {

        /**
         * Constructor
         */
        public function __construct()
        {
            require_once(S9_CORE_DIR . 'lib/social9_sdk.php');
            $this->s9sdk = new Social9();
            add_action('wp_ajax_social9_login', array($this, 'social9Login'));
            add_action('wp_ajax_social9_register', array($this, 'social9Register'));
            add_action('wp_ajax_social9_generate_apikey', array($this, 'social9GenerateApikeyByAccesstoken'));
            add_action('wp_ajax_social9_get_access_token', array($this, 'social9GetAccessToken'));
            add_action('wp_ajax_social9_trigger_widget_status', array($this, 'social9TriggerWidgetStatus'));

            add_action('wp_ajax_social9_create_widget', array($this, 'social9CreateWidget'));
            add_action('wp_ajax_social9_guest_widget', array($this, 'social9GuestWidget'));
        }
        /*
         * Callback for add_menu_page,
         * This is the first function which is called while plugin admin page is requested
         */
        public static function options_page()
        {
            require_once(S9_CORE_DIR . "admin/views/settings.php");
            S9_Core_Settings::render_options_page();
        }
        /**
         * 
         */
        public function social9Login()
        {
            $email = isset($_POST['email']) ? trim($_POST['email']) : "";
            $password = isset($_POST['password']) ? trim($_POST['password']) : "";
            $output = array();
            $output["status"] = "error";
            if (!is_email($email)) {
                $output["message"] = _e("Email is Invalid.", "Social9");
            } else if (empty($password)) {
                $output["message"] = _e("Password is Required.", "Social9");
            } else {
                $loginData = $this->s9sdk->login($email, $password);
                if (isset($loginData['access_token']) && !empty($loginData['access_token'])) {
                    //call generate API 
                    $this->social9GenerateApikey($loginData["Profile"]["Uid"], "WordPressAPI", $loginData["access_token"]);
                } else {
                    $output["data"] = $loginData;
                }
            }
            echo json_encode($output);
            wp_die();
        }
        function social9TriggerWidgetStatus()
        {
            $widget_action = isset($_POST['widget_action']) ? trim($_POST['widget_action']) : "";
            $widget_id = isset($_POST['widget_id']) ? trim($_POST['widget_id']) : "";
            $output = array();
            $output["status"] = "error";
            if (empty($widget_action)) {
                $output["message"] = _e("[widget_action] is Invalid.", "Social9");
            } else if (empty($widget_id)) {
                $output["message"] = _e("[widget_id] is Required.", "Social9");
            } else {
                if (in_array($widget_action, array("active", "deactive"))) {
                    $uid = get_option('social9_account_id');
                    $access_token = get_option('social9_access_token');
                    $function = $widget_action . "Widget";
                    $output['data'] = $this->s9sdk->$function($uid, $widget_id, $access_token);
                    $output["status"] = "success";
                } else {
                    $output["message"] = _e("[widget_action] is Invalid.", "Social9");
                }
            }
            echo json_encode($output);
            wp_die();
        }
        function social9CreateWidget()
        {
            $uid = get_option('social9_account_id');
            $access_token = get_option('social9_access_token');
            $wid = isset($_POST['id']) ? $_POST['id'] : "";
            if (!empty($wid)) {
                $output = $this->s9sdk->updateWidget($uid, $wid, $access_token, $this->getWidgetPayload($_POST));
            } else {
                $output = $this->s9sdk->createWidget($uid, $access_token, $this->getWidgetPayload($_POST));
            }
            echo json_encode($output);
            wp_die();
        }
        function social9GuestWidget()
        {
            update_option('social9_guest_widget', json_encode($this->getWidgetPayload($_POST)));
            wp_die();
        }

        function getWidgetPayload($post)
        {
            $payload = array(
                'name' => $post["name"] ? $post["name"] : "",
                'widget_category' => 'sharing',
                'widget_type' => $post["widget_type"] ? $post["widget_type"] : "",
                'providers' =>
                array(
                    'list' => $post["providers"]["list"] ? $post["providers"]["list"] : array(),
                    'use_default_buttons' => $post["providers"]["use_default_buttons"] == "true" ? true : false,
                    'max_visible_providers' => count($post["providers"]["list"]) + 1,
                ),
                'design' =>
                array(
                    'buttons' =>
                    array(
                        'size' => $post["design"]["buttons"]["size"],
                        'color' => $post["design"]["buttons"]["color"],
                        'bg_color' => $post["design"]["buttons"]["bg_color"],
                        'icon_color' => $post["design"]["buttons"]["icon_color"],
                        'border_radius' => (int)$post["design"]["buttons"]["border_radius"],
                        'hide_label' => $post["design"]["buttons"]["hide_label"] == "true" ? true : false,
                    ),
                    'animations' =>
                    array(
                        'entrance' => $post["design"]["animations"]["entrance"],
                        'hover' => $post["design"]["animations"]["hover"],
                    ),
                ),
                'options' =>
                array(
                    'counter' =>
                    array(
                        'type' => $post["options"]["counter"]["type"],
                        'min_show_count' => (int)$post["options"]["counter"]["min_show_count"],
                    ),
                    'container' => $post["options"]["container"],
                ),
                'layout' =>
                array(
                    'position' =>
                    array(
                        'desktop' =>
                        array(
                            'value' => $post["layout"]["position"]["desktop"]["value"],
                            'offset' => (int)$post["layout"]["position"]["desktop"]["offset"],
                            'hide' => $post["layout"]["position"]["desktop"]["hide"] == "true" ? true : false,
                        ),
                        'mobile' =>
                        array(
                            'value' => $post["layout"]["position"]["mobile"]["value"],
                            'offset' => (int)$post["layout"]["position"]["mobile"]["offset"],
                            'hide' => $post["layout"]["position"]["mobile"]["hide"] == "true" ? true : false,
                        ),
                    ),
                ),
                'shares' =>
                array(
                    'total' => '0',
                )
            );

            return $payload;
        }
        public function social9GenerateApikeyByAccesstoken()
        {
            $Uid = isset($_POST['user_id']) ? trim($_POST['user_id']) : "";
            $accessToken = isset($_POST['access_token']) ? trim($_POST['access_token']) : "";
            $output = array();
            $output["status"] = "error";
            if (empty($Uid)) {
                $output["message"] = _e("Uid is Required.", "Social9");
            } else if (empty($accessToken)) {
                $output["message"] = _e("Access Token is Required.", "Social9");
            } else {
                $output = $this->social9GenerateApikey($Uid, "WordPressAPI", $accessToken);
            }
            echo json_encode($output);
            wp_die();
        }
        public function social9Register()
        {
            $name = isset($_POST['name']) ? trim($_POST['name']) : "";
            $email = isset($_POST['email']) ? trim($_POST['email']) : "";
            $password = isset($_POST['password']) ? trim($_POST['password']) : "";
            $output = array();
            $output["status"] = "error";
            if (empty($name)) {
                $output["message"] = _e("Name is Required.", "Social9");
            } else if (!is_email($email)) {
                $output["message"] = _e("Email is Invalid.", "Social9");
            } else if (empty($password)) {
                $output["message"] = _e("Password is Required.", "Social9");
            } else {
                $registerData = $this->s9sdk->register($name, $email, $password);
                if (isset($registerData["Description"]) && !empty($registerData["Description"])) {
                    $output["data"] = $registerData;
                } else {
                    if (isset($registerData["Data"]['access_token']) && !empty($registerData["Data"]['access_token'])) {
                        $this->s9sdk->createWidget($registerData["Data"]["Profile"]["Uid"], $registerData["Data"]["access_token"], json_decode(get_option('social9_guest_widget')));
                        delete_option('social9_guest_widget');
                        $this->social9GenerateApikey($registerData["Data"]["Profile"]["Uid"], "WordPressAPI", $registerData["Data"]["access_token"]);
                    }
                }
            }
            //save plugin options data user_id and apikey
            echo json_encode($output);
            wp_die();
        }
        public function social9GenerateApikey($uid, $keyLabel, $accessToken)
        {
            $output = array();
            $output["status"] = "error";
            if (empty($uid)) {
                $output["message"] = _e("user_id is Required.", "Social9");
            } else if (empty($keyLabel)) {
                $output["message"] = _e("API Name is Required.", "Social9");
            } else if (empty($accessToken)) {
                $output["message"] = _e("access_token is Required.", "Social9");
            } else {
                $output["status"] = "success";
                $output["data"] = $this->s9sdk->generateApikey($uid, $keyLabel, $accessToken);
                if (isset($output["data"]["apikey"]) && !empty($output["data"]["apikey"])) {
                    S9_Social_Sharing::set_options(array(
                        'account_id' => $output["data"]["user_id"],
                        'apikey' => $output["data"]["apikey"],
                        'access_token' => $accessToken
                    ));
                }
            }
            //save plugin options data user_id and apikey
            echo json_encode($output);
            wp_die();
        }
        public function social9GetAccessToken()
        {
            $uid = isset($_POST['user_id']) ? trim($_POST['user_id']) : "";
            $apikey = isset($_POST['apikey']) ? trim($_POST['apikey']) : "";
            $output = array();
            $output["status"] = "error";
            if (empty($uid)) {
                $output["message"] = _e("user_id is Required.", "Social9");
            } else if (empty($apikey)) {
                $output["message"] = _e("apikey is Required.", "Social9");
            } else {

                $getAccessToken = $this->s9sdk->getAccessToken($uid, $apikey);
                if (isset($getAccessToken["access_token"]) && !empty($getAccessToken["access_token"])) {
                    S9_Social_Sharing::set_options(array(
                        'account_id' => $uid,
                        'apikey' => $apikey,
                        'access_token' => $getAccessToken["access_token"]
                    ));
                    $output["status"] = "success";
                    $output["data"] = array("apikey" => $apikey);
                }
            }
            //save plugin options data user_id and apikey
            echo json_encode($output);
            wp_die();
        }
    }
    new S9_Activation_Admin();
}
