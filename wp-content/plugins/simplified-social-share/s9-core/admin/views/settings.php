<?php
// Exit if called directly
if (!defined('ABSPATH')) {
    exit();
}

/**
 * The main class and initialization point of the plugin settings page.
 */
if (!class_exists('S9_Core_Settings')) {

    class S9_Core_Settings
    {
        public static function login_page()
        {
            global $current_user;
            wp_enqueue_script('lr-script', 'https://auth.lrcontent.com/v2/LoginRadiusV2.js', array('jquery'));
?>
            <section class="s9_form_view">
                <div class="s9_section-header">
                    <h1>Login</h1>
                </div>
                <div class="s9-message"></div>
                <script type="text/html" id="loginradiuscustom_tmpl">
                <# if(Name != "FacebookOAuth"){ #>
                    <button class="s9-provider-<#=Name.toLowerCase() #>" onclick="return LRObject.util.openWindow('<#=Endpoint #>');" title="<#=Name #>" alt="Sign in with <#=Name #>">
                    <img src="<?php echo S9_CORE_URL . '/assets/images/<#=Name.toLowerCase() #>.svg';?>" alt="<#=Name #>">
                    Sign in with <#=Name #>
                    </button>
                    <# } #>
                </script>
                <div id="interfacecontainerdiv" class="interfacecontainerdiv"></div>

                <div class="seprator">
                    <div class="d-flex align-items-center justify-content-center">or</div>
                </div>


                <div class="s9_form-group">
                    <label for="s9_login_email">Email:</label>
                    <input id="s9_login_email" type="email" value="<?php echo $current_user->user_email; ?>" />
                </div>
                <div class="s9_form-group">
                    <label for="s9_login_password">Password:</label>
                    <input id="s9_login_password" type="password" />
                </div>
                <div class="btn-wrap full-width">
                    <div class="btn btn-primary" id="s9_login_submit">Login</div>
                </div>
            </section>
        <?php
        }
        public static function manual_page()
        {
        ?>
            <section class="s9_form_view">
                <div class="s9_section-header">
                    <h1>Manual Setup</h1>
                </div>
                <div class="s9-message"></div>
                <div class="s9_form-group">
                    <label for="s9_account_id">Account Id:</label>
                    <input id="s9_account_id" type="text" />
                </div>
                <div class="s9_form-group">
                    <label for="s9_account_apikey">API key:</label>
                    <input id="s9_account_apikey" type="text" />
                </div>
                <div class="btn-wrap full-width">
                    <div class="btn btn-primary" id="s9_manual_submit">Save</div>
                </div>
            </section>
        <?php
        }
        public static function register_page()
        {
            global $current_user;
        ?>
            <section class="s9_form_view">
                <div class="s9_section-header">
                    <h1>Register</h1>
                </div>
                <div class="s9-message"></div>
                <div class="s9_form-group">
                    <label for="s9_register_name">Name:</label>
                    <input id="s9_register_name" type="text" value="<?php echo $current_user->display_name; ?>" />
                </div>
                <div class="s9_form-group">
                    <label for="s9_register_email">Email:</label>
                    <input id="s9_register_email" type="email" value="<?php echo $current_user->user_email; ?>" />
                </div>
                <div class="s9_form-group">
                    <label for="s9_register_password">Password:</label>
                    <input id="s9_register_password" type="password" />
                </div>
                <div class="btn-wrap full-width">
                    <div class="btn btn-primary" id="s9_register_submit">Register</div>
                </div>
                <div class="s9_description">
                    <p class="mb-0">
                        Already have Social9 account! <a href="<?php echo admin_url(); ?>admin.php?page=social9&action=login">Click here</a> to Login.
                    </p>
                    <!--<p>
                        Or
                        <a href="<?php echo admin_url(); ?>admin.php?page=social9&action=manual">Link you Social9 account manully with WordPress</a>
                    </p>-->
                </div>
            </section>
        <?php
        }

        private static function welcome_page()
        {
        ?>
            <section>
                <div class="s9_section-header">
                    <h1>Welcome to Social9!</h1>
                    <p>
                        Thanks for choosing Socail9! To get started, select and configure
                        a share button. You can always configure second type button later.
                    </p>
                </div>
                <div class="s9_button-wrapper">
                    <?php
                    foreach (array('inline', 'floating') as $type) {
                    ?>
                        <a href="admin.php?page=social9_share&action=guest&type=<?php echo $type; ?>">
                            <div class="s9_sharing-buttons">
                                <div class="s9_icon">
                                    <img src="<?php echo S9_SHARE_PLUGIN_URL . 'assets/images/' . $type . '.svg'; ?>" />
                                </div>
                                <div class="s9_buttonlabel"><?php echo ucfirst($type); ?> Sharing Button</div>
                            </div>
                        </a>
                    <?php
                    }
                    ?>
                </div>
                <div class="s9_description">
                    <p class="mb-0">
                        Already have Social9 account! <a href="<?php echo admin_url(); ?>admin.php?page=social9&action=login">Click here</a> to Login.
                    </p>
                    <!--<p>
                        Or
                        <a href="<?php echo admin_url(); ?>admin.php?page=social9&action=manual">Link you Social9 account manully with WordPress</a>
                    </p>-->
                </div>
            </section>
        <?php
        }
        public static function render_options_page()
        {
        ?>
            <div id="s9_root">
                <?php do_action('s9_admin_header_ui'); ?>
                <div class="s9_main">
                    <?php
                    if (isset($_POST['reset']) && current_user_can('manage_options')) {
                        S9_Core::reset_share_options();
                        echo '<p style="display:none;" class="s9-alert-box s9-notif">Sharing settings have been reset and default values have been applied to the plug-in</p>';
                        echo '<script type="text/javascript">jQuery(function(){jQuery(".s9-notif").slideDown().delay(3000).slideUp();});</script>';
                    }
                    $social9_account_id = get_option('social9_account_id');
                    $social9_apikey = get_option('social9_apikey');
                    $action = !empty($_GET['action']) ? trim($_GET['action']) : "welcome";
                    if (!empty($social9_account_id) && !empty($social9_apikey)) {
                        do_action('s9_reset_admin_ui', 'Social Sharing');
                    } else {
                        if ($action == "login") {
                            self::login_page();
                        } else if ($action == "register") {
                            self::register_page();
                        } /*else if ($action == "manual") {
                            self::manual_page();
                        } */ else {
                            self::welcome_page();
                        }
                    ?>
                </div>
            </div>
<?php
                        wp_enqueue_style("s9-googleapis", "https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;display=swap", array(), S9_PLUGIN_VERSION);
                        wp_enqueue_script('ajax-script', S9_CORE_URL . '/assets/js/ajax.js', array('jquery'));
                        wp_localize_script('ajax-script', 's9_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
                    }
					do_action('s9_create_mailazy_ui');
                }
            }
        }
