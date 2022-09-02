<?php
/**
 * Plugin Name: Linguise
 * Plugin URI: https://www.linguise.com/
 * Description: Linguise translation plugin
 * Version: 1.9.6
 * Text Domain: linguise
 * Domain Path: /languages
 * Author: Linguise
 * Author URI: https://www.linguise.com/
 * License: GPL2
 */

use Linguise\Vendor\Linguise\Script\Core\Configuration;

defined('ABSPATH') || die('');

// Check plugin requirements
$curlInstalled = function_exists('curl_version');
$phpVersionOk = version_compare(PHP_VERSION, '7.0', '>=');
if (!$curlInstalled || !$phpVersionOk) {
    add_action('admin_init', function () {
        if (current_user_can('activate_plugins') && is_plugin_active(plugin_basename(__FILE__))) {
            deactivate_plugins(__FILE__);
            // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Internal function used
            unset($_GET['activate']);
        }
    });
    add_action('admin_notices', function () use ($curlInstalled, $phpVersionOk) {
        echo '<div class="error">';
        if (!$curlInstalled) {
            echo '<p><strong>Curl php extension is required</strong> to install Linguise, please make sure to install it before installing Linguise again.</p>';
        }
        if (!$phpVersionOk) {
            echo '<p><strong>PHP 7.0 is the minimal version required</strong> to install Linguise, please make sure to update your PHP version before installing Linguise.</p>';
        }
        echo '</div>';
    });
    // Do not load anything more
    return;
}

define('LINGUISE_VERSION', '1.9.6');
define('LINGUISE_PLUGIN_URL', plugin_dir_url(__FILE__));
define('LINGUISE_PLUGIN_PATH', plugin_dir_path(__FILE__));

register_activation_hook(__FILE__, function () {
    if (!get_option('linguise_install_time', false)) {
        add_option('linguise_install_time', time());
    }
});

include_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'install.php');

/**
 * Get options
 *
 * @return array|mixed|void
 */
function linguiseGetOptions()
{
    $defaults = array(
        'token' => '',
        'default_language' => 'en',
        'enabled_languages' => array(),
        'flag_display_type' => 'popup',
        'display_position' => 'bottom_right',
        'enable_flag' => 1,
        'enable_language_name' => 1,
        'flag_shape' => 'rounded',
        'flag_en_type' => 'en-us',
        'flag_de_type' => 'de',
        'flag_es_type' => 'es',
        'flag_pt_type' => 'pt',
        'flag_border_radius' => 0,
        'flag_width' => 24,
        'browser_redirect' => 0,
        'language_name_display' => 'en',
        'pre_text' => '',
        'post_text' => '',
        'alternate_link' => 1,
        'add_flag_automatically' => 1,
        'custom_css' => '',
        'cache_enabled' => 1,
        'cache_max_size' => 200,
        'language_name_color' => '#222',
        'language_name_hover_color' => '#222',
        'flag_shadow_h' => 3,
        'flag_shadow_v' => 3,
        'flag_shadow_blur' => 6,
        'flag_shadow_spread' => 0,
        'flag_shadow_color' => '#bfbfbf',
        'flag_hover_shadow_h' => 3,
        'flag_hover_shadow_v' => 3,
        'flag_hover_shadow_blur' => 6,
        'flag_hover_shadow_spread' => 0,
        'flag_hover_shadow_color' => '#bfbfbf',
        'search_translation' => 0,
        'debug' => false
    );
    $options = get_option('linguise_options');
    if (!empty($options) && is_array($options)) {
        $options = array_merge($defaults, $options);
    } else {
        $options = $defaults;
    }
    return $options;
}

if (wp_doing_ajax()) {
    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'debug.php');
    return;
}

$languages_content = file_get_contents(dirname(__FILE__) . '/assets/languages.json');
$languages_names = json_decode($languages_content);

include_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'install.php');
include_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'switcher.php');
include_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'frontend/browser_language.php');
include_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'woocommerce.php');

include_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'configuration.php');
include_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'admin/menu.php');

register_deactivation_hook(__FILE__, 'linguiseUnInstall');
/**
 * UnInstall plugin
 *
 * @return void
 */
function linguiseUnInstall()
{
    global $wp_filesystem;
    if (empty($wp_filesystem)) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        WP_Filesystem();
    }

    // Save htaccess content
    $htaccess_path = ABSPATH . DIRECTORY_SEPARATOR . '.htaccess';
    $htaccess_content = $wp_filesystem->get_contents($htaccess_path);
    if ($wp_filesystem->exists($htaccess_path) && is_writable($htaccess_path)) {
        if (strpos($htaccess_content, '#### LINGUISE DO NOT EDIT ####') !== false) {
            $htaccess_content = preg_replace('/#### LINGUISE DO NOT EDIT ####.*?#### LINGUISE DO NOT EDIT END ####/s', '', $htaccess_content);
            $wp_filesystem->put_contents($htaccess_path, $htaccess_content);
        }
    }
}

add_action('admin_notices', function () {
    $translate_plugins = array(
        'sitepress-multilingual-cms/sitepress.php' => 'WPML Multilingual CMS',
        'polylang/polylang.php' => 'Polylang',
        'polylang-pro/polylang.php' => 'Polylang Pro',
        'translatepress-multilingual/index.php' => 'TranslatePress',
        'weglot/weglot.php' => 'Weglot',
        'gtranslate/gtranslate.php' => 'GTranslate',
        'conveythis-translate/index.php' => 'ConveyThis',
        'google-language-translator/google-language-translator.php' => 'Google Language Translator',
    );

    foreach ($translate_plugins as $path => $plugin_name) {
        if (is_plugin_active($path)) {
            echo '<div class="error">';
            echo '<p>'. sprintf(esc_html__('We\'ve detected that %s translation plugin is installed. Please disable it before using Linguise to avoid conflict with translated URLs mainly', 'linguise'), '<strong>'. esc_html($plugin_name) .'</strong>') .'</p>';
            echo '</div>';
        }
    }
});

add_action('parse_query', function ($query_object) {
    $linguise_original_language = false;
    foreach ($_SERVER as $name => $value) {
        if (substr($name, 0, 5) === 'HTTP_') {
            $key = str_replace(' ', '-', strtolower(str_replace('_', ' ', substr($name, 5))));
            if ($key === 'linguise-original-language') {
                $linguise_original_language = $value;
                break;
            }
        }
    }

    if (!$linguise_original_language) {
        return;
    }

    $options = linguiseGetOptions();

    if (!$options['search_translation']) {
        return;
    }

    if ($query_object->is_search()) {
        $raw_search = $query_object->query['s'];

        define('LINGUISE_SCRIPT_TRANSLATION', 1);
        define('LINGUISE_SCRIPT_TRANSLATION_VERSION', 'wordpress_plugin/1.9.6');
        include_once('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

        Configuration::getInstance()->set('cms', 'wordpress');
        Configuration::getInstance()->set('token', $options['token']);

        $translation = \Linguise\Vendor\Linguise\Script\Core\Translation::getInstance()->translateJson(['search' => $raw_search], site_url(), $linguise_original_language, '/');

        if (empty($translation->search)) {
            return;
        }

        $query_object->set('s', $translation->search);
    }
});

/**
 * First hook available to check if we should translate this request
 *
 * @return void
 */
function linguiseFirstHook()
{
    static $run = null;

    if ($run) {
        return;
    }
    $run = true;

    // Check if it has been already called or not
    if (is_admin()) {
        return;
    }

    $linguise_options = linguiseGetOptions();

    if (!$linguise_options['token']) {
        return;
    }

    include_once('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

    $base_dir = site_url('', 'relative');
    $path = substr($_SERVER['REQUEST_URI'], strlen($base_dir));

    $path = parse_url('https://localhost/' . ltrim($path, '/'), PHP_URL_PATH);

    $parts = explode('/', trim($path, '/'));

    if (!count($parts) || $parts[0] === '') {
        return;
    }

    $language = $parts[0];

    if (!in_array($language, array_merge($linguise_options['enabled_languages'], array('zz-zz')))) {
        return;
    }

    $_GET['linguise_language'] = $language;

    if (is_plugin_active('woocommerce/woocommerce.php')) {
        define('LINGUISE_SCRIPT_TRANSLATION_WOOCOMMERCE', true);
    }

    include_once('script.php');
}
add_action('muplugins_loaded', 'linguiseFirstHook', 1);
add_action('plugins_loaded', 'linguiseFirstHook', 1);
